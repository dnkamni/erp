<div id= "regis_content">
<div class="header content-header">
            <h2 class="heading">Register</h2>
        </div>
        <div class="section content-body form_content">
            <?php echo $form->create('User',array('action'=>'register','method'=>'POST','onsubmit' => '',"class"=>"login")); ?>
		<?php echo $session->flash(); ?>
		<ul>
		<li>
			<div class="label"><span class="star">*</span>First Name</div>
			<div class="input_box">
			<?php
				 echo $form->input("first_name",array("class"=>"string login-input","label"=>false,"div"=>false));
            ?>
			</div>
			<div class="clear"></div>
		</li>
		<li>
			<div class="label"><span class="star">*</span>Last Name</div>
			<div class="input_box">
			<?php
				 echo $form->input("last_name",array("class"=>"string login-input","label"=>false,"div"=>false));
            ?>
			</div>
			<div class="clear"></div>
		</li>
		<li>
			<div class="label"><span class="star">&nbsp;</span>Phone</div>
			<div class="input_box">
			<?php
				 echo $form->input("phone",array("class"=>"string login-input","label"=>false,"div"=>false));
			?>
			</div>
			<div class="clear"></div>
		</li>
		<!--<li>
			<div class="label"><span class="star">&nbsp;</span>Date of Birth</div>
			<div class="input_box">
			<?php
				 echo $form->input("dob",array("class"=>"","label"=>false,"div"=>false,"id"=>"dob"));
			?>
			</div>
			<div class="clear"></div>
		</li>-->
		<li>
			<div class="label"><span class="star">*</span>Address 1</div>
			<div class="input_box">
			<?php
				 echo $form->input("address1",array("class"=>"string login-input","label"=>false,"div"=>false));
            ?>
			</div>
			<div class="clear"></div>
		</li>
		<li>
			<div class="label"><span class="star">&nbsp;</span>Address 2</div>
			<div class="input_box">
			<?php
				 echo $form->input("address2",array("class"=>"string login-input","label"=>false,"div"=>false));
            ?>
			</div>
			<div class="clear"></div>
		</li>
		<li>
			<div class="label"><span class="star">*</span>Email</div>
			<div class="input_box">
			<?php
				 echo $form->input("email",array("class"=>"string login-input","label"=>false,"div"=>false));
			?>
			</div>
			<div class="clear"></div>
		</li>
		<li>
			<div class="label"><span class="star">*</span>Username</div>
			<div class="input_box">
			<?php
				 echo $form->input("username",array("class"=>"string login-input","label"=>false,"div"=>false));
			?>
			</div>
			<div class="clear"></div>
		</li>
		<li>
			<div class="label"><span class="star">*</span>Password</div>
			<div class="input_box">
			<?php 
				 echo $form->input("password",array("class"=>"string password-input","label"=>false));
            ?>
			</div>
			<div class="clear"></div>
		</li>
		<li>
			<div class="label"><span class="star">*</span>Confirm Password</div>
			<div class="input_box">
			<?php 
				 echo $form->input("confirm_password",array("class"=>"string password-input","label"=>false,"type"=>"password"));
            ?>
			</div>
			<div class="clear"></div>
		</li>
		<li>
			<div class="label">&nbsp;</div>
			<div class="input_box">
			<?php echo $form->submit('Register',array('class'=>"button submit-button",'div'=>false)); ?>
			</div>
			<div class="clear"></div>
		</li>
		</ul>
            <?php echo $form->end();?>
        </div>
</div>