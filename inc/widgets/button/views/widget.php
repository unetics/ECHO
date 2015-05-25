<?php $classes = "btn $btnStyle $btnAlign ";?>
<?php switch ($btnType): case 'url': ?>
		<a href='http://<?=$btnUrl?>' <?=$btnUrlFollow?> <?=$btnUrlWindow?> class="<?=$classes?>">
			<?=$btnText?>
		</a>
	<?php break;?>
	<?php case 'email': ?>
		<a href='mailto:<?=$btnEmailAddress?>?Subject=<?=$btnEmailSubject?>' class="<?=$classes?>">
			<?=$btnText?>
		</a>
	<?php break;?>
	<?php case 'tel': ?>
		<a href='tel:<?=$btnPhoneNumber?>' class="<?=$classes?>">
			<?=$btnText?>
		</a>
	<?php break;?>
	<?php case 'trigger': ?>
	    <a href='javascript:void(0)' onclick="<?=$btnOnclick?>" class="<?=$classes?>">
		    <?=$btnText?>
		</a>
	<?php break;?>
	<?php case 'posts': ?>
	    <a href='<?=$btnPostLink?>' class="<?=$classes?>">
		    <?=$btnText?>
		</a>
	<?php break;?>
	<?php case 'file': ?>
	    <a href='<?=$btnFile?>' class="<?=$classes?>">
		    <?=$btnText?>
		</a>
	<?php break;?>	
<?php endswitch;?>