<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
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
<script>
var base_url = "<?php echo BASE_URL; ?>";
</script>
<!--[if IE]>
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL."/css/ie.css"?>" />
<![endif]-->
<?php echo $javascript->link(array('tabcontent','submenu-top-nav-scr1','menu-dom-topnav'));?>
<link rel="shortcut icon" href="/img/favicon.ico">

</head>


<body ONLOAD="f31();">
<div class="bo1"><img src="<?php echo BASE_URL.'/images/zero.gif'?>" width="1" height="2"></div>
<div class="m1">

<?php echo $this->element('header');?>

</div>
<?php //call for index view
echo $this->element('menu');?>
<div class="m1"><img src="<?php echo BASE_URL.'/images/in-hdr1.jpg'?>" width="371" height="135"><img src="<?php echo BASE_URL.'/images/in-hdr2.jpg'?>" width="310" height="135"><img src="<?php echo BASE_URL.'/images/in-hdr3.jpg'?>" width="259" height="135"></div>

<div class="fr m3 w6"><br>
<p class="x8 c3 p13 b f3">Clients</p>
<p class="x9 p14 b c6"><a href="#">Alliances/Partners/Clients</a></p>
<p class="x9 p14 b c6"><a href="#">Associates</a></p>
<p class="x9 p14 b c6"><a href="#">Client Referral Program</a></p>
<p><br></p>
<p class="x10 c3 b p15">Business Partnership</p>
<p class="x8 c3 p13 b f3">Search Website</p>
<p class="c5 b f2">Type any keywords<br>
<input name="" type="text"><img src="<?php echo BASE_URL.'/images/go1.gif'?>" width="44" height="20" align="absmiddle" hspace="5"></p>
<p><br></p>
<p class="x8 c3 p13 b f3">Resources</p>
<p class="bo3 x11 p16">Print this web page now</p>
<p class="bo3 x12 p16">Make an online enquiry</p>
<p class="bo3 x13 p16">Set as Homepage</p>
<p class="bo3 x14 p16">Add to favourites</p>
<p><br>
<br>
</p>
<p><a href="http://www.elaap.com" target="blank"><img src="<?php echo BASE_URL.'/images/eLaap.gif'?>" width="205" height="104"></a></p>
</div>
<div class="m4 w7">
<?php echo $content_for_layout ;?>
            </div>

<p><br>
<br>
</p>

<?php echo $this->element('footer');?>
</body>
</html>
