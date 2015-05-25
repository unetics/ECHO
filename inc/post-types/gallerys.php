<?php

class ps_Gallery {

	function ps_Gallery() {
		add_action( 'init',	array($this,'create_post_type') );
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post', array( $this, 'save' ) );
	}

	function create_post_type() {
		$labels = array(
			'name'               => 'Gallerys',
			'singular_name'      => 'Gallery',
			'menu_name'          => 'Gallerys',
			'name_admin_bar'     => 'Gallery',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Gallery',
			'new_item'           => 'New Gallery',
			'edit_item'          => 'Edit Gallery',
			'view_item'          => 'View Gallery',
			'all_items'          => 'All Gallerys',
			'search_items'       => 'Search Gallerys',
			'parent_item_colon'  => 'Parent Gallery',
			'not_found'          => 'No Gallerys Found',
			'not_found_in_trash' => 'No Gallerys Found in Trash'
		);

		$args = array(
			'labels'              => $labels,
			'public'              => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'show_ui'             => true,
			'show_in_nav_menus'   => true,
			'show_in_menu'        => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-admin-appearance',
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'supports'            => array( 'title'),
			'has_archive'         => true,
			'rewrite'             => array( 'slug' => 'Gallerys' ),
			'query_var'           => true
		);

		register_post_type( 'ps_Gallery', $args );
	}
	
	/**
	 * Adds the meta box container.
	 */
	public function add_meta_box() {
		add_meta_box(
			'some_meta_box_name'
			,'test metabox'
			,array( $this, 'render_meta_box_content' )
			,'ps_gallery'
			,'advanced'
			,'high'
		);
	}
	
	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save( $post_id ) {
	

		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['myplugin_inner_custom_box_nonce'] ) )
			return $post_id;

		$nonce = $_POST['myplugin_inner_custom_box_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'myplugin_inner_custom_box' ) )
			return $post_id;

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
			return $post_id;

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) )
				return $post_id;
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) )
				return $post_id;
		}

		/* OK, its safe for us to save the data now. */

		// Sanitize the user input.
		$mydata = sanitize_text_field( $_POST['myplugin_new_field'] );
// 		$mydata = $_POST['myplugin_new_field'];

		// Update the meta field.
		update_post_meta( $post_id, '_my_meta_value_key', $_POST['myplugin_new_field']);
	}


	/**
	 * Render Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_meta_box_content( $post ) {
	
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'myplugin_inner_custom_box', 'myplugin_inner_custom_box_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$value = get_post_meta( $post->ID, '_my_meta_value_key', true);

		// Display the form, using the current value.
		?>
		<style type="text/css" media="screen">
			#some_meta_box_name{
				background: red;
			}
		</style>
		<label for="myplugin_new_field">Description for this field</label>
		<ul>
			<li>images</li>
		<?php
foreach($value as $arr) {
   for($i=0;$i<count($arr['img']);$i++)
   {
	   $image = wp_get_attachment_image($arr['img'][$i], 'thumbnail');
	   
	   	?>	<li><div class="dashicons dashicons-trash"></div></a>
			<?= $image ?>
		<input type="text" name="myplugin_new_field[gallery][img][]" value="<?= $arr['img'][$i] ?>" size="25" />
		<input type="text" name="myplugin_new_field[gallery][test][]" value="<?= $arr['test'][$i] ?>" size="25" />
		</li>
	   <?php
   }
}
 echo "</ul>";
     }
 	
}	


if ( is_admin() ) {
	new ps_Gallery();
}