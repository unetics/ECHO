<?php
/*
Plugin Name: tile Widget
Version: 1.0.1
Description: a tile 
*/
class tile extends WP_Widget {
		public function __construct() {
			// Instantiate the parent object
			parent::__construct(
				'tile', // Base ID
				'Tile', // Name
				array('description' => 'Create a tile')
			);
			// Register styles
			add_action('admin_print_styles', array( $this, 'register_admin_styles'));
			// Register scripts
			add_action('admin_enqueue_scripts', array( $this, 'register_admin_scripts'));
			add_action('wp_enqueue_scripts', array( $this, 'register_widget_scripts'));
		}

		public function widget($args, $instance) {
			echo $args['before_widget'];	
				extract($instance);
				include(__DIR__.'/views/widget.php');
			echo $args['after_widget'];
		}

		public function form($instance) {
			$instance = wp_parse_args((array)$instance, 
				array(
					// Heading
					'heading' => '',
					'headingType' => 'h3',
					'headingAlign' => 'center',
					// Content
					'content' => '',
					// Button
					'btnText' => '', 
					'btnType' => 'url',
					'btnUrl' => '', 
					'btnUrlFollow' => '', 
					'btnUrlWindow' => '', 
					'btnEmailAddress' => '', 
					'btnEmailSubject' => '', 
					'btnPhoneNumber' => '',
					'btnOnclick' => '',
					'btnWindow' => '', 
					'btnStyle' => '',
					'btnAlign' => '', 
					'btnPostLink' => '',
					'btnFile' => '',
				));
				extract($instance);
			include(__DIR__.'/views/admin.php');
		}

		public function update($new_instance, $old_instance) {
			$instance = $old_instance;
			// Heading
			$instance['heading'] = $new_instance['heading'];
			$instance['headingType'] = $new_instance['headingType'];
			$instance['headingAlign'] = $new_instance['headingAlign'];
			// Content
			$instance['content'] = $new_instance['content'];
			// Button
			$instance['btnText'] = $new_instance['btnText'];
			$instance['btnType'] = $new_instance['btnType'];
			$instance['btnUrl'] = $new_instance['btnUrl'];
			$instance['btnEmailAddress'] = $new_instance['btnEmailAddress'];
			$instance['btnEmailSubject'] = $new_instance['btnEmailSubject'];
			$instance['btnPhoneNumber'] = $new_instance['btnPhoneNumber'];
			$instance['btnOnclick'] = $new_instance['btnOnclick'];
			$instance['btnWindow'] = $new_instance['btnWindow'];
			$instance['btnStyle'] = $new_instance['btnStyle'];
			$instance['btnAlign'] = $new_instance['btnAlign'];
			$instance['btnPostLink'] = $new_instance['btnPostLink'];
			$instance['btnFile'] = $new_instance['btnFile'];
			return $instance;
		}
		function register_admin_styles(){}
		function register_admin_scripts(){}
		function register_widget_scripts(){}	
	}
	
add_action('widgets_init', create_function('', 'register_widget("tile");'));