<div class="primary-content">
<h1 class="title">
  
   <label for="XplodePage_ctl14_LoginBox_txtEmail_txtEmail"><strong>Login</strong></label>
</h1>
<p>In order to gain access to the Cello Electronics Resource Centre, which includes press information, brochures and the image gallery, please login using the form below. If you have forgotten your password, please follow the link.</p>
	<div class="register-form">
	       <?php echo $form->create('User',array('url'=>'/users/login','action'=>'login','method'=>'POST',"class"=>"login")); ?>
			<?php echo $session->flash(); ?>
	 <fieldset class="register-form">
	 
	    <!--<span  class="error" id="XplodePage_ctl14_LoginBox_lblErrors"></span>-->
		<label for="XplodePage_ctl14_LoginBox_txtEmail_txtEmail">E-mail address <span class="error">*</span></label>
			 <?php echo $form->input("user_name",array("class"=>"text","id"=>"XplodePage_ctl14_LoginBox_txtEmail_txtEmail","label"=>false,"div"=>false));
             ?></br>
		<div class="clearall"> </div>
		<label for="XplodePage_ctl14_LoginBox_txtPassword_txtPassword">Password <span class="error">*</span></label>
		    <?php echo $form->input("password",array("class"=>"text","id"=>"XplodePage_ctl14_LoginBox_txtPassword_txtPassword","label"=>false,"div"=>false)); ?></br>		
		<p class="forgotten-link">
			<?php  echo $html->link("Forgotten password?","forgot_password"); ?> </p>
        <?php echo $form->submit('Submit',array('class'=>"submit","id"=>"XplodePage_ctl14_LoginBox_btnSubmit","label"=>false,'div'=>false)); ?>		
		<div class="form-mandatory"><span class="error">*</span> Mandatory fields </div>
</fieldset>
	</div><div class="clearall"></div>
</div>
<div class="breadcrumbs1 breadcrumbs">
	<ul>
	<li style="z-index: 3;"><a href="<?php echo BASE_URL; ?>"><span>Home</span></a></li>
	<li style="z-index: 2;"><a href="<?php echo BASE_URL."users/login"; ?>"><span>Resource Centre</span></a></li>
	<li style="z-index: 1;"><strong><span>Login</span></strong></li>
	</ul>
	<div class="clearall"></div>
</div>
<?php echo $form->end();?>
<div class="clearall"></div>