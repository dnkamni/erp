// This file contains all the common javascript functions.
/**
    * @Method : changeCheckboxStatus
    * @Purpose:This method is used to change checkbox status.
    * @Param: formObj
    * @Return: none
**/
function changeCheckboxStatus(formObj) {
	selectAll = formObj.elements['selectAll'];
	var len = "";
	if(formObj.elements['IDs[]']){
	len = formObj.elements['IDs[]'].length;
	}
	if (len == undefined) {
		var elementsLen = formObj.elements.length;
		var len = 0;
		for (i = 0; i < elementsLen; i++)	{
			obj = formObj.elements[i];
			if (obj.name == "IDs[]") {
				len++;
			}
		}

		if (len == 1){
			var e = formObj.elements['IDs[]'];
			if (selectAll.checked) {
				e.checked = true;
			}
			else {
				e.checked = false;
			}
		}
	}
	else if (len > 1) {
		for (var i = 0; i < len; i++) {
			var e = formObj.elements['IDs[]'][i];
			if (selectAll.checked) {
				e.checked = true;
			}
			else {
				e.checked = false;
			}
		}
	}
}
/**
    * @Method : toggleCheck
    * @Purpose:This method is used to toggle checkbox.
    * @Param: formObj
    * @Return: none
**/
function toggleCheck(formObj) {
	var selectAll = formObj.elements['selectAll'];
	objCheckBoxes = null;
	if(document.getElementsByName('IDs[]')){
	var objCheckBoxes = document.getElementsByName('IDs[]');
	}
	var count = 0;
    	for (i = 0; i < objCheckBoxes.length; i++) {
		var e = objCheckBoxes[i];
		if(e.checked) {
		  count++;
		}
	}
	if(objCheckBoxes.length == count){
		selectAll.checked = true;
	}else{
		selectAll.checked = false;
	}
}

/**
    * @Method : atleastOneChecked
    * @Purpose:This method is used to check that atleast one checkbox is checked.
    * @Param: formObj
    * @Return: none
**/
function atleastOneChecked(message) {
	if(document.getElementsByName('IDs[]')){
	var objCheckBoxes = document.getElementsByName('IDs[]');
	var count = 0;
    	for (i = 0; i < objCheckBoxes.length; i++) {
		var e = objCheckBoxes[i];
		if(e.checked) {
		  count++;
		}
	}
    	if(count <= 0){ 
		alert("Please select atleast one checkbox.");
		return false;
	}else{
		return confirm(message);
	}
	}
	return true;
}