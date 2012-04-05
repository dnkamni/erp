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
				<?php $destination=realpath('../../app/webroot/img/employee_image'). DS;
				$userId = $user[0];
			    $profileImage = $common->file_exists_in_directory($destination,"/^".$userId."_/i");
				if(!empty($profileImage)){
					echo $html->image(BASE_URL."img/employee_image/".$profileImage ,array("title" => $user[1],"alt" => $user[1],"id"=>"profileImg"));
				}else{
					echo $html->image(BASE_URL."images/shared/no_image.png",array("title" => $user[1],"alt" => $user[1],"id"=>"profileImg"));
				}?>
				<div class="lines-dotted-short"></div>
				
				<div class="left"><a href=""><?php $html->image(BASE_URL."images/forms/icon_edit.gif", array("alt"=>"Edit",'width'=>"21",'height'=>"21"))?></a></div>
				<div class="right">
					<h5>Profile</h5>
					User can see his account info here
					<ul class="greyarrow">
						<li><a href="">Click here to visit</a></li> 
						<li><a href="">Click here to visit</a> </li>
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