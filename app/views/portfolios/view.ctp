<p class=" p17 c9 f4 b" style="margin-bottom:23px; margin-top:10px;"><strong></strong></p>
<?php foreach($resultData as $result) {?>

<div class="x25">
<div><img src="<?php echo BASE_URL.'/images/top.gif'?>"></div>
<div style="margin-left:5px;border-left:1px solid #F1F1F1;border-right:1px solid #F1F1F1;width:672px;height:auto;">
<div >
<div style=" height: auto; float:left; padding-left:17px;"><img src="<?php echo BASE_URL.$result['Portfolio']['image1'] ;?>" class="newsimg"></div>
<div>
	<div class="alignnews">	<div class="testimonial"><strong><?php echo $result['Portfolio']['title']; ; ?></strong></div>
		<div class="testi"><p><?php echo $result['Portfolio']['description'] ;?></p>
			<p class="x4 li1 p8 b"><a href="<?php echo BASE_URL."portfolios/details/". $result['Portfolio']['id'] ;?>">Read More</a></p>
		</div>
	</div>
</div>
	</div>	
</div>
<div><img src="<?php echo BASE_URL.'/images/bottom.gif'?>"></div>	
</div>




<p><br>
</p>
<?php }?>
<!--<div class="pagination">
		<?php// echo $paginator->prev(); ?>
		<?php //echo str_replace("|"," ",$paginator->numbers()); ?>
		<?php //echo $paginator->next(); ?> 
</div>
<?php //foreach($resultData as $result) {?>
<div class="news">
		<div style="float:left"><img src="<?php //echo BASE_URL.'img/news/'.$result['News']['image'] ;?>" style="padding-right:36px;"></div>
		<div class="newsborder"><?php //echo $result['News']['title']; ?></div>
		<div style="width:700px;text-align:left;"><p><?php //echo $result['News']['description'] ;?></p></div>
	</div>
<?php //} ?>-->
