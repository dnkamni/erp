<table border="1">
	<tr> 
		<td colspan='5' align='center'><b>Testimonial(s) Report<b></td> 
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
	<th class="tableTd">Author</th>
		<th class="tableTd">Description</th>
		<th class="tableTd">Keyword</th>
		<th class="tableTd">Type</th>
	</tr> 
	<?php //printing data
	foreach($crData as $val) { 
	$bgclr  = $val['Testimonial']['status']  ? '#ffffff' : '#ff6544'; //if status is deactivated then red.
	?>
		<tr>
		<td bgcolor="<?php echo $bgclr;?>" align="right"><?php echo $val['Testimonial']['author'] ?></td>
		<td bgcolor="<?php echo $bgclr;?>"  align="right"><?php echo nl2br($val['Testimonial']['description']) ?></td>
				<td bgcolor="<?php echo $bgclr;?>"  align="right"><?php echo $val['Testimonial']['keyword'] ?></td>	
				<td bgcolor="<?php echo $bgclr;?>"  align="right"><?php echo $val['Testimonial']['type'] ?></td>	
		</tr>
	<?php
	}//end for
	?>
	</tr>		
</table>