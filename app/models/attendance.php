<?php
/*
	* Attendance Model class
	* PHP versions 5.3.5
	* @date 28-Dec-2011
	* @Purpose:This model handles all the validations regarding Attendance management.
	* @filesource
	* @author  Netset Solutions
	* @revision
	* @version 1.3.12
*/

class Attendance extends AppModel {
    var $name = 'Attendance';
    var $validate = array(
			'user_id' => array(
				'rule' => 'notEmpty',
				'message' => "Enter User ID."
			),
			'date1' => array(
				'rule' => 'notEmpty',
				'message' => "Enter date."
			),
			'time_in' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Time."
			),
			
			'time_out' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Time."
			
			)
    );
	
	var $assocs = array(
     'User' => array(
      'type' => 'belongsTo',
      'className' => 'User',
      'foreignKey' =>'user_id'
     ),
     
	 	 
);
	
}
?>