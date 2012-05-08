<?php

	/**
	* Employees Controller class
	* PHP versions 5.1.4
	* @date 26-April-2012
	* @Purpose:This controller handles all the functionalities regarding user management.
	* @filesource
	* @author     Neema Tiwari
	* @revision
	* @version 0.0.1
	**/
	App::import('Sanitize');

class EmployeesController extends AppController
	{
    var $name       	=  "Employees";

   /**
	* Specifies helpers classes used in the view pages
	* @access public
    */

    var $helpers    	=  array('Html', 'Form', 'Javascript', 'Session','General');

    /**
	* Specifies components classes used
	* @access public
    */

    var $components 	=  array('Common','Upload');
    var $paginate		  =  array();
    var $uses       	=  array('User','Employee','Role'); // For Default Model

	/******************************* START FUNCTIONS **************************/



	#_________________________________________________________________________#

    /**
    * @Date: 28-Dec-2011
    * @Method : beforeFilter
    * @Purpose: This function is called before any other function.
    * @Param: none
    * @Return: none 
    **/

    function beforeFilter(){

		if(!empty($this->params['prefix']) && $this->params['prefix'] == "admin"){
			$this->checkUserSession();
		}else{                                                   
		$this->layout="layout_front";
		}$this->set('common',$this->Common);    
    }

    #_________________________________________________________________________#

    /**
    * @Date: 18-Apr-2012
    * @Method : index
    * @Purpose: This page will render home page
    * @Param: none
    * @Return: none 
    **/

	function index() {
    $this->set("title_for_layout","ERP :: NetSet Software - Empowering Innovation with Excellence!");
 
    }

	#_________________________________________________________________________#

    /**
    * @Date: 28-Dec-2011
    * @Method : admin_index
    * @Purpose: This is the default function of the administrator section for users
    * @Param: none
    * @Return: none 
    **/

	function admin_index() {
			$this->render('admin_login');
		if($this->Session->read("SESSION_ADMIN") != ""){

			$this->redirect(array("controller"=>"users","action"=>'dashboard'));
		}
    }

	#_________________________________________________________________________#

    /**
    * @Date: 11-Aug-2011
    * @Method : admin_list
    * @Purpose: This function is to show list of users in system.
    * @Param: none
    * @Return: none 
    **/

    function admin_list(){

		$this->set("title_for_layout", "Employees Listing");
		$this->set("pageTitle","Credentials Listing");             
		$this->set("search1", "");                                 
		$this->set("search2", "");                                 
		$criteria = "1"; //All Searching
		$this->Session->delete('SESSION_SEARCH');
			 
//print_($this->data); die;

// Delete user and its licences and orders(single/multiple)

		if(isset($this->params['form']['delete']) || isset($this->params['pass'][0]) == "delete"){

		if(isset($this->params['form']['IDs'])){

			$deleteString = implode("','",$this->params['form']['IDs']);
		}elseif(isset($this->params['pass'][1])){

			$deleteString = $this->params['pass'][1];
		}

		if(!empty($deleteString)){

			$this->User->deleteAll("User.id in ('".$deleteString."')");
			$this->Session->setFlash("<div class='success-message flash notice'>Employee(s) deleted successfully.</div>", 'layout_success');
			$this->redirect('list');
		}
	}
	 if(isset($this->data['User']) || !empty($this->params['named'])) {      
      if(!empty($this->data['User']['fieldName']) || isset($this->params['named']['field'])){                                                                 
        if(trim(isset($this->data['User']['fieldName'])) != ""){                
        $search1 = trim($this->data['User']['fieldName']);                      
        }elseif(isset($this->params['named']['field'])){                              
        $search1 = trim($this->params['named']['field']);                             
        }
        
        $this->set("search1",$search1);                                               
      }
      
      if(isset($this->data['User']['value1']) || isset($this->data['User']['value2']) || isset($this->params['named']['value'])){                  
      if(isset($this->data['User']['value1']) || isset($this->data['User']['value2'])){                                                            
      $search2 = ($this->data['User']['fieldName'] != "User.status")?trim($this->data['User']['value1']):$this->data['User']['value2'];      
      }elseif(isset($this->params['named']['value'])){       
      $search2 = trim($this->params['named']['value']);      
      }                                                      
      $this->set("search2",$search2);                        
      }
      
      /* Searching starts from here */                                               
      if(!empty($search1) && (!empty($search2) || $search1 == "User.status")){                                                                           
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
			$messageStr = "Selected employee(s) have been activated.";
		}elseif(isset($this->params['form']['unpublish'])){

			$setValue = array('status' => "'0'");
			$messageStr = "Selected employee(s) have been deactivated.";
		}

		if(!empty($setValue)){

		if(isset($this->params['form']['IDs'])){

			$saveString = implode("','",$this->params['form']['IDs']);
			}
		if($saveString != ""){

				$this->User->updateAll($setValue,"User.id in ('".$saveString."')");
				$this->Session->setFlash($messageStr, 'layout_success');
			}
		}

//pr($this->Session->read('SESSION_ADMIN'));

// If Admin is login then all records else only loggedin user record

		$this->paginate = array(
		'fields' => array(
		'User.id',
		'User.first_name',
		'User.employee_code',
		'User.current_salary',
		'User.email',
		'User.phone',
		'User.status',
		'User.created'
		),
			'conditions' => array(),
			'page'=> 1,'limit' => RECORDS_PER_PAGE,
			'order' => array('User.id' => 'desc')
		);
	$data = $this->paginate('User',$criteria);
	$this->set('resultData', $data);
    }

	#_________________________________________________________________________#

    /**
    * @Date: 21-Aug-2011
    * @Method : admin_add
    * @Purpose: This function is to add/edit user from admin section.
    * @Param: $id
    * @Return: none 
    * @Return: none 
    **/

	function admin_add($id = null) {

		if(!empty($id) || !empty($this->data['User']['id'])){

			$this->set("title_for_layout", "Edit Employee");
			$mode = "edit";

		}else{

			$this->set("title_for_layout", "Add Employee");
			$mode = "add";

		}

		if($this->data){
		
			$this->Employee->set($this->data['Employee']);
			$isValidated = $this->Employee->validates();
			if($isValidated){
				$this->data['Employee']['role_id'] = implode(",",$this->data['Employee']['role_id']);
				$this->data['Employee']['doj'] = $this->data['Employee']['doj_year'].'-'.$this->data['Employee']['doj_month'].'-'.$this->data['Employee']['doj_date'];
				$this->data['Employee']['dor'] = $this->data['Employee']['dor_year'].'-'.$this->data['Employee']['dor_month'].'-'.$this->data['Employee']['dor_date'];
				$this->data['Employee']['dob'] = $this->data['Employee']['dob_year'].'-'.$this->data['Employee']['dob_month'].'-'.$this->data['Employee']['dob_date'];
				//pr($this->data['Employee']); die;
				$this->Employee->save($this->data, array('validate'=>false));
				if($mode == "add"){
					$this->Session->setFlash("Employee has been created successfully.",'layout_success');
				}else{
					$this->Session->setFlash("Employee has been updated successfully.",'layout_success');
				}
				$this->redirect(array('action' => 'list'));

			}else{
				$this->set("Error",$this->Employee->invalidFields());
			}
		}else if(!empty($id)){

			$this->data = $this->Employee->find('first', array('conditions'=>array('id'=>Sanitize::escape($id))));
			if(!empty($this->data['Employee']['doj'])){
				$doj = explode('-',$this->data['Employee']['doj']);
				$this->data['Employee']['doj_year'] = $doj[0];
				$this->data['Employee']['doj_month'] = $doj[1];
				$this->data['Employee']['doj_date'] = $doj[2];
			}
			if(!empty($this->data['Employee']['dor'])){
				$dor = explode('-',$this->data['Employee']['dor']);
				$this->data['Employee']['dor_year'] = $dor[0];
				$this->data['Employee']['dor_month'] = $dor[1];
				$this->data['Employee']['dor_date'] = $dor[2];
			}
			if(!empty($this->data['Employee']['dob'])){
				$dob = explode('-',$this->data['Employee']['dob']);
				$this->data['Employee']['dob_year'] = $dob[0];
				$this->data['Employee']['dob_month'] = $dob[1];
				$this->data['Employee']['dob_date'] = $dob[2];
			}
			if(!empty($this->data['Employee']['role_id'])){
				$this->data['Employee']['role_id'] = explode(",",$this->data['Employee']['role_id']);
			}
			if(!$this->data){
				$this->redirect(array('action' => 'list'));

			}

		}

	}

	/**
   * @method      : download
   * @description : Used to download Employee record
   * @param       : type
   * return       : none
**/
	function admin_download()
	{              
	
	 if(empty($this->params['pass'][0])){
		$search = $this->Session->read('SESSION_SEARCH');
	   $crData = $this->User->find('all', array('conditions'=>$search)); //fetching all data
   }else{
    $crData = $this->User->find('all' , array('conditions'=>array('type'=>$this->params['pass'][0]),'order'=>'first_name ASC')); //fetching all related data                                           
	}	
    $this->set('crData',$crData); //Setting Employee Data                             
	$this->layout = 'pdf'; //this will use the pdf.ctp layout
	$this->render();	
	}	// end of download function
	
   #_________________________________________________________________________#


    /**
    * @Date: 23-Apr-2012
    * @Method : export
    * @Purpose: This function is used to show Employee Report in Excel format
    * @Param: none
    * @Return: none
    **/
    function admin_exportci(){

 
	 if(empty($this->params['pass'][0])){
	   $search = $this->Session->read('SESSION_SEARCH');
	   $crData = $this->User->find('all', array('conditions'=>$search)); //fetching all data
   }else{                                              
    $crData = $this->User->find('all' , array('conditions'=>array('type'=>$this->params['pass'][0]),'order'=>'first_name ASC')); //fetching all related data                                           
	}
	//setting excel parametres
	$this->set('filename',"UserReport_".date("Ymd"));
    $this->set('crData',$crData); //Setting Employee Data
	$this->layout = "export_xls";
    }
	
	#_________________________________________________________________________#


    /**
    * @Date: 30-Apr-2012
    * @Method : uploadPic
    * @Purpose: This function is used to upload employee pic
    * @Param: $id
    * @Return: none
    **/
	
	function uploadPic($id = null){
		if (!empty($_FILES)) {
			$destination = realpath('../../app/webroot/img/employee_image'). DS;					
			$file = $_FILES['uploadfile'];
			$filename = $id.'_'.time().'.'.strtolower($this->Common->file_extension($file['name']));
			$size=$_FILES['uploadfile']['size'];
			if($size>0){
				$files = $this->Common->get_files($destination,"/^".$id."_/i");
				if(!empty($files)){
					foreach($files as $x){
						@unlink($destination.$x);
					}
				}
				if(preg_match("/gif|jpg|jpeg|png/i",$this->Common->file_extension($file['name'])) > 0){
					$result = $this->Upload->upload($file, $destination, $filename,null,array('jpg','jpeg','gif','png','bmp'));
					echo "success";
					die;
				}
			}
		}
	}
	
	
}