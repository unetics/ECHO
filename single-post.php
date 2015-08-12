<head>
<?php get_header(); ?>
</head>
<body <?php body_class( $class ); ?>> 
	<?php the_nav('');?>
	<main>
		<div class="container panel-row-style">
			<div class="post_content">
				<?php the_title( '<h1>', '</h1>' ); ?>
				<?php the_content();?>
			</div>
		</div>
	</main>
<?php get_footer(); ?>
</body>
</html>