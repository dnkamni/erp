<?php

/**
	* Clients Controller class
	* PHP versions 5.3.5
	* @date 28-Dec-2011
	* @Purpose:This controller handles all the functionalities regarding Client management.
	* @filesource
	* @author  Netset Solutions
	* @revision
	* @version 1.3.12
**/

App::import('Sanitize');

class ClientsController extends AppController
{
    var $name       	=  "Clients";
	
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
    
    var $uses       	=  array('Client'); // For Default Model

	
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
    * @Method : admin_list
    * @Purpose: This function is to show list of Clients in system.
    * @Param: none
    * @Return: none 
    **/
    function admin_list(){
	$this->set('title_for_layout','Clients Listing');
	$this->set("pageTitle","Clients Listing");
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
			$this->Client->deleteAll("Client.id in ('".$deleteString."')");
			$this->Session->setFlash("<div class='success-message flash notice'>Client(s) deleted successfully.</div>");
			$this->redirect('list');
		}
	}
	
	if(isset($this->data['Client']) || !empty($this->params['named'])) {
		if(!empty($this->data['Client']['fieldName']) || isset($this->params['named']['field'])){
			if(trim(isset($this->data['Client']['fieldName'])) != ""){
				$search1 = trim($this->data['Client']['fieldName']);
			}elseif(isset($this->params['named']['field'])){
				$search1 = trim($this->params['named']['field']);
			}
			$this->set("search1",$search1);
		}
		if(isset($this->data['Client']['value1']) || isset($this->data['Client']['value2']) || isset($this->params['named']['value'])){
			if(isset($this->data['Client']['value1']) || isset($this->data['Client']['value2'])){
				$search2 = ($this->data['Client']['fieldName'] != "Client.status")?trim($this->data['Client']['value1']):$this->data['Client']['value2'];
			}elseif(isset($this->params['named']['value'])){
				$search2 = trim($this->params['named']['value']);
			}
			$this->set("search2",$search2);
		}
		//echo $search1."------".$search2;
		/* Searching starts from here */
		if(!empty($search1) && (!empty($search2) || $search1 == "Client.status")){
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
		$messageStr = "<div class='success-message flash notice'>Selected user(s) have been activated.</div>";
	}elseif(isset($this->params['form']['unpublish'])){
		$setValue = array('status' => "'0'");
		$messageStr = "<div class='success-message flash notice'>Selected user(s) have been deactivated.</div>";
	}

	if(!empty($setValue)){
		if(isset($this->params['form']['IDs'])){
			$saveString = implode("','",$this->params['form']['IDs']);
		}
		if($saveString != ""){
			$this->Client->updateAll($setValue,"Client.id in ('".$saveString."')");
			$this->Session->setFlash($messageStr);
		}
	}
	$this->paginate = array(
	'fields' => array(
		'id',
		'type',
		'username',
		'password',
		'description',
		'status',
		'created'
		),
		//'conditions' => array('id !=' => '1'),
		'page'=> 1,'limit' => RECORDS_PER_PAGE,
		'order' => array('id' => 'desc')
	);
	$data = $this->paginate('Client',$criteria);
	$this->set('resultData', $data);
	}
	
	#_________________________________________________________________________#
    /**
    * @Date: 21-Aug-2011
    * @Method : admin_add
    * @Purpose: This function is to add/edit credentals from admin section.
    * @Param: $id
    * @Return: none 
    * @Return: none 
    **/
	function admin_add($id = null) {
		if(!empty($id) || !empty($this->data['Client']['id'])){
		    $this->set('title_for_layout','Edit Client');
			$this->pageTitle = "Edit Client";
			$this->set("pageTitle","Edit Client");
			$mode = "edit";
		}else{
		    $this->set('title_for_layout','Add Client');
			$this->pageTitle = "Add Client";
			$this->set("pageTitle","Add Client");
			$mode = "add";
		}
			if($this->data){ 
			$this->Clients->set($this->data['Client']);
		$isValidated=$this->Client->validates();
		 if($isValidated){
				   $data=$this->data['Client'];
				   $this->Client->save($this->data['Client'], array('validate'=>false));
					if($mode == "add"){
						$this->Session->setFlash("<div class='success-message flash notice'>Client has been created successfully.</div>");
					}else{
						$this->Session->setFlash("<div class='success-message flash notice'>Client has been Faqd successfully.</div>");
					}
				  $this->redirect('list');
			}else{
				$this->set("Error",$this->Client->invalidFields());
			}
		}else if(!empty($id)){
			$this->data = $this->Client->find('first', array('conditions'=>array('id'=>Sanitize::escape($id))));	
			if(!$this->data){
				$this->redirect(array('action' => 'list'));
			}
		}

	}
	
	
}