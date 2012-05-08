<!--  start related-activities -->
	<div id="related-activities">
	<?php $user = $session->read("SESSION_ADMIN"); ?>
		<!--  start related-act-top -->
		<div id="related-act-top">
		<?php echo $html->image(BASE_URL."images/forms/header_related_doc.gif", array("alt"=>"Edit",'width'=>"271", 'height'=>"43")); ?>
		</div>
		<!-- end related-act-top -->
		
		<!--  start related-act-bottom -->
		<div id="related-act-bottom">
		
			<!--  start related-act-inner -->
			<div id="related-act-inner">
				<div class="right">
					<h5>Documents Management</h5>
          All corresponding documents will be listed here
          <div class="lines-dotted-short"></div>
		  <?php if(!empty($data) && $data['mode'] == "edit"){ ?>
				
				<div>
					<span id="spanButtonPlaceholder2"></span>
							<input id="btnCancel2" type="button" value="Cancel Uploads" onclick="cancelQueue(upload2);" disabled="disabled" style="margin-left: 2px; height: 22px; font-size: 8pt;display:none" />
					
				</div>

				
		  <?php } ?>
		  <?php $destination=realpath('../../app/webroot/img/all_docs/'.$data['type']). DS;
			$docs = $common->get_files($destination,"/^".$data['id']."_/i");
			?>
			<ul class="greyarrow">
			<?php foreach($docs as $doc){ ?>
  				<li>
					<?php echo preg_replace("/^[0-9]+_(.*)/i",'$1',$doc); ?>
					<a onclick="return confirm('Are you sure you want to delete document?'); " href="<?php echo BASE_URL.'employees/delete_doc/'.base64_encode($doc); ?>">Delete</a>
				</li>
            <?php } ?>
            
						
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