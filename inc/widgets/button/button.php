<?php
class button extends WP_Widget {
		public function __construct() {
			// Instantiate the parent object
			parent::__construct(
				'button', // Base ID
				'Button', // Name
				array('description' => 'Create a button link or action'), // Args
				array('icon' => 'dashicons dashicons-admin-links')
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
					'btnStyle' => 'default',
					'btnAlign' => '', 
					'btnPostLink' => '',
					'btnFile' => '',
				));
				extract($instance);
			include(__DIR__.'/views/admin.php');
		}

		public function update($new_instance, $old_instance) {
			$instance = $old_instance;
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
	}
add_action('widgets_init', create_function('', 'register_widget("button");'));