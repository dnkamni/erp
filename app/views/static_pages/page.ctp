  <!--wrapper-middle Start-->
  <div class="wrapper-middle-inner">
    <div class="mid-content">
<div class="right-panel center-panel" id="DogListForm">
     <?php
	    $cssHead=(!empty($_SESSION['SESSION_USER']) && $_SESSION['SESSION_USER']['type']=='S')?'class="supp"':'';
	    ?>
			<h1 <?php echo $cssHead; ?> ><?php echo ucwords($result['StaticPage']['title']); ?></h1>
 <div class="right-container">
	    <!--cont-top Start-->
	    <div class="cont-top"></div>
	    <!--cont-top End-->
	    <!--cont-midle Start-->
	    <div class="cont-midle">
		<div id="UserLoginForm" class="login-form">
			<div class="login-form" style="padding:10px 15px">
			<?php
			echo str_replace("[CONTACT_US]",$this->element('contact_us',array('id'=>$result['StaticPage']['id'])),$result['StaticPage']['content']);
?>
			</div>
      			<div class="clear"></div>
		</div>
      		<div class="clear"></div>
	   </div>
	   <div class="cont-bottom"></div>
           <div class="clear"></div>
 </div>
  </div>
    </div>
<div class="clear"></div>
  </div>
  <!--wrapper-top middle-->
 

 