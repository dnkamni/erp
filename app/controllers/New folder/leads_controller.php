<?php

/**
	* Leads Controller class
	* PHP versions 5.3.5
	* @date 28-Dec-2011
	* @Purpose:This controller handles all the functionalities regarding leads management.
	* @filesource
	* @author  Netset Solutions
	* @revision
	* @version 1.3.12
**/

App::import('Sanitize');

class LeadsController extends AppController
{
    var $name       	=  "Leads";
	
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
    
    var $uses       	=  array('Lead'); // For Default Model

	
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
    * @Date: 28-12-2011
    * @Method : admin_list
    * @Purpose: This function is to show list of leads in a project.
    * @Param: none
    * @Return: none 
    **/
    function admin_list(){
	$this->set('title_for_layout','Lead Listing');
	$this->set("pageTitle","Lead Listing");
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
			$this->Lead->deleteAll("Lead.id in ('".$deleteString."')");
			$this->Session->setFlash("<div class='success-message flash notice'>Lead(s) deleted successfully.</div>");
			
			$this->redirect('list');
		}
	}
	
	if(isset($this->data['Lead']) || !empty($this->params['named'])) {
		if(!empty($this->data['Lead']['fieldName']) || isset($this->params['named']['field'])){
			if(trim(isset($this->data['Lead']['fieldName'])) != ""){
				$search1 = trim($this->data['Lead']['fieldName']);
			}elseif(isset($this->params['named']['field'])){
				$search1 = trim($this->params['named']['field']);
			}
			$this->set("search1",$search1);
		}
		if(isset($this->data['Lead']['value1']) || isset($this->data['Lead']['value2']) || isset($this->params['named']['value'])){
			if(isset($this->data['Lead']['value1']) || isset($this->data['Lead']['value2'])){
				$search2 = ($this->data['Lead']['fieldName'] != "Lead.status")?trim($this->data['Lead']['value1']):$this->data['Lead']['value2'];
			}elseif(isset($this->params['named']['value'])){
				$search2 = trim($this->params['named']['value']);
			}
			$this->set("search2",$search2);
		}
		//echo $search1."------".$search2;
		/* Searching starts from here */
		if(!empty($search1) && (!empty($search2) || $search1 == "Lead.status")){
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
			$this->Lead->updateAll($setValue,"Lead.id in ('".$saveString."')");
			$this->Session->setFlash($messageStr);
		}
	}
	$this->paginate = array(
	'fields' => array(
		'id',
		'date_applied',
		'client_name',
		'project_name',
		'lead_from',
		'perspective_amount',
		'sales_id',
		'status',
		'created'
		),
		//'conditions' => array('id !=' => '1'),
		'page'=> 1,'limit' => RECORDS_PER_PAGE,
		'order' => array('id' => 'desc')
	);
	$data = $this->paginate('Lead',$criteria);
	$this->set('resultData', $data);
	}
	
	#_________________________________________________________________________#
    /**
    * @Date: 28-Dec-2011
    * @Method : admin_add
    * @Purpose: This function is to add/edit leads from admin section.
    * @Param: $id
    * @Return: none 
    * @Return: none 
    **/
	
	function admin_add($id = null) {
		if(!empty($id) || !empty($this->data['Lead']['id'])){
		
		    $this->set('title_for_layout','Edit Lead');
			$this->pageTitle = "Edit Lead";
			$this->set("pageTitle","Edit Lead");
			$mode = "edit";
		}else{
		    $this->set('title_for_layout','Add Lead');
			$this->pageTitle = "Add Lead";
			$this->set("pageTitle","Add Lead");
			$mode = "add";
		}
		if($this->data){
		$this->data['Lead']['date_applied'] = (!empty($this->data['Lead']['date_applied1'])?date('Y/m/d H:i:s', strtotime($this->data['Lead']['date_applied1'])):NULL);
			$this->Lead->set($this->data['Lead']);
			$isValidated = $this->Lead->validates();
			if($isValidated){
					$this->Lead->save($this->data, array('validate'=>false));
					$this->redirect(array('action' => 'list'));
					}else{
				$this->set("Error",$this->Lead->invalidFields());
			}
		}else if(!empty($id)){
			$this->data = $this->Lead->find('first', array('conditions'=>array('id'=>Sanitize::escape($id))));	
	
			$this->data['Lead']['start_date'] = (!empty($this->data['Lead']['start_date1'])?date('m/d/Y H:i:s', strtotime($this->data['Lead']['start_date1'])):NULL);  
			if(!$this->data){
				$this->redirect(array('action' => 'list'));
			}
		}

	}
	
	
}
