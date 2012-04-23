	<!--  start content-table-inner -->
	<div id="content-table-inner">
	<?php echo $form->create('Credential',array('action'=>'sendemail','method'=>'POST','onsubmit' => '',"class"=>"login")); ?>
	<?php $session->flash(); ?>
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
		<tr valign="top">
			<td>
	<!-- start id-form -->
	<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		<tr>
			<th valign="top">Email address(s):</th>
			<td><?php
				 echo $form->input("email_address",array("class"=>"inp-form","label"=>false,"div"=>false));
            ?><span class="">enter multiple email addresses seperated by comma<span></td>
			<td></td>
		</tr>
		<tr>
			<th valign="top">Message:</th>
			<td><?php
				 echo $form->textarea("message",array("class"=>"form-textarea","label"=>false,"div"=>false));
            ?></td>
			<td></td>
		</tr>
    <tr>
    
		<tr>
			<th>&nbsp;</th>
			<td valign="top">
			<?php echo $form->submit('Save',array('class'=>"form-submit",'div'=>false))."&nbsp;&nbsp;&nbsp;";?>
			</td>
			<td></td>
		</tr>
	</table>
	<!-- end id-form  -->

			</td>
		</tr>
	</table>
	<!-- end id-form  -->
	<div class="clear"></div>
	</div>
	<!--  end content-table-inner  -->