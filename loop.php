<?php
	/**
	 * The loop that displays posts.
	 *
	 * The loop displays the posts and the post content.  See
	 * http://codex.wordpress.org/The_Loop to understand it and
	 * http://codex.wordpress.org/Template_Tags to understand
	 * the tags used in it.
	 *
	 * This can be overridden in child themes with loop.php or
	 * loop-template.php, where 'template' is the loop context
	 * requested by a template. For example, loop-index.php would
	 * be used if it exists and we ask for the loop with:
	 * <code>get_template_part( 'loop', 'index' );</code>
	 */
	while ( have_posts() ) : the_post();
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header>
			<h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<?php if ( function_exists( 'flatline_post_header' ) ) flatline_post_header(); ?>
		</header>
		<div class="post-content">
			<?php if ( function_exists( 'flatline_post_content_or_excerpt' ) ) flatline_post_content_or_excerpt(); ?>
		</div>
		<footer>
			<?php if ( function_exists( 'flatline_post_footer' ) ) flatline_post_footer(); ?>
		</footer>
	</article>

<?php endwhile; ?>

	<?php /* Display navigation to next/previous pages when applicable */ ?>
	<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav class="paged-post-navigation">
			<?php
				if ( function_exists( 'flatline_get_pagination' ) ) :
					flatline_get_pagination();
				else :
					print '<ul>';
					if ( $previous = get_next_posts_link( __( 'Older Posts', 'flatline' ) ) )
						print '<li class="prev">' . $previous . '</li>';
					if ( $next = get_previous_posts_link( __( 'Newer Posts', 'flatline' ) ) )
						print '<li class="next">' . $next . '</li>';
					print '</ul>';
				endif;
			?>
		</nav>
	<?php endif; ?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>

	<article id="post-404" class="post type-post no-results not-found post-404">
		<header>
			<h1 class="post-title"><?php _e( '404: Not Found', 'flatline' ); ?></h1>
		</header>
		<div class="post-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'flatline' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</article>

<?php endif; ?>
