<?php
/*
	* Testimonial Model class
	* PHP versions 5.3.5
	* @date 30-Dec-2011
	* @Purpose:This model handles all the validations regarding testimonial management.
	* @filesource
	* @author  Netset Solutions
	* @revision
	* @version 1.3.12
*/

class Testimonial extends AppModel {
    var $name = 'Testimonial';
    var $validate = array(
			'author' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Author."
			),
			'published' => array(
				'rule' => 'notEmpty',
				'message' => "Published by."
			),
			'description' => array(
				'rule' => 'notEmpty',
				'message' => "Enter Description."
			)
    ); 
 	
}
?>