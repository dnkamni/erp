 <?php echo $javascript->link('ckeditor/ckeditor.js'); ?>
 <div id="page-heading">
        <h2 class="heading"><?php echo ($page_id != "")?"Edit":"New"; ?> Static Page</h2>
      </div>
           <?php echo $form->create('StaticPage',array('action'=>'add','method'=>'POST','onsubmit' => '',"class"=>"")); ?>
		<?php  echo $session->flash(); ?>
		<table cellspacing="0" cellpadding="4" border="0" align="center" width="100%" id="content-table" >
			<tr>
				<th rowspan="3" class="sized"><img src="<?php echo BASE_URL.'images/side_shadowleft.jpg';?>" width="20" height="300" alt="" /></th>
				<th class="topleft"></th>
				<td id="tbl-border-top">&nbsp;</td>
				<th class="topright"></th>
				<th rowspan="3" class="sized"><img src="<?php echo BASE_URL.'images/side_shadowright.jpg';?>" width="20" height="300" alt="" /></th>
			</tr>
	<tr>
	<td id="tbl-border-left"></td>
	<td>
	<!--  start content-table-inner -->
	<div id="content-table-inner">
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
		
		<!--  start step-holder -->
		<div id="step-holder">
			<div class="step-no">1</div>
			<div class="step-dark-left"><a href="">Edit details</a></div>
			<div class="step-dark-right">&nbsp;</div>
			<div class="step-no-off">2</div>
			<div class="step-light-left">CMS Detail</div>
			<div class="step-light-right">&nbsp;</div>
			<div class="step-no-off">3</div>
			<div class="step-light-left">Preview</div>
			<div class="step-light-round">&nbsp;</div>
			<div class="clear"></div>
		</div>
		<!--  end step-holder -->
		<!-- start id-form -->
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		<tr><tr>
			<th valign="top"><span class="star">*</span>Title</th>
			<td>
			<?php 
				 echo $form->input("title",array("class"=>"inp-form","label"=>false,"div"=>false));
            ?>	
			</td></tr>
			<tr>
			<th valign="top"><span class="star">*</span>Content</th>
			<td>
			<?php
				 echo $form->textarea("content",array("class"=>"inp-form","label"=>false,"div"=>false));
            ?>
			</td>
			<script>
			CKEDITOR.replace('data[StaticPage][content]', { "width": "900" }); 
			</script></tr>
			<!-- Fckeditor Ends here -->
			<tr>
			<th valign="top"><span class="star">&nbsp;</span>Meta Keywords </th>
			<td class="noheight">
		<?php
				 echo $form->input("meta_keywords",array("class"=>"inp-form","label"=>false,"div"=>false));
            ?>
			</td></tr>
			<tr>
			<th valign="top"><span class="star">&nbsp;</span>Meta Description </th>
			<td class="noheight">
		<?php
				 echo $form->input("meta_description",array("class"=>"inp-form","label"=>false,"div"=>false));
            ?>
			</td></tr>		
		<tr>
		<th>&nbsp;</th>
		<td valign="top">
		<?php 
			echo $form->hidden("StaticPage.id",array("value"=>$page_id)); 
			echo $form->submit(($page_id != "")?"Save":"Create Static Page",array('class'=>"form-submit",'div'=>false)); ?>
			<?php 
			echo $html->link('Cancel','list',array('class'=>'form-reset'));
			?>
			</td>
		<td></td>
	   </tr>	
	</table>
</tr>
</td>
	
	<tr>
		<td><img src="<?php echo BASE_URL.'images/blank.gif'; ?>" width="695" height="1" alt="blank" /></td>
		<td></td>
	</tr>
</table>
<div class="clear"></div>
</div>
</td> 

	<td id="tbl-border-right"></td>
</tr>
<tr>
	<th class="sized bottomleft"></th>
	<td id="tbl-border-bottom">&nbsp;</td>
	<th class="sized bottomright"></th>
</tr>
	<?php echo $form->hidden("id"); ?>
    <?php echo $form->end();?>
      </table>
