<section class="well">
<h3> Heading </h3>
<hr>
<div class="form-group">
    <div class="input-group">
	<input type="text" id="<?= $this->get_field_id('heading'); ?>" name="<?= $this->get_field_name('heading'); ?>" class="form-control" placeholder="Tile Heading" value="<?= $instance['heading'] ?>">
    <span class="input-group-addon">
    	<label>Type: </label>
	    <select class="type" id="<?= $this->get_field_id('headingType'); ?>" name="<?= $this->get_field_name('headingType'); ?>">
	        <option value="h1" <?php selected('h1', $instance['headingType']);?>>H1</option>
	        <option value="h2" <?php selected('h2', $instance['headingType']);?>>H2</option>
	        <option value="h3" <?php selected('h3', $instance['headingType']);?>>H3</option>
	        <option value="h4" <?php selected('h4', $instance['headingType']);?>>H4</option>
	    </select>
        <label>Align: </label>
		<select id="<?= $this->get_field_id('headingAlign'); ?>" name="<?= $this->get_field_name('headingAlign'); ?>">
			<option  value="align-center" <?php selected('align-center', $headingAlign, true);?> >Center</option>
			<option  value="align-left"   <?php selected('align-left', $headingAlign, true);?>>Left</option>
			<option  value="align-right"  <?php selected('align-right', $headingAlign, true);?>>Right</option>
		</select> 
	</span>
    </div>
</div>
</section>
<section class="well">
<h3> Text </h3>
<hr>
<div class="form-group">
	<textarea name="<?= $this->get_field_name('content'); ?>" class="form-control" rows="6" id="<?= $this->get_field_id('content'); ?>"><?= $content ?></textarea>
</div>
</section>

<section class="well">
<h3> Style </h3>
<hr>

<div class="form-group">
	<div class="input-group">
	
		<span class="input-group-addon">Padding Top:</span>
		<input type="text" class="form-control" placeholder="Padding in px" id="<?= $this->get_field_id('paddingTop'); ?>" name="<?= $this->get_field_name('paddingTop'); ?>" value="<?= $paddingTop ?>">
		<span class="input-group-addon">Padding Bottom:</span>
		<input type="text" class="form-control" placeholder="Padding in px" id="<?= $this->get_field_id('paddingBottom'); ?>" name="<?= $this->get_field_name('paddingBottom'); ?>" value="<?= $paddingBottom ?>"><span class="input-group-addon">
	<label>Style: </label>
	<select id="<?= $this->get_field_id('style');?>" name="<?= $this->get_field_name('style'); ?>">
		<option value="default" <?php selected('default', $instance['style']);?>>Default</option>
		<option value="primary" <?php selected('primary', $instance['style']);?>>Primary</option>
		<option value="alt" <?php selected('alt', $instance['style']);?>>Alt</option>
	</select>
	</span>
	</div>
</div>
</section>
