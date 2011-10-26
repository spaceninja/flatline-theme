<?php
	/**
	 * The template for displaying image attachments.
	 */
	get_header();
?>

<?php
	/* Run the loop for the category page to output the posts.
	 * If you want to overload this in a child theme then include a file
	 * called loop-attachment.php and that will be used instead.
	 */
	get_template_part( 'loop', 'attachment' );
?>

<?php get_footer(); ?>
