<?php


/**
* App Model class
*/

class AppModel extends Model {
 
    var $assocs = array();
    function expects($array) {
        foreach ($array as $assoc) {
                $type = $this->assocs[$assoc]['type'];
                unset($this->assocs[$assoc]['type']);
                $this->bindModel(
                        array($type =>
                                array($assoc => $this->assocs[$assoc])
                            ),false
                        );
        } 

    }

   /**
    * @Date: 22-Aug-2010
    * @Method : validData
    * @Purpose: Validate string for special character
    * @Param: $field
    * @Return: boolean
    **/
	function validData($field = array()) {
        foreach($field as $key => $value){
        $v1 = trim($value);
	
        if(preg_match("/[~!@#$%^&*]/",$v1, $matches)){
            return false; 
        }
         return true;
    }
   }

   /**
    * @Date: 22-Aug-2010
    * @Method : validNumber
    * @Purpose: Validate numerics only
    * @Param: $field
    * @Return: boolean
    **/
	function validFloat($field = array()) {
        foreach($field as $key => $value){
        $v1 = trim($value);
	
        if(preg_match("/^\s*([0-9]*)\.?[0-9]*\s*$/i",$v1, $matches)){
            return true; 
        }
         return false;
    }
   }

   /**
    * @Date: 22-Aug-2010
    * @Method : validNumber
    * @Purpose: Validate numerics only
    * @Param: $field
    * @Return: boolean
    **/
	function validNumber($field = array()) {
        foreach($field as $key => $value){
        $v1 = trim($value);
	
        if(preg_match("/^\s*[0-9]+\s*$/i",$v1, $matches)){
            return true; 
        }
         return false;
    }
   }

   /**
    * @Date: 07-Oct-2010
    * @Method : this function doesnt validate the fields passed in an array
    * @Purpose: Validate numerics only
    * @Param: $field
    * @Return: boolean
    **/
   function uninvalidate($fields = array())
   {
	foreach($fields as $field) {
	if (isset($this->validate[$field])) {
		unset($this->validate[$field]);
	}
	}
   }

}
?>