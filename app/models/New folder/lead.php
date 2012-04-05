<?php
/*
	* Lead Model class
	* PHP versions 5.3.5
	* @date 28-Dec-2011
	* @Purpose:This model handles all the validations regarding lead management.
	* @filesource
	* @author  Netset Solutions
	* @revision
	* @version 1.3.12
*/

class Lead extends AppModel {
    var $name = 'Lead';
    var $validate = array(
			'client_name' => array(
				'rule' => 'notEmpty',
				'message' => "Enter client Name."
			),
			'project_name' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Project Name ."
			),
			'date_applied' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Date applied."
			),
			
			'lead_from' => array(
				'rule' => 'notEmpty',
				'message' => "Heard From."
			),
			'contact_details' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Contact Details."
			),
			'perspective_amount' => array(
			'notEmpty' =>array(
			'rule' => 'notEmpty',
			'message'=> "Enter your Amount.",
			'last'=> true
			),
			'ruleName2'=>array(
				'rule' => 'Numeric',
				'message' => "Enter Valid  Amount(in Numerics)."
				
			)
			
			),
			
    );
	
	
  
}
?>