<table cellspacing="0" cellpadding="0" border="0" width="80%" class="adminBox">
	<tr>
		<td align="center" class="adminGridHeading">
		<strong>Administrator Controls</strong>
		</td>
	</tr>
	<tr>
		<td style="border-right: 2px solid rgb(255, 255, 255);">
			<table height="180" cellspacing="5" cellpadding="5" border="0" bgcolor="#ffffff" align="left" width="100%">
			<tr>
				<td valign="top">
				<table width="100%">
				
					<tr>
						<td width="20" class="dotted">
						<?php echo $html->link(
						$html->image("/images/arrow.jpg", array("alt" => "Users Management","class"=>"homeLink")),
						array("controller"=>"users","action"=>"list"),
						array('escape'=>false)
						); 
 						?>
						</td>
						<td valign="top" class="dotted">
						<?php echo $html->link("Users Management", array("controller"=>"users","action"=>"list"), array("class"=>"homeLink"), null, false);?>
						</td>
					</tr>
					<tr>
						<td width="20" class="dotted">
						<?php echo $html->link(
						$html->image("/images/arrow.jpg", array("alt" => "Retailers Management","class"=>"homeLink")),
						array("controller"=>"retailers","action"=>"add"),
						array('escape'=>false)
						); 
 						?>
						</td>
						<td valign="top" class="dotted">
						<?php echo $html->link("Retailers Management", array("controller"=>"retailers","action"=>"list"), array("class"=>"homeLink"), null, false);?>
						</td>
					</tr>
					<tr>
						<td width="20" class="dotted">
						<?php echo $html->link(
						$html->image("/images/arrow.jpg", array("alt" => "Static Pages Management","class"=>"homeLink")),
						array("controller"=>"static_pages","action"=>"list"),
						array('escape'=>false)
						); 
 						?>
						</td>
						<td valign="top" class="dotted">
						<?php echo $html->link("Static Pages Management", array("controller"=>"static_pages","action"=>"list"), array("class"=>"homeLink"), null, false); 				?>
						</td>
					</tr>
					<tr>
						<td width="20" class="dotted">
						<?php echo $html->link(
						$html->image("/images/arrow.jpg", array("alt" => "Series Management","class"=>"homeLink")),
						array("controller"=>"series","action"=>"add"),
						array('escape'=>false)
						); 
 						?>
						</td>
						<td valign="top" class="dotted">
						<?php echo $html->link("Series Management", array("controller"=>"series","action"=>"list"), array("class"=>"homeLink"), null, false); 				?>
						</td>
					</tr>
					<tr>
						<td width="20" class="dotted">
						<?php echo $html->link(
						$html->image("/images/arrow.jpg", array("alt" => "Insruction Book Management","class"=>"homeLink")),
						array("controller"=>"instructions","action"=>"add"),
						array('escape'=>false)
						); 
 						?>
						</td>
						<td valign="top" class="dotted">
						<?php echo $html->link("Insruction Book Management", array("controller"=>"instructions","action"=>"list"), array("class"=>"homeLink"), null, false); 				?>
						</td>
					</tr>
					<tr>
						<td width="20" class="dotted">
						<?php echo $html->link(
						$html->image("/images/arrow.jpg", array("alt" => "FAQs Management","class"=>"homeLink")),
						array("controller"=>"faqs","action"=>"add"),
						array('escape'=>false)
						); 
 						?>
						</td>
						<td valign="top" class="dotted">
						<?php echo $html->link("FAQs Management", array("controller"=>"faqs","action"=>"list"), array("class"=>"homeLink"), null, false); 				?>
						</td>
					</tr>
					<tr>
						<td width="20" class="dotted">
						<?php echo $html->link(
						$html->image("/images/arrow.jpg", array("alt" => "News Management","class"=>"homeLink")),
						array("controller"=>"news","action"=>"add"),
						array('escape'=>false)
						); 
 						?>
						</td>
						<td valign="top" class="dotted">
						<?php echo $html->link("News Management", array("controller"=>"news","action"=>"list"), array("class"=>"homeLink"), null, false); 				?>
						<tr>
						   <td  width="20" >
						   </td>
						   <td valign="top" >
						    <?php echo $html->link("News Category", array("controller"=>"news","action"=>"category_list"),array("class"=>"homeLink"), null, false);?>
						   </td>
						 </tr>
						</td>
					</tr>
					<tr>
						<td width="20" class="dotted">
						<?php echo $html->link(
						$html->image("/images/arrow.jpg", array("alt" => "Site Activity","class"=>"homeLink")),
						array("controller"=>"static_pages","action"=>"enquiry"),
						array('escape'=>false)
						); 
 						?>
						</td>
						<td valign="top" class="dotted">
						<?php echo $html->link("Site Activity", array("controller"=>"static_pages","action"=>"enquiry"), array("class"=>"homeLink"), null, false); 				?>
						</td>
					</tr>
					<tr>
						<td width="20" class="dotted">
						<?php echo $html->link(
						$html->image("/images/arrow.jpg", array("alt" => "Product Management","class"=>"homeLink")),
						array("controller"=>"products","action"=>"product_add"),
						array('escape'=>false)
						); 
 						?>
						<td valign="top">
						<?php echo $html->link("Product Management", array("controller"=>"Products","action"=>"product_list"), array("class"=>"homeLink"), null, false); 				?>                      
						<!--<?php echo"Product Management";?>-->
					
						<tr>
						   <td  width="20" >
						   </td>
						   <td valign="top" >
						    <?php echo $html->link("Product Type", array("controller"=>"products","action"=>"type_list"),array("class"=>"homeLink"), null, false);?>
						   </td>
						 </tr>
						 <tr>
						   <td  width="20" >
						   </td>
						   <td valign="top" >
						    <?php echo $html->link("Product Brand", array("controller"=>"products","action"=>"brand_list"),array("class"=>"homeLink"), null, false);?>
						   </td>
						 </tr>
						<tr>
						   <td  width="20" >
						   </td>
						   <td valign="top" >
						    <?php echo $html->link("Product Color", array("controller"=>"products","action"=>"color_list"),array("class"=>"homeLink"), null, false);?>
						   </td>
						 </tr>
						 <tr>
						   <td  width="20" >
						   </td>
						   <td valign="top" >
						    <?php echo $html->link("Product Size", array("controller"=>"products","action"=>"size_list"), array("class"=>"homeLink"), null, false);?>
						   </td>
						 </tr>
						 <tr>
						   <td  width="20" >
						   </td>
						   <td valign="top" >
						    <?php echo $html->link("Product Features", array("controller"=>"products","action"=>"feature_list"), array("class"=>"homeLink"), null, false);?>
						   </td>
						 </tr>
						 <tr>
						   <td  width="20" class="dotted">
						   </td>
						   <td valign="top" class="dotted">
						    <?php echo $html->link("Product Picture Quality", array("controller"=>"products","action"=>"picture_list"),array("class"=>"homeLink"), null, false);?>
						   </td>
						 </tr>
						</td>
					</tr>
					<tr>
						<td width="20" class="dotted">
						<?php echo $html->link(
						$html->image("/images/page_save.png", array("alt" => "Change Password","class"=>"homeLink")),
						array("controller"=>"users","action"=>"change_password"),
						array('escape'=>false)
						);
 						?>
						</td>
						<td valign="top" class="dotted">
						<?php echo $html->link("Change Password", array("controller"=>"users","action"=>"change_password"), array("class"=>"homeLink"), null, false); ?>
						</td>
					</tr>
					<tr>
						<td width="20" class="dotted">
						<?php echo $html->link(
						$html->image("/images/lock.png", array("alt" => "Logout","class"=>"homeLink")),
						"/admins/logout",
						array('escape'=>false)
						);
 						?>
						</td>
						<td valign="top" class="dotted">
						<?php echo $html->link("Logout", array("controller"=>"users","action"=>"logout"), array("class"=>"homeLink"), null, false); ?>
						</td>
					
					</tr>
				</table> 
				</td>
			</tr>
			</table>
		</td>
	</tr>
</table>