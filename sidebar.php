<?php
	/**
	 * The Sidebar containing the primary widget area.
	 */
?>

<aside id="sidebar" role="complementary">
	<?php
		if ( ! dynamic_sidebar('sidebar-1') ) :
		/**
		 * Default Sidebar Content
		 * What follows is some predefined sidebar content to be displayed 
		 * if the user hasn't set up any sidebar widgets.
		 */
	?>

	<section id="search" class="widget widget_search">
		<h4><?php _e( 'Search', 'flatline' ); ?></h4>
		<?php get_search_form(); ?>
	</section>

	<aside id="archives" class="widget">
		<h3 class="widget-title"><?php _e( 'Archives', 'flatline' ); ?></h3>
		<ul>
			<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
		</ul>
	</aside>

	<?php
		// Subscribe - from functions.php
		if ( function_exists( 'widget_flatline_subscribe' ) ) {
			$widget_settings = array(
				'before_widget' => '<section id="dojo-subscribe" class="widget widget_dojo_subscribe">',
				'after_widget' => '</section><!-- end subscribe -->',
				'before_title' => '<h4>',
				'after_title' => '</h4>',
			);
			widget_flatline_subscribe( $widget_settings );
		} ?>

	<section id="widget_meta" class="widget">
		<?php
			$widget_settings = array(
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '<h4>',
				'after_title' => '</h4>',
			);
			the_widget( 'WP_Widget_Meta', array(
				'title' => __( 'Meta', 'flatline' )
			), $widget_settings );
		?> 
	</section>

	<?php endif; // end dynamic sidebar section ?>
</aside> <!-- /#sidebar -->
