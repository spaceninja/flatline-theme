<?php get_header(); ?>
<!-- category.php -->

<header>
	<h1 class="page-title"><?php printf( __( 'Category Archives: %s', 'flatline' ), '<strong>' . single_cat_title( '', false ) . '</strong>' ); ?></h1>
	<?php
		$category_description = category_description();
		if ( ! empty( $category_description ) )
			echo '<div class="page-description">' . $category_description . '</div>';
	?>
</header>
<?php get_template_part( 'loop', 'category' ); ?>

<?php get_footer(); ?>
