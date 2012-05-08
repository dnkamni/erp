$(document).ready(function(){
	$('input').checkBox();
	$('#toggle-all').click(function(){
 	$('#toggle-all').toggleClass('toggle-checked');
	$('#mainform input[type=checkbox]').checkBox('toggle');
	return false;
	});
	
	$('.styledselect').selectbox({ inputClass: "selectbox_styled" });
	$('.styledselect_form_1').selectbox({ inputClass: "styledselect_form_1" });
	$('.styledselect_form_2').selectbox({ inputClass: "styledselect_form_2" });
	$('.styledselect_pages').selectbox({ inputClass: "styledselect_pages" });
	
	$("input.file_1").filestyle({ 
	image: "images/forms/upload_file.gif",
	imageheight : 29,
	imagewidth : 78,
	width : 300
	});
	
	$('a.info-tooltip ').tooltip({
		track: true,
		delay: 0,
		fixPNG: true, 
		showURL: false,
		showBody: " - ",
		top: -35,
		left: 5
	});



$(document).pngFix();

/** Added by Neema **/
$('a.delete').click(function(){
		if(confirm("Are you sure you want to delete?") == true){
			return true;
		}
		return false;
	});
	
	if($(".fancybox").attr('class') != undefined){
		$(".fancybox").fancybox({
		'width' : '65%',
		'height' : '100%',
		'autoScale' : false,
		'transitionIn' : 'none',
		'transitionOut' : 'none',
		'type' : 'iframe'
		});
	}
/** Added by Neema **/

});