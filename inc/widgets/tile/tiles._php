<?php
class SiteOrigin_Panels_Widget_tiles extends WP_Widget {
	function __construct() {
		parent::__construct(
			'tile',
			'Tile Builder',
			array(
				'description' => 'Build a tile using other widgets.',
				'panels_title' => false,
			),
			array(
			)
		);
	}

	function widget($args, $instance) {
		if( empty($instance['panels_data']) ) return;

		if( is_string( $instance['panels_data'] ) )
			$instance['panels_data'] = json_decode( $instance['panels_data'], true );
		if(empty($instance['panels_data']['widgets'])) return;

		if( empty( $instance['builder_id'] ) ) $instance['builder_id'] = uniqid();

		echo $args['before_widget'];
		echo siteorigin_panels_render( 'w'.$instance['builder_id'], true, $instance['panels_data'] );
		echo $args['after_widget'];
	}

	function update($new, $old) {
		$new['builder_id'] = uniqid();
		return $new;
	}

	function form($instance){
		$instance = wp_parse_args($instance, array(
			'panels_data' => '',
			'builder_id' => uniqid(),
		) );

		if( !is_string( $instance['panels_data'] ) ) $instance['panels_data'] = json_encode( $instance['panels_data'] );

		?>
		<div class="siteorigin-page-builder-widget siteorigin-panels-builder" id="siteorigin-page-builder-widget-<?php echo esc_attr( $instance['builder_id'] ) ?>" data-builder-id="<?php echo esc_attr( $instance['builder_id'] ) ?>">
			<p><a href="#" class="button-secondary siteorigin-panels-display-builder"><?php _e('Open Builder', 'siteorigin-panels') ?></a></p>

			<input type="hidden" data-panels-filter="json_parse" value="<?php echo esc_attr( $instance['panels_data'] ) ?>" class="panels-data" name="<?php echo $this->get_field_name('panels_data') ?>" />
			<input type="hidden" value="<?php echo esc_attr( $instance['builder_id'] ) ?>" name="<?php echo $this->get_field_name('builder_id') ?>" />
		</div>
		<script type="text/javascript">
			if(typeof jQuery.fn.soPanelsSetupBuilderWidget != 'undefined') {
				jQuery( "#siteorigin-page-builder-widget-<?php echo esc_attr( $instance['builder_id'] ) ?>").soPanelsSetupBuilderWidget();
			}
		</script>
		<?php
	}

}


register_widget('SiteOrigin_Panels_Widget_tiles');