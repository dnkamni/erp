<?php
/*
	* Credential Model class
	* PHP versions 5.3.5
	* @date 20-Aug-2011
	* @Purpose:This model handles all the validations regarding credential management.
	* @filesource
	* @author  Netset Solutions
	* @revision
	* @version 1.3.12
*/

class Credential extends AppModel {
    var $name = 'Credential';
    var $validate = array(
			'username' => array(
				'rule' => 'notEmpty',
				'message' => "Enter User Name."
			),
			'password' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Password."
			),
			'confirm_password' => array(
				'ruleName' => array(
				'rule' => 'notEmpty',
				'message' => "Enter confirm password."
				),
				'ruleName2' => array(
				'rule' => array('matchPasswords','password'),
				'message' => "Password and confirm password must be same."
				)
            ),
			'type' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Type."
			), 
			
    );
	
	
    /**
    * @Date: 20-Aug-2011
    * @Method : matchPasswords
    * @Purpose: Check if password entered by User is equal to confirm password
    * @Param: $field, $compare_field
    * @Return: boolean
    **/
	
	function matchPasswords($field = array(),$compare_field = null) {
        foreach($field as $key => $value){
        $v1 = trim($value);
		$v2 = trim($this->data[$this->name][ $compare_field ]);
        if($v1 != "" && $v2 !="" && $v1 != $v2){
            return false; 
        }
         return true;
      }
    }
   

   
   /**
    * @Date: 20-Aug-2011
    * @Method : isOldPasswordExists
    * @Purpose: Check if old password verified
    * @Param: $field
    * @Return: boolean
    **/
	
	function isOldPasswordExists($field = array()) {
	// Import Session Component
		App::import('Component', 'SessionComponent');
		$this->Session = new SessionComponent();
		$userSession = $this->Session->read("SESSION_ADMIN");
        foreach( $field as $key => $value ){
			$v1 = md5(trim($value));
			$result = $this->find('first', array('conditions' => array('id' => $userSession[0], 'password'=>$v1),'fields'=>array('id')));
			if(!is_array($result)){
				return false; 
			 }
			return true;
		}
    }
}
?>