<?php
/**
	* Static PagesController class
	* PHP versions 5.1.4
	* @date 28-Dec-2011
	* @Purpose:This controller handles all the functionalities regarding static page management.
	* @filesource
	* @author     Pankhi Ahluwalia
	* @revision
	* @copyright  Copyright � 2011 Netset Software
	* @version 0.0.1 
**/
App::import('Sanitize');
class StaticPagesController extends AppController
{
    var $name       	=  "StaticPages";
    /**
	* Specifies helpers classes used in the view pages
	* @access public
    */
    var $helpers    	=  array('Html', 'Form', 'Javascript','Session','General');
    /**
	* Specifies components classes used
	* @access public
    */
    var $components 	=  array('RequestHandler','Common','Email');

    var $paginate	    =  array();

    var $uses       	=  array('StaticPage');

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
        $this->layout = "layout_front";
		//$this->checkUserSession();
    }

    function index() {
	$this->set('title_for_layout', 'Static pages');
    }
   
    /**
    * @Date:28-Dec-2011
    * @Method : list
    * @Purpose: This function is to show static pages.
    * @Param: none
    * @Return: none 
    **/
    function admin_list(){
	$this->layout="layout_admin";
	$this->set('title_for_layout', 'Static pages');
	$this->set('pageTitle', 'Static pages');
	$this->set("search1", "");
	$this->set("search2", "");
	$criteria = "1";

	if(isset($this->data['StaticPage']) || !empty($this->params['named'])) {
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
			$search2 = trim($this->data['User']['value1']);
			}elseif(isset($this->params['named']['value'])){
			$search2 = trim($this->params['named']['value']);
			}
		$this->set("search2",$search2);
		}
		
		/* Searching starts from here */
		if(!empty($search1) && !empty($search2)){
			$criteria = $search1." LIKE '".Sanitize::escape($search2)."%'";
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
	
	$this->paginate = array(
			    'fields' => array(
			    'id',
			    'title',
			    'content',
			    'status',
	
			    'created'
			    ),
			    'page'=> 1,'limit' => '30',
			    'order' => array('id' => 'desc')
			    );
				
	$data = $this->paginate('StaticPage',$criteria);
	$this->set('resultData', $data);
    }

   #_________________________________________________________________________#

    /**
    * @Date: 28-Dec-2011
    * @Method : admin_add
    * @Purpose: Function to add static pages.
    * @Param: $id
    * @Return: none
    **/

    function admin_add($id = null) {
	$page_id = "";
	if($this->data)
	{
	   $this->StaticPage->set($this->data['StaticPage']);
	   $validate = $this->StaticPage->validates();
	   $page_id = $this->data['StaticPage']['id'];
	   if($validate){
	     
	   	$this->StaticPage->save($this->data['StaticPage']);
		$pageId = ($this->StaticPage->getLastInsertId() != "")?$this->StaticPage->getLastInsertId():$page_id;
		if($this->StaticPage->getLastInsertId()){
			$this->Session->setFlash("<div class='success-message flash notice'>Static page has been created successfully.</div>");
		}else{
			$this->Session->setFlash("<div class='success-message flash notice'>Static page has been updated successfully.</div>");
		}
		$this->redirect('view/'.$pageId);
	   }
 	}
	elseif(isset($id) && is_numeric($id)){
		$this->data = $this->StaticPage->findById($id);
		if(is_array($this->data)){
		  $page_id = $this->data['StaticPage']['id'];
		}else{
		  $this->redirect('static_pages');
		}
	}
    $this->set('page_id',$page_id);
    }

   #_________________________________________________________________________#

    /**
    * @Date: 28-Dec-2011
    * @Method : admin_view
    * @Purpose: Function to view a static page.
    * @Param: $id
    * @Return: none
    **/
    
    function admin_view($id = null) {
	if(isset($id) && is_numeric($id)){
		$result = $this->StaticPage->findById($id);
		if($result){
			$this->set('result',$result);
		}else{
			$this->redirect('static_pages');
		}
	}else{
		$this->redirect('static_pages');
	}
    }
    
    
   #_________________________________________________________________________#

    /**
    * @Date: 28-Dec-2011
    * @Method : page
    * @Purpose: Function to view a static page.
    * @Param: $id
    * @Return: none
    **/
    
    function page($id = null) {
        $this->layout = "layout_front_flex";
//	pr($this->params['form']);
	if(isset($id) && is_numeric($id)){
		if(!empty($this->data)){
			$this->contactus($id);
		}
		$result = $this->StaticPage->findById($id);		
		if($result){
			$this->set('title_for_layout', $result['StaticPage']['title']);
			$this->set('result',$result);
		}else{
		    $this->redirect('/users/index');
		}
	}else{
	    $this->redirect('/users/index');
	}
    }

    
  #_________________________________________________________________________#

    /**
    * @Date: 8-Sep-2010
    * @Method : view
    * @Purpose: Function to view a static page.
    * @Param: $id
    * @Return: none
    **/
    
    function view($slug= null) {
	
	$this->layout="layout_inner";
	
	if(isset($slug)){
	
	     if(!empty($this->data)){
			$this->contactus($id);
		   }
		$result = $this->StaticPage->findBySlug($slug);
	
		if($result){
		
			$this->set('result',$result);
		}else{
			$this->redirect('/');
		}
	}else{
		$this->redirect('/');
	}
    }
    #_________________________________________________________________________#

    /**
    * @Date: 23-Nov-2010
    * @Method : contactus
    * @Purpose: This function is used to show list of Credits 
    * @Param: none
    * @Return: none 
    **/
    function contactus($id) {
	$this->StaticPage->set($this->data['StaticPage']);
	$isValidated = $this->StaticPage->validates();
	if($isValidated){
	$subject = "Notification: Contact Us";
	$message = "Dear Admin,<br/><br/>A user has tried to contact you. Please find the details below:<br/>
	<table cellpadding='4' cellspacing='1' border='0' style='font-size:12px;'>
	<tr><td align='right'><b>Subject:</b></td><td>".$this->data['StaticPage']['subject']."</td></tr>
	<tr><td align='right'><b>Name:</b></td><td>".ucwords($this->data['StaticPage']['name'])."</td></tr>
	<tr><td align='right'><b>Email address:</b></td><td>".$this->data['StaticPage']['email']."</td></tr>
	<tr><td align='right'><b>Website:</b></td><td>".$this->data['StaticPage']['website']."</td></tr>
	<tr><td align='right'><b>Phone:</b></td><td>".$this->data['StaticPage']['phone']."</td></tr>
	<tr><td align='right'><b>Notes/Questions/Feedback:</b></td><td>".$this->data['StaticPage']['feedback']."</td></tr>
	</table><br/>Thanks,<br/>Dog Booking Support";

	$this->Email->to   = ADMIN_EMAIL;
	$this->Email->subject  = $subject;
	$this->Email->replyTo  = ADMIN_EMAIL;
	$this->Email->from     = ADMIN_EMAIL;
	$this->Email->fromName = ADMIN_NAME;
	$this->Email->sendAs   = 'html';
	$this->Email->send($message);
	$this->Session->setFlash("<div class='success-message flash notice'>Thank you for contacting us. One of our representative will contact you soon!!!</div>");
	$this->redirect('/static_pages/page/'.$id);
	}else{
		$this->set('error',$this->StaticPage->invalidFields());
	}
   }

}

?>