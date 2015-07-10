<section class="well">
	
<div class="heading">
	<h3> Button </h3>
    <select class="btnType" id="<?= $this->get_field_id('btnType'); ?>" name="<?= $this->get_field_name('btnType'); ?>">
        <option value="url"     <?php selected('url', $btnType);?>>Link Url</option>
        <option value="email"   <?php selected('email', $btnType);?>>Link Email</option>
        <option value="tel"     <?php selected('tel', $btnType);?>>Link Phone</option>
        <option value="posts"   <?php selected('posts', $btnType);?>>Link Page/Post</option>
        <option value="file"    <?php selected('file', $btnType);?>>Link File</option>
        <option value="trigger" <?php selected('trigger', $btnType);?>>Javascript Trigger</option>
    </select>
</div>

<div class="form-group">
    <div class="input-group">
        <input type="text" id="<?= $this->get_field_id('btnText'); ?>" name="<?= $this->get_field_name('btnText'); ?>" class="form-control" placeholder="Button Text" value="<?= $instance['btnText'] ?>">
        <span class="input-group-addon">
            Colour: 
            <select id="<?= $this->get_field_id('btnColour'); ?>" name="<?= $this->get_field_name('btnColour'); ?>">              				<option value="" 	<?php selected('', $btnType);?>>Primary</option>
            	<option value="btn--accent" 	<?php selected('btn--accent', $btnType);?>>Accent</option>
                <option value="btn--black"   	<?php selected('btn--black', $btnType);?>>Black</option>
                <option value="btn--white"  		<?php selected('btn--white', $btnType);?>>White</option>
            </select>
<!--
            <label>text colour: </label>
            <select id="<?= $this->get_field_id('btnTextColour'); ?>" name="<?= $this->get_field_name('btnTextColour'); ?>">              				<option value="text-primary" 	<?php selected('text-primary', $btnType);?>>Primary</option>
            	<option value="text-accent" 	<?php selected('text-accent', $btnType);?>>Accent</option>
            </select>
-->
			<label>Style: </label>
			<select id="<?= $this->get_field_id('btnStyle'); ?>" name="<?= $this->get_field_name('btnStyle'); ?>">
				<option  value="default"   <?php selected('default', $btnStyle, true);?> >Default</option>
				<option  value="ghost"     <?php selected('ghost', $btnStyle, true);?>>Ghost</option>
				<option  value="link"      <?php selected('link', $btnStyle, true);?>>Simple Link</option>
			</select>
			<label>Align: </label>
			<select id="<?= $this->get_field_id('btnAlign'); ?>" name="<?= $this->get_field_name('btnAlign'); ?>">
				<option  value="float-center" <?php selected('float-center', $btnAlign, true);?> >Center</option>
				<option  value="float-left"   <?php selected('float-left', $btnAlign, true);?>>Left</option>
				<option  value="float-right"  <?php selected('float-right', $btnAlign, true);?>>Right</option>
				<option  value="float-block"  <?php selected('float-block', $btnAlign, true);?>>Block</option>
			</select>
        </span>
        

    </div>
</div>
<div id="url" class="btn-types" style="display:none">
	<div class="input-group">
	    <span class="input-group-addon">http://</span>
		<input type="text" class="form-control" placeholder="Website URL" id="<?= $this->get_field_id('btnUrl'); ?>" name="<?= $this->get_field_name('btnUrl'); ?>" value="<?= $btnUrl ?>">
	       <span class="input-group-addon">
	            Follow: 
	            <select id="<?= $this->get_field_id('btnUrlFollow'); ?>" name="<?= $this->get_field_name('btnUrlFollow'); ?>">
	            	<option value="" <?php selected('', $btnUrlFollow);?>>Yes</option>
	                <option value="rel='nofollow'" <?php selected("rel='nofollow'", $btnUrlFollow);?>>No</option>
	            </select>
	        </span>
	        <span class="input-group-addon">
	            Window: 
	            <select id="<?= $this->get_field_id('btnUrlWindow'); ?>" name="<?= $this->get_field_name('btnUrlWindow'); ?>">
	            	<option value="" <?php selected('', $btnUrlWindow);?>>Current</option>
	                <option value="target='_blank'" <?php selected("target='_blank'", $btnUrlWindow);?>>New</option>
	            </select>
	        </span>
	</div>
</div>
<div id="email" class="btn-types" style="display:none">
	<div class="input-group">
		<span class="input-group-addon">Mailto:</span>
		<input type="text" class="form-control" placeholder="Your Email Address" id="<?= $this->get_field_id('btnEmailAddress'); ?>" name="<?= $this->get_field_name('btnEmailAddress'); ?>" value="<?= $btnEmailAddress ?>">
		<span class="input-group-addon">Subject:</span>
		<input type="text" class="form-control" placeholder="Email Subject Line" id="<?= $this->get_field_id('btnEmailSubject'); ?>" name="<?= $this->get_field_name('btnEmailSubject'); ?>" value="<?= $btnEmailSubject ?>">
	</div>

</div>
<div id="tel" class="btn-types" style="display:none">
	<div class="input-group">
		<span class="input-group-addon">Tel:</span>
		<input type="text" class="form-control" placeholder="Your Phone Number" id="<?= $this->get_field_id('btnPhoneNumber'); ?>" name="<?= $this->get_field_name('btnPhoneNumber'); ?>" value="<?= $btnPhoneNumber ?>">
	</div>
</div>
<div id="posts" class="btn-types" style="display:none">
<select data-placeholder="Choose a post" class="chosen-select" id="<?= $this->get_field_id('btnPostLink'); ?>" name="<?= $this->get_field_name('btnPostLink'); ?>">
<?php
$query = new WP_Query( array( 'post_type'=>'any', 'posts_per_page'=> -1));
while ($query->have_posts()):
    $query->the_post();
    $title = get_the_Title(); 
    $link  = get_permalink();  
    $type  = get_post_type(); 
    echo "<option value='$link' ".selected($link, $btnPostLink).">$type - $title</option>";
endwhile;               
wp_reset_query();
?>
</select>
	</div>

<div id="file" class="btn-types" style="display:none">
	<select data-placeholder="Choose a post" class="chosen-select" id="<?= $this->get_field_id('btnFile'); ?>" name="<?= $this->get_field_name('btnFile'); ?>">
	<?php
	$query = new WP_Query( array( 'post_status' => 'any', 'post_mime_type' => 'application', 'post_type'=>'attachment', 'posts_per_page'=> -1));
	while ($query->have_posts()):
	    $query->the_post();
	    $title = get_the_Title(); 
	    $link  = wp_get_attachment_url();  
	    $type  = get_post_mime_type(); 
	    echo "<option value='$link' ".selected($link, $btnFile).">$type - $title</option>";
	endwhile;               
	wp_reset_query();
	?>
	</select>
</div>	
	
<div id="trigger" class="btn-types" style="display:none">
	<div class="input-group">
	    <span class="input-group-addon">onclick:</span>
		<input type="text" class="form-control" placeholder="Your Javascript" id="<?= $this->get_field_id('btnOnclick'); ?>" name="<?= $this->get_field_name('btnOnclick'); ?>" value="<?= $btnOnclick ?>">
	</div>
</div>

<script>
    jQuery('section .btnType').change(
    function(){
        var pappa = jQuery(this).closest('section');
        pappa.addClass('im_active');
        jQuery('section.im_active .btn-types').slideUp();
        jQuery('section.im_active #' + jQuery(this).val()).slideDown();
        pappa.removeClass('im_active');
    });
    
    jQuery('section .btnType').change();

	jQuery(".chosen-select").chosen({ width: "100%", search_contains:true });
</script>
</section>
