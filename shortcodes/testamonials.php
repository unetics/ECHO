<?php
// [quotes]
function quote( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'count' 		=> 2,
 		'orderby' 		=> 'rand'       
	), $atts ) );

	$args = array(
        'posts_per_page' => (int) $count,
        'post_type' => 'testamonials',
        'orderby' => $orderby,
        'no_found_rows' => true,
    );
	// the query
	$the_query = new WP_Query( $args ); 
	$first = true;
	ob_start(); ?>

	<div class="quotes">
	<?php 	if ( $the_query->have_posts() ) : 
	 		while ( $the_query->have_posts() ) : $the_query->the_post();

	           $name = get_m('testamonials_client_name');
	           $business = get_m('testamonials_business_name');
	           $link = get_m('testamonials_link');
            
            $client_name = (empty($name)) ? '' : $name;
            $source = (empty($business)) ? '' : ' - ' . $business;
            $link = (empty($link)) ? '' : $link;
            $cite = ( $link ) ? '<a href="' . esc_url( $link ) . '" target="_blank">' . $client_name . $source . '</a>' : $client_name . $source;

			if ( $first ): ?>
				<div class="quote active">
				<?php $first = false; ?>
			 <?php else:  ?>
			<div class="quote">	
			<?php endif; ?>
	 		
			
				<blockquote><?= the_content(); ?></blockquote>
			    <cite><?= $cite ?></cite>
			</div>
			
	
			<?php endwhile; ?>
	</div>
	<?php  wp_reset_postdata(); 
	  else:  ?>
	  <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; ?>
	<script>
		jQuery(document).ready(function() {
		setInterval(function() {
        var elt = jQuery('.quotes .quote.active');
        var nextelt;
        if (elt.is(":last-child")) nextelt = jQuery('.quotes .quote:first-child');
        else nextelt = elt.next();
        elt.removeClass('active');
        nextelt.addClass('active');
    }, 5000);
});
		
	</script>


	 <?PHP return ob_get_clean();
}
add_shortcode( 'quote', 'quote' );
