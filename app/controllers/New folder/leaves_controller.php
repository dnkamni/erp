<?php

/**
	* Leaves Controller class
	* PHP versions 5.3.5
	* @date 28-Dec-2011
	* @Purpose:This controller handles all the functionalities regarding leaves management.
	* @filesource
	* @author  Netset Solutions
	* @revision
	* @version 1.3.12
**/

App::import('Sanitize');

class LeavesController extends AppController
{
    var $name       	=  "Leaves";
	
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
    
    var $uses       	=  array('Leave','User'); // For Default Model

	
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
    * @Date: 28-Dec-2011
    * @Method : admin_list
    * @Purpose: This function is to show list of leaves in system.
    * @Param: none
    * @Return: none 
    **/
function admin_list(){
	$this->set('title_for_layout','Leave Listing');
	$this->set("pageTitle","Leave Listing");
    $this->set("search1", "");
	$this->set("search2", "");
	$criteria = "1";

	// Delete user and its licences and orders(single/multiple)
	if(isset($this->params['form']['delete']) || isset($this->params['pass'][0]) == "delete"){
		if(isset($this->params['form']['IDs'])){
			$deleteString = implode("','",$this->params['form']['IDs']);
			}elseif(isset($this->params['pass'][1])){
			$deleteString = $this->params['pass'][1];		
		}
		if(!empty($deleteString)){
			$this->Leave->deleteAll("Leave.id in ('".$deleteString."')");
			$this->Session->setFlash("<div class='success-message flash notice'>Leave(s) deleted successfully.</div>");
			
			$this->redirect('list');
		}
	}
	
	if(isset($this->data['Leave']) || !empty($this->params['named'])) {
		if(!empty($this->data['Leave']['fieldName']) || isset($this->params['named']['field'])){
			if(trim(isset($this->data['Leave']['fieldName'])) != ""){
				$search1 = trim($this->data['Leave']['fieldName']);
			}elseif(isset($this->params['named']['field'])){
				$search1 = trim($this->params['named']['field']);
			}
			$this->set("search1",$search1);
		}
		if(isset($this->data['Leave']['value1']) || isset($this->data['Leave']['value2']) || isset($this->params['named']['value'])){
			if(isset($this->data['Leave']['value1']) || isset($this->data['Leave']['value2'])){
				$search2 = ($this->data['Leave']['fieldName'] != "Leave.status")?trim($this->data['Leave']['value1']):$this->data['Leave']['value2'];
			}elseif(isset($this->params['named']['value'])){
				$search2 = trim($this->params['named']['value']);
			}
			$this->set("search2",$search2);
		}
		//echo $search1."------".$search2;
		/* Searching starts from here */
		if(!empty($search1) && (!empty($search2) || $search1 == "Leave.status")){
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
	/*if(isset($this->params['form']['publish'])){
		$setValue = array('status' => "'1'");
		$messageStr = "<div class='success-message flash notice'>Selected Client(s) have been activated.</div>";
	}elseif(isset($this->params['form']['unpublish'])){
		$setValue = array('status' => "'0'");
		$messageStr = "<div class='success-message flash notice'>Selected Client(s) have been deactivated.</div>";
	} */
	if(!empty($setValue)){
		if(isset($this->params['form']['IDs'])){
			$saveString = implode("','",$this->params['form']['IDs']);
		}
		if($saveString != ""){
			$this->Leave->updateAll($setValue,"Leave.id in ('".$saveString."')");
			$this->Session->setFlash($messageStr);
		}
	}
	$this->paginate = array(
	'fields' => array(
		'Leave.id',
		'Leave.requested_user_id',
		'User.username',
		'User.username',
		'Leave.from_date',
		'Leave.to_date',
		'Leave.reason',
		'Leave.request_for',
		'Leave.status',
		'Leave.created'
		),
		'page'=> 1,'limit' => RECORDS_PER_PAGE,
		'order' => array('Leave.id' => 'desc')
	);
	$this->Leave->expects(array("User"));
	$data = $this->paginate('Leave',$criteria);
	$this->set('resultData', $data);
	}
	

	#_________________________________________________________________________#
    /**
    * @Date: 28-Dec-2011
    * @Method : admin_add
    * @Purpose: This function is to add/edit leaves from admin section.
    * @Param: $id
    * @Return: none 
    * @Return: none 
    **/
	function admin_add($id = null) {
		if(!empty($id) || !empty($this->data['Leave']['id'])){
		    $this->set('title_for_layout','Edit Leave Detail');
			$this->pageTitle = "Edit Leave Detail";
			$this->set("pageTitle","Edit Leave Detail");
			$mode = "edit";
		}else{
		    $this->set('title_for_layout','Add Leave Detail');
			$this->pageTitle = "Add Leave Detail";
			$this->set("pageTitle","Add Leave Detail");
			$mode = "add";
		}
		if($this->data){
		$this->data['Leave']['from_date'] = (!empty($this->data['Leave']['from_date1'])?date('Y/m/d H:i:s', strtotime($this->data['Leave']['from_date1'])):NULL);
		$this->data['Leave']['to_date'] = (!empty($this->data['Leave']['to_date1'])?date('Y/m/d H:i:s', strtotime($this->data['Leave']['to_date1'])):NULL);
			$this->Leave->set($this->data['Leave']);
			$isValidated = $this->Leave->validates();
			if($isValidated){
					$this->Leave->save($this->data, array('validate'=>false));	
			$this->redirect(array('action' => 'list'));
			}else{
				$this->set("Error",$this->Leave->invalidFields());
			}
		}else if(!empty($id)){
			$this->data = $this->Leave->find('first', array('conditions'=>array('id'=>Sanitize::escape($id))));
            $this->data['Leave']['to_date1'] = (!empty($this->data['Leave']['to_date'])?date('m/d/Y H:i:s', strtotime($this->data['Leave']['to_date'])):NULL);
			$this->data['Leave']['from_date1'] = (!empty($this->data['Leave']['from_date'])?date('m/d/Y H:i:s', strtotime($this->data['Leave']['from_date'])):NULL);  				 
			if(!$this->data){
				$this->redirect(array('action' => 'list'));
			}
		}

	}
	
	
}