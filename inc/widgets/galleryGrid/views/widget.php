<?php $loop = new WP_Query( array( 'post_type' => 'ps_gallery', 'posts_per_page' => -1 ) ); ?>
<div class="js-masonry clearfix">
	<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<div class="item">
			<?php
			    $id= get_the_ID();
				$gall = easy_image_gallery($id);
				echo($gall);
				?>
		</div>
	<?php endwhile; wp_reset_query(); ?>
</div>

		<div style="display:none;" class="orderForm">
		<div class="order-html">
			<div class="order-cont">												
	
				<div class="order-info">
					<span class="ib count">Info</span>
					<span class="close ib orderClose"><span class="icon-close"></span></span>
				</div>
				<div class="info-inner">
					<div class="left">
						<p>	All these images are for sale, in various formats.<br/>
					To enquire about this image, enter your email address here.</p>
					</div>
					<div class="right">
					<form action="<?php the_permalink(); ?>" method="post">
					    <p><input type="text" name="message_email" value="" placeholder="Your E-Mail"></p>
					    <input type="hidden" name="image" value="">
					    <p><input type="submit"></p>
					</form>
					</div>
				</div>
			</div>
		</div>
	</div>
				
	<?php		if (!empty($_POST['message_email'])){	
				$email = get_bloginfo('admin_email');
				$message = "You received an inquiry from ";
				$message .= $_POST['message_email'];
				$message .= " about the image";
				$message .= $_POST['image'];
				$sent = wp_mail($email, 'Image Inquiry', $message);
				if($sent){
// 					echo("success"); 
					}//message sent!
				else{
// 					 echo("not success");
					 } //message wasn't sent
		};?>

<script>
	$(window).load(function() {
    	$('.js-masonry').masonry({
		  itemSelector: '.item',
		  isFitWidth: true
		});

	});

</script>