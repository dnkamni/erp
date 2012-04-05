<p class=" p17 c9 f4 b" style="margin-bottom: 23px; margin-top: 10px;"><strong><?php echo $pageTitle;?></strong></p>
<?php 
foreach($resultData as $result) {?>

<div class="x25">
<div><img src="<?php echo BASE_URL.'/images/top.gif'?>"></div>
<div style="margin-left:5px;border-left:1px solid #F1F1F1;border-right:1px solid #F1F1F1;width:672px;">
		<div class="testimonial"><strong><?php echo $result['Testimonial']['author']; ?></strong></div>
		<div class="testi"><p><?php echo $result['Testimonial']['description'] ;?></p></div>
</div>
<div><img src="<?php echo BASE_URL.'/images/bottom.gif'?>"></div>	
</div>
<p><br>
</p>
<?php }?>
<div class="pagination">
		<?php echo $paginator->prev(); ?>
		<?php echo str_replace("|"," ",$paginator->numbers()); ?>
		<?php echo $paginator->next(); ?> 
</div>
<!--<?php 
foreach($resultData as $result) {?>
<div class="news">
	
		<div class="newsborder"><?php echo $result['Testimonial']['author']; ?></div>
		<div style="width:700px;text-align:left;"><p><?php echo $result['Testimonial']['description'] ;?></p></div>
	</div>
<?php } ?>-->
