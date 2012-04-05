<?php
/*
	* ProjectUpdate Model class
	* PHP versions 5.3.5
	* @date 20-Aug-2011
	* @Purpose:This model handles all the validations regarding ProjectUpdate management.
	* @filesource
	* @author  Netset Solutions
	* @revision
	* @version 1.3.12
*/

class ProjectsUpdate extends AppModel {
    var $name = 'ProjectsUpdate';
	  var $validate = array(
	'screen_name' => array(
				'rule' => 'notEmpty',
				'message' => "Enter screen name."
			),
			'user_id' => array(
				'rule' => 'notEmpty',
				'message' => "Enter User ID."
			),
			'project_id' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Project Id."
			),
			'technology' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Technology."
			)
    );
	var $assocs = array(
	 'User' => array(
      'type' => 'belongsTo',
      'className' => 'User',
      'foreignKey' =>'user_id'
     ),
	
     'Project' => array(
      'type' => 'belongsTo',
      'className' => 'Project',
      'foreignKey' =>'project_id'
     )
	 
);
	

}
?>