<div class="primary-content"> 
<h1 class="title">
 <label for="XplodePage_ctl14_LoginBox_txtEmail_txtEmail">Forgotten Password</label>
</h1>
		<?php echo $form->create('User',array('action'=>'forgot_password','method'=>'POST','onsubmit' => '',"class"=>"login")); ?>
<p>Lorem ipsum dolor sit in met, consec tetuer amd adipiscing elit, sed diam non ummy nibh euismod nibh euismod tincidunt ut laoreet dolore magna aliquam tincidunt ut laoreet magna.</p>
<div class="register-form">
<fieldset class="register-form">
	<div class="error-msg">
    <span id="XplodePage_ctl14_lblErrors"></span>
	<span id="XplodePage_ctl14_lblInfo"></span>
	</div>	
	    <?php echo $session->flash(); ?>
		<label for="XplodePage_ctl14_txtEmail_txtEmail">E-mail address <span class="error">*</span></label>
		 <?php echo $form->input("user_name",array("class"=>"text","id"=>"XplodePage_ctl14_txtEmail_txtEmail","label"=>false,"div"=>false)); ?></br>
		<div class="clearall"> </div>	
	     <?php echo $form->submit('Send',array('class'=>"submit","id"=>"XplodePage_ctl14_btnSubmit","label"=>false,'div'=>false)); ?>	
		<div class="form-mandatory"><span class="error">*</span> Mandatory fields</div>	
</fieldset>
</div>
	<div class="clearall"></div>
	</div>
<div class="breadcrumbs1 breadcrumbs">
	<ul>
	<li style="z-index: 3;"><a href="<?php echo BASE_URL; ?>"><span>Home</span></a></li>
	<li style="z-index: 2;"><a href="<?php echo BASE_URL."users/login"; ?>"><span>Resource Centre</span></a></li>
	<li style="z-index: 1;"><strong><span>Forgotten Password</span></strong></li>
	</ul>
	<div class="clearall"></div>
	<?php echo $form->end();?>
</div>
	<div class="clearall"></div>