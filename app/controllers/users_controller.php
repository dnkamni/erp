<?php

	/**
	* User Controller class
	* PHP versions 5.1.4
	* @date 27-Dec-2011
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
    var $paginate		  =  array();
    var $uses       	=  array('User','Role','Gallery'); // For Default Model

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
    * @Date: 28-Dec-2011
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
    * @Method : login
    * @Purpose: used for authorizing front end user
    * @Param: none
    * @Return: none
    **/

    function login($mode = null){

			$this->set("title_for_layout","User Login"); 
			$this->layout="layout_front";
		if($this->Session->read("SESSION_USER") != ""){
	
			$this->redirect(array('controller'=>'products','action'=>'listing'));
			}

		if($this->data){

			$this->User->set($this->data['User']);
			$isValidated = $this->User->validates();
		if($isValidated){

// validates user login information
			$password    = md5($this->data['User']['password']);
			$condition = "(username='".Sanitize::escape($this->data['User']['user_name'])."' OR email='".Sanitize::escape($this->data['User']['user_name'])."') AND password='".$password."' AND id != '1' AND status = '1'";
			$user_details = $this->User->find('first', array("conditions" => $condition, "fields" => array("id","first_name","username")));				if(is_array($user_details) && count($user_details) > 0){
			$this->Session->write("SESSION_USER", array($user_details['User']['id'],$user_details['User']['first_name'],$user_details['User']['username']));
			$this->redirect(array('controller'=>'products','action' => 'listing'));
//$this->redirect("dashboard");
		}else{
			$this->Session->setFlash("<div class='error-message flash notice'>The username or password you entered is incorrect.</div>");
				}
			}
		}elseif($mode == "facebook"){
		
			$cookie = $this->_get_facebook_cookie(FACEBOOK_APP_ID, FACEBOOK_APP_SECRET);
		if(!empty($cookie)){

			$url =  'https://graph.facebook.com/me?access_token=' .$cookie['access_token'];
// Initialize session and set URL.
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
// Set so curl_exec returns the result instead of outputting it.
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Get the response and close the channel.
			$response = curl_exec($ch);
			curl_close($ch);
			$user = json_decode($response);
			$result = $this->User->find("first", array("conditions"=>array('facebookid'=>$user->id)));
		if(!empty($result)){
		
// If facebook user exists
			$this->Session->write("SESSION_USER", array($result['User']['id'],$result['User']['first_name']));
			$this->redirect("dashboard");
		}else{

			$password = rand('1111','9999');
			$location = $user->location;
			$saveData = array(
			'first_name' => $user->first_name,
			'last_name' => $user->last_name,
			'username' => $user->email,
			'email' => $user->email,
			'password' => md5($password),
			'address1' => $location->name,
			'facebookid' => $user->id,
			'status' => "1",
			);
			$this->User->save($saveData,  array('validate'=>false));
// Send email to user with login credentials
//
//
//
// Send email to user with login credentials
			$this->Session->setFlash("<div class='success-message flash notice'>You have been registered successfully to this site. Please check your email for the login credentials.</div>");
			$this->Session->write("SESSION_USER", array($this->User->id,$saveData['first_name']));
			$this->redirect(array('controller'=>'products','action' => 'listing'));
			}
		}else{
			$this->redirect("login");

		     }

		}



	}

	#_________________________________________________________________________#

	/**
    * @Date: 28-Dec-2011
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
			$condition = "(username='".Sanitize::escape($this->data['User']['user_name'])."' OR email='".Sanitize::escape($this->data['User']['user_name'])."') AND password='".$password."'  AND status = '1'";
			$user_details = $this->User->find('first', array("conditions" => $condition, "fields" => array("id","first_name")));
		if(is_array($user_details) && count($user_details) > 0){
		
			$this->Session->write("SESSION_ADMIN", array($user_details['User']['id'],$user_details['User']['first_name']));
			$this->redirect(array('controller'=>'users','action'=>'dashboard'));

		}else{
			$this->Session->setFlash("<div class='error-message flash notice'>The username or password you entered is incorrect.</div>");

				}
			}

		}

	}


	#_________________________________________________________________________#

    /**
    * @Date: 28-Dec-2011
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
    * @Date: 28-Dec-2011
    * @Method : admin_dashboard
    * @Purpose: This function is to show Admin dashboard.
    * @Param: none
    * @Return: none 
    **/

    function admin_dashboard(){

			$this->set("title_for_layout", "ERP Dashboard");
			$user = $this->Session->read("SESSION_ADMIN");
			$user_data=  $this->User->find('first', array('conditions'=>array('id'=>$user[0])));
			$destination=realpath('../../app/webroot/img/employee_image'). DS;
			$images=$this->Common->get_files($destination);
			$this->set('resultdata',$user_data);
			$this->set('images',$images);
    }

	#_________________________________________________________________________#

    /**
    * @Date: 11-Aug-2010
    * @Method : register
    * @Purpose: Used for user registration
    * @Param: none
    * @Return: none
    **/

    function register(){

			$this->layout = "layout_before_login";
			$this->pageTitle = "User Registration";

		if($this->data){

			$this->User->set($this->data['User']);
			$isValidated = $this->User->validates();
		if($isValidated){

			$this->data['User']['password']    = md5($this->data['User']['password']);
			$this->User->save($this->data, array('validate'=>false));
			$this->Session->setFlash("<div class='success-message flash notice'>You have been registered successfully. Please check your mail to activate your account.</div>");
			$subject = "Account Activation Instructions!";
			$name    = $this->data['User']['first_name']." ".$this->data['User']['last_name'];
			$this->Email->to       = trim($this->data['User']['email']);
			$this->Email->subject  = $subject;
			$this->Email->replyTo  = ADMIN_EMAIL;
			$this->Email->from     = ADMIN_EMAIL;
			$this->Email->fromName = ADMIN_NAME;
			$this->Email->sendAs   = 'html';
			$link = BASE_URL."users/activate_account/".md5($this->User->id);
			$message = "Dear <span style='color:#666666'>".$name."</span>,<br/><br/>You have been registered successfully.<br/>Please follow <a href='".$link."'>this link</a> to activate your account.<br/><br/>If you have trouble clicking this link, copy and paste below link to your browser.<br/><br/>".$link."<br/><br/>Thanks, <br/>Support Team";
			$this->Email->send($message);
			$this->redirect('/');
			}
		}
	}

	#_________________________________________________________________________#

	/**
    * @Date: 11-Aug-2010
    * @Method : activate_account
    * @Purpose: Account activation by email
    * @Param: md5 of user id
    * @Return: none
    **/

    function activate_account($id){

		if(!empty($id)){

			$this->User->updateAll(array('status'=>'1'), array('MD5(id)'=>$id));
			$this->Session->setFlash("<div class='success-message flash notice'>Your account has been activated successfully. Please login to proceed.</div>");
			$this->redirect(array('action' => 'login'));
		}
	}

	#_________________________________________________________________________#

    /**
    * @Date: 11-Aug-2010
    * @Method : forgot_password
    * @Purpose: This function is to reset user's password.
    * @Param: none
    * @Return: none 
    **/

    function forgot_password(){

			$this->layout="layout_front";
			$this->pageTitle = "Forgotten password";
		if($this->data){

			$this->User->set($this->data['User']);
			$isValidated = $this->User->validates();
		if($isValidated){

			$condition = "(username='".Sanitize::escape($this->data['User']['user_name'])."' OR email='".Sanitize::escape($this->data['User']['user_name'])."') AND id != '1' AND status = '1'";
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

			$message = "Dear <span style='color:#666666'>".$name."</span>,<br/><br/>Your password has been reset successfully.<br/><br/>Please find the following login details:<br/><br/> Username: ".$emp_details['User']['username']."<br/>Email: ".$emp_details['User']['email']."<br/>Password: ".$resetPassword."<br/><br/>Thanks, <br/>Support Team";

		if ($this->Email->send($message)) {

			$this->User->updateAll(array("password"=>"'".md5($resetPassword)."'"),array("id"=>$emp_details['User']['id']));
			$this->Session->setFlash("<div class='success-message flash notice'>Your password has been reset and successfully sent to your email id.</div>");
            }
			$this->redirect(array("action"=>"forgot_password"));
		}else{

			$this->Session->setFlash("<div class='error-message flash notice'>The Username or email doesn&#39;t exists.</div>");
	    }

	}
	}

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
			$this->pageTitle = "Forgot password";

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

	#_________________________________________________________________________#

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