<!--DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"-->

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
<?php echo $html->css(array("style")); ?>
<!--[if IE]>
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL."/css/ie.css"?>" />
<![endif]-->
<script>
var base_url = "<?php echo BASE_URL; ?>";
</script>
<?php echo $javascript->link(array('tabcontent','submenu-top-nav-scr1','menu-dom-topnav'));?>
<link rel="shortcut icon" href="/img/favicon.ico">

</head>
<body ONLOAD="f31();">
<div class="bo1"><img src="<?php echo BASE_URL."images/zero.gif"?>" width="1" height="2"></div>
<div class="m1">

<?php //call for index view
echo $this->element('header');?>


</div>
<?php //call for index view
echo $this->element('menu');?>

<?php //call for index view
echo $content_for_layout;?>

<?php //call for index view
echo $this->element('footer');?>

<SCRIPT TYPE="text/javascript">

var countries=new ddtabcontent("countrytabs")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</SCRIPT>


    </body>
</html>