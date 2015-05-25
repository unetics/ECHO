<div id="slider" class="btn-types" style="display:none">
	<h3>Slider Options</h3>
	<br/>
	AutoPlay: 
	<select id="<?= $this->get_field_id('sliderAutoPlay'); ?>" name="<?= $this->get_field_name('sliderAutoPlay'); ?>">
	    <option value="true" <?php selected('true', $sliderAutoPlay);?>>Yes</option>
	    <option value="false" <?php selected('false', $sliderAutoPlay);?>>No</option>
	</select>
	Pagination: 
	<select id="<?= $this->get_field_id('sliderPagination'); ?>" name="<?= $this->get_field_name('sliderPagination'); ?>">
	    <option value="true" <?php selected('true', $sliderPagination);?>>Yes</option>
	    <option value="false" <?php selected('false', $sliderPagination);?>>No</option>
	</select>
	Stop on Hover: 
	<select id="<?= $this->get_field_id('sliderHover'); ?>" name="<?= $this->get_field_name('sliderHover'); ?>">
	    <option value="true" <?php selected('true', $sliderHover);?>>Yes</option>
	    <option value="false" <?php selected('false', $sliderHover);?>>No</option>
	</select>
	Nav Arrows: 
	<select id="<?= $this->get_field_id('sliderNav'); ?>" name="<?= $this->get_field_name('sliderNav'); ?>">
	    <option value="true" <?php selected('true', $sliderNav);?>>Yes</option>
	    <option value="false" <?php selected('false', $sliderNav);?>>No</option>
	</select>
</div>
