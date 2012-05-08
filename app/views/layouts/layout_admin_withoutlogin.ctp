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
<?php echo $html->css("screen"); ?>
<?php echo $javascript->link(array('jquery-1.4.1.min','custom_jquery','jquery.pngFix.pack')); ?>
<link rel="shortcut icon" href="<?php echo BASE_URL?>img/favicon.ico">
<script>
var base_url = "<?php echo BASE_URL; ?>";
</script>
<script type="text/javascript">
$(document).ready(function(){
$(document).pngFix( );
});
</script>
</head>
<?php $user = $session->read("SESSION_ADMIN"); ?>
<body id="login-bg"> 

<!-- Start: login-holder -->
<div id="login-holder">
	<!-- start logo -->
	<div id="logo-login">
		<?php echo $session->flash(); ?>
		<?php echo $html->link(
			$html->image(BASE_URL."images/shared/logo.png",array("height"=>"100px","alt" => SITE_NAME)),
			array('controller'=>'users','action'=>'login'),
			array('escape'=>false,'title'=>SITE_NAME)
			);			
		?>
	</div>
	<!-- end logo -->
	
	<div class="clear"></div>
	
	 <?php echo $content_for_layout; ?>

</div>
<!-- End: login-holder -->
</body>
</html>
<?php echo $this->element("sql_dump"); ?>