<?php
/*
	* Project Model class
	* PHP versions 5.3.5
	* @date 20-Aug-2011
	* @Purpose:This model handles all the validations regarding project management.
	* @filesource
	* @author  Netset Solutions
	* @revision
	* @version 1.3.12
*/

class Project extends AppModel {
    var $name = 'Project';
    var $validate = array(
			'name' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Project name."
			),
			'client_id' => array(
				'rule' => 'notEmpty',
				'message' => "Enter client id."
			),
			'technology' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Technology."
			),
			'name' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Project name."
			),
			'client_id' => array(
				'rule' => 'notEmpty',
				'message' => "Enter client id."
			)
			
    );
	var $assocs = array(
     'Client' => array(
      'type' => 'belongsTo',
      'className' => 'Client',
      'foreignKey' =>'client_id'
     ),	 
);
	

}
?>