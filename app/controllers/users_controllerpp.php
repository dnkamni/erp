<?php

/**
	* User Controller class
	* PHP versions 5.1.4
	* @date 12-Aug-2011
	* @Purpose:This controller handles all the functionalities regarding user management.
	* @filesource
	* @author     Neema Tiwari
	* @revision
	* @version 0.0.1
**/

App::import('Sanitize');

class UsersController extends AppController
{
    var $name       	=  "Users";
	
    /**
	* Specifies helpers classes used in the view pages
	* @access public
    */
	
    var $helpers    	=  array('Html', 'Form', 'Javascript', 'Session','General');
	
    /**
	* Specifies components classes used
	* @access public
    */
	
    var $components 	=  array('RequestHandler','Email','Common');

    var $paginate		=  array();
    
    var $uses       	=  array('User'); // For Default Model

/******************************* START FUNCTIONS **************************/

	#_________________________________________________________________________#
    /**
    * @Date: 11-Aug-2011
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
    * @Date: 11-Aug-2011
    * @Method : index
    * @Purpose: This function is the default function of the controller
    * @Param: none
    * @Return: none 
    **/
	function index() {
		if($this->Session->read("SESSION_USER") != ""){
		
		}
    }
	
	#_________________________________________________________________________#
    /**
    * @Date: 11-Aug-2011
    * @Method : admin_index
    * @Purpose: This is the default function of the administrator section for users
    * @Param: none
    * @Return: none 
    **/
	function admin_index() {
		$this->render('admin_login');
		if($this->Session->read("SESSION_ADMIN") != ""){
			$this->redirect('dashboard');
		}
    }

	 #_________________________________________________________________________#
    /**
    * @Date: 28-Dec-2011
    * @Method : index
    * @Purpose: This function is the default function of the controller
    * @Param: none
    * @Return: none 
    **/
	function home() {
	$this->layout="layout_inner";
		if($this->Session->read("SESSION_USER") != ""){
		}
    }
	
	
	
	#_________________________________________________________________________#
	/**
    * @Date: 11-Aug-2011
    * @Method : admin_login
    * @Purpose: used for authorizing administrator section
    * @Param: none
    * @Return: none
    **/
    function admin_login(){
		$this->layout = "layout_admin_withoutlogin";
		$this->set("title_for_layout", "ERP Home");
		if($this->Session->read("SESSION_ADMIN") != ""){
			$this->redirect(array('controller'=>'users','action'=>'dashboard'));
		}
		if($this->data){
			$this->User->set($this->data['User']);
			$isValidated = $this->User->validates();
			if($isValidated){
				// validates user login information
				$password    = md5($this->data['User']['password']);
				$condition = "(username='".Sanitize::escape($this->data['User']['user_name'])."' OR email='".Sanitize::escape($this->data['User']['user_name'])."') AND password='".$password."' AND status = '1'";
				$emp_details = $this->User->find('first', array("conditions" => $condition, "fields" => array("id","first_name")));
				if(is_array($emp_details) && count($emp_details) > 0){
					$this->Session->write("SESSION_ADMIN", array($emp_details['User']['id'],$emp_details['User']['first_name'],$emp_details['User']['role_id']));
					$this->redirect(array('controller'=>'users','action'=>'dashboard'));
				}else{
					$this->Session->setFlash("<div class='error-message flash notice'>The username or password you entered is incorrect.</div>");
				}
			}
		}
	}
	
	#_________________________________________________________________________#
    /**
    * @Date: 11-Aug-2011
    * @Method : admin_logout
    * @Purpose: This function is used to destroy admin session.
    * @Param: none
    * @Return: none 
    **/
    function admin_logout(){
		$this->Session->delete("SESSION_ADMIN");
		$this->redirect(array('controller'=>'users','action' => 'login'));
    }
	
	#_________________________________________________________________________#
    /**
    * @Date: 11-Aug-2011
    * @Method : admin_dashboard
    * @Purpose: This function is to show Admin dashboard.
    * @Param: none
    * @Return: none 
    **/
    function admin_dashboard(){
		$this->set("title_for_layout", "My Account");
		$user = $this->Session->read("SESSION_ADMIN");
	    $user_data=  $this->User->find('first', array('conditions'=>array('id'=>$user[0])));
	    $this->set('resultdata',$user_data);
    }
	
	#_________________________________________________________________________#
    /**
    * @Date: 17-Aug-2010
    * @Method : admin_forgot_password
    * @Purpose: This function is to reset admin's password.
    * @Param: none
    * @Return: none 
    **/
    function admin_forgot_password(){
	$this->set("title_for_layout", "Forgot password");
	if($this->data){
	$this->User->set($this->data['User']);
	$isValidated = $this->User->validates();
	if($isValidated){
		$condition = "(username='".Sanitize::escape($this->data['User']['user_name'])."' OR email='".Sanitize::escape($this->data['User']['user_name'])."') AND id = '1' AND status = '1'";
		$emp_details = $this->User->find('first', array("conditions" => $condition, "fields" => array("id","email","username","first_name","last_name")));
		if($emp_details){
			// Reset password
			$resetPassword = rand(100000,999999);
			$subject = "Forgot your Password!";
			
			// Send mail to User
			$name    = $emp_details['User']['first_name']." ".$emp_details['User']['last_name'];
			$this->Email->to       = trim($emp_details['User']['email']);
			$this->Email->subject  = $subject;
			$this->Email->replyTo  = ADMIN_EMAIL;
			$this->Email->from     = ADMIN_EMAIL;
			$this->Email->fromName = ADMIN_NAME;
			$this->Email->sendAs   = 'html';
			// set values to be used on email template
			$message = "Dear <span style='color:#666666'>".$name."</span>,<br/><br/>Your password has been reset successfully.<br/><br/>Please find the following login details:<br/><br/> Username: ".$emp_details['User']['username']."<br/>Email: ".$emp_details['User']['email']."<br/>Password: ".$resetPassword."<br/><br/>Thanks, <br/>Support Team";;
			if ($this->Email->send($message)) {
			
				$this->User->updateAll(array("password"=>"'".md5($resetPassword)."'"),array("id"=>$emp_details['User']['id']));
				$this->Session->setFlash("<div class='success-message flash notice'>Your password has been reset and successfully sent to your email id.</div>");
            }
			//$this->redirect(array("action"=>"forgot_password"));
		}else{
			$this->Session->setFlash("<div class='error-message flash notice'>The Username or email doesn&#39;t exists.</div>");
	    }
	}
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
	$this->set("search1", "");
	$this->set("search2", "");
	$criteria = "1";
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
			$this->Session->setFlash("<div class='success-message flash notice'>User(s) deleted successfully.</div>");
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
			$messageStr = "Selected user(s) have been activated.";
		}elseif(isset($this->params['form']['unpublish'])){
			$setValue = array('status' => "'0'");
			$messageStr = "Selected user(s) have been deactivated.";
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
				'User.current_salary',
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
		//pr($this->data); die;
			$this->User->set($this->data['User']);
			$isValidated = $this->User->validates();
			if($isValidated){
					if($mode == "add"){
						$password = $this->data['User']['password'];
						$this->data['User']['password']    = md5($this->data['User']['password']);
						$this->data['User']['status']    = "1";
					}
					
					$this->User->save($this->data, array('validate'=>false));
					if($mode == "add"){
						$this->Session->setFlash("<div class='success-message flash notice'>New user has been created successfully. Account information has been sent to his email address.</div>");
						$subject = "Account Created on ERP!!";
						$name    = $this->data['User']['first_name']." ".$this->data['User']['last_name'];
						$this->Email->to       = trim($this->data['User']['email']);
						$this->Email->subject  = $subject;
						$this->Email->replyTo  = ADMIN_EMAIL;
						$this->Email->from     = ADMIN_EMAIL;
						$this->Email->fromName = ADMIN_NAME;
						$this->Email->sendAs   = 'html';
						
						$message = "Dear <span style='color:#666666'>".$name."</span>,<br/><br/>Your account has been created successfully by Administrator.<br/>Please find the below details of your account: <br/><br/><b>First Name:</b> ".$this->data['User']['first_name']."<br/><b>Last Name:</b> ".$this->data['User']['last_name'].((!empty($this->data['User']['phone']))?"<br/><b>Phone:</b> ".$this->data['User']['phone']:"")."<br/><b>Address:</b> ".$this->data['User']['address1']." ".$this->data['User']['address2']."<br/><b>Email:</b> ".$this->data['User']['email']."<br/><b>Username:</b> ".$this->data['User']['username']."<br/><b>Password:</b> ".$password."<br/><br/>Thanks, <br/>Support Team";
						$this->Email->send($message);
					}else{
						$this->Session->setFlash("<div class='success-message flash notice'>User has been updated successfully.</div>");
					}
				$this->redirect(array('action' => 'list'));
			}else{
				$this->set("Error",$this->User->invalidFields());
			}
		}else if(!empty($id)){
			$this->data = $this->User->find('first', array('conditions'=>array('id'=>Sanitize::escape($id))));	
			if(!$this->data){
				$this->redirect(array('action' => 'list'));
			}
		}

	}
	
	#_________________________________________________________________________#
    /**
    * @Date: 24-Aug-2010
    * @Method : admin_change_password
    * @Purpose: This function is to change admin password.
    * @Param: none
    * @Return: none 
    **/
	function admin_change_password(){
		$this->pageTitle = "Change password";
		$this->set("pageTitle","Change password");
		if($this->data){
			$this->User->set($this->data['User']);
			$isValidated = $this->User->validates();
			if($isValidated){
				$userSession = $this->Session->read("SESSION_ADMIN");
				// Update new password
				$result = $this->User->updateAll(array("password"=>"'".md5(Sanitize::escape($this->data['User']['password']))."'"),array('id'=>$userSession[0]));
				if($result){
					$this->Session->setFlash("<div class='success-message flash notice'>Your password has been changed successfully.</div>");
					$this->redirect(array("action"=>"change_password"));
				}
			}
		}
    }
	_________________________________________________________________________#
    /**
    * @Date: 24-Aug-2010
    * @Method : admin_change_password
    * @Purpose: This function is to change admin password.
    * @Param: none
    * @Return: none 
    **/
	function gallery(){
		$this->pageTitle = "Gallery";
		$this->layout="layout_inner";
	
	$result = $this->Gallery->find('all');

    $this->set("resultData",$result);
		
    }
	
	
	
}