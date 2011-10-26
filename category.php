<?php
	/**
	 * The template for displaying Category Archive pages.
	 */
	get_header();
?>

<header id="page-header">
	<h1 class="page-title"><?php printf( __( 'Category Archives: %s', 'flatline' ), '<strong>' . single_cat_title( '', false ) . '</strong>' ); ?></h1>
	<?php
		$category_description = category_description();
		if ( ! empty( $category_description ) )
			echo '<div class="page-description">' . $category_description . '</div>';
	?>
</header>

<?php
	/* Run the loop for the category page to output the posts.
	 * If you want to overload this in a child theme then include a file
	 * called loop-category.php and that will be used instead.
	 */
	get_template_part( 'loop', 'category' );
?>

<?php get_footer(); ?>
