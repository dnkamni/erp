<?php #echo $javascript->link('front'); ?>
	<?php
	    $cssHead=(!empty($_SESSION['SESSION_USER']) && $_SESSION['SESSION_USER']['type']=='S')?'class="supp"':'';
	    ?>
	    <h1 <?php echo $cssHead; ?> ><?php echo ucwords($title_for_layout); ?></h1>
	  <div class="right-container" id="DogListForm">
	    <!--cont-top Start-->
	    <div class="cont-top"></div>
	    <!--cont-top End-->
	    <!--cont-midle Start-->
	    <div class="cont-midle">
	      <!--pr-brief Start--><div class="login-form" style="padding: 10px 15px;">
		<?php
			echo $result['StaticPage']['content']; $result['StaticPage']['content'];
		?></div>
    		<div class="clear"></div>
  	    </div>
	    <!--cont-midle End-->
	    <!--cont-Bottom Start-->
	    <div class="cont-bottom"></div>
	    <!--cont-Bottom End-->
	  </div>
