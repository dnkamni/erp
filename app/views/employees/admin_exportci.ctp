<table border="1">
	<tr> 
		<td colspan='6' align='center'><b>Employee(s) Report<b></td> 
	</tr>
	<tr>		
		<td class="tableTd">&nbsp;</td>
		<td class="tableTd">&nbsp;</td>
		<td class="tableTd">&nbsp;</td>
		<td class="tableTd">&nbsp;</td>
		<td class="tableTd">&nbsp;</td>
		<td class="tableTd">&nbsp;</td>
	</tr>
	<tr>		
		<td class="tableTd">&nbsp;</td>
		<td class="tableTd">&nbsp;</td>
		<td class="tableTd">&nbsp;</td>
		<td class="tableTd">&nbsp;</td>
		<td class="tableTd">&nbsp;</td>
		<td class="tableTd">&nbsp;</td>
	</tr>  		
	<tr>
	<th class="tableTd">Employee Code</th>
	<th class="tableTd">First Name</th>
	<th class="tableTd">Last Name</th>
	<th class="tableTd">Email</th>
	<th class="tableTd">Phone</th>
	<th class="tableTd">Salary</th>
	</tr> 
	<?php //printing data
	foreach($crData as $val) { 
	$bgclr  = $val['User']['status']  ? '#ffffff' : '#ff6544'; //if status is deactivated then red.
	?>
		<tr>
		<td bgcolor="<?php echo $bgclr;?>" align="right"><?php echo $val['User']['employee_code'] ?></td>
		<td bgcolor="<?php echo $bgclr;?>"  align="left"><?php echo $val['User']['first_name'] ?></td>
		<td bgcolor="<?php echo $bgclr;?>"  align="left"><?php echo $val['User']['last_name'] ?></td>
		<td bgcolor="<?php echo $bgclr;?>"  align="right"><?php echo $val['User']['email'] ?></td>
		<td bgcolor="<?php echo $bgclr;?>"  align="right"><?php echo $val['User']['phone'] ?></td>	
		<td bgcolor="<?php echo $bgclr;?>"  align="right"><?php echo $val['User']['current_salary'] ?></td>	
		</tr>
	<?php
	}//end for
	?>
	</tr>		
</table>