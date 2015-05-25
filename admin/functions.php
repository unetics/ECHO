<?php
function load_custom_wp_admin_style() {
		wp_enqueue_style( 'admin', get_template_directory_uri() . '/admin/assets/css/admin.css');
        wp_enqueue_script('admin', get_template_directory_uri() . '/admin/assets/js/admin.min.js', array('jquery'), '1.0.0' );
}			
add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_style' );

/* admin check */
if ( current_user_can( 'manage_options' ) ) {

} else {
    /* A user without admin privileges */
}