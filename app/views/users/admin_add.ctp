<!--  start content-table-inner -->
	<div id="content-table-inner">
	<?php $user = $session->read("SESSION_ADMIN"); ?>
	<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr valign="top">
	<td>
	
		<!-- start id-form -->
		<table border="0" cellpadding="0" cellspacing="0"  id="id-form">
		<tr>
			<th valign="top">Employee name:</th>
			<td><input type="text" class="inp-form" /></td>
			<td></td>
		</tr>
		<tr>
			<th valign="top">Email:</th>
			<td><input type="text" class="inp-form" /></td>
			<!--<td>
			<div class="error-left"></div>
			<div class="error-inner">This field is required.</div>
			</td>-->
		</tr>
		<tr>
		<th valign="top">Role:</th>
		<td>	
		<select  class="styledselect_form_1">
			<option value="">HR</option>
			<option value="">Project Manager</option>
			<option value="">Developer</option>
			<option value="">Sales</option>
			<option value="">Operation</option>
		</select>
		</td>
		<td></td>
		</tr>
		<!--<tr>
		<th valign="top">Sub Category:</th>
		<td>	
		<select  class="styledselect_form_1">
			<option value="">All</option>
			<option value="">Products</option>
			<option value="">Categories</option>
			<option value="">Clients</option>
			<option value="">News</option>
		</select>
		</td>
		<td></td>
		</tr> -->
		<tr>
			<th valign="top">Salary:</th>
			<td><input type="text" class="inp-form" /></td>
			<td></td>
		</tr>
		<tr>
		<th valign="top">Date of Joining:</th>
		<td class="noheight">
		
			<table border="0" cellpadding="0" cellspacing="0">
			<tr  valign="top">
				<td>
				<form id="chooseDateForm" action="#">
				
				<select id="d" class="styledselect-day">
					<option value="">dd</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
					<option value="16">16</option>
					<option value="17">17</option>
					<option value="18">18</option>
					<option value="19">19</option>
					<option value="20">20</option>
					<option value="21">21</option>
					<option value="22">22</option>
					<option value="23">23</option>
					<option value="24">24</option>
					<option value="25">25</option>
					<option value="26">26</option>
					<option value="27">27</option>
					<option value="28">28</option>
					<option value="29">29</option>
					<option value="30">30</option>
					<option value="31">31</option>
				</select>
				</td>
				<td>
					<select id="m" class="styledselect-month">
						<option value="">mmm</option>
						<option value="1">Jan</option>
						<option value="2">Feb</option>
						<option value="3">Mar</option>
						<option value="4">Apr</option>
						<option value="5">May</option>
						<option value="6">Jun</option>
						<option value="7">Jul</option>
						<option value="8">Aug</option>
						<option value="9">Sep</option>
						<option value="10">Oct</option>
						<option value="11">Nov</option>
						<option value="12">Dec</option>
					</select>
				</td>
				<td>
					<select  id="y"  class="styledselect-year">
						<option value="">yyyy</option>
						<option value="2005">2005</option>
						<option value="2006">2006</option>
						<option value="2007">2007</option>
						<option value="2008">2008</option>
						<option value="2009">2009</option>
						<option value="2010">2010</option>
					</select>
					</form>
				</td>
				<td><a href=""  id="date-pick"><img src="../../images/forms/icon_calendar.jpg"   alt="" /></a></td>
			</tr>
			</table>
		
		</td>
		<td></td>
	</tr>
	<tr>
		<th valign="top">Address:</th>
		<td><textarea rows="" cols="" class="form-textarea"></textarea></td>
		<td></td>
	</tr>
	<tr>
	<th>Image 1:</th>
	<td><input type="file" class="file_1" /></td>
	<td>
	<!--<div class="bubble-left"></div>
	<div class="bubble-inner">JPEG, GIF 5MB max per image</div>
	<div class="bubble-right"></div>-->
	</td>
	</tr>
	<tr>
	<th>Image 2:</th>
	<td>  <input type="file" class="file_1" /></td>
	<td><!--<div class="bubble-left"></div>
	<div class="bubble-inner">JPEG, GIF 5MB max per image</div>
	<div class="bubble-right"></div>-->
	</tr>
	<tr>
	<th>Image 3:</th>
	<td><input type="file" class="file_1" /></td>
	<td><!--<div class="bubble-left"></div>
	<div class="bubble-inner">JPEG, GIF 5MB max per image</div>
	<div class="bubble-right"></div>-->
	</tr>
	<tr>
		<th>&nbsp;</th>
		<td valign="top">
			<input type="button" value="" class="form-submit" />
			<input type="reset" value="" class="form-reset"  />
		</td>
		<td></td>
	</tr>
	</table>
	<!-- end id-form  -->

	</td>
	<td>

	<?php echo $this->element('user_sidebar'); ?>
	

</td>
</tr>
</table>
	<!-- end id-form  -->
<div class="clear"></div>
 

</div>
<!--  end content-table-inner  -->