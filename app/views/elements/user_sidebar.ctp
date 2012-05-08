<!--<script type="text/javascript">
		var swfu;

		window.onload = function() {
			var id = '<?php echo ((!empty($data) && $data['mode']=="edit")?$data['id']:''); ?>';
			var settings = {
				flash_url : base_url+"js/swfupload/swfupload.swf",
				upload_url: base_url+'employees/uploadPic/'+id,
				post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
				file_types : "*.jpeg;*.jpg;*.png;*.gif",
				file_types_description : "Image files",
				//file_upload_limit : 1,
				file_queue_limit : 0,
				file_post_name: 'uploadfile',
				debug: false,
				custom_settings : {
					progressTarget : "fsUploadProgress",
					cancelButtonId : "btnCancel"
				},
				// Button settings
				
				button_image_url : base_url+'js/swfupload/wdp_buttons_upload_114x29.png',
				button_width : 114,
				button_height : 29,
				button_placeholder_id: "spanButtonPlaceHolder",
				button_text_left_padding: 12,
				button_text_top_padding: 3,
				
				// The event handler functions are defined in handlers.js
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : function(file, serverData, responseReceived){location.href=base_url+"/admin/employees/add/"+id; },
				upload_complete_handler : uploadComplete,
				queue_complete_handler : queueComplete	// Queue plugin event
			};

			swfu = new SWFUpload(settings);
	     };
	</script>
-->
<?php if(!empty($data)) { ?>
<script type="text/javascript">
		var upload1, upload2;
		window.onload = function() {
			var id = '<?php echo ((!empty($data) && $data['mode']=="edit")?$data['id']:''); ?>';
			upload1 = new SWFUpload({
				// Backend Settings
				upload_url: base_url+'employees/uploadPic/'+id,
				post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},

				// File Upload Settings
				
				file_types : "*.jpeg;*.jpg;*.png;*.gif",
				file_types_description : "All Files",
				
				file_post_name: 'uploadfile',
				// Event Handler Settings (all my handlers are in the Handler.js file)
				//file_dialog_start_handler : fileDialogStart,
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : function(file, serverData, responseReceived){location.href=base_url+"/admin/employees/add/"+id; },
				upload_complete_handler : uploadComplete,

				// Button Settings
				button_image_url : base_url+'js/swfupload/wdp_buttons_upload_114x29.png',
				button_width : 114,
				button_height : 29,
				button_placeholder_id : "spanButtonPlaceholder1",
				
				
				// Flash Settings
				flash_url : base_url+"js/swfupload/swfupload.swf",
				

				custom_settings : {
					progressTarget : "fsUploadProgress1",
					cancelButtonId : "btnCancel1"
				},
				
				// Debug Settings
				debug: false
			});
			
			upload2 = new SWFUpload({
				// Backend Settings
				upload_url: base_url+'employees/uploadDocs/'+id,
				post_params: {"PHPSESSID" : "<?php echo session_id(); ?>"},
				file_queue_limit : "5",
				file_types : "*.*",
				file_post_name: 'uploadfile',
				// Event Handler Settings (all my handlers are in the Handler.js file)
				//file_dialog_start_handler : fileDialogStart,
				file_queued_handler : fileQueued,
				file_queue_error_handler : fileQueueError,
				file_dialog_complete_handler : fileDialogComplete,
				upload_start_handler : uploadStart,
				upload_progress_handler : uploadProgress,
				upload_error_handler : uploadError,
				upload_success_handler : function(file, serverData, responseReceived){location.href=base_url+"/admin/employees/add/"+id; },
				upload_complete_handler : uploadComplete,

				// Button Settings
				button_image_url : base_url+'js/swfupload/wdp_buttons_upload_114x29.png',
				button_width : 114,
				button_height : 29,
				button_placeholder_id : "spanButtonPlaceholder2",
				
				
				// Flash Settings
				flash_url : base_url+"js/swfupload/swfupload.swf",

				swfupload_element_id : "flashUI2",		// Setting from graceful degradation plugin
				degraded_element_id : "degradedUI2",	// Setting from graceful degradation plugin

				custom_settings : {
					progressTarget : "fsUploadProgress2",
					cancelButtonId : "btnCancel2"
				},

				// Debug Settings
				debug: false
			});
		};
</script>
<?php } ?>
<!--  start related-activities -->
	<div id="related-activities">
	<?php $user = $session->read("SESSION_ADMIN"); ?>
		<!--  start related-act-top -->
		<div id="related-act-top">
		<?php echo $html->image(BASE_URL."images/forms/header_related_act.gif", array("alt"=>"Edit",'width'=>"271", 'height'=>"43")); ?>
		</div>
		<!-- end related-act-top -->
		
		<!--  start related-act-bottom -->
		<div id="related-act-bottom">
		
			<!--  start related-act-inner -->
			<div id="related-act-inner">
				<div class="right">
					<h5>Employees Management</h5>
          This section is used by Admin and HR only to manage all employees information.
		  <?php
		 
			if(!empty($data) && $data['mode'] == "edit"){
				$destination=realpath('../../app/webroot/img/employee_image'). DS;
				$userId = $data['id'];
			    $profileImage = $common->file_exists_in_directory($destination,"/^".$userId."_/i");
				if(!empty($profileImage)){
					echo $html->image(BASE_URL."img/employee_image/".$profileImage ,array("title" => 'Profile Pic',"alt" => 'Profile Pic',"id"=>"profileImg"));
				}else{
					echo $html->image(BASE_URL."images/shared/no_image.png",array("title" => 'Profile Pic',"alt" => 'Profile Pic',"id"=>"profileImg"));
				}
			}elseif(!empty($data)){
				echo $html->image(BASE_URL."images/shared/no_image.png",array("title" => 'Profile Pic',"alt" => 'Profile Pic',"id"=>"profileImg"));
			}?>
          <div class="lines-dotted-short"></div>
		  
		  <?php if(!empty($data) && $data['mode'] == "edit"){ ?>
				
				<div>
					
					<span id="spanButtonPlaceholder1"></span>
					<input id="btnCancel1" type="button" value="Cancel Uploads" onclick="cancelQueue(upload1);" disabled="disabled" style="margin-left: 2px; height: 22px; font-size: 8pt;display:none"  />
				</div>

				</form>
		  <?php } ?>
					<ul class="greyarrow">
  					<li>
					
            <?php
			if(!empty($data)){
				echo $html->link("Back to Listing", array('controller'=>'employees','action'=>'list'));
			}else{
				echo $html->link("Add New Employee", array('controller'=>'employees','action'=>'add'));
			}
            ?>
            </li> 
  					<li>
            <?php echo $html->link("Download Search Result : Excel",
            array('controller'=>'employees','action'=>'exportci','onclick'=>'return false;')
            );	
            ?>
            </li>
  					<li>
            <?php echo $html->link("Download Search Result : PDF",
            array('controller'=>'employees','action'=>'download')
            );	
            ?>
            </li>
  			
						
					</ul>
				</div>
				<div class="clear"></div>
			</div>
			<!-- end related-act-inner -->
			<div class="clear"></div>
		
		</div>
		<!-- end related-act-bottom -->
	
	</div>
	<!-- end related-activities -->