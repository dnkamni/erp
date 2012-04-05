<div id= "regis_content">
	<div class="header content-header">
        <h2 class="heading">Forgot Password</h2>
    </div>
	<div class="section content-body form_content">
		<?php echo $form->create('User',array('action'=>'forgot_password','method'=>'POST','onsubmit' => '',"class"=>"login")); ?>
		<?php echo $session->flash(); ?>
		<ul>
		<li>
			<div class="label">Username or Email</div>
			<div class="input_box">
			<?php
				echo $form->input("user_name",array("class"=>"string login-input","label"=>false,"div"=>false));
			?>
			</div>
			<div class="clear"></div>
		</li>
		<li>
			<div class="label">&nbsp;</div>
			<div class="input_box">
			<?php echo $form->submit('Submit',array('class'=>"button submit-button",'div'=>false)); ?>
			</div>
			<div class="clear"></div>
		</li>
		</ul>
		<?php echo $form->end();?>
	</div>
</div>