<?php echo $javascript->link(array("fancybox/jquery.mousewheel-3.0.4.pack.js", "fancybox/jquery.fancybox-1.3.4.pack.js"));?>
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
		$(document).ready(function() {
			$("a[rel=example_group]").fancybox({
				'transitionIn'		: 'none',
				'overlayShow'		: false,
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});
		});
	</script>
	<br/>
<h2 style="margin-left:10px; color:#FD1600;">Fun@ Netset Software</h2>
<br/>
<div class="j p18">
 <div style="margin-top:8px;text-align:justify;font-size:12px;width:692px;float-left">
<?php 
$attr 	  = "rel='example_group'";
 foreach($resultData as $result){ ?>
	
		<a <?php echo $attr;?> href="<?php echo BASE_URL . $result['Gallery']['bigimage']?>" title="<?php echo $result['Gallery']['title']; ?>"><img style='border:2px solid #ffffff;' alt="" src="<?php echo BASE_URL.$result['Gallery']['smallimage']?>"/></a>		
	
  <?php } ?>
  </div>
</div>