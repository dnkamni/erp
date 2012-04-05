<?php 

	if(empty($_SESSION['6_letters_code'] ) ||
	  strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0)
	{
	//Note: the captcha code is compared case insensitively.
	//if you want case sensitive match, update the check above to
	// strcmp()
		$errors .= "\n The captcha code does not match!";
	}
	
	/* if(empty($errors))
	{
		//send the email
		$to            = $your_email;
		$subject_title = "Admin! Message from NetSet Portal.";
		$from          = $your_email;
		$ip            = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
		
		$body = "A user  $name submitted the contact form:\n".
		"Reason: $reason\n".
		"Name: $name\n".
		"Subject: $subject\n".
		"Email: $visitor_email \n".
		"Message: \n ".
		"$user_message\n".
		"IP: $ip\n";	
		
		$headers = "From: $from \r\n";
		$headers .= "Reply-To: $subject_title \r\n";
		$headers .= "content-type: text/html";		
		
		mail($to, $subject_title, nl2br($body),$headers);
		
		echo 'Thanks for the submission, we will get back to you in a business day!';
	} */
}


?>
<div id="contactus">

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
	<div style="margin-top:50px;text-align:justify;margin-left:30px;font-size:12px;">
<?php
if(!empty($errors)){
echo "<p class='err'>".nl2br($errors)."</p>";
}
?>
<form class="wpcf7-form" name="contact_form" id="contact_frm" method="post" action="">
<?php echo $form->create('Portfolio',array('action'=>'weblead','method'=>'POST','onsubmit' => '',"class"=>"login",'enctype'=>'multipart/form-data')); ?>
		<?php $session->flash(); ?>
	<ul>
         <li>
			<div class="label">Reason</div>
			<div class="input_box">
			<?php
			    $data =  $general->reason();
				 echo $form->input("reason",array("type"=>"select","class"=>"string login-input","options"=>$data,"label"=>false,"div"=>false));
             ?>
			</div>
			<div class="clear"></div>
		</li> 
		 <!-- <div class="form_row" > <label> Reason <span class="indicates">*</span></label>
   				
				
				<select class="textfield" id="reason" name="reason">
				<option value=""> -- select any -- </option>
				<option value="quote" <?php echo $var=='quote'?"selected='selected'":''?>>Request for Quote</option>
				<option value="industrial" <?php echo $var=='industrial'?"selected='selected'":''?>>Industrial Training</option>
				<option value="feedback" <?php echo $var=='feedback'?"selected='selected'":''?>>Feedback / Grievance</option>
				<option value="general" <?php echo $var=='general'?"selected='selected'":''?>>General Query</option>
				</select>
				<span class="error" id="your_name_Info"></span>
		   </div>-->
		   
            <div class="form_row "> <label> Name: <span class="indicates">*</span></label>
   				<?php echo $form->input("name",array("class"=>"string login-input","label"=>false,"div"=>false)); ?>
				
		   </div>
           
            <div class="form_row "><label>Email  <span class="indicates">*</span></label>
  				<?php echo $form->input("email",array("class"=>"string login-input textarea","label"=>false,"div"=>false)); ?>
		
		   </div>
                  
		   <div class="form_row "><label>Subject <span class="indicates">*</span></label>
			<?php echo $form->input("subject",array("class"=>"string login-input textarea","label"=>false,"div"=>false)); ?>
		   </div>     
             
            <div class="form_row"><label>Message <span class="indicates">*</span></label>
				<textarea rows="10" class="textfield" cols="40" name="message"><?php echo htmlentities($user_message) ?></textarea> 
			</div>
			
            <div class="form_row"><label>&nbsp;</label>
			<p>
			<img src="<?php echo $base_url;?>library/captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' style="margin-bottom:5px;" ><br>
				<label>Enter code: <span class="indicates">*</span></label>
				<input id="6_letters_code"  class="textfield"name="6_letters_code" type="text"><br>
				<small>Can't read the image? click <a href='javascript: refreshCaptcha();' style="color:red;">here</a> to refresh</small>
			</p>
			</div>			
			<div class="form_row "><label>&nbsp;</label>
                <input type="submit" class="b_submit" value="Send" name="submit">  
			</div>
               
          </form>
			<div style="text-align:justify;margin-left:30px;font-size:12px;width:300px;float:left">
			<strong><font color="red" size="+1">NetSet Solutions</font></strong><br/>
			F-28 Phase VIII<br>
			Industrial Area<br>
			Mohali - 160070, Punjab<br>
			+91-172-4511-980<br/>
			info@netsetsolutions.com<br/><br/>
			<div id="map_canvas" style="width: 400px; height: 300px"></div>
		  </div>
		  <div style="clear:both"></div>
	</div>	
</div>
<script language='JavaScript' type='text/javascript'>
function refreshCaptcha()
{
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>