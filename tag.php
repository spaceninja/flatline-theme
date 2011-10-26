<?php
	/**
	 * The template for displaying Tag Archive pages.
	 */
	get_header();
?>

<header id="page-header">
	<h1 class="page-title"><?php printf( __( 'Tag Archives: %s', 'flatline' ), '<strong>' . single_tag_title( '', false ) . '</strong>' ); ?></h1>
	<?php
		$tag_description = tag_description();
		if ( ! empty( $tag_description ) )
			echo '<div class="page-description">' . $tag_description . '</div>';
	?>
</header>

<?php
	/* Run the loop for the tag archive to output the posts
	 * If you want to overload this in a child theme then include a file
	 * called loop-tag.php and that will be used instead.
	 */
	get_template_part( 'loop', 'tag' );
?>

<?php get_footer(); ?>
