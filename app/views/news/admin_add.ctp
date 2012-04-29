<!-- start content-table-inner -->
	<div id="content-table-inner">
	<?php echo $form->create('News',array('action'=>'add','method'=>'POST','onsubmit' => '',"class"=>"login",'enctype'=>"multipart/form-data")); ?>
	<?php $session->flash(); ?>
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
		<tr valign="top">
			<td>
	<!-- start id-form -->
	<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		<tr>
			<th valign="top">Title:</th>
			<td><?php
				 echo $form->input("title",array("class"=>"inp-form","label"=>false,"div"=>false));
            ?></td>
			<td></td>
		</tr>		
		<tr>
			<th valign="top">Type:</th>
			<td>	
			<?php                                             			
			 // Creating options for Type field
		   $options=array('news'    =>  'news', 
                      'information'    => 'information',                      
                      );
			echo $form->input("type",array('type'=>'select','options'=>$options,"class"=>"styledselect_form_1","label"=>false,"div"=>false));    
             ?>
			</select>
			</td>
			</td></td>
		</tr>
			<th valign="top">Description:</th>
			<td><?php
				 echo $form->input("description",array("class"=>"form-textarea","label"=>false,"div"=>false));
				 echo $form->hidden("id");
            ?></td>
		</tr>
		<tr>
			<th>&nbsp;</th>
			<td valign="top">
			<?php echo $form->submit('Save',array('class'=>"form-submit",'div'=>false))."&nbsp;&nbsp;&nbsp;"; 
			echo $form->button('Cancel',array('type'=>'button','class'=>"form-reset",'div'=>false,'onclick'=>"location.href='".BASE_URL."admin/news/list'")); 
			?>
			</td>
			<td></td>
		</tr>
	</table>
	<!-- end id-form  -->
			</td>
			<td>
<!--  start related-activities -->
	<div id="related-activities">
	<?php $user = $session->read("SESSION_ADMIN"); ?>
		<!--  start related-act-top -->
		<div id="related-act-top">
		<?php echo $html->image(BASE_URL."images/forms/header_related_act.gif", array("alt"=>"Edit",'width'=>"271", 'height'=>"43")); ?>
		</div>
		<!-- end related-act-top -->		
		<!--  start related-act-bottom -->
		<div id="related-act-bottom">		
			<!--  start related-act-inner -->
			<div id="related-act-inner">				
				<div class="left"><a href=""><?php $html->image(BASE_URL."images/forms/icon_edit.gif", array("alt"=>"Edit",'width'=>"21",'height'=>"21"))?></a></div>
				<div class="right">
					<h5>News Management</h5>
          This section is used by Admin only, Here all information, news, Very Important Contacts should be saved.
          <div class="lines-dotted-short"></div>
					<ul class="greyarrow">
  					<li>
            <?php 
            echo $html->link("Go To Listing",
            array('controller'=>'news','action'=>'list')
            );	
            ?>
            </li>               						
					</ul>
				</div>
				<div class="clear"></div>
			</div>
			<!-- end related-act-inner -->
			<div class="clear"></div> 		
		</div>
		<!-- end related-act-bottom -->	
	</div>
	<!-- end related-activities -->
			</td>
		</tr>
	</table>
	<!-- end id-form  -->
	<div class="clear"></div>
	</div>
	<!--  end content-table-inner  -->