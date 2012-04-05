<?php
/**
	* News Controller class
	* PHP versions 5.1.4
	* @date 30-Dec-2011
	* @Purpose:This controller handles all the functionalities regarding News management.
	* @filesource
	* @author     Pankhi Ahluwalia
	* @revision
	* @copyright  Copyright ? 2011 Netset Solutions
	* @version 0.0.1 
**/
App::import('Sanitize');
class NewsController extends AppController {

	var $name = 'News';

    /**
	* Specifies helpers classes used in the view pages
	* @access public
    */
    var $helpers    	=  array('Html', 'Form', 'Javascript','Session','General');
    /**
	* Specifies components classes used
	* @access public
    */
    var $components 	=  array('RequestHandler','Common','Upload');

    var $paginate	   =  array();

    var $uses          =  array('News');

/******************************* START FUNCTIONS **************************/
#_________________________________________________________________________#

    /**
    * @Date: 30-Dec-2011
    * @Method : beforeFilter
    * @Purpose: This function is called before any other function.
    * @Param: none
    * @Return: none 
    **/
    function beforeFilter(){
	//
     if(!empty($this->params['prefix']) && $this->params['prefix'] == "admin"){
			$this->checkUserSession();
		}
		else
		{	
		}
		$this->layout="layout_admin";
		$this->set('common',$this->Common);
    }

    function index() {
     $this->set('title_for_layout', 'News');
    }
 

    /**
    * @Date:30-Dec-2011
    * @Method : list
    * @Purpose: This function is to show news.
    * @Param: none
    * @Return: none 
    **/
   function admin_list(){
	
	$this->set('title_for_layout', 'News Listing');
	$this->set("search1", "");
	$this->set("search2", "");
	$criteria = "1";
	
	// Delete user (single/multiple)
	if(isset($this->params['form']['delete']) || isset($this->params['pass'][0]) == "delete"){
		if(isset($this->params['form']['IDs'])){
			$deleteString = implode("','",$this->params['form']['IDs']);
		}elseif(isset($this->params['pass'][1])){
			$deleteString = $this->params['pass'][1];
		}
		
		if(!empty($deleteString)){
			$this->News->deleteAll("News.id in ('".$deleteString."')");
			$this->Session->setFlash("<div class='success-message flash notice'>News(s) deleted successfully.</div>");
			$this->redirect('list');
		}
	}
	if(isset($this->data['News']) || !empty($this->params['named'])) {
		if(!empty($this->data['News']['fieldName']) || isset($this->params['named']['field'])){
			if(trim(isset($this->data['News']['fieldName'])) != ""){
			$search1 = trim($this->data['News']['fieldName']);
			}elseif(isset($this->params['named']['field'])){
			$search1 = trim($this->params['named']['field']);
			}
		$this->set("search1",$search1);
		}
		if(isset($this->data['News']['value1']) || isset($this->params['named']['value'])){
			if(isset($this->data['News']['value1'])){
			$search2 = trim($this->data['News']['value1']);
			}elseif(isset($this->params['named']['value'])){
			$search2 = trim($this->params['named']['value']);
			}
		$this->set("search2",$search2);
		}
		 
		/* Searching starts from here */
		if(!empty($search1) && (!empty($search2) )){
			$criteria = $search1." LIKE '%".Sanitize::escape($search2)."%'";
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
			$messageStr = "<div class='success-message flash notice'>Selected News(s) have been activated.</div>";
		}elseif(isset($this->params['form']['unpublish'])){
			$setValue = array('status' => "'0'");
			$messageStr = "<div class='success-message flash notice'>Selected News(s) have been deactivated.</div>";
		}
		if(!empty($setValue)){
			if(isset($this->params['form']['IDs'])){
				$saveString = implode("','",$this->params['form']['IDs']);
			}
			if($saveString != ""){
				$this->News->NewsAll($setValue,"News.id in ('".$saveString."')");
				$this->Session->setFlash($messageStr);
			}
		}
		$this->paginate = array(
			    'fields' => array(
				'News.id',
				'News.summary',
				'News.image',
				'News.status',
				'News.published_on',				
				'News.created'
			    ),
			    'conditions' => array(),
			    'page'=> 1,
			    'limit' => RECORDS_PER_PAGE,
			    'order' => array('News.id' => 'desc')
			    );
	
	$data = $this->paginate('News',$criteria);
	$this->set('resultData', $data);
    }

   #_________________________________________________________________________#

    /**
    * @Date: 14-Sep-2011
    * @Method : admin_add
    * @Purpose: Function to add countries.
    * @Param: $id
    * @Return: none
    **/

    function admin_add($id = null) {
	
	// to check permission to for particular action of controller
	//$this->checkAccess();	
	if(!empty($id) || !empty($this->data['News']['id'])){
			$this->pageTitle = "Edit News";
			$this->set("pageTitle","Edit News");
			$mode = "edit";
		}else{
			$this->pageTitle = "Add News";
			$this->set("pageTitle","Add News");
			$mode = "add";
		}	
	if($this->data){ 
	
	$this->data['News']['published_on'] = date('Y/m/d h:i:s', strtotime($this->data['News']['published']));
			if($mode == "edit" && $this->data['News']['image']['size']<=0){

				unset($this->data['News']['image']);
			 }
		$this->News->set($this->data['News']);
		$isValidated=$this->News->validates();
		 if($isValidated){
				if(!empty($this->data['News']['image']) && $this->data['News']['image']['size']>0){
					$destination=realpath('../../app/webroot/img/products/news') . DS;
					$file= $this->data['News']['image'];
					$small=explode(".",$file['name']);
				    $small=$small['0']."-small.".$small['1']; 
				    $criteria=array(
							  'conditions'=>array('News.id'=>$this->data['News']['id']),
							  'fields'=>array("News.image")
							  );
					$image=$this->News->find("first",$criteria);
					@unlink($destination.$image['News']['image']); //Remove the existing image		
						$result1 = $this->Upload->upload($file, $destination,  $small, array('type' => 'resizecrop', 'size' => array('195', '150')));
						$result = $this->Upload->upload($file, $destination, $file['name'], array('type' => 'resizecrop', 'size' => array('325', '250')));
						$this->data['News']['image'] = $this->data['News']['image']['name'];	
				}
				else{
					unset($this->data['News']['image']);
				}
				   $data=$this->data['News'];
				 $this->News->saveAll($this->data['News'], array('validate'=>false));
				
					if($mode == "add"){
						$this->Session->setFlash("<div class='success-message flash notice'>News has been created successfully.</div>");
					}else{
						$this->Session->setFlash("<div class='success-message flash notice'>News has been Newsd successfully.</div>");
					}
				  $this->redirect('list');
			}else{
				$this->set("Error",$this->News->invalidFields());
			}
		}
       else if(!empty($id)){		
			$this->data = $this->News->find('first', array('conditions'=>array('id'=>Sanitize::escape($id))));	
			$this->data['News']['published'] = date('m/d/Y', strtotime($this->data['News']['published_on']));
		    
		}
    }

   #_________________________________________________________________________#

    /**
    * @Date: 14-Sep-2011
    * @Method : admin_view
    * @Purpose: Function to view a News.
    * @Param: $id
    * @Return: none
    **/
    
    function admin_view($id = null) {
	if(isset($id) && is_numeric($id)){
		$result = $this->News->findById($id);
		if($result){
			$this->set('result',$result);
		}else{
			$this->redirect('list');
		}
	}else{
		$this->redirect('list');
	}
    }
    #_________________________________________________________________________#

    /**
    * @Date: 14-Sep-2011
    * @Method : admin_view
    * @Purpose: Function to view a News.
    * @Param: $id
    * @Return: none
    **/
    
    function viewNews() {
	
	$result = $this->News->find('all');
	$this->set("result",$result);
    }
	
	#_________________________________________________________________________#

    /**
    * @Date: 14-Dec-2011
    * @Method :Details
    * @Purpose: Function to details of rhe news
    * @Param: $id
    * @Return: none
    **/
	
	function details(){	
	    $this->layout="layout_inner";
    	$this->pageTitle = "News";
		$this->set("pageTitle","Latest News - NetSet Software");	
		$this->set("title_for_layout","NetSet Software:: Software Development Company India | Custom Software Application Development | Outsource Web Development Services");
		$this->paginate = array(
		        'fields' => array(
                'id',
				'title',
			    'description',
				'image',	
			    ),
				//'conditions'=>array('published'=>'1')
			    'order' => array('id' => 'desc')
			    );
	$data = $this->paginate('News');
    $this->set('resultData', $data);
  }

}

?>