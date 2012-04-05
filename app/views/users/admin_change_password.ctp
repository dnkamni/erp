<div>
<div class="header content-header">
            <h2 class="heading"><?php echo $pageTitle; ?></h2>
        </div>
        <div class="section content-body form_content">
            <?php echo $form->create('User',array('action'=>'change_password','method'=>'POST','onsubmit' => '',"class"=>"login")); ?>
		<?php echo $session->flash(); ?>
		<ul>
		<li>
			<div class="label"><span class="star">*</span>Old Password</div>
			<div class="input_box">
			 <?php
                             echo $form->password("old_password",array("class"=>"string login-input","label"=>false,"div"=>false));
                         ?>
			 <?php echo $form->error('old_password'); ?> 
			</div>
			<div class="clear"></div>
		</li>
		<li>
			<div class="label"><span class="star">*</span>New Password</div>
			<div class="input_box">
			<?php 
                             echo $form->input("password",array("type"=>"password","class"=>"string password-input","label"=>false));
                         ?>
			<?php echo $form->error('new_password'); ?> 
			</div>
			<div class="clear"></div>
		</li>
		<li>
			<div class="label"><span class="star">*</span>Confirm Password</div>
			<div class="input_box">
			<?php 
                             echo $form->password("confirm_password",array("class"=>"string password-input","label"=>false));
                         ?>
			<?php echo $form->error('confirm_password'); ?> 
			</div>
			<div class="clear"></div>
		</li>
		<li>
			<div class="label">&nbsp;</div>
			<div class="input_box">
			<?php echo $form->submit('Submit',array('class'=>"button submit-button",'div'=>false)); ?>
			<?php 
			echo $form->button('Cancel',array('type'=>'button', 'class'=>"button submit-button",'div'=>false,'onclick'=>"location.href='".BASE_URL."/admin/users/list'")); 
			?>
			</div>
			<div class="clear"></div>
		</li>
		</ul>
            <?php echo $form->end();?>
        </div>
</div>