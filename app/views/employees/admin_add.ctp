<?php echo $javascript->link(array('swfupload/swfupload.js','swfupload/swfupload.queue.js','swfupload/fileprogress.js','swfupload/handlers.js'));?>
<!--  start content-table-inner -->
	<div id="content-table-inner">
	<?php echo $form->create('Employee',array('action'=>'add','method'=>'POST','onsubmit' => '',"class"=>"login")); ?>
	<?php $session->flash(); ?>
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
		<tr valign="top">
			<td width="75%">
	<!-- start id-form -->
	<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		<tr><td colspan="2"> <h2>General</h2></td></tr>
		<tr>
			<th valign="top">Employee Code:</th>
			<td><?php
				 echo $form->input("employee_code",array("class"=>"inp-form","label"=>false,"div"=>false));
            ?></td>
			
		</tr>
		<tr>
			<th valign="top">Assign Role:</th>
			<td><?php
				foreach($general->getUserRoles() as $key=>$role){
					$checked = array();
					if(!empty($this->data['Employee']['role_id']) && in_array($key, $this->data['Employee']['role_id'])){
						$checked = array('checked'=>true);
					}
					echo $form->input("role_id.$key",array_merge($checked ,array('type'=>'checkbox',"label"=>false,"div"=>false,"value"=>$key,"id"=>'role_'.$key,"hiddenField"=>false)));
					echo "<label for = 'role_".$key."'>".$role."</label><br/>";
				}
				
            ?></td>
			
		</tr>
		<tr>
			<th valign="top">First Name:</th>
			<td><?php
				 echo $form->input("first_name",array("type"=>"text","id"=>"crpass","class"=>"inp-form","label"=>false,"div"=>false));
            ?>    	
            </td>
			
		</tr>
		<tr>
			<th valign="top">Last Name:</th>
			<td><?php
				 echo $form->input("last_name",array("type"=>"text","id"=>"crpass","class"=>"inp-form","label"=>false,"div"=>false));
            ?>    	
            </td>
			
		</tr>
		<tr>
			<th valign="top">Father's Name:</th>
			<td><?php
				 echo $form->input("father_name",array("type"=>"text","id"=>"crpass","class"=>"inp-form","label"=>false,"div"=>false));
            ?>    	
            </td>
			
		</tr>
		<tr>
			<th valign="top">Mother's Name:</th>
			<td><?php
				 echo $form->input("mother_name",array("type"=>"text","id"=>"crpass","class"=>"inp-form","label"=>false,"div"=>false));
            ?>    	
            </td>
			
		</tr>
		<tr>
			<th valign="top">Current Salary:</th>
			<td><?php
				 echo $form->input("current_salary",array("class"=>"inp-form number","label"=>false,"div"=>false));
            ?></td>
			
		</tr>
		<tr>
			<th valign="top">Experience:</th>
			<td><?php
				 echo $form->input("experience",array("class"=>"inp-form","label"=>false,"div"=>false));
            ?></td>
	</tr>
	<tr>
			<th valign="top">Previous Employement:</th>
			<td><?php
				 echo $form->textarea("previous_employment",array("class"=>"form-textarea","label"=>false,"div"=>false));
            ?></td>
	</tr>
	<tr>
			<th valign="top">Date of Joining:</th>
			
			<td>
			<?php
			$optionsDays=$common->getDaysArray();
			$optionsMonths=$common->getMonthsArray();
			$optionsYears =$common->getCustomYearsArray();			
		    
			echo $form->input("doj_date",array('type'=>'select','options'=>$optionsDays,"class"=>"styledselect_form_1","label"=>false,"div"=>false));
			echo $form->input("doj_month",array('type'=>'select','options'=>$optionsMonths,"class"=>"styledselect_form_1","label"=>false,"div"=>false));
			echo $form->input("doj_year",array('type'=>'select','options'=>$optionsYears,"class"=>"styledselect_form_1","label"=>false,"div"=>false));			
             ?>
			</td>
	</tr>
	<tr>
			<th valign="top">Date of Relieving:</th>
			<td><?php
			echo $form->input("dor_date",array('type'=>'select','options'=>$optionsDays,"class"=>"styledselect_form_1","label"=>false,"div"=>false));
			echo $form->input("dor_month",array('type'=>'select','options'=>$optionsMonths,"class"=>"styledselect_form_1","label"=>false,"div"=>false));
			echo $form->input("dor_year",array('type'=>'select','options'=>$optionsYears,"class"=>"styledselect_form_1","label"=>false,"div"=>false));			
             ?></td>
	</tr>
		
		<tr><td colspan="2"> <h2>Login Information</h2></td></tr>
		
		<tr>
			<th valign="top">User Name:</th>
			<td><?php
				 echo $form->input("username",array("type"=>"text","id"=>"crpass","class"=>"inp-form","label"=>false,"div"=>false));
            ?>    	
            </td>
			
		</tr>
		<tr>
			<th valign="top">Email:</th>
			<td><?php
				 echo $form->input("email",array("type"=>"text","id"=>"crpass","class"=>"inp-form","label"=>false,"div"=>false));
            ?>    	
            </td>
			
		</tr>
		<tr>
			<th valign="top">Password:</th>
			<td><?php
				 echo $form->input("password",array("type"=>"text","id"=>"crpass","class"=>"inp-form","label"=>false,"div"=>false));
            ?>    	
            </td>
			
		</tr>
		
		<tr><td colspan="2"> <h2>Contact Information</h2></td></tr>
		<tr>
			<th valign="top">Phone:</th>
			<td><?php
				 echo $form->input("phone",array("type"=>"text","id"=>"crpass","class"=>"inp-form number","label"=>false,"div"=>false));
            ?>    	
            </td>
			
		</tr>
		
		<tr>
			<th valign="top">Address:</th>
			<td><?php
				 echo $form->textarea("full_address",array("type"=>"text","class"=>"form-textarea","id"=>"crpass","label"=>false,"div"=>false));
            ?>    	
            </td>
			
		</tr>
		<tr>
			<th valign="top">Personal Email:</th>
			<td><?php
				 echo $form->input("personal_email",array("type"=>"text","id"=>"crpass","class"=>"inp-form","label"=>false,"div"=>false));
            ?>    	
            </td>
			
		</tr>
		
		<tr><td colspan="2"> <h2>Personal Information</h2></td></tr>
		<tr>
			<th valign="top">Place of Birth:</th>
			<td><?php
				 echo $form->input("place_of_birth",array("type"=>"text","id"=>"crpass","class"=>"inp-form","label"=>false,"div"=>false));
            ?>    	
            </td>
			
		</tr>
		<tr>
			<th valign="top">DOB:</th>
			<td><?php
				echo $form->input("dob_date",array('type'=>'select','options'=>$optionsDays,"class"=>"styledselect_form_1","label"=>false,"div"=>false));
				echo $form->input("dob_month",array('type'=>'select','options'=>$optionsMonths,"class"=>"styledselect_form_1","label"=>false,"div"=>false));
				echo $form->input("dob_year",array('type'=>'select','options'=>$common->getYearsArray(),"class"=>"styledselect_form_1","label"=>false,"div"=>false));
            ?>    	
            </td>
			
		</tr>
		<tr>
			<th valign="top">Gender:</th>
			<td>	
			<?php
			
			 // Creating options for Type field
		   $options=array('Male'    =>  'Male', 
                      'Female'    => 'Female'
                      );
			echo $form->input("sex",array('type'=>'select','options'=>$options,"class"=>"styledselect_form_1","label"=>false,"div"=>false));    
             ?>
			</select>
			</td>
			</td></td>
		</tr>
		<tr>
			<th valign="top">Urban/Rural:</th>
			<td>	
			<?php
			
			 // Creating options for Type field
		   $options=array('urban'    =>  'Urban', 
                      'rural'    => 'Rural'
                      );
			echo $form->input("urban_rural",array('type'=>'select','options'=>$options,"class"=>"styledselect_form_1","label"=>false,"div"=>false));    
             ?>
			</select>
			</td>
			</td></td>
		</tr>
		<tr>
			<th valign="top">Marital Status:</th>
			<td>	
			<?php
			
			 // Creating options for Type field
		   $options=array('single'    =>  'Single', 
                      'married'    => 'Married',
					   'divorsed'    => 'Divorsed'
                      );
			echo $form->input("urban_rural",array('type'=>'select','options'=>$options,"class"=>"styledselect_form_1","label"=>false,"div"=>false));    
             ?>
			</select>
			</td>
			</td></td>
		</tr>
		<tr>
			<th valign="top">Caste:</th>
			<td><?php
				 echo $form->input("caste",array("class"=>"inp-form","label"=>false,"div"=>false));
            ?></td>
		</tr>
    <tr>
	<tr>
			<th valign="top">Religion:</th>
			<td><?php
				 echo $form->input("religion",array("class"=>"inp-form","label"=>false,"div"=>false));
            ?></td>
		</tr>
	<tr>
			<th valign="top">Caste:</th>
			<td><?php
				 echo $form->input("caste",array("class"=>"inp-form","label"=>false,"div"=>false));
            ?></td>
	</tr>
	<tr>
			<th valign="top">Languages Known:</th>
			<td><?php
				 echo $form->textarea("language_known",array("class"=>"form-textarea","label"=>false,"div"=>false));
            ?></td>
		</tr>
	
	<tr>
			<th valign="top">Qualifications:</th>
			<td><?php
				 echo $form->textarea("qualification",array("class"=>"form-textarea","label"=>false,"div"=>false));
            ?></td>
	</tr>
	<tr>
			<th valign="top">Skills:</th>
			<td><?php
				 echo $form->textarea("skills",array("class"=>"form-textarea","label"=>false,"div"=>false));
            ?></td>
	</tr>
	<tr><td colspan="2"> <h2>Other Information</h2></td></tr>
   <tr>
			<th valign="top">Notes:</th>
			<td><?php
				 echo $form->textarea("notes",array("class"=>"form-textarea","label"=>false,"div"=>false));
            ?></td>
	</tr>
	<tr>
			<th valign="top">Documents:</th>
			<td><?php
				 echo $form->textarea("documents",array("class"=>"form-textarea","label"=>false,"div"=>false));
            ?></td>
	</tr>
		<tr>
			<th>&nbsp;</th>
			<td valign="top">
			<?php echo $form->hidden("id");
			echo $form->submit('Save',array('class'=>"form-submit",'div'=>false))."&nbsp;&nbsp;&nbsp;"; 
			echo $form->button('Cancel',array('type'=>'button','class'=>"form-reset",'div'=>false,'onclick'=>"location.href='".BASE_URL."admin/employees/list'")); 
			?>
			</td>
			<td></td>
		</tr>
	</table>
	<?php echo $form->end(); ?>
	<!-- end id-form  -->

			</td>
			<td>
			<form id="form1" action="" method="post" enctype="multipart/form-data">
			<?php
			if($title_for_layout == "Add Employee"){
				echo $this->element('user_sidebar', array('data'=>array('mode'=>'add')));
			}else{
				$ele = array('id'=>$this->data['Employee']['id'],'mode'=>'edit','type'=>'employees');
				echo $this->element('user_sidebar', array('data'=>$ele));
				echo $this->element('document_sidebar', array('data'=>$ele));
			}
			
			?>
			</form>
			</td>
		</tr>
	</table>
	
	<!-- end id-form  -->
	<div class="clear"></div>
	</div>
	<!--  end content-table-inner  -->