<?php
/*
	* Transaction Model class
	* PHP versions 5.3.5
	* @date 20-Aug-2011
	* @Purpose:This model handles all the validations regarding transaction management.
	* @filesource
	* @author  Netset Solutions
	* @revision
	* @version 1.3.12
*/

class Transaction extends AppModel {
    var $name = 'Transaction';
    var $validate = array(
			'amount' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Amount."
			),
			'description' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Description."
			),
    ); 
 	
}
?>