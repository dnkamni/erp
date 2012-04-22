<!-- start loginbox -->
<?php echo $form->create('User',array('action'=>'login','method'=>'POST','onsubmit' => '',"class"=>"login")); ?>
	<div id="loginbox">
	<!--  start login-inner -->
	<div id="login-inner">
	<?php echo $session->flash(); ?><br/>
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th>User Name / Email</th>
			<td><?php echo $form->input("user_name",array("class"=>"login-inp","label"=>false,"div"=>false));
             ?></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><?php echo $form->input("password",array("class"=>"login-inp","label"=>false,"div"=>false)); ?></td>
		</tr>
		<!-- <tr>
			<th></th>
			<td valign="top"><input type="checkbox" class="checkbox-size" id="login-check" /><label for="login-check">Remember me</label></td>
		</tr> -->
		<tr>
			<th></th>
			<td><?php echo $form->submit('',array('class'=>"submit-login",'div'=>false)); ?></td>
		</tr>
		</table>
	</div>
 	<!--  end login-inner -->
	<div class="clear"></div>
	<?php 
		 //echo $html->link("Forgot Password?","forgot_password",array("class"=>"forgot-pwd"));
  ?>
 </div>
 <!--  end loginbox -->
<?php echo $form->end();?>