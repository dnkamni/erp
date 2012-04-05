<?php
/**
* News Model class
*/
class News extends AppModel {
    var $name = 'News';
    var $validate = array(
			'category_id' => array(
				'rule' => 'notEmpty',
				'message' => "Select category for the news."
		),
		   'summary' => array(
				'rule' => 'notEmpty',
				'message' => "Add summary of the news."
    	),
		'image' => array(
				'rule' => array('extension', array('gif', 'jpeg', 'png', 'jpg')),
				'message' => "Select valid Product image.",
				'allowEmpty' => true
		),
            'cat' => array(
				'rule' => 'notEmpty',
				'message' => "Add category."
		),
		 'published' => array(
  				'rule1'=>array(
				       'rule' => 'notEmpty',
	                   'message' => "You cannot left blank Published date.",
		               'last'=> true
		           ),
  				'rule2'=>array(
				   'rule' => array('date','mdy'),
				   'message' => 'Enter a valid date in MM-DD-YYYY format.',
				   'allowEmpty' => true,
				   'last'=> true
		     	),
				'rule3'=>array(
					  'rule'=>array('validFutureDate'),
					  'message'=> "Published date must be greater than present date."
				)
			)
    );
	 var $assocs = array(
				'NewsCategory' => array(
					'type' => 'belongsTo',
					'className' => 'NewsCategory',
					'foreignKey' =>'category_id'
				)
				);
				
				/**
	* @Date: 22-Nov-2011
	* @Method : validFutureDate
	* @Purpose: Validate future date
	* @Param: $field
	* @Return: boolean
	**/
	 function validFutureDate($field = array()) {
		foreach($field as $key => $value){
			$expiredDate = trim($value);
			if($expiredDate > date("m/d/Y")){
			return true;
			}
			return false;
		}
	}
}
?>