<?php
/*
	* weblead Model class
	* PHP versions 5.3.5
	* @date 20-Aug-2011
	* @Purpose:This model handles all the validations regarding weblead management.
	* @filesource
	* @author  Netset Solutions
	* @revision
	* @version 1.3.12
*/

class Weblead extends AppModel {
    var $name = 'Weblead';
    var $validate = array(
			'name' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Name."
			),
			'email' => array(
				'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => "Enter your email.",
				 'last' => true
				),
				'ruleName2' => array(
				'rule' => array('email'),
				'message' => "Enter valid email address."
				),
			),
			'description' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Description."
			)
    ); 
 	
}
?>