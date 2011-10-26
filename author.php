<?php
	/**
	 * The template for displaying Author Archive pages.
	 */
	get_header();
?>

<header id="page-header">
	<?php
		// If a user has filled out their description, show a bio on their entries.
		the_post();
	?>
		<h1 class="page-title"><?php printf( __( 'Author Archives: %s', 'flatline' ), '<strong>' . get_the_author() . '</strong>' ); ?></h1>
	<?php if ( get_the_author_meta( 'description' ) ) : ?>
		<section class="author-bio">
			<header>
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'flatline_author_bio_avatar_size', 64 ) ); ?>
				<h3><?php printf( __( 'About %s', 'flatline' ), get_the_author() ); ?></h2>
			</header>
			<div class="author-content">
				<?php the_author_meta( 'description' ); ?>
			</div>
		</section>
	<?php
		endif;
		rewind_posts();
	?>
</header>

<?php
	/* Run the loop for the author archive page to output the authors posts
	 * If you want to overload this in a child theme then include a file
	 * called loop-author.php and that will be used instead.
	 */
	get_template_part( 'loop', 'author' );
?>

<?php get_footer(); ?>
