
<div class="primary-content">
<div class="home-gallery-content">
	<div class=" jcarousel-skin-home-top">
		<div class="jcarousel-container jcarousel-container-horizontal" style="display: block;">
		<div class="jcarousel-clip jcarousel-clip-horizontal">
		<ul class="jcarousel-list jcarousel-list-horizontal" id="home-top-gallery" style="width: 2360px; left: 0px;">
		
		</ul></div>
		</div>
	</div>
</div>
	<div class="main-content">
		<h1> 
		
		
		</h1>
		<p> </p>
		<div class="clearall"></div>
	</div>
		
		<script type="text/javascript">
    // <![CDATA[
    jQuery(document).ready(function() {
        jQuery(".hometab-nav").tabs();

		Cufon.replace('.hometab-nav a', { fontFamily: 'Arial', hover: true});

        jQuery(".hometab-nav a").bind("click", function() {
        	Cufon.refresh('.hometab-nav a');
        });
	});
    // ]]>
</script>
	
	<div class="hometab-nav ui-tabs ui-widget ui-widget-content ui-corner-all">
        <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
    
            <li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active">
                 <a href="#home-tabs-1"><span class="tab-inner">Technology and Innovation</span> </a>
            </li>
    
            <li class="ui-state-default ui-corner-top">
                <a href="#home-tabs-3"><span class="tab-inner">Partnerships</span></a>
            </li>
    
            <li class="ui-state-default ui-corner-top">
                <a href="#home-tabs-4"><span class="tab-inner">Service</span></a>
            </li>
    
        </ul>
     </div>
</div>
<div class="secondaryy-content">
		<div class="homepage-whats-new">
			<h2>
				<cufon class="cufon cufon-canvas" alt="What's " style="width: 93px; height: 26.4px;">
				<canvas width="115" height="26" style="width: 115px; height: 26px; top: 1px; left: -1px;"></canvas><cufontext>What's </cufontext>
				</cufon>
				<cufon class="cufon cufon-canvas" alt="new" style="width: 52px; height: 26.4px;">
				<canvas width="60" height="26" style="width: 60px; height: 26px; top: 1px; left: -1px;"></canvas><cufontext>new</cufontext>
				</cufon>
			</h2>
<script type="text/javascript">
  Cufon.replace('h2');
</script>
			<div class=" jcarousel-skin-whats-new">
				<div class="jcarousel-container jcarousel-container-horizontal">
					<div class="jcarousel-prev jcarousel-prev-horizontal jcarousel-prev-disabled jcarousel-prev-disabled-horizontal"style="display: block;" disabled="true"></div>
				    <div class="jcarousel-next jcarousel-next-horizontal" style="display: block;" disabled="false"></div>
					<div class="jcarousel-clip jcarousel-clip-horizontal">
						<ul id="homepage-gallery" class="jcarousel-list jcarousel-list-horizontal" style="width: 1050px; left: 0px;">
							<li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal"jcarouselindex="1">
							<p class="whats-new-img"><A href="<?php echo BASE_URL; ?>" title="Read more about Cello 3D TV range"></a></p>
							<h3>
								<cufon class="cufon cufon-canvas" alt="Cello " style="width: 50px; height: 18px;">
								<canvas width="65" height="18" style="width: 65px; height: 18px; top: 1px; left: -1px;"></canvas>
								<cufontext>Cello </cufontext></cufon>
								
								<cufon class="cufon cufon-canvas" alt="3D " style="width: 29px; height: 18px;">
								<canvas width="44" height="18" style="width: 44px; height: 18px; top: 1px; left: -1px;"></canvas>
								<cufontext>3D </cufontext></cufon>
								
								<cufon class="cufon cufon-canvas" alt="TV " style="width: 29px; height: 18px;">
								<canvas width="44" height="18" style="width: 44px; height: 18px; top: 1px; left: -1px;"></canvas>
								<cufontext>TV </cufontext></cufon>
								
								<cufon class="cufon cufon-canvas" alt="range" style="width: 50px; height: 18px;"><canvas width="60" height="18" style="width: 60px; height: 18px; top: 1px; left: -1px;"></canvas><cufontext>range</cufontext></cufon>
							</h3>
							<p class="find-out-more"><A class="button find-out" href="<?php echo BASE_URL;?>" target="_blank" title="Read more about Cello 3D TV range">
							<span>Find out more</span></a></p>
						 </li>		 
				</ul>		
		 </div></div></div>
	 </div>
	 <div class="homepage-latest-news">
		<div class="latest-news-inner">
		</div>
	 </div>
	 <div id="XplodePage_suModule_upForm">
		<div class="sign-up">
			<div class="sign-up-inner">
			<h2>Sign Up for Updates	</h2>
			<p>Stay up to date with Cello communications, technologies, innovations and partnerships news.</p>	
			<div class="text">
			 <?php echo $form->input("user_name",array("class"=>"text","id"=>"XplodePage_suModule_txtEmail_txtEmail","label"=>false,"div"=>false));
             ?></br>
			 <?php echo $form->submit('Subscribe',array('class'=>"button","id"=>"XplodePage_suModule_btnSubmit","label"=>false,'div'=>false)); ?>
			</div>
			<div class="clearall"></div>
		</div>
	    </div>
    </div>
<?php echo $form->end();?>
</div>
<div class="clearall"></div>