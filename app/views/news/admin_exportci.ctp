<table border="1">
	<tr> 
		<td colspan='5' align='center'><b>Credential(s) Report<b></td> 
	</tr>
	<tr>		
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
	</tr>  		
	<tr>
	<th class="tableTd">Username</th>
	<th class="tableTd">Password</th>
	<th class="tableTd">Description</th>
	<th class="tableTd">Type</th>
	<th class="tableTd">Keyword</th>
	</tr> 
	<?php //printing data
	foreach($crData as $val) { 
	$bgclr  = $val['Credential']['status']  ? '#ffffff' : '#ff6544'; //if status is deactivated then red.
	?>
		<tr>
		<td bgcolor="<?php echo $bgclr;?>" align="right"><?php echo $val['Credential']['username'] ?></td>
		<td bgcolor="<?php echo $bgclr;?>"  align="left"><?php echo $val['Credential']['password'] ?></td>
		<td bgcolor="<?php echo $bgclr;?>"  align="right"><?php echo nl2br($val['Credential']['description']) ?></td>
		<td bgcolor="<?php echo $bgclr;?>"  align="right"><?php echo nl2br($val['Credential']['type']) ?></td>	
		<td bgcolor="<?php echo $bgclr;?>"  align="right"><?php echo $val['Credential']['keyword'] ?></td>	
		</tr>
	<?php
	}//end for
	?>
	</tr>		
</table>