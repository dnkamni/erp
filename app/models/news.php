<?php

/**
* News Model class
*/

class News extends AppModel {

    var $name = 'News';      
    var $validate = array(   
			'title' => array(    
			'rule' => 'notEmpty',
			'message' => "Select Title."
		),
		'description' => array(
				'rule' => 'notEmpty',
				'message' => "Select Description."
		)                                     
		);
}    
?>