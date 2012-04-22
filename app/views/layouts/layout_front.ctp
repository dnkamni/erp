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
<meta name="Description" content="NetSet Software (P) Ltd : software organization with over a decade experience in building high end database driven applications for health care, EDI Programming, Compliance Applications, Travel portals, CRM , Supply Chain Management, Ecommerce, Real Estate, E-learning, Social Networking, Infotainment using latest Microsoft &amp; Open Source Technologies. Get a quote for customized application development &amp; Business Consulting from smartData Enterprises.">
<meta name="Keywords" content="Offshore Software Development Outsourcing, Software development Company India, Software Development Services, Application Development Outsourcing, Offshore software outsource, Software Information Technology Outsourcing, web application development">
<meta name="Offshore Software Development" content="Offshore Software Development, Offshore Software Outsourcing, Software development company">
<meta name="classification" content="Offshore Software Development, Offshore Software Outsourcing, Software development company">
<meta name="page-topic" content="Offshore Software Development, Offshore Software Outsourcing, Software development company, Software Development Services, Software Outsourcing, application development outsourcing, Offshore, Offshore development, Offshore Outsourcing, Services India, Offshore software outsource, outsourcing software, Software Development Outsourcing, Software Information Technology Outsourcing, software outsource, web application development, software outsourcing Company, software company India">
<meta name="page-type" content="Offshore Software Development, Offshore Software Outsourcing, Software development company, Software Development Services, Software Outsourcing, application development outsourcing, Offshore, Offshore development, Offshore Outsourcing, Services India, Offshore software outsource, outsourcing software, Software Development Outsourcing, Software Information Technology Outsourcing, software outsource, web application development, software outsourcing Company, software company India">
<meta name="audience" content="all">
<meta name="author" content="NetSet Software (P) Ltd.">
<meta name="revisit-after" content="2 days">
<meta name="content-Language" content="English">
<meta name="distribution" content="global">
<meta name="copyright" content="http://www.netsetsoftware.com">
<link rel="canonical" href="http://www.netsetsoftware.com">
<meta name="robots" content="All">
<meta name="Rating" content="Software Development Outsourcing">
<meta name="Classification" content="Software Development Outsourcing">
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