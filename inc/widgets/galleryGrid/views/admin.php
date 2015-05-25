<div class="<?= $this->get_field_id('id'); ?>">
	<input type="hidden" id="<?= $this->get_field_id('id'); ?>" name="<?= $this->get_field_name('id'); ?>" value="<?= $this->get_field_id('id'); ?>">
<section class="well">
<h3> Gallery </h3>
<hr>
<div class="form-group">
    <div class="input-group">
	    <span class="input-group-addon">
<?php
$type = 'ps_gallery';	
$args=array(
  'post_type' => $type,
  'post_status' => 'publish',
  'posts_per_page' => -1,
  'ignore_sticky_posts'=> 1);

$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {?>
	<label>Choose Gallery: </label>
	<select id="<?= $this->get_field_id('gallery'); ?>" name="<?= $this->get_field_name('gallery'); ?>">
	<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
		<?php global $id; ?>
  		<option  value="<?= $id ?>" <?php selected($id, $gallery, true);?> ><?php the_title(); ?></option>
    <?php endwhile; ?>
    </select>
    <?php
}
wp_reset_query();  // Restore global post data stomped by the_post().
?>
	    </span>
        <span class="input-group-addon">
            Gallery Type: 
            <select class="btn-type" id="<?= $this->get_field_id('galleryType'); ?>" name="<?= $this->get_field_name('galleryType'); ?>">
                <option value="carousel"     <?php selected('carousel', $galleryType);?>>Carousel</option>
                <option value="slider"     <?php selected('slider', $galleryType);?>>Slider</option>
            </select>
        </span>    

    </div>
</div>
<?php require 'adminCarousel.php'; ?>
<?php require 'adminSlider.php'; ?>

<script>
	var wid = '<?= $this->get_field_id('id'); ?>';
	var type = '<?= $this->get_field_id('galleryType'); ?>';

	 jQuery(function() {
        jQuery("#" + type).change(function(){
	        jQuery('.' + wid + ' .btn-types').slideUp();
	        jQuery('.' + wid + ' #' + jQuery(this).val()).slideDown();
        });
    });
	jQuery('.'+wid+' #' + jQuery("#" + type).val()).slideDown();
</script>

</section>
</div>