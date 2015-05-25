<?php
/*
Plugin Name: Panel Widget
Version: 1.2.2
Description: a panel
Author: Mitchell Bray
*/
class panel extends WP_Widget {

		public function __construct() {
			// Instantiate the parent object
			parent::__construct(
				'panel', // Base ID
				'Panel', // Name
				array('description' => 'Create a Panel with Heading and Text')
			);
			
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
					// Style
					'style' 		=> '',
					'paddingTop' 	=> '',
					'paddingBottom' => '',
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
			// Style
			$instance['paddingTop'] = $new_instance['paddingTop'];
			$instance['paddingBottom'] = $new_instance['paddingBottom'];
			$instance['style'] = $new_instance['style'];
			
			return $instance;
		}
		
	}
add_action('widgets_init', create_function('', 'register_widget("panel");'));