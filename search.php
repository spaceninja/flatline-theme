<?php
	/**
	 * The template for displaying Search Results pages.
	 */
	get_header();
	global $wp_query;
	$total_results = $wp_query->found_posts;
?>
<!-- search.php -->

<header id="page-header">
	<h1 class="page-title">
		<?php _e( 'Search Results for', 'flatline' ); ?>
		<strong><?php echo get_search_query(); ?></strong>
		<em>(<?php print $total_results; ?>)</em>
	</h1>
</header>

<?php
	/* Run the loop for the search to output the results.
	 * If you want to overload this in a child theme then include a file
	 * called loop-search.php and that will be used instead.
	 */
	get_template_part( 'loop', 'search' );
?>

<?php get_footer(); ?>