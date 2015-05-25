<?php
function team_sc( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'count' 		=> 2,
 		'orderby' 		=> 'rand'       
	), $atts ) );

	$args = array(
        'posts_per_page' => (int) $count,
        'post_type' => 'team',
        'orderby' => $orderby,
        'no_found_rows' => true,
    );

	// the query
	$the_query = new WP_Query( $args ); 
	$first = true;
	ob_start(); ?>
	<div class="team">
	<?php 	if ( $the_query->have_posts() ) : 
	 		while ( $the_query->have_posts() ) : $the_query->the_post();
	 		
            $post_id = get_the_ID();
            $team_data = get_post_meta( $post_id);
			$image = ( empty( $team_data['team_img'][0] ) ) ? '' : '<img src="'.$team_data["team_img"][0].'"/>';?>
			<div class="team-member">
				<div class="title">
					<h3><?= the_title(); ?></h3>
					<p class="lead position"><?= $team_data['team_role'][0] ?> <span> <?= $team_data['team_cred'][0] ?></span></p>
				</div>
				<div class="img-container "><?= $image ?></div>
				<div class="clear"></div>
			    <p ><?= $team_data['team_job_desc'][0] ?></p>
			    <p><?= $team_data['team_bio'][0] ?></p>
			</div>
			
<!--
			<?= $image ?>
	    	<div  class="link" >
					<span class="text"><strong><?= the_title(); ?></strong> 
					<?= $team_data['team_role'][0] ?> <span> <?= $team_data['team_cred'][0] ?></span>
					</span>
					
			</div>
			<div>
				<p ><?= $team_data['team_job_desc'][0] ?></p>
			    <p><?= $team_data['team_bio'][0] ?></p>
			</div>
-->

			
			
			
			
			    			<?php endwhile; ?>	
			    			

	</div>
	<?php  wp_reset_postdata(); ?>
	<?php endif; ?>

	 <?PHP return ob_get_clean();
}
add_shortcode( 'team', 'team_sc' );