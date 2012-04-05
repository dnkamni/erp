<?php

/**
	* User Controller class
	* PHP versions 5.3.5
	* @date 5th-Jan-2011
	* @Purpose:This controller handles all the functionalities regarding user roles management.
	* @filesource
	* @author  Neema Tiwari
	* @revision
	* @version 1.3.12
**/

App::import('Sanitize');

class RolesController extends AppController
{
    var $name       	=  "Roles";
	
    /**
	* Specifies helpers classes used in the view pages
	* @access public
    */
	
    var $helpers    	=  array('Html', 'Form', 'Javascript', 'Session');
	
    /**
	* Specifies components classes used
	* @access public
    */
	
    var $components 	=  array('RequestHandler','Email','Common');

    var $paginate		=  array();
    
    var $uses       	=  array('Role'); // For Default Model

	
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
	
		$this->checkUserSession();
		$this->set('common',$this->Common);
    }

    #_________________________________________________________________________#
    /**
    * @Date: 28-Dec-2011
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
    * @Date: 5-Jan-2012
    * @Method : admin_list
    * @Purpose: This function is to show list of roles in system.
    * @Param: none
    * @Return: none 
    **/
	
    function admin_list(){
	$this->set('title_for_layout','User Roles Listing');
    $this->set("search1", "");
	$this->set("search2", "");
	$criteria = "1";
	//print_r($this->data); die;
	// Delete user and its licences and orders(single/multiple)
	if(isset($this->params['form']['delete']) || isset($this->params['pass'][0]) == "delete"){
		if(isset($this->params['form']['IDs'])){
			$deleteString = implode("','",$this->params['form']['IDs']);
		}elseif(isset($this->params['pass'][1])){
			$deleteString = $this->params['pass'][1];
		}

		if(!empty($deleteString)){
			$this->Role->deleteAll("Role.id in ('".$deleteString."')");
			$this->Session->setFlash("<div class='success-message flash notice'>User Role(s) deleted successfully.</div>");
			$this->redirect('list');
		}
	}
	
	if(isset($this->data['Role']) || !empty($this->params['named'])) {
		if(!empty($this->data['Role']['fieldName']) || isset($this->params['named']['field'])){
			if(trim(isset($this->data['Role']['fieldName'])) != ""){
				$search1 = trim($this->data['Role']['fieldName']);
			}elseif(isset($this->params['named']['field'])){
				$search1 = trim($this->params['named']['field']);
			}
			$this->set("search1",$search1);
		}
		if(isset($this->data['Role']['value1']) || isset($this->data['Role']['value2']) || isset($this->params['named']['value'])){
			if(isset($this->data['Role']['value1']) || isset($this->data['Role']['value2'])){
				$search2 = ($this->data['Role']['fieldName'] != "Role.status")?trim($this->data['Role']['value1']):$this->data['Role']['value2'];
			}elseif(isset($this->params['named']['value'])){
				$search2 = trim($this->params['named']['value']);
			}
			$this->set("search2",$search2);
		}
		//echo $search1."------".$search2;
		/* Searching starts from here */
		if(!empty($search1) && (!empty($search2) || $search1 == "Role.status")){
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
			$messageStr = "<div class='success-message flash notice'>Selected role(s) have been activated.</div>";
		}elseif(isset($this->params['form']['unpublish'])){
			$setValue = array('status' => "'0'");
			$messageStr = "<div class='success-message flash notice'>Selected role(s) have been deactivated.</div>";
		}
	if(!empty($setValue)){
		if(isset($this->params['form']['IDs'])){
			$saveString = implode("','",$this->params['form']['IDs']);
		}
		if($saveString != ""){
			$this->Role->updateAll($setValue,"Role.id in ('".$saveString."')");
			$this->Session->setFlash($messageStr, 'layout_success');
		}
	}
	$this->paginate = array(
	'fields' => array(
		'id',
		'role',
		'description',
		'created',
		'status'
		),
		'conditions' => array(),
		'page'=> 1,'limit' => RECORDS_PER_PAGE,
		'order' => array('id' => 'desc')
	);
	$data = $this->paginate('Role',$criteria);
	$this->set('resultData', $data);
	}
	

	function admin_add($id = null) {
		if(!empty($id) || !empty($this->data['Role']['id'])){
		    $this->set('title_for_layout','Edit Role');
			$this->pageTitle = "Edit Role";
			$this->set("pageTitle","Edit Role");
			$mode = "edit";
		}else{
		    $this->set('title_for_layout','Role');
			$this->pageTitle = "Add User Role";
			$this->set("pageTitle","Add User Role");
			$mode = "add";
		}
		if($this->data){
		//pr($this->data); die;
			$this->Role->set($this->data['Role']);
			$isValidated = $this->Role->validates();
			if($isValidated){
					
					$this->Role->save($this->data, array('validate'=>false));
					if($mode == "add"){
						$this->Session->setFlash('User Role has been created successfully.', 'layout_success');
					}else{
						$this->Session->setFlash('User Role has been updated successfully.', 'layout_success');
					}
				$this->redirect(array('action' => 'list'));
			}else{
				$this->set("Error",$this->Role->invalidFields());
			}
		}else if(!empty($id)){
		//echo $id;
			$this->data = $this->Role->find('first', array('conditions'=>array('id'=>Sanitize::escape($id))));	
			//pr($this->data);
			if(!$this->data){
				$this->redirect(array('action' => 'list'));
			}
		}

	}
	
	
}