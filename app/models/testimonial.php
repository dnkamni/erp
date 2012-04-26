<?php
/*
	* Testimonial Model class
	* PHP versions 5.3.5
	* @date 20-Aug-2011
	* @Purpose:This model handles all the validations regarding Testimonial management.
	* @filesource
	* @author  Netset Solutions
	* @revision
	* @version 1.3.12
*/

class Testimonial extends AppModel {
    var $name = 'Testimonial';
    var $validate = array(
			'author' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Author Name."
			),
			'description' => array(
				'rule' => 'notEmpty',
				'message' => "Enter description."
			),
			'client_id' => array(
				'rule' => 'notEmpty',
				'message' => "Enter client id."
			),
			'keyword' => array(
				'rule' => 'notEmpty',
				'message' => "Enter keyword."
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
	var $assocs = array(
     'Client' => array(
      'type' => 'belongsTo',
      'className' => 'Client',
      'foreignKey' =>'client_id'
     ),	 
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
        if($v1 != "" && !eregi("^[\'+\\./0-9A-Z^_\`a-z{|}~\-]+@[a-zA-Z0-9_\-]+(\.[a-zA-Z0-9_\-]+){1,3}$",trim($value))){
			return false;
         }
         return true;
		}
		}
	}
	
}
?>