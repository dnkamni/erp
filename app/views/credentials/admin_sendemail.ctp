<?php echo $html->css(array("screen")); ?>
<?php echo $javascript->link(array('jquery-1.4.1.min','jquery.mousewheel-3.0.4.pack.js','jquery.fancybox-1.3.4.js'));?>
<script type="text/javascript" language="javascript">
		var succ = "<?php echo (!empty($success)?"1":"0"); ?>";
		if(succ == "1"){
			parent.location.reload(true); 
		}
</script>
  <!--  start content-table-inner -->
	<div id="content-table-inner" style="padding:6px 0px 0px 20px;">
	<h2>Send Credential</h2>
	<?php echo $form->create('Credential',array('action'=>'sendemail','method'=>'POST','onsubmit' => '',"class"=>"login")); ?>
	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="fancyboxform">
		<tr valign="top">
			<td>
	<!-- start id-form -->
	<table border="0" cellpadding="0" cellspacing="0"  id="id-form"  style="font-size:12px">
		<tr>
			<th valign="top">Email address(s):</th>
			<td><?php
				 echo $form->input("email_address",array("class"=>"inp-form","label"=>false,"div"=>false,"style"=>"height:31px;width:200px"));
            ?><br/><span class="note">enter multiple email addresses seperated by comma<span></td>
			<td></td>
		</tr>
		<tr>
			<th valign="top">Username:</th>
			<td><?php
				 echo nl2br($crData['Credential']['username']);
            ?></td>
			<td></td>
		</tr>	
		<tr>
			<th valign="top">Password:</th>
			<td><?php
				 echo nl2br($crData['Credential']['password']);
            ?></td>
			<td></td>
		</tr>	
		<tr>
			<th valign="top">Description:</th>
			<td><?php
				 echo nl2br($crData['Credential']['description']);
            ?>
      </td>
			<td></td>
		</tr>	
		<tr>
			<th valign="top">keyword(s):</th>
			<td><?php
				 echo nl2br($crData['Credential']['keyword']);
            ?>
      </td>
			<td></td>
		</tr>		
		
		<tr>
			<th valign="top">Message:</th>
			<td><?php
				 echo $form->textarea("message",array("class"=>"form-textarea","label"=>false,"div"=>false,"style"=>"width:390px;height:103px"));
            ?></td>
			<td></td>
		</tr>
    <tr>
    
		<tr>
			<th>&nbsp;</th>
			<td valign="top">
			<?php echo $form->hidden('id', array("value"=>$crData['Credential']['id'])); echo $form->submit('Save',array('class'=>"form-submit",'div'=>false))."&nbsp;&nbsp;&nbsp;";?>
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