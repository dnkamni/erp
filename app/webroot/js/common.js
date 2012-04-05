$(document).ready(function(){

$("#searchBy").change(function(){
	if($(this).val().match(/\.status/gi) != null){
		$('#search_select').show();
		$('#search_selecttype').hide();
		$('#search_input').hide();
	}else if($(this).val().match(/\.user_type/gi) != null){
		$('#search_select').hide();
		$('#search_selecttype').show();
		$('#search_input').hide();
	}else{
	    $('#search_select').hide();
		$('#search_selecttype').hide();
		$('#search_input').show();
	}
});
});

//disabling enter key
function stopRKey1(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text" || node.type=="checkbox"))  {return false;}
}

// function to set mode
function setSubmitMode(mode){
$('#UserMode').val(mode);
$('#listForm').submit();
}

// round a number to 2 decimal places
function roundNumber(num, dec) {
	var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
	return result;
}

// Function to check empty string (return true if empty else false)
function isEmpty(value){
	if(value!=undefined && value.replace(/\s*/gi, "") == "") return true;
	return false;
};
// Function to check zip code
function isValidZip(value){
	if(trim(value).match(/^\s*\d{5,6}\s*$/gi) != null)
	return true;
	return false;
};

// Function to check phone
function isValidPhone(value){ 
	if(trim(value).match(/^\d{3}\-\d{3}\-\d{4}$/gi) != null || trim(value).match(/^\d{10}$/i) != null)
	return true;
	return false;
};

// Function to check confirm password
function isValidConfirmPassword(value1,value2){ 
	if(value1 == value2)
	return true;
	return false;
};

// Function to check password length -- 4 character
function isValidPassword(value){ 
	if(trim(value).length > 4)
	return true;
	return false;
};

// Function to check email
function isValidEmail(value){ 
	if(trim(value).match(/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/gi) != null)
	return true;
	return false;
};

// Function to check url
function isValidURL(value){ 
	value = value.replace('www.','');
	if(trim(value).match(/^((http(s?):\/\/)?(www.)?(([\w-_~]+\.)*[\w-_~]+\.[\w-_]+(:[0-9]+)?))(\/.*)?$/gi) != null)
	return true;
	return false;
};

// return a trimmed string
function trim(value){ 
	return value.replace(/^\s*(.*)\s*$/gi, "$1");
};

// check for valid date
function trim(value){ 
	return value.replace(/^\s*(.*)\s*$/gi, "$1");
};

// Function to check valid bar code(UPC and EAN) (return true if empty else false)
function checkBarCode(value){ 
	if(trim(value).match(/^[0-9]{12,13}$/gi) != null) return true;
	return false;
};

// Function to check valid number(unsigned integer) (return true if empty else false)
function isNumber(value){
	if(trim(value).match(/^[0-9]+$/gi) != null) return true;
	return false;
};
// Function to check valid number(integer + decimal number) (return true if empty else false)
function isFloat(value){
	if(trim(value).match(/^\s*([0-9]*)\.?[0-9]*\s*$/gi) != null) return true;
	return false;
};

// Function to check date (mm/dd/yyyy)
function isValidDate(value){ 
	if(value.match(/^\s*(0?[1-9]|1[0-2])\s*(\/)\s*(([1-2][0-9])|(3[0-1])|(0[1-9])|[1-9])\s*(\/)\s*((19)|(2[0-9]))[0-9]{2}\s*$/gi) != null) return true;
	return false;
};

// get current date
function getCurrentDate(){
	var currentTime = new Date();
	m = "";
	d = "";
	month = currentTime.getMonth()+1;
	month = m + month;
	if(month.length == "1"){
		month = '0'+ month;
	}
	day = currentTime.getDate();
	day = d + day;
	if(day.length == "1"){
		day = '0'+ day;
	}
	date = month+'/'+day+'/'+currentTime.getFullYear();	
	return date;
}

//function to disable calendar if not in edit or add mode.
function calender(){
if ($('#savecancel_buttons').attr('style') == "display: none;") {
	return false;
}else{
	$('#datepicker').datepicker('show');
}
return false;
}

//function to set credit refund
function changeused(){
	if($('#credit_type').val() == 'refund') { 
	$('#status').val('used');
	} else {
	$('#status').val('unused');	
	}
}
