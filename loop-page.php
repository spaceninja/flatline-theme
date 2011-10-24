<!-- loop-page.php -->
<?php while ( have_posts() ) : the_post(); ?>

	<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header>
			<h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
		</header>
		<div class="post-content">
				<?php the_content(); ?>
				<?php wp_link_pages ( array ( 'before' => '<nav class="post-nav"><p><strong>' . __( 'Pages:', 'flatline' ) . '</strong> ', 'after' => '</p></nav>' ) ); ?>
		</div>
		<?php edit_post_link( __( 'Edit', 'flatline' ), '<footer><p class="edit-link">', '</p></footer>' ); ?>
	</article>

	<?php comments_template( '', true ); ?>

<?php endwhile; ?>

