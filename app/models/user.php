<?php
/**
* User Model class
*/
class User extends AppModel {
    var $name = 'User';
    var $validate = array(
			'first_name' => array(
				'rule' => 'notEmpty',
				'message' => "Enter first name."
			),
			'last_name' => array(
				'rule' => 'notEmpty',
				'message' => "Enter last name."
			),
			'phone' => array(
				'rule' => array('phone', '/^\s*[0-9\-\+\s]+$/i', 'us'),
				'message' => "Enter valid phone number.",
				'allowEmpty'=>true
			),
			'password' => array(
				'rule' => 'notEmpty',
				'message' => "Enter your password."
			),
			'address1' => array(
				'rule' => 'notEmpty',
				'message' => "Enter address field 1."
			),
			'user_name' => array(
				'rule' => 'notEmpty',
				'message' => "Enter your username or email."
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
			'old_password' => array(
				'ruleName' => array(
				'rule' => 'notEmpty',
				'message' => "Enter old password.",
				 'last' => true
				),
				'ruleName2' => array(
				'rule' => array('isOldPasswordExists'),
				'message' => "Old password doesnot exists."
				)
			),
			'confirm_password' => array(
				'ruleName' => array(
				'rule' => 'notEmpty',
				'message' => "Enter confirm password."
				),
				'ruleName2' => array(
				'rule' => array('matchPasswords','password'),
				'message' => "Password and confirm password must be same."
				)
            ),
			'dob' => array(
				'rule' => array('validDOB'),
				'message' => "Date of birth should not be greater than today's date."
			),
			'summary' => array(
				'rule' => 'notEmpty',
				'message' => "Enter description."
			),
		  'url' => array(
		       'rule' => array('url'),
		       'message' => "Enter valid url of website.",
			   'allowEmpty' => true,
	       ),
    );
	
	  var $assocs = array(
		'ProductRetailer' => array(
				'type'       => 'hasMany',
				'className'  => 'ProductRetailer',
				'foreignKey' => 'user_id',
		  ),
	    'ProductsBrand' => array(
						'type' => 'belongsTo',
						'className' => 'ProductsBrand',
						'foreignKey' =>'brand_id'
					),
		
    );
	
	  
    /**
    * @Date: 14-Aug-2010
    * @Method : matchPasswords
    * @Purpose: Check if password entered by User is equal to confirm password
    * @Param: $field, $compare_field
    * @Return: boolean
    **/
	function matchPasswords($field = array(),$compare_field = null) {
        foreach($field as $key => $value){
        $v1 = trim($value);
		$v2 = trim($this->data[$this->name][ $compare_field ]);
        if($v1 != "" && $v2 !="" && $v1 != $v2){
            return false; 
        }
         return true;
    }
   }
   
   /**
    * @Date: 22-Aug-2010
    * @Method : validDOB
    * @Purpose: Validate Date of Birth
    * @Param: $field
    * @Return: boolean
    **/
	function validDOB($field = array()) {
        foreach($field as $key => $value){
        $v1 = trim($value);
        if($v1 != "" && $v1 > date('Y-m-d')){
            return false; 
        }
         return true;
    }
   }
   
   /**
    * @Date: 04-Feb-2010
    * @Method : isOldPasswordExists
    * @Purpose: Check if old password verified
    * @Param: $field
    * @Return: boolean
    **/
	function isOldPasswordExists($field = array()) {
	// Import Session Component
		App::import('Component', 'SessionComponent');
		$this->Session = new SessionComponent();
		$userSession = $this->Session->read("SESSION_ADMIN");
        foreach( $field as $key => $value ){
			$v1 = md5(trim($value));
			$result = $this->find('first', array('conditions' => array('id' => $userSession[0], 'password'=>$v1),'fields'=>array('id')));
			if(!is_array($result)){
				return false; 
			 }
			 return true;
		}
   }
}
?>