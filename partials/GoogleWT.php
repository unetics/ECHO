<?php global $theme_options; 
	if (!empty($theme_options['GoogleWT'])){ ?>
		<meta name="google-site-verification" content="<?= $theme_options['GoogleWT'];?>" />
	<?php } ?>