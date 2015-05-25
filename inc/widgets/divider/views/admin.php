<p>
	<label for="<?php echo $this->get_field_id('height') ?>">Height in px (adds equal margin to top and bottom)</label>
	<input type="text" class="widefat" id="<?php echo $this->get_field_id('height') ?>" name="<?php echo $this->get_field_name('height') ?>" value="<?php echo esc_attr($instance['height']) ?>" />
</p>
		
<div>
	<label>Display Line?</label>
	<select id="<?= $this->get_field_id('line');?>" name="<?= $this->get_field_name('line'); ?>">
		<option value="" <?php selected('', $instance['line'],true);?>>yes</option>
		<option value="invisible" <?php selected('invisible', $instance['line'],true);?>>No</option>
	</select>
</div>