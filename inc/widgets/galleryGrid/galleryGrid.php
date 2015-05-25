<?php
/*
Plugin Name: Gallery Grid Widget
Version: 1.2.2
Description: gallery
Author: Mitchell Bray
*/
class galleryGrid extends WP_Widget {
		public function __construct() {
			// Instantiate the parent object
			parent::__construct(
				'gallerygrid', // Base ID
				'Gallery Grid', // Name
				array('description' => 'Make a Grid of Galleries'), // Args
				array('width' => 600, 'height' => 550)				
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
					'id' => '',					
					'gallery' => '',
					'galleryType' => '',
					//carousel
					'carouselItems' => '3',
					'carouselAutoPlay' => 'true',
					//slider
					'sliderAutoPlay' => 'true',
					'sliderPagination' => 'true',
					'sliderHover' => 'true',
					'sliderNav' => 'true',					
				));
				extract($instance);
			include(__DIR__.'/views/admin.php');
			
		}

		public function update($new_instance, $old_instance) {
			$instance = $old_instance;
			
			$instance['id'] = $new_instance['id'];
			$instance['gallery'] = $new_instance['gallery'];
			$instance['galleryType'] = $new_instance['galleryType'];
			
			$instance['carouselItems'] = $new_instance['carouselItems'];
			$instance['carouselAutoPlay'] = $new_instance['carouselAutoPlay'];
			
			$instance['sliderAutoPlay'] = $new_instance['sliderAutoPlay'];
			$instance['sliderPagination'] = $new_instance['sliderPagination'];		
			$instance['sliderHover'] = $new_instance['sliderHover'];
			$instance['sliderNav'] = $new_instance['sliderNav'];	
							
			return $instance;
		}		
	}
add_action('widgets_init', create_function('', 'register_widget("galleryGrid");'));
