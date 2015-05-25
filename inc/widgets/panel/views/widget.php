<div class="<?=$style?>" style="padding-top: <?=$paddingTop?>px; padding-bottom: <?=$paddingBottom?>px;" > 
	<?php if (strlen($heading) > 0):	?>
		<<?=$headingType?> class="<?=$headingAlign?>"><?=$heading?></<?=$headingType?>>
	<? endif; ?>
	<?= wpautop($content); ?>
</div>