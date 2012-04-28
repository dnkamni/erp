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
			'email_address' => array(
				'ruleName' => array(
				'rule' => 'notEmpty',
				'message' => "Enter email address(s).",
				'last' => true
				),
				'ruleName2' => array(
				'rule' => array('verifyEmails'),
				'message' => 'Some of the email addresses is not valid.'
				)
            )
    );
	
	/**

    * @Date: 25-April-2012

    * @Method : verifyEmails

    * @Purpose: Validate Comma seperated email address

    * @Param: $field

    * @Return: boolean

    **/

	function verifyEmails($field = array()) {

        foreach($field as $key => $value){

        $v1 = explode(",",$value);
		foreach($v1 as $value){
        if($value != "" && !eregi("^[\'+\\./0-9A-Z^_\`a-z{|}~\-]+@[a-zA-Z0-9_\-]+(\.[a-zA-Z0-9_\-]+){1,3}$",trim($value))){
			return false;
			break;
         }
		}
		}
		return true;
	}
	
}
?>