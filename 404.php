<?php
	/**
	 * The template for displaying 404 pages (Not Found).
	 */
	get_header();
?>

<article id="page-404" class="page type-page no-results not-found post-404">
	<header>
		<h1 class="post-title"><?php _e( '404: File Not Found', 'flatline' ); ?></h1>
	</header>
	<div class="post-content">

		<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'flatline' ); ?></p>

		<div id="widgets">
			
			<section id="widget-search" class="widget">
				<h2><?php _e( 'Search', 'flatline' ); ?></h2>
				<?php get_search_form(); ?>
			</section>

			<section id="widget-pages" class="widget">
				<h2><?php _e( 'Pages', 'flatline' ); ?></h2>
				<ul><?php wp_list_pages( 'sort_column=menu_order&depth=0&title_li=' ); ?></ul>
			</section>

			<?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array(
				'before_widget' => '<section id="widget-recent" class="widget">',
				'after_widget' => '</section>',
				'widget_id' => '404'
			) ); ?>

			<section id="widget-archives" class="widget">
				<h2><?php _e( 'Monthly Archives', 'flatline' ); ?></h2>
				<ul><?php wp_get_archives( 'type=monthly&limit=10' ); ?></ul>
			</section>

			<section id="widget-top-categories" class="widget">
				<h2><?php _e( 'Top Categories', 'flatline' ); ?></h2>
				<ul><?php wp_list_categories( array(
					'title_li' => '',
					'orderby' => 'count',
					'order' => 'DESC',
					'heirarchical' => false,
					'show_count' => true,
					'number' => 10
				) ); ?></ul>
			</section>

			<section id="widget-top-tags" class="widget">
				<h2><?php _e( 'Top Tags', 'flatline' ); ?></h2>
				<?php
					$tags = get_tags( array(
						'orderby' => 'count',
						'order' => 'DESC',
						'number' => 10
					) );
					$html = '<ul>';
					foreach ($tags as $tag){
						$tag_link = get_tag_link($tag->term_id);
						$html .= "<li><a href='{$tag_link}' Tag' class='{$tag->slug}'>";
						$html .= "{$tag->name}</a> <span class='count'>({$tag->count})</span></li>";
					}
					$html .= '</ul>';
					echo $html;
				?>
			</section>

		</div>

	</div> <!-- /.post-content -->

</article>

<?php get_footer(); ?>
