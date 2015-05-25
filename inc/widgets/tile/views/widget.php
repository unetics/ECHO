<div class="tile">
	<div class="tile-content">
	<!-- todo add image option -->
	<<?=$headingType?> class="tile-title <?=$headingAlign?>"><?=$heading?></<?=$headingType?>>
	<?= wpautop($content); ?>

	</div>
	<div class="btn-wrap">	
	<?php switch ($btnType): case 'url': ?>
		<a href='http://<?=$btnUrl?>' <?=$btnUrlFollow?> <?=$btnUrlWindow?> class="btn <?=$btnStyle.' '.$btnAlign?>"><?=$btnText?></a>
	<?php break;?>
	<?php case 'email': ?>
		<a href='mailto:<?=$btnEmailAddress?>?Subject=<?=$btnEmailSubject?>' class="btn <?=$btnStyle.' '.$btnAlign?>"><?=$btnText?></a>
	<?php break;?>
	<?php case 'tel': ?>
		<a href='tel:<?=$btnPhoneNumber?>' class="btn <?=$btnStyle.' '.$btnAlign?>"><?=$btnText?></a>
	<?php break;?>
	<?php case 'trigger': ?>
	    <a href='javascript:void(0)' onclick="<?=$btnOnclick?>" class="btn <?=$btnStyle.' '.$btnAlign?>"><?=$btnText?></a>
	<?php break;?>
	<?php case 'posts': ?>
	    <a href='<?=$btnPostLink?>' class="btn <?=$btnStyle.' '.$btnAlign?>"><?=$btnText?></a>
	<?php break;?>
		<?php case 'file': ?>
	    <a href='<?=$btnFile?>' class="btn <?=$btnStyle.' '.$btnAlign?>"><?=$btnText?></a>
	<?php break;?>	
	<?php case 'none': ?>
	   <br/>
	<?php break;?>		
	<?php endswitch;?>
</div>
</div>