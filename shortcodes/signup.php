<?php
// [signup placeholder="placeholder-value" button="button-value"]heading value[/signup]
function signup_form( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'placeholder' => 'Enter your email...',
		'button' => 'Join'
	), $atts ) );

if( isset($_POST['email_address']) ) {	
$to = get_option('admin_email');
$subject = "Email Signup";
$message = $_POST['email_address'];
$sent = wp_mail($to, $subject, strip_tags($message));
if($sent) $content = '<span class="success">You have successfully signed up</span> Thank You';
else $content = '<span class="fail">Sorry Something went Wrong</span><br/> <span class="small">Please email me at <a href="mailto:sales@foru.com.au?Subject=email signup">sales@foru.com.au</a> </span>' ; //message wasn't sent
}
	
ob_start();	?>

	<div class="signup">
		<h2><?=$content?></h2>
		<form action="<?php the_permalink(); ?>" method="post">
			<input name="email_address" type="email" placeholder="<?=$placeholder?>">
			<input class="submit" type="submit" value="<?=$button?>">
		</form>
	</div>
	
<?PHP return ob_get_clean(); }

add_shortcode( 'signup', 'signup_form' );