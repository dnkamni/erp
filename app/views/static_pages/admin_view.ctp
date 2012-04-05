<div>
	<div class="header content-header">
		<h2 class="heading">View Static Page</h2>
		<?php echo $html->link("Back","list",array("class"=>"green_link")); ?>
		<div class="clear"></div>
	</div>
	<div class="section content-body form_content">
		<div id="mainArea">
		<?php $session->flash(); ?>
		<ul>
		<li>
			<div class="label">Title: </div>
			<div class="input_box">
			 <?php echo $result['StaticPage']['title']; ?> 
			</div>
			<div class="clear"></div>
		</li>
		<li>
			<div class="label">Slug: </div>
			<div class="input_box">
			<?php echo $result['StaticPage']['slug']; ?>
			</div>
			<div class="clear"></div>
		</li>
		<li>
			<div class="label">Content: </div>
			<div class="input_box">
			<?php echo $result['StaticPage']['content']; ?>
			</div>
			<div class="clear"></div>
		</li>
		<li>
			<div class="label">Meta Keywords: </div>
			<div class="input_box">
			<?php echo $result['StaticPage']['meta_keywords']; ?>
			</div>
			<div class="clear"></div>
		</li>
		<li>
			<div class="label">Meta Description: </div>
			<div class="input_box">
			<?php echo $result['StaticPage']['meta_description']; ?>
			</div>
			<div class="clear"></div>
		</li>
		</ul>
		</div>
		<div class="clear"></div>
	</div>
</div>