<?php
/*
Template Name: Archives Page
shamelessly lifted from Roots theme
*/
get_header(); ?>

<article id="page-archives" class="page type-page no-results page-archives">
	<header>
		<h1 class="post-title"><?php _e( 'Archives', 'flatline' ); ?></h1>
	</header>
	<div class="post-content">

		<section id="widget-archives" class="widget">
			<h2><?php _e( 'Monthly Archives', 'flatline' ); ?></h2>
			<ul><?php wp_get_archives( 'type=monthly' ); ?></ul>
		</section>

		<section id="widget-pages" class="widget">
			<h2><?php _e( 'Pages', 'flatline' ); ?></h2>
			<ul><?php wp_list_pages( 'sort_column=menu_order&depth=0&title_li=' ); ?></ul>
		</section>

		<section id="widget-top-categories" class="widget">
			<h2><?php _e( 'Top Categories', 'flatline' ); ?></h2>
			<ul><?php wp_list_categories( array(
				'title_li' => '',
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

	</div> <!-- /.post-content -->

</article>

<?php get_footer(); ?>
