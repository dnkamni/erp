<?php echo $html->script(array("fancybox/jquery.mousewheel-3.0.4.pack.js", "fancybox/jquery.fancybox-1.3.4.pack.js")); ?>
<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
		$("a#example1").fancybox();
	});
</script>

<div class="j p18">
 
<?php // $portfolio=$general->getPortfolio(); 
 foreach($resultData as $result){ ?>
<div class="portfolio"><?php echo $result['Portfolio']['title']; ?></div>
	<div class="port" >
		<div id="example1"><?php echo $result['Portfolio']['imageblock']?></div>
		
		<div class="desc" > <strong style="color:#FD6100;">Technology Used : </strong><?php echo $result['Portfolio']['technology']; ?></div>
		<div class="desc" ><strong style="color:#FD6100;"> Domain :</strong> <?php echo $result['Portfolio']['domain']; ?></div>
		<div class="desc" > <strong style="color:#FD6100;"></strong><?php echo $result['Portfolio']['url']; ?></div>
		<div class="desc" ><?php echo $result['Portfolio']['long_description']; ?></div>
  </div>
  <?php } ?>
</div>