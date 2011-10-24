<?php get_header(); ?>
<!-- tag.php -->

<header>
	<h1 class="page-title"><?php printf( __( 'Tag Archives: %s', 'flatline' ), '<strong>' . single_tag_title( '', false ) . '</strong>' ); ?></h1>
	<?php
		$tag_description = tag_description();
		if ( ! empty( $tag_description ) )
			echo '<div class="page-description">' . $tag_description . '</div>';
	?>
</header>
<?php get_template_part( 'loop', 'tag' ); ?>

<?php get_footer(); ?>
