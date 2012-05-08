<?php
/**
* User Model class
*/
class Employee extends AppModel {
    var $name = 'User';
    var $validate = array(			'employee_code' => array(				'notEmpty' => array(				'rule' => 'notEmpty',				'message' => "Enter employee code.",				 'last' => true				),				'isUnique' => array(				'rule' => 'isUnique',				'message' => "Employee code already exists."				)			),			
			'first_name' => array(
				'rule' => 'notEmpty',
				'message' => "Enter first name.",
			),
			'last_name' => array(
				'rule' => 'notEmpty',
				'message' => "Enter last name."
			),			'father_name' => array(				'rule' => 'notEmpty',				'message' => "Enter father's name."			),			'mother_name' => array(				'rule' => 'notEmpty',				'message' => "Enter mother's name."			),			'current_salary' => array(				'notEmpty' => array(				'rule' => 'notEmpty',				'message' => "Enter salary.",				 'last' => true				),				'number' => array(				'rule' => 'numeric',				'message' => "Enter valid salary."				)			),			/*'doj1' => array(				'rule' => 'notEmpty',				'message' => "Enter valid date of joining."			),			'dor1' => array(				'rule' => 'notEmpty',				'message' => "Enter valid date of relieving.",			),*/
			'phone' => array(
				'rule' => array('phone', '/^\s*[0-9\-\+\s]+$/i', 'us'),
				'message' => "Enter valid phone number.",
			),
			'password' => array(
				'rule' => 'notEmpty',
				'message' => "Enter your password."
			),
			'personal_email' => array(
				'rule' => array('email'),
				'message' => "Enter valid personal email.",				'allowEmpty' => true
			),
			'username' => array(
				'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => "Enter your username.",
				 'last' => true
				),
				'isUnique' => array(
				'rule' => 'isUnique',
				'message' => "Username already exists."
				)
			),
			'email' => array(
				'notEmpty' => array(
				'rule' => 'notEmpty',
				'message' => "Enter your email.",
				 'last' => true
				),
				'ruleName2' => array(
				'rule' => array('email'),
				'message' => "Enter valid email address."
				),
				'isUnique' => array(
				'rule' => 'isUnique',
				'message' => "Email address already exists."
				)
            ),
			'dob_year' => array(
				'rule' => array('validDOB','dob_month','dob_date'),
				'message' => "Date of birth should not be greater than today's date."
			)
    );
   
   /**
    * @Date: 22-Aug-2010
    * @Method : validDOB
    * @Purpose: Validate Date of Birth
    * @Param: $field
    * @Return: boolean
    **/
	function validDOB($field = array(),$compare_month = null,$compare_date = null) {		 foreach($field as $key => $value){		$v1 = trim($value);		$v2 = strtotime($v1.'-'.$this->data['Employee'][ $compare_month ].'-'.$this->data['Employee'][ $compare_date ]);        if($v2 > time()){            return false;        }    }	return true;	
   }
}
?>