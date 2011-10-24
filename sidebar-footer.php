<?php
	// make sure none of the footer sidebar areas are empty
	if ( ! is_active_sidebar( 'sidebar-2' )
		&& ! is_active_sidebar( 'sidebar-3' )
		&& ! is_active_sidebar( 'sidebar-4' )
	)
		return;
	// we have widgets
?>
<aside id="sidebar-footer" <?php flatline_footer_sidebar_class(); ?>>

	<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
		<div id="sidebar-2" class="sidebar">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div><!-- #first .widget-area -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
		<div id="sidebar-3" class="sidebar">
			<?php dynamic_sidebar( 'sidebar-3' ); ?>
		</div><!-- #second .widget-area -->
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
		<div id="sidebar-4" class="sidebar">
			<?php dynamic_sidebar( 'sidebar-4' ); ?>
		</div><!-- #third .widget-area -->
	<?php endif; ?>

</aside><!-- #supplementary -->