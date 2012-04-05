<?php
/*
	* User Model class
	* PHP versions 5.3.5
	* @date 20-Aug-2011
	* @Purpose:This model handles all the validations regarding user management.
	* @filesource
	* @author  Netset Solutions
	* @revision
	* @version 1.3.12
*/

class Role extends AppModel {
    var $name = 'Role';
    var $validate = array(
			'role' => array(
				'rule' => 'notEmpty',
				'message' => "Enter User Role."
			),
			'description' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Description."
			),
    ); 
 	
}
?>