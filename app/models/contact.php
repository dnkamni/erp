<?php
/*
	* Contact Model class
	* PHP versions 5.3.5
	* @date 28-Dec-2011
	* @Purpose:This model handles all the validations regarding contact management.
	* @filesource
	* @author  Netset Solutions
	* @revision
	* @version 1.3.12
*/

class Contact extends AppModel {
    var $name = 'Contact';
    var $validate = array(
			'name' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Name."
			),
			'communication_details' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Communication Details."
			),
			'skill_set' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Skill Set."
			),
			'bank_details' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Bank Details."
			)				
    );
}
?>