<?php
/*
	* Salary Model class
	* PHP versions 5.3.5
	* @date 28-Dec-2011
	* @Purpose:This model handles all the validations regarding Salary management.
	* @filesource
	* @author  Netset Solutions
	* @revision
	* @version 1.3.12
*/

class Salary extends AppModel {
    var $name = 'Salary';
    var $validate = array(
			'user_id' => array(
				'rule' => 'notEmpty',
				'message' => "Enter User Id."
			),
			'month' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Month."
			),
			'year' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Year."
			),
			'salary' => array(
			'notEmpty' =>array(
			'rule' => 'notEmpty',
			'message'=> "Enter your Salary in numeric format",
			'last'=> true
			),
			'ruleName2'=>array(
				'rule' => 'Numeric',
				'message' => "Enter Valid  Salary."	
			)
			),		
			'notes' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Notes."
			),		
    );
	
	var $assocs = array(
		 'User' => array(
		'type' => 'belongsTo',
		 'className' => 'User',
		'foreignKey' =>'user_id'
		)
	);
	

}
?>