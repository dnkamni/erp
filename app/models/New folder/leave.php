<?php
/*
	* Leave Model class
	* PHP versions 5.3.5
	* @date 20-Aug-2011
	* @Purpose:This model handles all the validations regarding Leave management.
	* @filesource
	* @author  Netset Solutions
	* @revision
	* @version 1.3.12
*/

class Leave extends AppModel {
    var $name = 'Leave';
    var $validate = array(
			'user_id' => array(
				'rule' => 'notEmpty',
				'message' => "Enter User Id."
			),
			'requested_user_id' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Requested User Id."
			),
			'reason' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Reason."
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