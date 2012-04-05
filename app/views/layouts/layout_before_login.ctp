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
<?php echo $html->css("style"); ?>
<link rel="shortcut icon" href="/img/favicon.ico">
</head>
   <body class="login-page">
    <div class="header page-header">
	<div class="fr c1 p1 support_buttons" style="padding-right: 50px;text-align: right;color:#1387d8">How it works : 
	<a href="#"><img height="15" align="ABSMIDDLE" width="15" src="<?php echo BASE_URL; ?>images/face.gif"></a>
	<a href="#"><img hspace="5" height="15" align="ABSMIDDLE" width="15" src="<?php echo BASE_URL; ?>images/tw.gif"></a>
	<a href="#"><img height="15" align="ABSMIDDLE" width="15" src="<?php echo BASE_URL; ?>images/or.gif"></a>
	
	<iframe src="http://www.facebook.com/plugins/like.php?app_id=265876723423267&amp;href=http%3A%2F%2Fnetsetsolutions.com&amp;send=false&amp;layout=button_count&amp;width=75&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font=arial&amp;height=20" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:75px; height:20px;" allowTransparency="true"></iframe>

<!--	<a href="#"><img hspace="5" height="18" align="ABSMIDDLE" width="42" src="<?php echo BASE_URL; ?>images/like.gif"></a>
	<a href="#"><img height="18" align="ABSMIDDLE" width="23" src="<?php echo BASE_URL; ?>images/k2.gif"></a>-->
	<!-- Place this tag where you want the +1 button to render -->
			<g:plusone size="medium"></g:plusone>
			
			<!-- Place this tag after the last plusone tag -->
			<script type="text/javascript">
			  (function() {
				var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
				po.src = 'https://apis.google.com/js/plusone.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>
	<!--<a href="#"><img hspace="5" height="18" align="ABSMIDDLE" width="30" src="<?php echo BASE_URL; ?>images/p1.gif"></a>
	<a href="#"><img height="18" align="ABSMIDDLE" width="24" src="<?php echo BASE_URL; ?>images/zero.gif"></a>-->
	</div>
		<?php echo $html->link(
			$html->image(BASE_URL."images/logo.gif", array("height"=>"100px","alt" => SITE_NAME)),
			"login",
			array('escape'=>false,'title'=>SITE_NAME)
			);
			/*echo $html->link(
			SITE_NAME,
			"login",
			array('escape'=>false,'title'=>SITE_NAME)
			);*/
		?>
    </div>
		<div class="admin_menu"><?php echo $html->link(
			"Home",
			"/",
			array('title'=>'Home')
			);			
	?> <b>|</b> <?php echo $html->link(
			"Register",
			"register",
			array('title'=>'Register')
			);			
	?>  </div>
    <div class="section page-content">
	<div>
        <?php echo $content_for_layout; ?>
	</div>
	<div class="clear"></div>
    </div>
    <div id="footer">
	Copyright 2010.  <?php echo SITE_NAME; ?>. All Rights Reserved.<br />
    </div>
</body>
</html>