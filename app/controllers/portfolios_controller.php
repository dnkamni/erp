<?php

	/**
	* Portfolio Controller class
	* PHP versions 5.3.5
	* @date 2-Jan-2012
	* @Purpose:This controller handles all the functionalities regarding Portfolio management.
	* @filesource
	* @author  Netset Solutions
	* @revision
	* @version 1.3.12
	**/
App::import('Sanitize');

class PortfoliosController extends AppController
{
    var $name       	=  "Portfolios";

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
    var $uses       	=  array('Portfolio'); // For Default Model

/******************************* START FUNCTIONS **************************/

	#_________________________________________________________________________#

    /**
    * @Date: 2-Jan-2012
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
    * @Date: 2-Jan-2012
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
    * @Date: 2-Jan-2012
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
    * @Date: 3-Jan-2012
    * @Method : details
    * @Purpose: This is the default function of the administrator section for users
    * @Param: none
    * @Return: none 
    **/

	function view($slug=null) {

	$this->layout="layout_inner";
	$cond = array_merge(array('OR'=>array("Portfolio.technology LIKE"=>'%'.$slug.'%','Portfolio.domain LIKE'=>'%'.$slug.'%')));
	$result = $this->Portfolio->find('all',array('conditions'=>$cond));
    $this->set("resultData",$result);
   }

	#_________________________________________________________________________#

    /**
    * @Date: 3-Jan-2012
    * @Method : details
    * @Purpose: This is the default function of the administrator section for users
    * @Param: none
    * @Return: none 
    **/

	function details($id=null) {

 $this->layout="layout_inner";	
		$this->set("title_for_layout","NetSet Software:: Software Development Company India | Custom Software Application Development | Outsource Web Development Services");
		$cond = array('Portfolio.published'=>'1','Portfolio.id'=>$id);
		$conditions = array(
        'fields' => array(
        'id',
		'title',
		'description',
		'image1',
		'imageblock ',				
		'long_description',
		'technology',
		'domain',
		'url'
		    ),
		'conditions'=>$cond,
		'order' => array('id' => 'desc')
			    );
	$data = $this->Portfolio->find('all',$conditions);
    $this->set('resultData', $data);
    }
	}

	?>

	

