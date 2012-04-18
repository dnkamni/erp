<?php
	/**	* Project Controller class	* PHP versions 5.3.5	* @date 28-Dec-2011	* @Purpose:This controller handles all the functionalities regarding project management.	* @filesource	* @author  Netset Solutions	* @revision		* @version 1.3.12	**/
App::import('Sanitize');class ProjectsController extends AppController{	var $name       	=  "Projects";
	/**	* Specifies helpers classes used in the view pages	* @access public	*/
	var $helpers    	=  array('Html', 'Form', 'Javascript', 'Session','General');
/*** Specifies components classes used* @access public*/	var $components 	=  array('RequestHandler','Email','Common');	var $paginate		=  array();	var $uses       	=  array('Project','Client','ProjectsUpdate'); // For Default Model
/******************************* START FUNCTIONS **************************/
#_________________________________________________________________________#
	/**
	* @Date: 28-Dec-2011	* @Method : beforeFilter	* @Purpose: This function is called before any other function.	* @Param: none    * @Return: none 	**/
	function beforeFilter(){
		$this->checkUserSession();		$this->set('common',$this->Common);}			
	#_________________________________________________________________________#
	/**
	* @Date: 28-Dec-2011	* @Method : index	* @Purpose: This function is the default function of the controller	* @Param: none	* @Return: none 	**/
	function index() {
		$this->render('login');		if($this->Session->read("SESSION_USER") != ""){		$this->redirect('dashboard');	}}
#_________________________________________________________________________#
	/**	* @Date: 28-Dec-2011	* @Method : admin_index	* @Purpose: This is the default function of the administrator section for users	* @Param: none	* @Return: none 	**/
	function admin_index() {
		$this->render('admin_login');		if($this->Session->read("SESSION_ADMIN") != ""){		$this->redirect('dashboard');		}	}		#_________________________________________________________________________#
	/**	* @Date: 28-Dec-2011	* @Method : admin_list	* @Purpose: This function is to show list of Projects in system.	* @Param: none	* @Return: none 	**/
	function admin_list(){		$this->set('title_for_layout','Projects Listing');		$this->set("pageTitle","Projects Listing");		$this->set("search1", "");		$this->set("search2", "");		$criteria = "1";		// Delete user and its licences and orders(single/multiple)
		if(isset($this->params['form']['delete']) || isset($this->params['pass'][0]) == "delete"){
		if(isset($this->params['form']['IDs'])){		$deleteString = implode("','",$this->params['form']['IDs']);		}elseif(isset($this->params['pass'][1])){		$deleteString = $this->params['pass'][1];	}
		if(!empty($deleteString)){
		$this->Project->deleteAll("Project.id in ('".$deleteString."')");		$this->Session->setFlash("<div class='success-message flash notice'>Project(s) deleted successfully.</div>");		$this->redirect('list');	}}		if(isset($this->data['Project']) || !empty($this->params['named'])) {
		if(!empty($this->data['Project']['fieldName']) || isset($this->params['named']['field'])){
		if(trim(isset($this->data['Project']['fieldName'])) != ""){			$search1 = trim($this->data['Project']['fieldName']);		}elseif(isset($this->params['named']['field'])){			$search1 = trim($this->params['named']['field']);		}		$this->set("search1",$search1);	}
		if(isset($this->data['Project']['value1']) || isset($this->data['Project']['value2']) || isset($this->params['named']['value'])){
		if(isset($this->data['Project']['value1']) || isset($this->data['Project']['value2'])){			$search2 = ($this->data['Project']['fieldName'] != "Project.status")?trim($this->data['Project']['value1']):$this->data['Project']['value2'];		}elseif(isset($this->params['named']['value'])){			$search2 = trim($this->params['named']['value']);		}		$this->set("search2",$search2);	}
	//echo $search1."------".$search2;
	/* Searching starts from here */
		if(!empty($search1) && (!empty($search2) || $search1 == "Project.status")){
		$criteria = $search1." LIKE '%".Sanitize::escape($search2)."%'"; 		}else{		$this->set("search1","");		$this->set("search2","");	}}		if(isset($this->params['named'])){
	$urlString = "/";	$completeUrl  = array();		if(!empty($this->params['named']['page']))
				$completeUrl['page'] = $this->params['named']['page'];		if(!empty($this->params['named']['sort']))
		$completeUrl['sort'] = $this->params['named']['sort'];		if(!empty($this->params['named']['direction']))
		$completeUrl['direction'] = $this->params['named']['direction'];		if(!empty($search1))
		$completeUrl['field'] = $search1;		if(isset($search2))
		$completeUrl['value'] = $search2;		foreach($completeUrl as $key=>$value){
		$urlString.= $key.":".$value."/";	}}

		$this->set('urlString',$urlString);
		if(isset($this->params['form']['publish'])){
		$setValue = array('status' => "'1'");		$messageStr = "<div class='success-message flash notice'>Selected user(s) have been activated.</div>";
		}elseif(isset($this->params['form']['unpublish'])){		$setValue = array('status' => "'0'");		$messageStr = "<div class='success-message flash notice'>Selected user(s) have been deactivated.</div>";	} 
		if(!empty($setValue)){
		if(isset($this->params['form']['IDs'])){		$saveString = implode("','",$this->params['form']['IDs']);	}
		if($saveString != ""){		$this->Project->updateAll($setValue,"Project.id in ('".$saveString."')");		$this->Session->setFlash($messageStr);	}}
		$this->paginate = array(
	'fields' => array(	'Project.id',	'Project.name',	'Project.description',	'Client.client_name',	'Project.start_date',	'Project.credentials',	'Project.notes',	'Project.technology',	'Project.sales',	'Project.pm',	'Project.developer',	'Project.platform',	'Project.type',	'Project.created',	'Project.status',	),
	//'conditions' => array('id !=' => '1'),
	'page'=> 1,'limit' => RECORDS_PER_PAGE,	'order' => array('Project.id' => 'desc')	);
		$this->Project->expects(array("Client"));		$data = $this->paginate('Project',$criteria);		$this->set('resultData', $data);
		// pr($data ); die;
	}
	#_________________________________________________________________________#
	/**	* @Date: 28-Dec-2011	* @Method : admin_add	* @Purpose: This function is to add/edit projects from admin section.	* @Param: $id	* @Return: none 	* @Return: none 	**/
	function admin_add($id = null) {
		if(!empty($id) || !empty($this->data['Project']['id'])){
		$this->set('title_for_layout','Edit Project');		$this->pageTitle = "Edit Project";		$this->set("pageTitle","Edit Project");		$mode = "edit";		}else{
		$this->set('title_for_layout','Project');		$this->pageTitle = "Project";		$this->set("pageTitle","Add Project");		$mode = "add";	}
		if($this->data){
	//pr($this->data); die;			$this->data['Project']['start_date'] = (!empty($this->data['Project']['start_date1'])?date('Y/m/d H:i:s', strtotime($this->data['Project']['start_date1'])):NULL);			$this->Project->set($this->data['Project']);			$isValidated = $this->Project->validates();		if($isValidated){			$this->Project->save($this->data, array('validate'=>false));		if($mode == "add"){			$this->Session->setFlash("<div class='success-message flash notice'>Projects has been created successfully.</div>");   			}else{			$this->Session->setFlash("<div class='success-message flash notice'>Projects has been updated successfully.</div>");					}			$this->redirect(array('action' => 'list'));		}else{			$this->set("Error",$this->Project->invalidFields());		}		}else if(!empty($id)){
			$this->data = $this->Project->find('first', array('conditions'=>array('id'=>Sanitize::escape($id))));				$this->data['Project']['start_date'] = (!empty($this->data['Project']['start_date1'])?date('m/d/Y H:i:s', strtotime($this->data['Project']['start_date1'])):NULL);  		if(!$this->data){
			$this->redirect(array('action' => 'list'));		}	}}
	#_________________________________________________________________________#
	/**
	* @Date: 28-Dec-2011	* @Method : admin_add	* @Purpose: This function is to add/edit Project update from admin section.	* @Param: $id	* @Return: none 	* @Return: none 	**/
	function admin_project_add($id = null)  {
	if(!empty($id) || !empty($this->data['ProjectsUpdate']['id'])){		$this->set('title_for_layout','Edit Project Upadate');		$this->pageTitle = "Edit Project Update";		$this->set("pageTitle","Edit Project Upadate");		$mode = "edit";	}else{		$this->set('title_for_layout','Project Update');		$this->pageTitle = "Project Upadate";		$this->set("pageTitle","Add Project Upadate");		$mode = "add";	}
	if($this->data){	// pr($this->data); die;
		$this->ProjectsUpdate->set($this->data['Project']);		$isValidated = $this->ProjectsUpdate->validates();		if($isValidated){
			$this->ProjectsUpdate->save($this->data, array('validate'=>false));			$this->redirect(array('action' => 'project_list'));		}else{		
			$this->set("Error",$this->ProjectsUpdate->invalidFields());
		}		}else if(!empty($id)){
			$this->data = $this->ProjectsUpdate->find('first', array('conditions'=>array('id'=>Sanitize::escape($id))));			$this->data['Project']=$this->data['ProjectsUpdate'];
		if(!$this->data){			$this->redirect(array('action' => 'project_list'));		}	}}
	#_________________________________________________________________________#
	/**	* @Date: 28-Dec-2011	* @Method : admin_list	* @Purpose: This function is to show list of Project update in system.	* @Param: none	* @Return: none 	**/
	function admin_project_list(){
			$this->set('title_for_layout','Projects Update Listing');			$this->set("pageTitle","Projects Update Listing");			$this->set("search1", "");			$this->set("search2", "");			$criteria = "1";
// Delete user and its licences and orders(single/multiple)
if(isset($this->params['form']['delete']) || isset($this->params['pass'][0]) == "delete"){
	if(isset($this->params['form']['IDs'])){
		$deleteString = implode("','",$this->params['form']['IDs']);	}elseif(isset($this->params['pass'][1])){
		$deleteString = $this->params['pass'][1];	}
		if(!empty($deleteString)){
			$this->ProjectsUpdate->deleteAll("ProjectsUpdate.id in ('".$deleteString."')");			$this->Session->setFlash("<div class='success-message flash notice'>Project(s) deleted successfully.</div>");			$this->redirect('project_list');
	}
}
		if(isset($this->data['ProjectsUpdate']) || !empty($this->params['named'])) {
		if(!empty($this->data['ProjectsUpdate']['fieldName']) || isset($this->params['named']['field'])){
		if(trim(isset($this->data['ProjectsUpdate']['fieldName'])) != ""){			$search1 = trim($this->data['ProjectsUpdate']['fieldName']);		}elseif(isset($this->params['named']['field'])){			$search1 = trim($this->params['named']['field']);		}		$this->set("search1",$search1);	}
		if(isset($this->data['ProjectsUpdate']['value1']) || isset($this->data['ProjectsUpdate']['value2']) || isset($this->params['named']['value'])){
		if(isset($this->data['ProjectsUpdate']['value1']) || isset($this->data['ProjectsUpdate']['value2'])){			$search2 = ($this->data['ProjectsUpdate']['fieldName'] != "ProjectsUpdate.status")?trim($this->data['ProjectsUpdate']['value1']):$this->data['ProjectsUpdate']['value2'];		}elseif(isset($this->params['named']['value'])){			$search2 = trim($this->params['named']['value']);		}
		$this->set("search2",$search2);
	}	//echo $search1."------".$search2;
	/* Searching starts from here */
		if(!empty($search1) && (!empty($search2) || $search1 == "ProjectsUpdate.status")){		$criteria = $search1." LIKE '%".Sanitize::escape($search2)."%'"; 
		}else{		$this->set("search1","");		$this->set("search2","");	}
}		if(isset($this->params['named'])){
			$urlString = "/";			$completeUrl  = array();		if(!empty($this->params['named']['page']))
			$completeUrl['page'] = $this->params['named']['page'];		if(!empty($this->params['named']['sort']))
			$completeUrl['sort'] = $this->params['named']['sort'];
		if(!empty($this->params['named']['direction']))
			$completeUrl['direction'] = $this->params['named']['direction'];		if(!empty($search1))
			$completeUrl['field'] = $search1;		if(isset($search2))
			$completeUrl['value'] = $search2;			foreach($completeUrl as $key=>$value){			$urlString.= $key.":".$value."/";
	}
}	
		$this->set('urlString',$urlString);		if(isset($this->params['form']['publish'])){
			$setValue = array('status' => "'1'");			$messageStr = "<div class='success-message flash notice'>Selected user(s) have been activated.</div>";
		}elseif(isset($this->params['form']['unpublish'])){			$setValue = array('status' => "'0'");			$messageStr = "<div class='success-message flash notice'>Selected user(s) have been deactivated.</div>";
} 		if(!empty($setValue)){
		if(isset($this->params['form']['IDs'])){
			$saveString = implode("','",$this->params['form']['IDs']);
	}
		if($saveString != ""){
			$this->ProjectsUpdate->updateAll($setValue,"ProjectsUpdate.id in ('".$saveString."')");			$this->Session->setFlash($messageStr);	}}
		$this->paginate = array(
	'fields' => array(	'ProjectsUpdate.id',	'User.username',	'ProjectsUpdate.screen_name',	'Project.name',	'ProjectsUpdate.description',	'ProjectsUpdate.status',	'ProjectsUpdate.created'	),	'page'=> 1,'limit' => RECORDS_PER_PAGE,	'order' => array('ProjectsUpdate.id' => 'desc'));
		$this->ProjectsUpdate->expects(array("Project","User"));		$data = $this->paginate('ProjectsUpdate',$criteria);		$this->set('resultData', $data);}




}