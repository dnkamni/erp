<?php foreach($result as $resultdata)
{?>

<p class=" p17 c9 f4 b"><?php echo $result['StaticPage']['title'] ?></p>
        <div class="j p18">
    
              <?php echo str_replace("[CONTACT_US]",$this->element('contact_us',array('id'=>$result['StaticPage']['id'])),$result['StaticPage']['content']);?>
	    </div>

<?php }?>