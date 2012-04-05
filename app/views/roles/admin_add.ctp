<!--  start content-table-inner -->
	<div id="content-table-inner">
	<?php echo $form->create('Role',array('action'=>'add','method'=>'POST','onsubmit' => '',"class"=>"login")); ?>
	<?php $session->flash(); ?>
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
	
		<!-- start id-form -->
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		<tr>
			<th valign="top">Role name:</th>
			<td><?php
				 echo $form->input("role",array("class"=>"inp-form","label"=>false,"div"=>false));
            ?></td>
			<td></td>
		</tr>
		<tr>
			<th valign="top">Description:</th>
			<td><?php
				 echo $form->input("description",array("class"=>"form-textarea","label"=>false,"div"=>false));
				 echo $form->hidden("id");
            ?></td>
		</tr>
		
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
		<?php echo $form->submit('Save',array('class'=>"form-submit",'div'=>false))."&nbsp;&nbsp;&nbsp;"; 
			  echo $form->button('Cancel',array('type'=>'button','class'=>"form-reset",'div'=>false,'onclick'=>"location.href='".BASE_URL."admin/roles/list'")); 
			?>
		</td>
		<td></td>
	</tr>
	</table>
	<!-- end id-form  -->

	</td>
	<td>

	<?php echo $this->element('user_sidebar'); ?>
	

</td>
</tr>
</table>
	<!-- end id-form  -->
<div class="clear"></div>
 

</div>
<!--  end content-table-inner  -->