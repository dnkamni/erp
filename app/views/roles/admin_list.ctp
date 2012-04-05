<?php
$newUrl = "list".$urlString;
$urlArray = array(
	'field' 	=> $search1,
	'value' 	=> $search2
);
$paginator->options(array('url'=>$urlArray));
?>
<?php echo $form->create('Role',array('action'=>$newUrl,'method'=>'POST', "class" => "longFieldsForm", "name" => "listForm", "id" => "mainform")); ?>
<!--  start content-table-inner -->
	<div id="content-table-inner">
	<?php $user = $session->read("SESSION_ADMIN"); ?>
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
	
	<!--  start table-content  -->
			<div id="table-content">
			<?php echo $session->flash(); ?>
				<div class="addLinks">
				<?php echo $html->link("Add New Role",
				array('controller'=>'roles','action'=>'add')
				);	
				?>
				</div>
				<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
				<tr>
					<th class="table-header-check"><a id="toggle-all" ></a> </th>
					<th class="table-header-repeat line-left minwidth-1"  width="26%"><?php echo $paginator->sort('Role', 'Role.role');?></th>
					<th class="table-header-repeat line-left minwidth-1"  width="21%"><?php echo $paginator->sort('Description', 'Role.description');?></th>
					<th class="table-header-repeat line-left" width="22%"><?php echo $paginator->sort('Created', 'Role.created');?></th>
					<th class="table-header-repeat line-left" width="16%"><?php echo $paginator->sort('Status', 'Role.status');?></th>
					<th class="table-header-options line-left" width="18%"><a href="#A">Options</a></th>
				</tr>
				<?php if(count($resultData)>0){
				$i = 1;
				foreach($resultData as $result): 
				if($i%2)$class = "alternate-row"; else $class = "";  ?>
				<tr class="<?php echo $class; ?>">
					<td><input  type="checkbox" name="IDs[]" value="<?php echo $result['Role']['id'];?>"/></td>
					<td><?php echo ucwords($result['Role']['role']); ?></td>
					<td><?php echo $result['Role']['description']; ?></td>
					<td><?php echo date(DATE_FORMAT, strtotime($result['Role']['created'])); ?></td>
					<td><?php echo ($result['Role']['status'] == '1')?$html->image(BASE_URL."images/table/green.png", array("alt"=>"Activated")):$html->image(BASE_URL."images/table/red.png", array("alt"=>"Deactivated")); ?></td>
					<td class="options-width" align="center">
					<?php
					echo $html->link("",
						array('controller'=>'roles','action'=>'add',$result['Role']['id']),
						array('class'=>'icon-1 info-tooltip','title'=>'Edit')
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