<?php
/**
* Widget Name: Divider
* Widget URI: http://unetics.org
* Description: add required space
* Version: 1.0
*/
class divider extends WP_Widget {
	
	function __construct(){
		parent::__construct(
			'divider',
			'Divider', //name
			array(
				'classname' 	=> 'divider',
				'description' 	=> 'Create Vertical Space Between Widgets'
			)
		);
		// Register styles
		add_action('admin_print_styles', array( $this, 'register_admin_styles'));
		// Register scripts
		add_action('admin_enqueue_scripts', array( $this, 'register_admin_scripts'));
	}
	
	function form( $instance ){
		$instance = wp_parse_args(
			(array)$instance,	
			array(
				'height' => '',
				'line' => '',
			)
		);
		include(__DIR__.'/views/admin.php');
	}
	
	function update( $new_instance, $old_instance ){
		$old_instance['height'] = $new_instance['height'];
		$old_instance['line'] = $new_instance['line'];
		return $old_instance;
		
	}
	
	function widget( $args, $instance){
		echo $args['before_widget'];	
		include(__DIR__.'/views/widget.php');
		echo $args['after_widget'];
	}
	
	function register_admin_styles(){ 	}
	function register_admin_scripts(){	}

}
add_action('widgets_init', create_function('', 'register_widget("divider");'));