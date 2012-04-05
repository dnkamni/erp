<script type="text/javascript">
$(function() {
$('a.info-tooltip ').tooltip({
	track: true,
	delay: 0,
	fixPNG: true, 
	showURL: false,
	showBody: " - ",
	top: -35,
	left: 5
});
});
</script> 
<?php 
$session->flash(); 
$newUrl = "list".$urlString;
$urlArray = array(
	'field' 	=> $search1,
	'value' 	=> $search2
);
$paginator->options(array('url'=>$urlArray));
?>
<?php echo $form->create('StaticPage',array('action'=>$newUrl,'method'=>'POST', "class" => "longFieldsForm", "name" => "listForm", "id" => "listForm")); ?>
<!--  start content-table-inner -->
<div id="content-table-inner">
<?php $user = $session->read("SESSION_ADMIN"); ?>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
<tr valign="top">
<td>

<!--  start table-content  -->
		<div id="table-content">
			<!--  start message-red -->
			<div id="message-red">
			<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td class="red-left">Error. <a href="">Please try again.</a></td>
				<td class="red-right"><a class="close-red"><img src="../../images/table/icon_close_red.gif"   alt="" /></a></td>
			</tr>
			</table>
			</div>
			<!--  end message-red -->
			<!--  start message-green -->
			<div id="message-green">
			<table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr>
				<td class="green-left">Role added sucessfully. <a href="">Add new one.</a></td>
				<td class="green-right"><a class="close-green"><img src="../../images/table/icon_close_green.gif"   alt="" /></a></td>
			</tr>
			</table>
			</div>
			<!--  end message-green -->
	
	 
			<!--  start product-table ..................................................................................... -->
			
			<table border="0" width="100%" cellpadding="0" cellspacing="0" id="product-table">
			<tr>
				<th class="table-header-check"><input type="checkbox" onclick="changeCheckboxStatus(listForm)" name="selectAll" id="toggle-all"/></th>
				<th class="table-header-repeat line-left minwidth-1"><?php echo $paginator->sort('Title', 'StaticPage.title');?> </th>
				<th class="table-header-repeat line-left minwidth-1"><?php echo $paginator->sort('Content', 'StaticPage.content');?> </th>
				<th class="table-header-repeat line-left"><?php echo $paginator->sort('Created At', 'StaticPage.created');?> </th>
				<th class="table-header-options line-left minwidth-1">Action</th>
			</tr>
				<?php if(count($resultData)>0){
				$i = 1;
				foreach($resultData as $result): 
				if($i%2)$class = "odd"; else $class = "alternate-row";  ?>
		<tr class="<?php echo $class; ?>">
			<td><input type="checkbox" onclick="toggleCheck(listForm)" name="IDs[]" class="checkbox disableEvent" value="<?php echo $result['StaticPage']['id'];?>" /></td>
		    <td><?php echo $result['StaticPage']['title']; ?></td>
			<td class="type-view"><?php echo substr(strip_tags($result['StaticPage']['content']),0,110)."..."; ?></td>
	    	<td class="created-at-view"><?php echo date(DATE_FORMAT,strtotime($result['StaticPage']['created'])); ?></td> 
			<td class="options-width">
				<a href="<?php echo BASE_URL.'admin/static_pages/add/'.$result['StaticPage']['id'];?>" title="Edit" class="icon-1 info-tooltip"></a>
				<a href="" onClick="return atleastOneChecked('If you delete user then all the information associated with this user will also be deleted. Are you sure you want to delete this user?');" title="Delete" class="icon-2 info-tooltip"></a>
			</td>
		</tr>
				<?php $i++ ;endforeach; ?>
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
			<?php if(count($resultData)>0){ ?>
				<div id="actions-box-slider">
					<a href="<?php echo BASE_URL.'admin/roles/add/'.$result['Role']['id'];?>" class="action-edit">Edit</a>
			
					<?php echo $form->submit("",array("div"=>false,"name"=>"publish",'class'=>"activate",'onclick' => "return atleastOneChecked('Activate selected records?');")); ?><div style="float:right ;margin-top:-20px;margin-right:19px;font-weight:bold">Activate</div>
						<?php echo $form->submit("",array("div"=>false,"name"=>"unpublish",'class'=>"deactivate",'onclick' => "return atleastOneChecked('Deactivate selected records?');","value"=>"0")); ?><div style="float:right ;margin-top:-20px;margin-right:7px;font-weight:bold">Deactivate</div>
				</div>
					<?php } ?>
			<div class="clear"></div>
		</div>
		<!-- end actions-box........... -->
		
		<!--  start paging..................................................... -->
		<table border="0" cellpadding="0" cellspacing="0" id="paging-table">
		<tr>
		<td>
		<?php echo $paginator->prev(); ?>
		<?php echo $paginator->numbers(); ?>
		<?php echo $paginator->next(); ?> 
		<?php echo $this->Paginator->counter(array('format' => ' page %start% / %count%.',"id"=>"page-info")); ?>
		</td>
		
		</tr>
		</table>
		<!--  end paging................ -->
		
		<div class="clear"></div>

</td>
<td>



</td>
</tr>
</table>
	<?php echo $form->hidden('Role.mode', array('value'=>'')); ?>
	<?php echo $form->end(); ?>
<div class="clear"></div>


</div>
<!--  end content-table-inner  -->