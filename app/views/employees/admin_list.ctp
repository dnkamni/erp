<?php
$newUrl = "list".$urlString;
//echo $search1." ".$search2; die;
$urlArray = array(
	'field' 	=> $search1,
	'value' 	=> $search2
);
$paginator->options(array('url'=>$urlArray));
?>
<?php echo $form->create('Employee',array('action'=>$newUrl,'method'=>'POST', "class" => "longFieldsForm", "name" => "listForm", "id" => "mainform")); ?>
<!--  start content-table-inner -->
	<div id="content-table-inner">
	<?php $user = $session->read("SESSION_ADMIN"); ?>
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
	
	<!--  start table-content  -->
			<div id="table-content">
			<?php echo $session->flash(); ?>
			<table cellspacing="0" cellpadding="4" border="0" align="center" class="top-search" style="margin-left:40px;">
		<tr>
			<td width="14%">
				<b>Search by:</b>
				<?php
				$fieldsArray = array(
				''				          => '---',
				'User.employee_code'     => 'Employee Code',
				'User.first_name'         => 'First Name',
				'User.email'  => 'Email address',
				'User.phone'  => 'Phone',
				'User.current_salary'  => 'Current Salary',
				);
				echo $form->select("User.fieldName",$fieldsArray,$search1,array("id"=>"searchBy","label"=>false,"style"=>"width:200px","class"=>"styledselect","empty"=>false),false); ?>
			</td>
			<td width="20%">
				<b>Search value:</b><br/>
				<?php
				$display1   = "display:none";
				$display2   = "display:none";
				if($search1 != "User.status"){
					$display1 = "display:block";
				}else{
					$display2 = "display:block";
				}
					echo $form->input("User.value1",array("id"=>"search_input","class"=>"top-search-inp","style"=>"width:200px;$display1", "div"=>false, "label"=> false,"value"=>$search2));
					
				?>
			</td>
			<td width="40%"><br/>
		  		<?php
				echo $form->button("Search", array('class'=>'form-search','id'=>'search','onclick'=>'setSubmitMode(this.id)'))."&nbsp;&nbsp;&nbsp;";
				echo $form->button("Reset",array('type'=>'button','class'=>"form-reset",'div'=>false,'onclick'=>"location.href='".BASE_URL."admin/employees/list'"));				
				?>
			</td>
		</tr>
	</table>
		<br/>
		<div class="addLinks">
				<?php echo $html->link("Add New Employee",
				array('controller'=>'employees','action'=>'add')
				);	
				?>
				</div>
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					<th class="table-header-check"><a id="toggle-all" ></a> </th>
					<th class="table-header-repeat line-left minwidth-1"  width="14%"><?php echo $paginator->sort('Employee Code', 'User.employee_code');?></th>
					<th class="table-header-repeat line-left minwidth-1"  width="16%"><?php echo $paginator->sort('First Name', 'User.first_name');?></th>
					<th class="table-header-repeat line-left minwidth-1"  width="20%"><?php echo $paginator->sort('Email', 'User.email');?></th>
					<th class="table-header-repeat line-left minwidth-1"  width="30%"><?php echo $paginator->sort('Phone', 'User.phone');?></th>
					<th class="table-header-repeat line-left" width="10%"><?php echo $paginator->sort('Salary', 'User.current_salary');?></th>
					<th class="table-header-repeat line-left" width="10%"><?php echo $paginator->sort('Status', 'User.status');?></th>
					<th class="table-header-options line-left" width="12%"><a href="#A">Options</a></th>
				</tr>
				<?php if(count($resultData)>0){
			$i = 1;
			foreach($resultData as $result):
			if(!$result['User']['status']%2)$class = "alternate-row"; else $class = "";  ?>
				<tr class="<?php echo $class; ?>">
					<td><input  type="checkbox" name="IDs[]" value="<?php echo $result['User']['id'];?>"/></td>
					<td><?php echo $result['User']['employee_code']; ?></td>
					<td><?php echo $result['User']['first_name']; ?></td>
					<td><?php echo $html->link($result['User']['email'],"mailto:".$result['User']['email']); ?></td>
					<td><?php echo nl2br($result['User']['phone']); ?></td>
					<td><?php echo number_format($result['User']['current_salary']); ?></td>
					<td style="text-align:center">
						<?php echo ($result['User']['status'] == '1')?$html->image(BASE_URL."images/table/green.png", array("alt"=>"Activated")):$html->image(BASE_URL."images/table/red.png", array("alt"=>"Deactivated")); ?>
					</td>
					<td class="options-width" align="center">
						<?php
						echo $html->link("",
						array('controller'=>'employees','action'=>'add',$result['User']['id']),
						array('class'=>'icon-1 info-tooltip','title'=>'Edit')
					);
						?>
						<?php
						echo $html->link("",
						array('controller'=>'employees','action'=>'list','delete',$result['User']['id']),
						array('class'=>'icon-2 info-tooltip delete','title'=>'Delete')
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
			<div id="actions-box">
				<a href="" class="action-slider"></a>
				<div id="actions-box-slider">
					
					<?php echo $form->submit("Activate",array("div"=>false,"class"=>"action-activate","name"=>"publish",'onclick' => "return atleastOneChecked('Activate selected records?');")); ?>
					<?php echo $form->submit("Deactivate",array("div"=>false,"class"=>"action-deactivate","name"=>"unpublish",'onclick' => "return atleastOneChecked('Deactivate selected records?');")); ?>
				</div>
				<div class="clear"></div>
			</div>
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

	<?php echo $this->element('user_sidebar'); ?>

</td>
</tr>
</table>
 
<div class="clear"></div>
 

</div>
<?php echo $form->end(); ?>
<!--  end content-table-inner  -->