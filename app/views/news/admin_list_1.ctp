<?php
$newUrl = "list".$urlString;
$urlArray = array(
	'field' 	=> $search1,
	'value' 	=> $search2
);
$paginator->options(array('url'=>$urlArray));
?>
<?php echo $form->create('Credential',array('action'=>$newUrl,'method'=>'POST', "class" => "longFieldsForm", "name" => "listForm", "id" => "mainform")); ?>
<!--  start content-table-inner -->
	<div id="content-table-inner">
	<?php $user = $session->read("SESSION_ADMIN"); ?>
			<?php echo $session->flash(); ?><br/>
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
				<!--  start actions-box ............................................... -->
			<!--<div id="actions-box">
				<a href="" class="action-slider"></a>
				<div id="actions-box-slider">
					
					<?php echo $form->submit("Activate",array("div"=>false,"class"=>"action-activate","name"=>"publish",'onclick' => "return atleastOneChecked('Activate selected records?');")); ?>
					<?php echo $form->submit("Deactivate",array("div"=>false,"class"=>"action-deactivate","name"=>"unpublish",'onclick' => "return atleastOneChecked('Deactivate selected records?');")); ?>
				</div>
				<div class="clear"></div>
			</div>-->
			<!-- end actions-box........... -->	
	<!--  start table-content  -->
		<div id="table-content">
	<table cellspacing="0" cellpadding="4" border="0" align="center" class="top-search" style="margin-left:230px;">
		<tr>
			<td width="20%">
				<b>Search by:<b><br/>
				<?php
				$fieldsArray = array(
				''				                => 'Select',
				'Credential.username'     => 'Username',
				'Credential.type'         => 'Type',
				'Credential.description'  => 'Description'
				);
				echo $form->select("Credential.fieldName",$fieldsArray,$search1,array("id"=>"searchBy","label"=>false,"style"=>"width:100px","class"=>"styledselect_form_1"),false); ?>
			</td>
			<td width="30%">
				<b>Search value:</b><br/>
				<?php
				$display1   = "display:none";
				$display2   = "display:none";
				if($search1 != "Credential.status"){
					$display1 = "display:block";
				}else{
					$display2 = "display:block";
				}
					echo $form->input("Credential.value1",array("id"=>"search_input","class"=>"inp-form","style"=>"width:200px;$display1", "div"=>false, "label"=> false,"value"=>$search2)); 
					echo $form->select("Credential.value2",array('1' => 'Active','0' => 'Inactive'),
					$search2,array("id"=>"search_select","label"=>false,"style"=>"width:100px;$display2","class"=>"disableEvent"), false);
				?>
			</td>
			<td width="40%"><br/>
				<?php
				echo $form->button("Search", array('id'=>'search','onclick'=>'setSubmitMode(this.id)'))."&nbsp;&nbsp;&nbsp;";
				echo $form->button("Reset",array('type'=>'button','class'=>"",'div'=>false,'onclick'=>"location.href='".BASE_URL."admin/credentials/list'"));
				
				?>
			</td>
		</tr>
	</table>
		<br/>
	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
		<tr>
			<th class="table-header-check"><a id="toggle-all" ></a> </th>
			<th class="table-header-repeat line-left minwidth-1"  width="26%"><?php echo $paginator->sort('Username', 'Credential.username');?></th>
			<th class="table-header-repeat line-left minwidth-1"  width="26%"><?php echo $paginator->sort('Type', 'Credential.type');?></th>
			<th class="table-header-repeat line-left minwidth-1"  width="21%"><?php echo $paginator->sort('Description', 'Credential.description');?></th>
			<th class="table-header-repeat line-left" width="22%"><?php echo $paginator->sort('Created', 'Credential.created');?></th>
			<th class="table-header-options line-left" width="18%"><a href="#A">Options</a></th>
		</tr>
			<?php if(count($resultData)>0){
			$i = 1;
			foreach($resultData as $result): 
			if($i%2)$class = "alternate-row"; else $class = "";  ?>
		<tr class="<?php echo $class; ?>">
			<td><input  type="checkbox" name="IDs[]" value="<?php echo $result['Credential']['id'];?>"/></td>
			<td><?php echo $result['Credential']['username']; ?></td>
			<td><?php echo $result['Credential']['type']; ?></td>
			<td><?php echo $result['Credential']['description']; ?></td>
			<td><?php echo date(DATE_FORMAT, strtotime($result['Credential']['created'])); ?></td>
			<td class="options-width" align="center">
				<?php
				echo $html->link("",
				array('controller'=>'credentials','action'=>'add',$result['Credential']['id']),
				array('class'=>'icon-1 info-tooltip','title'=>'Edit')
			);
				?>
				<?php
				echo $html->link("",
				array('controller'=>'credentials','action'=>'delete',$result['Credential']['id']),
				array('class'=>'icon-2 info-tooltip','title'=>'Delete')
			);
				?>
			</td>
		</tr>
				<?php $i++ ;
				endforeach; ?>
				<?php } else { ?>
		<tr>
			<td colspan="10" class="no_records_found">No records found</td>
		</tr>
			<?php } ?>
	</table>
	<!--  end product-table................................... --> 
			</div>
	<!--  end content-table  -->
		
	<!--  start actions-box ............................................... -->
			
	<!-- end actions-box........... -->
		
	<!--  start paging..................................................... -->
	<table border="0" cellpadding="0" cellspacing="0" id="paging-table">
		<tr>
			<td>
				<?php echo $paginator->prev('« Previous', array('class' => 'page-left'), null, array('class' => 'page-left')); ?>
				<div id="page-info"><?php echo $this->Paginator->counter(array('format' => ' Page<strong> %page%</strong> / %pages%',"id"=>"page-info")); ?></div>
				<?php echo $paginator->next('Next »', array('class' => 'page-right'), null, array('class' => 'page-right')); ?>
			</td>
		</tr>
	</table>
	<!--  end paging................ -->
		<div class="clear"></div>
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
					<h5>Credentials Management</h5>
          This section is used by Admin and PM only to view senstive credentials.
          <div class="lines-dotted-short"></div>
					<ul class="greyarrow">
  					<li>
            <?php echo $html->link("Add New Credential",
            array('controller'=>'credentials','action'=>'add')
            );	
            ?>
            </li> 
						<li><a href="">Download Search Result</a> </li>
						<li><a href="">Download Odesk Credentials</a> </li>
						<li><a href="">Download Elance Credentials</a> </li>
						<li><a href="">Download Gmail Credentials</a> </li>
						<li><a href="">Download Skype Credentials</a> </li>
						<li><a href="">Download Webmail Credentials</a> </li>
						<li><a href="">Download Other Credentials</a> </li>
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
		<div class="clear"></div>
		</div>
	<?php echo $form->end(); ?>
	<!--  end content-table-inner  -->
				<!--  start actions-box ............................................... -->
			<div id="actions-box">
				<a href="" class="action-slider"></a>
				<div id="actions-box-slider">
					
					<?php echo $form->submit("Activate",array("div"=>false,"class"=>"action-activate","name"=>"publish",'onclick' => "return atleastOneChecked('Activate selected records?');")); ?>
					<?php echo $form->submit("Deactivate",array("div"=>false,"class"=>"action-deactivate","name"=>"unpublish",'onclick' => "return atleastOneChecked('Deactivate selected records?');")); ?>
				</div>
				<div class="clear"></div>
			</div>
			<!-- end actions-box........... -->