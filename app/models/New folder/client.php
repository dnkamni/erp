<?php
/*
	* Client Model class
	* PHP versions 5.3.5
	* @date 20-Aug-2011
	* @Purpose:This model handles all the validations regarding client management.
	* @filesource
	* @author  Netset Solutions
	* @revision
	* @version 1.3.12
*/

class Client extends AppModel {
    var $name = 'Client';
    var $validate = array(
			'client_name' => array(
				'rule' => 'notEmpty',
				'message' => "Enter client Name."
			),
			'client_address' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Client Address."
			),
			
			'heard_from' => array(
				'rule' => 'notEmpty',
				'message' => "Heard From."
			),
			'contact_details' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Contact Details."
			)
    );
	   
}
?>