<div id="carousel" class="btn-types" style="display:none">
	<h3>Carousel Options</h3>
	<br/>
	Items: 
	<select id="<?= $this->get_field_id('carouselItems'); ?>" name="<?= $this->get_field_name('carouselItems'); ?>">
	    <option value="1" <?php selected('1', $carouselItems);?>>One</option>
	    <option value="2" <?php selected('2', $carouselItems);?>>Two</option>
	    <option value="3" <?php selected('3', $carouselItems);?>>Three</option>
	    <option value="4" <?php selected('4', $carouselItems);?>>Four</option>
	    <option value="5" <?php selected('5', $carouselItems);?>>Five</option>
	    <option value="6" <?php selected('6', $carouselItems);?>>Six</option>
	    <option value="7" <?php selected('7', $carouselItems);?>>Seven</option>
	</select>
	<span>How many get displayed at a time</span>
	<br/>
	AutoPlay: 
	<select id="<?= $this->get_field_id('carouselAutoPlay'); ?>" name="<?= $this->get_field_name('carouselAutoPlay'); ?>">
	    <option value="true" <?php selected('true', $carouselAutoPlay);?>>Yes</option>
	    <option value="false" <?php selected('false', $carouselAutoPlay);?>>No</option>
	</select>
</div>
