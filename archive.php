<?php get_header(); ?>
<!-- archive.php -->

<h1 class="page-title">
	<?php if ( is_day() ) : ?>
		<?php printf( __( 'Archives for <span>%s</span>', 'flatline' ), get_the_date() ); ?>
	<?php elseif ( is_month() ) : ?>
		<?php printf( __( 'Archives for <span>%s</span>', 'flatline' ), get_the_date( 'F Y' ) ); ?>
	<?php elseif ( is_year() ) : ?>
		<?php printf( __( 'Archives for <span>%s</span>', 'flatline' ), get_the_date( 'Y' ) ); ?>
	<?php endif; ?>
</h1>
<?php get_template_part( 'loop', 'archive' ); ?>

<?php get_footer(); ?>
