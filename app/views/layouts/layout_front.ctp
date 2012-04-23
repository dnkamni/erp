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
<?php echo $html->css(array("style","helper","core","blocks","navigation","skins","forms","lightbox","resource-centre","tipsy")); ?>
<?php echo $javascript->link(array('jquery','functions','listing','common','functions','jquery.tipsy'));?>
<link rel="shortcut icon" href="/img/favicon.ico">
<script>
var base_url = "<?php echo BASE_URL; ?>";
</script>
</head>
<?php $user = $session->read("SESSION_USER"); ?>

<?php if($this->params['controller'] == "static_pages" && (!empty($this->params['pass'][0]) && $this->params['pass'][0] == "contact-us" ||$this->params['pass'][0] == "faqs")){
	$bodyClass="black-page";
}else{
    $bodyClass="white-page";
}?>
<body id="wide" class="<?php echo $bodyClass; ?>">


 <div class="container">

 <div class="content png-bg">
		   
		  <?php echo $content_for_layout; ?>
	
		
    <div class="header2">
			<strong class="logo png-bg">Cello Electronics</strong>
			
			<div class="logout">
			
			<?php if (!empty($user)) { ?>
			Resource Centre: <strong><?php echo $user['1'];?></strong>	
				<?php echo $html->link("Logout", array("controller"=>"users","action"=>"logout"), array("id"=>"XplodePage_ctl11_Logout_btnLogout"), null, false); 
				} ?>
			</div>
			
			<div class="search-box">
			   <div class="text">
			   <!--<input name="XplodePage$ctl28$SearchBox1$txtKeyword" type="text" value="Keyword search" id="XplodePage_ctl28_SearchBox1_txtKeyword" class="text" onkeypress="javascript: if (event.keyCode == 13) { document.getElementById('hidSearchBoxStayUpToDateClicked').value = 'True'; form.submit(); return false; }" onfocus="setOnFocus('Keyword search',this)" onblur="setOnBlur('Keyword search',this)" />
			
			<input type="submit" name="XplodePage$ctl28$SearchBox1$btnSubmit" value="" onclick="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;XplodePage$ctl28$SearchBox1$btnSubmit&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, false))" id="XplodePage_ctl28_SearchBox1_btnSubmit" class="button" />
			
			<input type="hidden" value="" id="hidSearchBoxStayUpToDateClicked" name="hidSearchBoxStayUpToDateClicked" />
-->
			   </div>
			   <div class="clearall"></div>
			</div>
			 <div class="clearall"></div>
			<?php
		    //menu bar
		    echo $this->element('menu');
		     ?>
		 <div class="clearall"></div>
		 <a class="access-keys" name="skip">Skip navigation</a>
		 <div class="clearall"></div>
    </div>
    <div class="footer1">
		<!--<p class="fuse8-link">
		
	      <span class="b-f8 b-f8_black"><em class="b-f8__i"><strong class="b-f8__i__b">fuse8</strong></em> <a target="blank" title="design agency" href="http://www.fuse8.com/" class="b-f8__a">design agency</a></span>
		</p>-->
		<p class="logo-small"><span class="png-bg">Cello</span></p>
		<div class="footer1-nav">		
			<ul>
			 <li><a accesskey="8" href="<?php echo BASE_URL."/static_pages/page/terms-conditions"; ?>">Terms & Conditions</a></li>
			  <li><a href="<?php echo BASE_URL."/static_pages/page/privacy-policy"; ?>">Privacy Policy</a></li>
			  <li><a accesskey="0" href="<?php echo BASE_URL."/static_pages/page/accessibility"; ?>">Accessibility Statement</a></li>
			  <li><a accesskey="3" href="<?php echo BASE_URL."/static_pages/page/sitemap"; ?>">Site Map</a></li>
			  <li><a href="<?php echo BASE_URL."/static_pages/page/about-cello"; ?>">Tech Track 100</a></li>
				
				
		
			</ul>
			<span> 2009 Cello Electronics</span>
			<div class="clearall"></div>
		</div>
		<div class="clearall"></div>
		<div class="access-keys">
			<a href="#" accesskey="t">Top of the page</a>
			<a href="<?php echo BASE_URL; ?>" accesskey="1">Homepage</a>
			<a href="<?php echo BASE_URL; ?>" accesskey="3">Site map</a>
			<a href="<?php echo BASE_URL; ?>" accesskey="0">Accessibility</a>
			<a href="<?php echo BASE_URL; ?>" accesskey="s">Skip navigation</a>
		</div>
    </div>
	  
</div>
</div>

    </body>
</html>