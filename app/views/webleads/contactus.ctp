<div class="j p18">


 <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAA79GYi9PaIwUQDVkYvHBX3BT4ACbww8ZGc_TnjfSeM6fqm-nikRSWFfkeVhNswEpqW6xI9UeRWZ_d6g&sensor=true"
            type="text/javascript"></script>
    <script type="text/javascript">
    function initialize() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map_canvas"));
        map.setCenter(new GLatLng(30.7098049, 76.7043865), 13);
        map.setUIToDefault();
      }
    }
    </script>
	<script type="text/javascript">
		$(document).ready(function() {
		initialize(); GUnload();
		var map = new GMap2(document.getElementById("map_canvas"));
		map.setCenter(new GLatLng(30.7098049, 76.7043865), 13);
		var point = new GLatLng(30.7098049, 76.7043865);
		map.addOverlay(new GMarker(point));
		});
	</script>
<!-- the container of images -->
	<div style="margin-top:28px;text-align:justify;font-size:12px;">
<?php if($slug=="contactus"){ 
   $text="Contact Us";
   }else{
    $text="Request Quote";}?>
<h2 style="padding-bottom:44px;color:#FD6100"><?php echo $text; ?></h2>

<!--<form class="wpcf7-form" name="contact_form" id="contact_frm" method="post" action="">-->
<div style="float:left;width:318px;">
<?php echo $form->create('Weblead',array('action'=>'contactus','method'=>'POST','onsubmit' => '',"class"=>"login","id"=>"contact_frm",'enctype'=>'multipart/form-data')); ?>
		<?php $session->flash(); ?>
	
        <div class="form_row"> <label> <span class="indicates">*</span>Reason:</label>
			<div class="input_box">
			<?php
			      $data =  $general->reason();
				 echo $form->input("reason",array("type"=>"select","class"=>" space string login-input","options"=>$data,"label"=>false,"div"=>false));
             ?>
			 </div>
			 <div class="clear"></div>
		</div>
		
         <div class="form_row "> <label><span class="indicates">*</span> Name:</label>
   			<div class="input_box">	
			<?php echo $form->input("name",array("class"=>" space string login-input","label"=>false,"div"=>false)); ?>
			</div> 
			<div class="clear"></div>	
		</div>
           
            <div class="form_row "> <label><span class="indicates">*</span> Email:</label>
   			<div class="input_box">	
			<?php echo $form->input("email",array("class"=>" space string login-input","label"=>false,"div"=>false)); ?>
			</div> 
			<div class="clear"></div>	
		</div>
                  
		  <div class="form_row "> <label><span class="indicates">*</span> Subject:</label>
   			<div class="input_box">	
			<?php echo $form->input("subject",array("class"=>" space string login-input","label"=>false,"div"=>false)); ?>
			</div> 
			<div class="clear"></div>	
		</div>    
             
            <div class="form_row"> <label><span class="indicates">*</span> Message:</label>
   			<div class="input_box">	
			<?php echo $form->textarea("message",array("style"=>"width:175px;height:100px;","class"=>" space string login-input","label"=>false,"div"=>false)); ?>
			</div> 
			<div class="clear"></div>	
		</div>
           	
			<div class="form_row "><label>&nbsp;</label>
                <?php echo $form->submit('Save',array('class'=>"b_submit",'div'=>false))."&nbsp;&nbsp;&nbsp;";?>
				
			</div>
			</div>
			 <div style="clear"></div>
<div style="text-align:justify;font-size:12px;">
			<strong><font color="#FD6100" size="+1">NetSet Software Pvt. Ltd.</font></strong><br/>
			C-134, INNCUBE, Punjab InfoTech,<br>
			Industrial Area Phase-8,<br>
			Mohali-160071, Punjab<br>
			+91-172-4511-980<br/>
			info@netsetsolutions.com<br/><br/>		
		<!--<div id="map_canvas" style="margin-left:318px;width: 367px; height: 300px; position: relative; background-color: rgb(229, 227, 223);"></div>-->
</div>
		  <div style="clear"></div>
	</div>	

</div>
<script language='JavaScript' type='text/javascript'>
function refreshCaptcha()
{
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>