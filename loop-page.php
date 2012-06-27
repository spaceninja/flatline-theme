<?php
	/**
	 * The loop that displays a page.
	 *
	 * The loop displays the posts and the post content.  See
	 * http://codex.wordpress.org/The_Loop to understand it and
	 * http://codex.wordpress.org/Template_Tags to understand
	 * the tags used in it.
	 *
	 * This can be overridden in child themes with loop-page.php.
	 */
	while ( have_posts() ) : the_post();
?>

	<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header>
			<h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		</header>
		<div class="post-content">
			<?php
				if ( function_exists( 'flatline_post_thumb' ) ) flatline_post_thumb();
				the_content();
				numbered_in_page_links( array ( 'before' => '<nav class="post-nav"><p><strong>' . __( 'Pages:', 'flatline' ) . '</strong> ', 'after' => '</p></nav>' ) );
			?>
		</div>
		<?php edit_post_link( __( 'Edit', 'flatline' ), '<footer><p class="edit-link">', '</p></footer>' ); ?>
	</article>

	<?php if ( function_exists( 'flatline_page_comments' ) ) flatline_page_comments(); ?>

<?php endwhile; ?>

