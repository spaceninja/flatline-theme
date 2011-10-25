<?php
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
<?php get_template_part( 'loop', 'search' ); ?>

<?php get_footer(); ?>