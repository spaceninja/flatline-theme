<?php
	/**
	 * The template for displaying attachments.
	 */
	get_header();
?>

<?php
	/* Run the loop for the author archive page to output the authors posts
	 * If you want to overload this in a child theme then include a file
	 * called loop-attachment.php and that will be used instead.
	 */
	get_template_part( 'loop', 'attachment' );
?>

<?php get_footer(); ?>
