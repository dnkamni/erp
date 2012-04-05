<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title_for_layout;?></title>
<meta http-equiv="cache-control" content="no-cache"> <!-- tells browser not to cache -->
<meta http-equiv="expires" content="0"> <!-- says that the cache expires 'now' -->
<meta http-equiv="pragma" content="no-cache"> <!-- says not to use cached stuff, if there is any -->
<meta content="IE=7" http-equiv="X-UA-Compatible" /> 
<meta content="e-magazine" name="keywords" />
<meta content="e-magazine" name="description" />
<meta content="English" name="language" />
<meta content="1 week" name="revisit-after" />
<meta content="global" name="distribution" />
<meta content="index, follow" name="robots" />
<?php print $html->charset('UTF-8') ?>
<?php echo $html->css(array("screen","datePicker")); ?>
<?php echo $javascript->link(array('jquery-1.4.1.min','ui.core','ui.checkbox','jquery.bind','common','listing')); ?>
<link rel="shortcut icon" href="/img/favicon.ico">
<script>
var base_url = "<?php echo BASE_URL; ?>";
</script>
<![if !IE 7]>

<!--  styled select box script version 1 -->
<?php echo $javascript->link(array('jquery.selectbox-0.5')); ?>

<![endif]>
<?php echo $javascript->link(array('jquery.selectbox-0.5_style_2','jquery.selectbox-0.5_style_2','jquery.filestyle','custom_jquery','jquery.tooltip','jquery.dimensions','date','jquery.datePicker','jquery.pngFix.pack','functions')); ?>
<!--[if IE]>
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL."/css/ie.css"?>" />
<![endif]-->
</head>
<?php $user = $session->read("SESSION_ADMIN"); ?>
<body> 
<!-- Start: page-top-outer -->
<div id="page-top-outer">    

<!-- Start: page-top -->
<div id="page-top">

	<!-- start logo -->
	<div id="logo">
	<?php echo $html->link(
			$html->image(BASE_URL."images/shared/logosel.png",array("alt" => SITE_NAME)),
			array('controller'=>'users','action'=>'login'),
			array('escape'=>false,'title'=>SITE_NAME)
			);			
	?>
	</div>
	<!-- end logo -->
	
	<!--  start top-search -->
	<div id="top-search">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
		<td><input type="text" value="Search" onblur="if (this.value=='') { this.value='Search'; }" onfocus="if (this.value=='Search') { this.value=''; }" class="top-search-inp" /></td>
		<td>
		 
		<select  class="styledselect">
			<option value="">All</option>
			<option value="">Products</option>
			<option value="">Categories</option>
			<option value="">Clients</option>
			<option value="">News</option>
		</select> 
		 
		</td>
		<td>
		<?php echo $form->submit(BASE_URL.'images/shared/top_search_btn.gif', array('div'=>false)); ?>
		</td>
		</tr>
		</table>
	</div>
 	<!--  end top-search -->
 	<div class="clear"></div>

</div>
<!-- End: page-top -->

</div>
<!-- End: page-top-outer -->
	
<div class="clear">&nbsp;</div>
 
<!--  start nav-outer-repeat START -->
<div class="nav-outer-repeat"> 
<!--  start nav-outer -->
<div class="nav-outer"> 

		<!-- start nav-right -->
		<div id="nav-right">
		
			<div class="nav-divider">&nbsp;</div>
			<div class="showhide-account"><?php echo $html->link(
				$html->image(BASE_URL."images/shared/nav/nav_myaccount.gif",array("alt" => 'Logout')),
				array('controller'=>'users','action'=>'dashboard'),
				array('escape'=>false,'title'=>'My Account')
				);	
			?></div>
			<div class="nav-divider">&nbsp;</div>
			<?php echo $html->link(
				$html->image(BASE_URL."images/shared/nav/nav_logout.gif",array("alt" => 'Logout')),
				array('controller'=>'users','action'=>'logout'),
				array('escape'=>false,'title'=>'Logout','id'=>'logout')
				);	
			?>
			<div class="clear">&nbsp;</div>
			
		</div>
		<!-- end nav-right -->


		<!--  start nav -->
		<div class="nav">
		<div class="table">
		
		<ul class="current"><li><a href="#nogo"><b>HRM</b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub show">
			<ul class="sub">
				<li>
				<?php echo $html->link("Employees",
				array('controller'=>'users','action'=>'list')
				);	
				?></li>
				<li><a href="#nogo">Attendances</a></li>
				<li><a href="#nogo">Salaries</a></li>
				<li><a href="#nogo">Leaves</a></li>
				<li><a href="#nogo">Salaries</a></li>
				<li><a href="#nogo">Appraisals</a></li>
			</ul>
		</div>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		
		<div class="nav-divider">&nbsp;</div>
		                    
		<ul class="select"><li><a href="#nogo1"><b>Finance</b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub show">
			<ul class="sub">
				<li><a href="#nogo1">Transactions</a></li>
			</ul>
		</div>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		
		<div class="nav-divider">&nbsp;</div>
		
		<ul class="select"><li><a href="#nogo2"><b>Sales</b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub">
			<ul class="sub">
				<li><a href="#nogo2">Clients</a></li>
				<li><a href="#nogo2">Billing</a></li>
				<li><a href="#nogo2">Leads</a></li>
				<li><a href="#nogo2">Payments</a></li>
				<li><a href="#nogo2">Credentials</a></li>
			</ul>
		</div>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		
		<div class="nav-divider">&nbsp;</div>
		
		<ul class="select"><li><a href="#nogo3"><b>Operation</b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub">
			<ul class="sub">
				<li><a href="#nogo3">Contacts</a></li>
				<li class="sub_show"><a href="#nogo3">Dispatchs</a></li>
				<li><a href="#nogo3">Inwards</a></li>
			</ul>
		</div>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		
		<div class="nav-divider">&nbsp;</div>
		
		<ul class="select"><li><a href="#nogo3"><b>Project Management</b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub">
			<ul class="sub">
				<li><a href="#nogo3">Projects</a></li>
				<li class="sub_show"><a href="#nogo3">Project Updates</a></li>
				<li><a href="#nogo3">Reviews</a></li>
				<li><a href="#nogo3">Messages</a></li>
				<li><a href="#nogo3">Documents</a></li>
			</ul>
		</div>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		
		<div class="nav-divider">&nbsp;</div>
		
		<ul class="select"><li><a href="#nogo3"><b>Website</b><!--[if IE 7]><!--></a><!--<![endif]-->
		<!--[if lte IE 6]><table><tr><td><![endif]-->
		<div class="select_sub">
			<ul class="sub">
				<li><a href="#nogo3">CMS</a></li>
				<li><?php echo $html->link("Roles",
				array('controller'=>'roles','action'=>'list')
				);	
				?></li>
				<li><a href="#nogo3">Portfolio</a></li>
				<li><a href="#nogo3">Testimonials</a></li>
				<li><a href="#nogo3">News</a></li>
				<li><a href="#nogo3">Galleries</a></li>
				<li><a href="#nogo3">Contact Us</a></li>
			</ul>
		</div>
		<!--[if lte IE 6]></td></tr></table></a><![endif]-->
		</li>
		</ul>
		
		<div class="nav-divider">&nbsp;</div>
		
		<div class="clear"></div>
		</div>
		<div class="clear"></div>
		</div>
		<!--  start nav -->

</div>
<div class="clear"></div>
<!--  start nav-outer -->
</div>
<!--  start nav-outer-repeat................................................... END -->
 
 <div class="clear"></div>
 
<!-- start content-outer -->
<div id="content-outer">
<!-- start content -->
<div id="content">


<div id="page-heading"><h1><?php echo $title_for_layout; ?></h1></div>


<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
<tr>
	<th rowspan="3" class="sized"><?php $html->image(BASE_URL."images/shared/side_shadowleft.jpg", array("alt"=>"Activated","width"=>"20", "height"=>"300"))?></th>
	<th class="topleft"></th>
	<td id="tbl-border-top">&nbsp;</td>
	<th class="topright"></th>
	<th rowspan="3" class="sized"><?php $html->image(BASE_URL."images/shared/side_shadowright.jpg", array("alt"=>"Activated","width"=>"20", "height"=>"300"))?></th>
</tr>
<tr>
	<td id="tbl-border-left"></td>
	<td>
		<?php echo $content_for_layout; ?>
	</td>
	<td id="tbl-border-right"></td>
</tr>
<tr>
	<th class="sized bottomleft"></th>
	<td id="tbl-border-bottom">&nbsp;</td>
	<th class="sized bottomright"></th>
</tr>
</table>
<div class="clear">&nbsp;</div>

</div>
<!--  end content -->
<div class="clear">&nbsp;</div>
</div>
<!--  end content-outer -->

 

<div class="clear">&nbsp;</div>
    
<!-- start footer -->         
<div id="footer">
	<!--  start footer-left -->
	<div id="footer-left">
	 &copy; Copyright <?php echo SITE_NAME; ?> <?php echo $html->link(BASE_URL,BASE_URL);?>. All Rights Reserved.
	</div>
	<!--  end footer-left -->
	<div class="clear">&nbsp;</div>
</div>
<!-- end footer -->
 
</body>
</html>
<?php echo $this->element("sql_dump"); ?>