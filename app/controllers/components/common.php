<?php 
/*
This Component is used for creating common function which could be reuse by other controllers

*/
class CommonComponent extends Object { //cake extends Object for creating component
	/**  @Date: 21-Aug-2010
    	*@Method : licenceCode (This 
    	*@Purpose: This function is used to generate licence code.
    **/
	function randomCode($plength='8'){

		$code="";
		$chars = 'ABCDEFGHJKLMNPQRTUVWXY346789ABCDEFGHJKLMNPQRTUVWXY346789';//string by which new code will be generated
		mt_srand(microtime() * 1000000);
		for($i = 0; $i < $plength; $i++) {
			$key = mt_rand(0,strlen($chars)-1);
			$code = $code . $chars{$key};
		}
		$code=trim($code);
		return $code ;

	}

	/** @Date: 22-Aug-2010
    	*@Method : getUserDropdown
    	*@Purpose: This function is used to generate licence code.
    **/

	function getUserDropdown(){
	
		App::import('Model','User');
		$this->User = new User();
		$this->User->unbindModel(array('hasMany' => array('Licence','Order')));
		$result = $this->User->find('all', array( 
			'fields'=>array('id','status','username'),
			'order'=>'username ASC',
			'conditions' => "User.id != '1'"
		));
		$return = array(''=>'Select User');
		foreach($result as $row){
			$return[$row['User']['id']] = ucwords($row['User']['username'])." (".(($row['User']['status'] == '1')?'Active':'Inactive').")";
		}
		return $return;
	}

    /** @Date: 5-Feb-2010
    	*@Method : sendHtmlEmail
    	*@Purpose: This function is used to send email(template) using cakephp email component.
    **/
	function sendHtmlEmail($to = null,$subject = null,$bcc = array(),$template = null,$emailInfo = array())	{

		App::import('Component', 'Email'); // Import Email component
		$this->Email = new EmailComponent();
		$this->Email->to       = $to;
		$this->Email->bcc      = $bcc;
		$this->Email->subject  = $subject;
		$this->Email->replyTo  = "support@netsetsoftware.com";
		$this->Email->from     = "support@netsetsoftware.com";
		$this->Email->template = $template;
		$this->Email->sendAs   = 'html';
		$this->Email->xMailer  = "";
		if ($this->Email->send()) {
			return true;
		}else{
			return false;
		}
	}
    /**

    	* @Date: 11-Nov-2009
    	*@Method : changeDateFormat
    	*@Purpose:Gets Details of a Date Span . Called Via AJAX.
    **/

	function changeDateFormat($date = "", $format_in = "", $format_to = ""){

      $tmp_date = explode("-",$date);
      switch($format_in){
	  case "Y-m-d":
	  $t_stmp = mktime(0,0,0,$tmp_date[1],$tmp_date[2],$tmp_date[0]);
	  case "m-d-Y":
	  $t_stmp = mktime(0,0,0,$tmp_date[0],$tmp_date[1],$tmp_date[2]);
      }
      return date($format_to,$t_stmp);
         }

   /**

    * @Date: 18-Nov-2009
    *@Method : getSortLabel
    *@Purpose: Used for sorting purpose
   **/

  function getSortLabel($orderBy = "",$params = ""){

	if($orderBy!="" && is_array($params) && count($params)>0){

		if(isset($params['sort']) && $params['sort']!="" && $orderBy==$params['sort']){

			if(isset($params['direction'])){

				if($params['direction'] == "asc"){
					return "&uarr;";
				}else{
					return "&darr;";
				}
			}

		}elseif($orderBy == "Account.first_name"){
			return "&darr;";
		}

	}elseif($orderBy == "Account.first_name" && count($params)==0){
		return "&darr;";
	}
     }
    /**

    	* @Date: 26-Nov-2009
    	*@Method : getStateArray
    	*@Purpose: Get an array of US states
    **/

  function getStateArray(){

    return array(""=>"",
	"AK"=>"AK",
	"AL"=>"AL",
	"AR"=>"AR",
	"AS"=>"AS",
    "AZ"=>"AZ",
	"CA"=>"CA",
	"CO"=>"CO",
	"CT"=>"CT",
	"DC"=>"DC",
	"DE"=>"DE",
	"FL"=>"FL",
	"GA"=>"GA",
	"GU"=>"GU",
	"HI"=>"HI",
	"IA"=>"IA",
	"ID"=>"ID",
	"IL"=>"IL",
	"IN"=>"IN",
	"KS"=>"KS",
	"KY"=>"KY",
	"LA"=>"LA",
	"MA"=>"MA",
	"MD"=>"MD",
	"ME"=>"ME",
	"MI"=>"MI",
	"MN"=>"MN",
	"MO"=>"MO",
	"MS"=>"MS",
	"MT"=>"MT",
	"NC"=>"NC",
	"ND"=>"ND",
	"NE"=>"NE",
	"ND"=>"ND",
	"NH"=>"NH",
	"NJ"=>"NJ",
	"NV"=>"NV",
	"NY"=>"NY",
	"OH"=>"OH",
	"OK"=>"OK",
	"OR"=>"OR",
	"PA"=>"PA",
	"PR"=>"PR",
	"RI"=>"RI",
	"SC"=>"SC",
	"SD"=>"SD",
	"TN"=>"TN",
	"TX"=>"TX",
	"UT"=>"UT",
	"VA"=>"VA",
	"VT"=>"VT",
	"VI"=>"VI",
	"WA"=>"WA",
	"WI"=>"WI",
	"WV"=>"WV",
	"WY"=>"WY");
  }
  /**
    * @Date: 1-Dec-2009
    *@Method : getRandomNumber
    *@Purpose: Generates a random number
  **/

    function getRandomNumber(){

      srand ((double) microtime( )*1000000);
      $random_number = rand();
      return $random_number;
  }

   /**
    * @Date: 16-Dec-2009
    *@Method : getMonthsArray
    *@Purpose: Get an array of Months
  **/

  function getMonthsArray(){

    return array("01" => "January",
	"02" => "February",
	"03" => "March",
	"04" => "April",
	"05" => "May",
	"06" => "June",
	"07" => "July",
	"08" => "August",
	"09" => "September",
	"10" => "October",
	"11" => "November",
	"12" => "December"
		);
  }

   /**
	 * @Date: 16-Dec-2009
	 *@Method : getDaysArray
	 *@Purpose: Get an array of days
   **/

   function getDaysArray(){
   
      $i 		= 1;
      $array 	= array();
      while($i<=31){
      $array[$i] = $i;
	  $i++;
      }
      return $array;
   }
   /**
    * @Date: 16-Dec-2009
    *@Method : getDaysArray
    *@Purpose: Get an array of years
   **/

   function getYearsArray(){

      $i 	= date("Y")-100;
      $array 	= array();
      while($i<=date("Y")){
	  $array[$i] = $i;
	  $i++;
      }
      return $array;
   }
   /** @Date: 11-Jan-2009
    *@Method : getRandomString
    *@Purpose: generates random number.
  **/
	function getRandomString($length)

	{
		if($length>0) 
		{ 
		$rand_id="";
		for($i=1; $i<=$length; $i++)
		{
		mt_srand((double)microtime() * 1000000);
		$num = mt_rand(1,36);
		$rand_id .= $this->assign_rand_value($num);
		}
		}
		return $rand_id;
	}

   /** @Date: 11-Jan-2009
    *@Method : assign_rand_value
    *@Purpose: generates random number. This function is used by getRandomString function.
  **/

      function assign_rand_value($num)
	{
	// accepts 1 - 36
	switch($num)
	{
	case "1":
	$rand_value = "a";
	break;
	case "2":
	$rand_value = "b";
	break;
	case "3":
	$rand_value = "c";
	break;
	case "4":
	$rand_value = "d";
	break;
	case "5":
	$rand_value = "e";
	break;
	case "6":
	$rand_value = "f";
	break;
	case "7":
	$rand_value = "g";
	break;
	case "8":
	$rand_value = "h";
	break;
	case "9":
	$rand_value = "i";
	break;
	case "10":
	$rand_value = "j";
	break;
	case "11":
	$rand_value = "k";
	break;
	case "12":
	$rand_value = "l";
	break;
	case "13":
	$rand_value = "m";
	break;
	case "14":
	$rand_value = "n";
	break;
	case "15":
	$rand_value = "o";
	break;
	case "16":
	$rand_value = "p";
	break;
	case "17":
	$rand_value = "q";
	break;
	case "18":
	$rand_value = "r";
	break;
	case "19":
	$rand_value = "s";
	break;
	case "20":
	$rand_value = "t";
	break;
	case "21":
	$rand_value = "u";
	break;
	case "22":
	$rand_value = "v";
	break;
	case "23":
	$rand_value = "w";
	break;
	case "24":
	$rand_value = "x";
	break;
	case "25":
	$rand_value = "y";
	break;
	case "26":
	$rand_value = "z";
	break;
	case "27":
	$rand_value = "0";
	break;
	case "28":
	$rand_value = "1";
	break;
	case "29":
	$rand_value = "2";
	break;
	case "30":
	$rand_value = "3";
	break;
	case "31":
	$rand_value = "4";
	break;
	case "32":
	$rand_value = "5";
	break;
	case "33":
	$rand_value = "6";
	break;
	case "34":
	$rand_value = "7";
	break;
	case "35":
	$rand_value = "8";
	break;
	case "36":
	$rand_value = "9";
	break;
	}
	return $rand_value;
	}
    /**
    * @Date: 15-Feb-2010
    * @Method : validEmailId
    * @Purpose: Validate email Id if filled
    * @Param:  $value
    * @Return: boolean
    **/

   function validEmailId($value = null) {

         $v1 = trim($value);
         if($v1 != "" && !eregi("^[\'+\\./0-9A-Z^_\`a-z{|}~\-]+@[a-zA-Z0-9_\-]+(\.[a-zA-Z0-9_\-]+){1,3}$",$v1)){
	    return false; 
         }
      return true;
   } 

    function file_exists_in_directory($directory, $pattern=false, $filename=false) {

//echo $pattern."+++++".$directory;

        if(!isset($directory) OR !isset($filename) OR is_dir($directory) == false OR strlen($filename) < 0) return false;

        $returnval = false;
        if(false != ($handle = opendir($directory))) {

        while (false !== ($file = readdir($handle))) {

        if ($file != "." && $file != "..") {

        if($pattern != false) {

        if(preg_match("$pattern", $file) > 0 ) {
        $returnval = $file;
        break;
          }
        } else {
        if($file == $filename) {
         $returnval = $file;
          break;
                        }
                    }
                }
            }
        }
        closedir($handle);
        return $returnval;
    }
	// return an array of files in directory else false if none found

	function get_files($directory, $pattern = false) {

		if(!isset($directory) OR is_dir($directory) == false ) return false;
		$returnval = array();

		if(false != ($handle = opendir($directory))) {
		while (false !== ($file = readdir($handle))) {

	    if ($file != "." && $file != "..") {

		if($pattern != false) {

		if(preg_match("$pattern", $file) > 0 ) {
		$returnval[] = $file;
             }
			}else{
				$returnval[] = $file;
			}
			}
		}
		}
		closedir($handle);
		return $returnval;
	}

	/**
	* Makes directory, returns TRUE if exists or made
	* @param string $pathname The directory path.
	* @return boolean returns TRUE if exists or made or FALSE on failure.
	*/
	function mkdir_recursive($path, $mode = 0777)

	{	
		$basicPath = ROOT.DS."app".DS."webroot".DS."contents".DS;
		$dirs = explode(DS , $path);
		$count = count($dirs);
		$path = '';
		for ($i = 0; $i < $count; ++$i) {
	    $path .= $dirs[$i].DS;
		if (!is_dir($basicPath.rtrim($path,"/"))){
		mkdir($basicPath.$path, $mode);
			}
		}
		return true;
	}
	/**
	* Remove directory, returns TRUE if exists or made
	* @param string $pathname The directory path.
	*/
       function rmdir_recursive($dir) {

		$basicPath = ROOT.DS."app".DS."webroot".DS."contents".DS;
		if(is_dir($basicPath.$dir)){
		$files = scandir($basicPath.$dir);
		array_shift($files);    // remove '.' from array
		array_shift($files);    // remove '..' from array

		foreach ($files as $file) {
		$file = $basicPath.$dir .DS. $file;
		if (is_dir($file)) {
		rmdir_recursive($file);
		rmdir($file);
		} else {

		unlink($file);
		      }
		}
		rmdir($basicPath.$dir);
		}
	}
}

?>

