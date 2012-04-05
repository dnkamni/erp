<?php
/**
* StaticPage Model class
*/
class StaticPage extends AppModel {
    var $name = 'StaticPage';
    var $validate = array(
		'title' => array(
		'rule' => 'notEmpty',
		'message' => "Enter page title."
		),
	'name' => array(
		'rule' => 'notEmpty',
		'message' => "Enter name."
	),
	'subject' => array(
		'rule' => 'notEmpty',
		'message' => "Enter subject."
	),
	'email' => array(
		'rule' => array('email'),
		'message' => "Enter valid email address."
	),
	'website' => array(
		'rule' => array('url', true),
		'message' => "Enter valid website.",
		'allowEmpty' => true
	),
	'phone' => array(
		    'rule' => array('phone', '/^\s*[0-9\-\+\s]+$/i', 'us'),
		    'message' => "Enter valid phone number.",
		    'allowEmpty' => true
        ),
	'feedback' => array(
		'rule' => 'notEmpty',
		'message' => "Write your question/feedback."
	),
    );
}
?>