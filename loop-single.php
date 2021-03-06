<?php
	/**
	 * The loop that displays a single post.
	 *
	 * The loop displays the posts and the post content.  See
	 * http://codex.wordpress.org/The_Loop to understand it and
	 * http://codex.wordpress.org/Template_Tags to understand
	 * the tags used in it.
	 *
	 * This can be overridden in child themes with loop-single.php.
	 */
	while ( have_posts() ) : the_post();
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header>
			<h1 class="post-title"><?php the_title(); ?></h1>
			<?php if ( function_exists( 'flatline_post_header' ) ) flatline_post_header(); ?>
		</header>
		<div class="post-content">
			<?php
				if ( function_exists( 'flatline_post_thumb' ) ) flatline_post_thumb();
				the_content();
				numbered_in_page_links( array ( 'before' => '<nav class="post-nav"><p><strong>' . __( 'Pages:', 'flatline' ) . '</strong> ', 'after' => '</p></nav>' ) );
			?>
		</div>
		<?php
			// If the author has filled out their description, show a bio on their entries.
			if ( get_the_author_meta( 'description' ) ) : ?>
				<section class="author-bio">
					<header>
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'flatline_author_bio_avatar_size', 64 ) ); ?>
						<h3><?php printf( __( 'About %s', 'flatline' ), get_the_author() ); ?></h2>
					</header>
					<div class="author-content">
						<?php the_author_meta( 'description' ); ?>
						<p class="more">
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
								<?php printf( __( 'View all posts by %s', 'flatline' ), get_the_author() ); ?>
							</a>
						</p>
					</div>
				</section>
		<?php endif; ?>
		<footer>
			<?php if ( function_exists( 'flatline_post_footer' ) ) flatline_post_footer(); ?>
		</footer>
	</article>

	<?php comments_template( '', true ); ?>

	<nav class="single-post-navigation">
		<ul>
			<?php previous_post_link( '<li class="previous"><strong>' . apply_filters( 'flatline_single_previous_post', __( 'Previous Post:', 'flatline' ) ) . '</strong> %link</li>' ); ?>
			<?php next_post_link('<li class="next"><strong>' . apply_filters( 'flatline_single_next_post', __( 'Next Post:', 'flatline' ) ) . '</strong> %link</li>'); ?>
		</ul>
	</nav>

<?php endwhile; ?>
