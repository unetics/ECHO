<?php wp_enqueue_script( 'owlCarousel', get_template_directory_uri().'/gallery/carousel/js/owl.carousel.js', array( 'jquery' ) );?>
<?php wp_enqueue_style( 'owlCarousel', get_template_directory_uri().'/gallery/carousel/css/owl.carousel.css', false );?>
<?php wp_enqueue_style( 'owlCarouselTheme', get_template_directory_uri().'/gallery/carousel/css/owl.theme.css', false );?>
<style type="text/css" media="screen">
.Carousel .item{
  margin: 3px;
}
.Carousel .item img{
  display: block;
  max-width: 100%;
  height: auto;
  margin: 0 auto;
}
</style>
<div class="<?= $id; ?>">
<?php if ( is_array($images)): ?>
	<?php foreach ($images as $image) { ?>
	    <div class="item">
		    <?php $img = wp_get_attachment_image_src($image) ?>
		    <img class="lazyOwl" data-src="<?= $img['0'];?>" alt="Lazy Owl Image">
		</div>
	<?php } ?>	
<?php else: ?>
<p>You need to add images to your gallery</p>
<?php endif ?>
</div>

<script>
/* The Owl Initialization Script
/* The first lines conditionally show the slide animation */
jQuery(function($){
$(document).ready(function() {
 
  $('.<?= $id; ?>').owlCarousel({
    items: <?= $carouselItems; ?>,
    lazyLoad : true,
    autoPlay: <?= $carouselAutoPlay; ?>
  }); 
 
});
});
</script>