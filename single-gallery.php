<?php 
	
	print_r(tr_post_field("[gallery]"));

	$args = array( 'post_type' => 'attachment', 'orderby' => 'menu_order', 'order' => 'ASC', 'post_mime_type' => 'image' ,'post_status' => null, 'numberposts' => null, 'post_parent' => $post->ID );

	$attachments = get_posts($args);
	
	if ($attachments) {
		foreach ( $attachments as $attachment ) {
	$alt = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);
	$image_title 	= $attachment->post_title;
	$caption 		= $attachment->post_excerpt;
	$description 	= $image->post_content;
	$thumb 			= wp_get_attachment_thumb_url($attachment->ID );
	print_r($attachment);
?>
	<a href="<?php echo wp_get_attachment_url( $attachment->ID); ?>" title="<?php echo $image_title; ?>">
		<img src="<?= $thumb ?>" alt="<?php echo $alt; ?>" />
	</a>
	<?=$caption?>
 <?php } } ?>