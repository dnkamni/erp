<?php 

/**           
	* Credentials Controller class
	* PHP versions 5.3.5          
	* @date 18-Mar-2012           
	* @Purpose:This controller handles all the functionalities regarding Testimonial management.
	* @filesource                                                                          
	* @author  Sandeep Srivastava                                                          
	* @revision                                                                            
	* @version 1.3.12                                                                      
**/

App::import('Sanitize'); // To get rid of Malicious Data

class TestimonialsController extends AppController {

    var $name       	=  "Testimonials";    // Controller Name       	

    /**
    * Specifies helpers classes used in the view pages
    * @access public                                  
    */                                                      
    var $helpers    	=  array('Html', 'Form', 'Javascript', 'Session');
	

    /**
	  * Specifies components classes used
	  * @access public
    */              
    var $components 	 =  array('RequestHandler','Email','Common');   

    var $paginate		   =  array(); //pagination
                                            
    var $uses       	 =  array('Testimonial'); // For Default Model
    	

/******************************* START FUNCTIONS **************************/


	#_________________________________________________________________________#

    /**                                                           
    * @Date: 19-Apr-2012                                          
    * @Method : beforeFilter
    * @Purpose: This function is called before any other function.
    * @Param: none                                                
    * @Return: none                                               
    **/

    function beforeFilter(){ // This  function is called first before parsing this controller file
		$this->checkUserSession(); // Checking valid Session.
		$this->set('common',$this->Common);                  
		$this->layout = "layout_admin";
	}



    #_________________________________________________________________________#

    /**      
    * @Date: 19-Apr-2012        
    * @Method : index           
    * @Purpose: This function is the default function of the controller
    * @Param: none                                                     
    * @Return: none                                                    
    **/

    function index() {
    
      $this->render('login');
      
      if($this->Session->read("SESSION_USER") != ""){      
      $this->redirect('dashboard');                        
      }    
    }

	

	#_________________________________________________________________________#

    /**                         
    * @Date: 19-Apr-2012        
    * @Method : admin_list      
    * @Purpose: This function is to show list of Credentials in the System
    * @Param: none                                                        
    * @Return: none                                                       
    **/

    function admin_list(){
      $this->set('title_for_layout','Testimonials Listing');      
      $this->set("pageTitle","Testimonials Listing");             
      $this->set("search1", "");                                 
      $this->set("search2", "");                                 
      $criteria = "1"; //All Searching
	  $this->Session->delete('SESSION_SEARCH');
	

      // Delete user and its licences and orders(single/multiple)      
      if(isset($this->params['form']['delete']) || isset($this->params['pass'][0]) == "delete"){                                                      
      if(isset($this->params['form']['IDs'])){                         
        $deleteString = implode("','",$this->params['form']['IDs']);      
      }elseif(isset($this->params['pass'][1])){                         
        $deleteString = $this->params['pass'][1];                         
      }
      
      if(!empty($deleteString)){      
        $this->Testimonial->deleteAll("Testimonial.id in ('".$deleteString."')");
        $this->Session->setFlash("<div class='success-message flash notice'>Testimonial(s) deleted successfully.</div>", 'layout_success');
		$this->redirect('list');                                                  
      }
      
      }                  
      if(isset($this->data['Testimonial']) || !empty($this->params['named'])) {      
      if(!empty($this->data['Testimonial']['fieldName']) || isset($this->params['named']['field'])){                                                                 
        if(trim(isset($this->data['Testimonial']['fieldName'])) != ""){                
        $search1 = trim($this->data['Testimonial']['fieldName']);                      
        }elseif(isset($this->params['named']['field'])){                              
        $search1 = trim($this->params['named']['field']);                             
        }
        
        $this->set("search1",$search1);                                               
      }
      
      if(isset($this->data['Testimonial']['value1']) || isset($this->data['Testimonial']['value2']) || isset($this->params['named']['value'])){                  
      if(isset($this->data['Testimonial']['value1']) || isset($this->data['Testimonial']['value2'])){                                                            
      $search2 = ($this->data['Testimonial']['fieldName'] != "Testimonial.status")?trim($this->data['Testimonial']['value1']):$this->data['Testimonial']['value2'];      
      }elseif(isset($this->params['named']['value'])){       
      $search2 = trim($this->params['named']['value']);      
      }                                                      
      $this->set("search2",$search2);                        
      }
      
      /* Searching starts from here */                                               
      if(!empty($search1) && (!empty($search2) || $search1 == "Testimonial.status")){                                                                           
      $criteria = $search1." LIKE '%".Sanitize::escape($search2)."%'"; 
      $this->Session->write('SESSION_SEARCH', $criteria);
      }else{      
      $this->set("search1","");      
      $this->set("search2","");      
      }
      
      }
      
      if(isset($this->params['named'])){      
          $urlString = "/";                       
          $completeUrl  = array();
          
          if(!empty($this->params['named']['page']))      
          $completeUrl['page'] = $this->params['named']['page'];
          
          if(!empty($this->params['named']['sort']))                  
          $completeUrl['sort'] = $this->params['named']['sort'];
          
          if(!empty($this->params['named']['direction']))             
          $completeUrl['direction'] = $this->params['named']['direction'];
          
          if(!empty($search1))                                        
          $completeUrl['field'] = $search1;
          
          if(isset($search2))                                         
          $completeUrl['value'] = $search2;
          
          foreach($completeUrl as $key=>$value){                      
          $urlString.= $key.":".$value."/";                           
          }
      }
      
      $this->set('urlString',$urlString);      
      if(isset($this->params['form']['publish'])){      
      $setValue = array('status' => "'1'");             
      $messageStr = "Selected Testimonial(s) have been activated.";              
      }elseif(isset($this->params['form']['unpublish'])){
      $setValue = array('status' => "'0'");             
      $messageStr = "Selected Testimonial(s) have been deactivated.";            
      }
                                                       
      
      if(!empty($setValue)){                            
      if(isset($this->params['form']['IDs'])){          
      $saveString = implode("','",$this->params['form']['IDs']);      
      }
      
      if($saveString != ""){                                          
      $this->Testimonial->updateAll($setValue,"Testimonial.id in ('".$saveString."')");                                                                 
      $this->Session->setFlash($messageStr, 'layout_success');                          
      }
      
      }
      
      $this->paginate = array(                                        
      'fields' => array(                                              
      'id',           
      'author', 
	  'type', 
	   'keyword', 	  
      'description',
      'status',      
      'modified'           
      ),      
      'page'=> 1,'limit' => 10,      
      'order' => array('id' => 'desc')      
      );
      
      $data = $this->paginate('Testimonial',$criteria);      
      $this->set('resultData', $data);
	}                                                   
	

	#_________________________________________________________________________#

	function admin_add($id = null) {
		if(!empty($id) || !empty($this->data['Testimonial']['id'])){
		   $this->set('title_for_layout','Edit Testimonial');      
			 $this->pageTitle = "Edit Testimonial";
			 $this->set("pageTitle","Edit Testimonial");
			 $mode = "edit";
		}else{            
		   $this->set('title_for_layout','Add Testimonial');
			 $this->pageTitle = "Add Testimonial";
			 $this->set("pageTitle","Add Testimonial");
			 $mode = "add";
		}

			if($this->data){

			$this->Testimonial->set($this->data['Testimonial']);
			$isValidated=$this->Testimonial->validates();
		 
        if($isValidated){
				   $data=$this->data['Testimonial'];//post
				   $this->Testimonial->save($this->data['Testimonial'], array('validate'=>false));                                         
					if($mode == "add"){                    
						$this->Session->setFlash("Testimonial has been created successfully.",'layout_success');
					}else{                                  
						$this->Session->setFlash("Testimonial has been updated successfully.",'layout_success');
					}                                       
				  $this->redirect('list');                
			}else{                                      
				$this->set("Error",$this->Testimonial->invalidFields());
			}

		}else if(!empty($id)){       
			$this->data = $this->Testimonial->find('first', array('conditions'=>array('id'=>Sanitize::escape($id))));	                                                
			if(!$this->data){                                                         
				$this->redirect(array('action' => 'list'));                             
			}                                                                         
		}                                                                           
	}
  
 /**
   * @method      : download
   * @description : Used to download credentials record
   * @param       : type
   * return       : none
**/
	function admin_download()
	{              
	
	 if(empty($this->params['pass'][0])){
		$search = $this->Session->read('SESSION_SEARCH');
	   $crData = $this->Testimonial->find('all', array('conditions'=>$search)); //fetching all data
   }else{
    $crData = $this->Testimonial->find('all' , array('conditions'=>array('type'=>$this->params['pass'][0]),'order'=>'author')); //fetching all related data                                           
	}	
    $this->set('crData',$crData); //Setting Testimonial Data                             
	$this->layout = 'pdf'; //this will use the pdf.ctp layout
	$this->render();	
	}	// end of download function
	
   #_________________________________________________________________________#


    /**
    * @Date: 23-Apr-2012
    * @Method : export
    * @Purpose: This function is used to show Testimonial Report in Excel format
    * @Param: none
    * @Return: none
    **/
    function admin_exportci(){ 
	 if(empty($this->params['pass'][0])){
	   $search = $this->Session->read('SESSION_SEARCH');
	   $crData = $this->Testimonial->find('all', array('conditions'=>$search)); //fetching all data
   }else{                                              
    $crData = $this->Testimonial->find('all' , array('conditions'=>array('type'=>$this->params['pass'][0]),'order'=>'author')); //fetching all related data                                           
	}
	//setting excel parametres
	$this->set('filename',"TestimonialReport_".date("Ymd"));
    $this->set('crData',$crData); //Setting Testimonial Data
	$this->layout = "export_xls";
    }
                                                                               
}