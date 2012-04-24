<!--  start content-table-inner -->
	<div id="content-table-inner">
	<?php $user = $session->read("SESSION_ADMIN"); ?>
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td width="70%">
		<!--  start message-red -->
				<div id="message-blue">
        <?php echo $session->flash(); ?>
				</div>
				<!--  end message-red -->
		<!-- start id-form -->
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form" width="100%">
		
		<tr>
			<th valign="middle" colspan="2" class="dashline">Basic Information:</th>
		</tr>
		<tr>
			<th valign="top">Employee Code:</th>
			<td><?php echo $resultdata['User']['employee_code']?></td>
			<td></td>
		</tr>
		<tr>
			<th valign="top">Employee Name:</th>
			<td><?php echo $resultdata['User']['first_name']." ".$resultdata['User']['last_name']?></td>
		</tr>
		<tr>
			<th valign="top">Role:</th>
			<td><?php //echo $resultdata['Role']['role_id']?></td>
		</tr>
		<tr>
			<th valign="top">Current Salary:</th>
			<td><?php echo $resultdata['User']['current_salary']?></td>
		</tr>
		<tr>
			<th valign="top">Email:</th>
			<td><?php echo $resultdata['User']['email']?></td>
		</tr>
		<tr>
			<th valign="top">Date of Joining:</th>
			<td><?php echo date(DATE_FORMAT, strtotime($resultdata['User']['doj']));?></td>
		</tr>
		<tr>
			<th valign="top">Qualification:</th>
			<td><?php echo $resultdata['User']['qualification']?></td>
		</tr>
		<?php if(!empty($resultdata['User']['skills'])) { ?>
		<tr>
			<th valign="top">Skills:</th>
			<td><?php echo $resultdata['User']['skills']?></td>
		</tr>
		<?php } ?>
		<?php if(!empty($resultdata['User']['experience'])) { ?>
		<tr>
			<th valign="top">Experience:</th>
			<td><?php echo $resultdata['User']['experience']?></td>
		</tr>
		<?php } ?>
		<?php if(!empty($resultdata['User']['previous_employment'])) { ?>
		<tr>
			<th valign="top">Previous Employment</th>
			<td><?php echo $resultdata['User']['previous_employment']?></td>
		</tr>
		<?php } ?>
		<?php if(!empty($resultdata['User']['dor']) && $resultdata['User']['dor'] != "0000-00-00 00:00:00"){ ?>
		<tr>
			<th valign="top">Date of Relieving:</th>
			<td><?php echo date(DATE_FORMAT, strtotime($resultdata['User']['dor']));?></td>
		</tr>
		<?php } ?>	
		<tr>
			<th valign="top" colspan="2" class="dashline">Personal Information:</th>
		</tr>
		<tr>
			<th valign="top">Username:</th>
			<td><?php echo $resultdata['User']['username']?></td>
		</tr>
		<tr>
			<th valign="top">Father&#39;s Name:</th>
			<td><?php echo $resultdata['User']['father_name']?></td>
		</tr>
		<tr>
			<th valign="top">Mother&#39;s Name:</th>
			<td><?php echo $resultdata['User']['mother_name']?></td>
		</tr>
		<?php if(!empty($resultdata['User']['phone'])) { ?>
		<tr>
			<th valign="top">Phone Number:</th>
			<td><?php echo $resultdata['User']['phone']?></td>
		</tr>
		<?php } ?>
		<tr>
			<th valign="top">Date of Birth:</th>
			<td><?php echo $resultdata['User']['dob']?></td>
		</tr>
		<?php if(!empty($resultdata['User']['place_of_birth'])) { ?>
		<tr>
			<th valign="top">Place of Birth:</th>
			<td><?php echo $resultdata['User']['place_of_birth']?></td>
		</tr>
		<?php } ?>
		<tr>
			<th valign="top">Full Address:</th>
			<td><?php echo $resultdata['User']['full_address']?></td>
		</tr>
		<tr>
			<th valign="top">Personal Email:</th>
			<td><?php echo $resultdata['User']['personal_email']?></td>
		</tr>
		<tr>
			<th valign="top">Gender:</th>
			<td><?php echo $resultdata['User']['sex']?></td>
		</tr>
		<?php if(!empty($resultdata['User']['urban_rural'])) { ?>
		<tr>
			<th valign="top">Urban/Rural:</th>
			<td><?php echo $resultdata['User']['urban_rural']?></td>
		</tr>
		<?php } ?>
		<tr>
			<th valign="top">Marital Status:</th>
			<td><?php echo ucwords($resultdata['User']['marital_status']); ?></td>
		</tr>
		<tr>
			<th valign="top">Caste:</th>
			<td><?php echo ucwords($resultdata['User']['caste']); ?></td>
		</tr>
			<tr>
			<th valign="top">Religion:</th>
			<td><?php echo ucwords($resultdata['User']['religion']);?></td>
		</tr>
			<tr>
			<th valign="top">Languages Known:</th>
			<td><?php echo ucwords($resultdata['User']['language_known']); ?></td>
		</tr>
		<?php if(!empty($resultdata['User']['notes'])) { ?>
		<tr>
			<th valign="top">Notes:</th>
			<td><?php echo $resultdata['User']['notes']?></td>
		</tr>
		<?php } ?>
		<?php if(!empty($resultdata['User']['document'])) { ?>
		<tr>
			<th valign="top">Document:</th>
			<td><?php echo $resultdata['User']['document']?></td>
		</tr>
		<?php } ?>
	</table>
	<!-- end id-form  -->

	</td>
	<td width="30%">

	<?php echo $this->element('user_sidebar'); ?>

</td>
</tr>
</table>
 
<div class="clear"></div>
 

</div>
<!--  end content-table-inner  -->