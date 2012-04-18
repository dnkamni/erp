<?php


	/**
	* Salaries Controller class
	* PHP versions 5.3.5
	* @date 28-Dec-2011
	* @Purpose:This controller handles all the functionalities regarding salary management.
	* @filesource
	* @author  Netset Solutions
	* @revision
	* @version 1.3.12
	**/

	App::import('Sanitize');

class SalariesController extends AppController

{
    var $name       	=  "Salaries";
	
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
    var $uses       	=  array('Salary','User'); // For Default Model

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
    * @Purpose: This function is to show list of salaries given to the employee.
    * @Param: none
    * @Return: none 
    **/

    function admin_list(){

		$this->set('title_for_layout','Salary Listing');
		$this->set("pageTitle","Salary Listing");
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

			$this->Salary->deleteAll("Salary.id in ('".$deleteString."')");
			$this->Session->setFlash("<div class='success-message flash notice'>Salary(s) deleted successfully.</div>");
			$this->redirect('list');

		}

	}

	

		if(isset($this->data['Salary']) || !empty($this->params['named'])) {

		if(!empty($this->data['Salary']['fieldName']) || isset($this->params['named']['field'])){

			if(trim(isset($this->data['Salary']['fieldName'])) != ""){

				$search1 = trim($this->data['Salary']['fieldName']);
			}elseif(isset($this->params['named']['field'])){
				$search1 = trim($this->params['named']['field']);
			}
			$this->set("search1",$search1);
		}

		if(isset($this->data['Salary']['value1']) || isset($this->data['Salary']['value2']) || isset($this->params['named']['value'])){

		if(isset($this->data['Salary']['value1']) || isset($this->data['Salary']['value2'])){
			
		$search2 = ($this->data['Salary']['fieldName'] != "Salary.status")?trim($this->data['Salary']['value1']):$this->data['Salary']['value2'];
		}elseif(isset($this->params['named']['value'])){

				$search2 = trim($this->params['named']['value']);
			}
			$this->set("search2",$search2);
		}

		//echo $search1."------".$search2;

		/* Searching starts from here */

		if(!empty($search1) && (!empty($search2) || $search1 == "Salary.status")){

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

			$this->Salary->updateAll($setValue,"Salary.id in ('".$saveString."')");
			$this->Session->setFlash($messageStr);
		}

	}

		$this->paginate = array(

		'fields' => array(
		'Salary.id',
		'User.first_name',
		'Salary.month',
		'Salary.year',
		'Salary.salary',
		'Salary.notes',
		'Salary.status',
		'Salary.created'
		),
		'conditions' => array(),
		'page'=> 1,'limit' => RECORDS_PER_PAGE,
		'order' => array('Salary.id' => 'desc')
	);

	$this->Salary->expects(array("User"));
	$data = $this->paginate('Salary',$criteria);
	//pr(	$data);die;
	$this->set('resultData', $data);
	$data = $this->paginate('Salary',$criteria);
	$this->set('resultData', $data);
	}


	#_________________________________________________________________________#

    /**
    * @Date: 28-Dec-2011
    * @Method : admin_add
    * @Purpose: This function is to add/edit salary from admin section.
    * @Param: $id
    * @Return: none 
    * @Return: none 
    **/

	function admin_add($id = null) {

		if(!empty($id) || !empty($this->data['Salary']['id'])){
		
		    $this->set('title_for_layout','Edit Salary');
			$this->pageTitle = "Edit Salary";
			$this->set("pageTitle","Edit Salary");
			$mode = "edit";
		}else{

		    $this->set('title_for_layout','Add Salary');
			$this->pageTitle = "Add Salary";
			$this->set("pageTitle","Add Salary");
			$mode = "add";
		}

		if($this->data){

			$this->Salary->set($this->data['Salary']);
			$isValidated = $this->Salary->validates();
		if($isValidated){
			$this->Salary->save($this->data, array('validate'=>false));
			$this->redirect(array('action' => 'list'));
		}else{

			$this->set("Error",$this->Salary->invalidFields());
			}

		}else if(!empty($id)){

			$this->data = $this->Salary->find('first', array('conditions'=>array('id'=>Sanitize::escape($id))));	
			if(!$this->data){

			$this->redirect(array('action' => 'list'));

			}

		}



	}

	

}