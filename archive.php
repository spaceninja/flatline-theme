<?php
	/**
	 * The template for displaying Archive pages.
	 *
	 * Used to display archive-type pages if nothing more specific matches a query.
	 * For example, puts together date-based pages if no date.php file exists.
	 *
	 * Learn more: http://codex.wordpress.org/Template_Hierarchy
	 */
	get_header();
?>

<header id="page-header">
	<h1 class="page-title">
		<?php if ( is_day() ) : ?>
			<?php printf( __( 'Archives for <span>%s</span>', 'flatline' ), get_the_date() ); ?>
		<?php elseif ( is_month() ) : ?>
			<?php printf( __( 'Archives for <span>%s</span>', 'flatline' ), get_the_date( 'F Y' ) ); ?>
		<?php elseif ( is_year() ) : ?>
			<?php printf( __( 'Archives for <span>%s</span>', 'flatline' ), get_the_date( 'Y' ) ); ?>
		<?php endif; ?>
	</h1>
</header>

<?php
	/* Run the loop for the archives page to output the posts.
	 * If you want to overload this in a child theme then include a file
	 * called loop-archive.php and that will be used instead.
	 */
	get_template_part( 'loop', 'archive' );
?>

<?php get_footer(); ?>
