<?php
/**
 * flatline functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, flatline_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'flatline_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 *
 * Functions available to override in child themes:
 *
 * flatline_setup()                 - theme defaults and feature support
 * flatline_excerpt_length()        - post excerpt length
 * flatline_continue_reading_link() - "keep reading" excerpt link
 * flatline_archive_post_count()    - archive page post count
 * flatline_posted_on()             - post header metadata
 * flatline_posted_in()             - post footer metadata
 * flatline_widgets_init()          - register sidebars
 * flatline_copyright()             - copyright statement
 * flatline_comment()               - comment markup
 */



/**
 * Tell WordPress to run flatline_setup() when the 'after_setup_theme' hook is run.
 *
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override flatline_setup() in a child theme, add your own flatline_setup to your child theme's
 * functions.php file.
 */
if ( ! function_exists( 'flatline_setup' ) ) :
	function flatline_setup(){

		// Make Flatline available for translation.
		load_theme_textdomain( 'flatline', TEMPLATEPATH . '/languages' );
		$locale = get_locale();
		$locale_file = TEMPLATEPATH . "/languages/$locale.php";
		if ( is_readable( $locale_file ) )
			require_once( $locale_file );

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// Add support for custom backgrounds
		add_custom_background();

		// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
		add_theme_support( 'post-thumbnails' );
		// set_post_thumbnail_size(150, 150, false);

		// Add default posts and comments RSS feed links to <head>.
		add_theme_support( 'automatic-feed-links' );

		// Add support for a variety of post formats
		add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menu( 'primary', __( 'Primary Menu', 'flatline' ) );

	}
endif;
add_action('after_setup_theme', 'flatline_setup');

/**
 * Remove unnecessary wordpress cruft from wp_head
 */
function flatline_head_cleanup() {
	// http://wpengineer.com/1438/wordpress-header/
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
	remove_action('wp_head', 'noindex', 1);	
	remove_action('wp_head', 'rel_canonical');	
}
add_action('init', 'flatline_head_cleanup');

/**
 * Register javascript files
 */
function flatline_register_scripts() {
	$tmpl_url = get_template_directory_uri();
	// modernizr is an html5/css3 polyfill
	wp_register_script ( 'modernizr', $tmpl_url . '/js/modernizr-2.0.6.min.js', '', '2.0.6', false );
	// flexie fixes flexbox layouts in bad browsers
	wp_register_script ( 'flexie', $tmpl_url . '/js/flexie.min.js', array( 'jquery' ), '1.0.3', true );
	// re-register jquery to load in the footer
	wp_register_script ( 'jquery', '', '', '', true );
}
add_action('init', 'flatline_register_scripts');

/**
 * Enqueue javascript files
 */
if ( ! function_exists( 'flatline_scripts' ) ) :
	function flatline_scripts() {
	  if (!is_admin()):
			wp_enqueue_script( 'modernizr' );
			wp_enqueue_script( 'flexie' );
		endif;
	}
endif;
add_action('wp_enqueue_scripts', 'flatline_scripts');

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Flatline's style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Deprecated way to remove inline styles printed when the gallery shortcode is used.
 *
 * This function is no longer needed or used. Use the use_default_gallery_style
 * filter instead, as seen above.
 */
function flatline_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) ) :
	add_filter( 'gallery_style', 'flatline_remove_gallery_css' );
endif;

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * This function uses a filter (show_recent_comments_widget_style) new in WordPress 3.1
 * to remove the default style.
 */
function flatline_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'flatline_remove_recent_comments_style' );

/**
 * Sets the post excerpt length to 40 words.
 * Create your own flatline_continue_reading_link to override in a child theme
 */
if ( ! function_exists( 'flatline_excerpt_length' ) ) :
	function flatline_excerpt_length( $length ) {
		return 40;
	}
endif;
add_filter( 'excerpt_length', 'flatline_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 * Create your own flatline_continue_reading_link to override in a child theme
 */
if ( ! function_exists( 'flatline_continue_reading_link' ) ) :
	function flatline_continue_reading_link() {
		return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Keep&nbsp;reading', 'flatline' ) . '</a>';
	}
endif;

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and flatline_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function flatline_auto_excerpt_more( $more ) {
	return ' &hellip;' . flatline_continue_reading_link();
}
add_filter( 'excerpt_more', 'flatline_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function flatline_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= flatline_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'flatline_custom_excerpt_more' );

/**
 * Show More Posts on Archive Pages
 *
 * By default, the search and archive pages obey the "max posts per page"
 * setting. This function overrides that setting to display 25 posts.
 * Create your own change_archive_posts_per_page to override in a child theme
 */
if ( ! function_exists( 'flatline_archive_post_count' ) ) :
	function flatline_archive_post_count( $query ) {
		if ( $query->is_search || $query->is_archive ) // is this a search or archive page?
			$query->query_vars['posts_per_page'] = 25;
		return $query; // Return our modified query variables
	}
endif;
add_filter( 'pre_get_posts', 'flatline_archive_post_count' ); // Hook our custom function onto the request filter

/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own flatline_posted_on to override in a child theme
 */
if ( ! function_exists( 'flatline_posted_on' ) ) :
	function flatline_posted_on() {
		printf( __( 'Posted by %1$s on %2$s', 'flatline' ),
			sprintf( '<a href="%1$s">%2$s</a>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			),
			sprintf( '<time datetime="%1$s" pubdate><a href="%2$s">%3$s</a></time>',
				esc_attr( get_the_date( 'c' ) ),
				get_permalink(),
				get_the_date()
			)
		);
		edit_post_link( __( 'Edit', 'flatline' ), ' | <span class="edit-link">', '</span>' );
	}
endif;

/**
 * Prints HTML with meta information for the current post's categories and tags.
 * Create your own flatline_posted_in to override in a child theme
 */
if ( ! function_exists( 'flatline_posted_in' ) ) :
	function flatline_posted_in() {
		_e( 'Filed under ', 'flatline');
		the_category( ', ' );
		if ( get_the_tags() ) the_tags( ', ',', ' );
	}
endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function flatline_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'flatline_page_menu_args' );

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override flatline_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 */
if ( ! function_exists( 'flatline_widgets_init' ) ) :
	function flatline_widgets_init() {
		$sidebars = array( 'Sidebar', 'Footer Area One', 'Footer Area Two', 'Footer Area Three' );
		foreach ($sidebars as $sidebar) {
			register_sidebar( array( 'name'=> $sidebar,
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h4>',
				'after_title' => '</h4>'
			) );
		}
	}
endif;
/** Register sidebars by running flatline_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'flatline_widgets_init' );

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 */
function flatline_footer_sidebar_class() {
	$count = 0;
	if ( is_active_sidebar( 'sidebar-2' ) )
		$count++;
	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;
	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;
	$class = '';
	switch ( $count ) {
		case '1':
			$class = 'one-sidebar';
			break;
		case '2':
			$class = 'two-sidebars';
			break;
		case '3':
			$class = 'three-sidebars';
			break;
	}
	if ( $class )
		echo 'class="' . $class . '"';
}

/**
 * Prints HTML for the site's copyright statement
 * Create your own flatline_copyright to override in a child theme
 */
if ( ! function_exists( 'flatline_copyright' ) ) :
	function flatline_copyright() {
		printf( __( '&copy; Copyright %1$s by %2$s. Powered by %3$s and %4$s.', 'flatline' ),
			date( 'Y' ),
			get_bloginfo( 'name' ),
			'<a href="http://spaceninja.com/flatline/">Flatline</a>',
			'<a href="http://wordpress.org/">WordPress</a>'
		);
	}
endif;

/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own flatline_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
if ( ! function_exists( 'flatline_comment' ) ) :
	function flatline_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
		?>
		<li class="post pingback">
			<p>
				<?php _e( 'Pingback:', 'flatline' ); ?>
				<?php comment_author_link(); ?>
				<?php edit_comment_link( __( 'Edit', 'flatline' ), '<span class="edit-link">', '</span>' ); ?>
			</p>
		<?php
				break;
			default : // regular comments
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				<header>
					<?php
						if ( $comment->comment_parent == 0 ) :
							$avatar_size = 64; // parent comment avatar size
						else :
							$avatar_size = 48; // reply comment avatar size
						endif;
						echo get_avatar( $comment, apply_filters( 'flatline_comment_avatar_size', $avatar_size ) );
					?>
					<h3><?php comment_author_link() ?></h3>
				</header>
				<div class="comment-content">
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<p class="notice comment-awaiting-moderation">
							<?php _e( 'Your comment is awaiting moderation.', 'flatline' ); ?>
						</p>
					<?php endif; ?>
					<?php comment_text(); ?>
				</div>
				<footer>
					<time datetime="<?php echo comment_date('c') ?>">
						<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<?php
								/* translators: 1: date, 2: time */
								printf( __( '%1$s at %2$s', 'flatline' ), get_comment_date(),  get_comment_time() );
							?></a>
					</time>
					<?php
						if ( comments_open() ) :
							echo '| ';
							comment_reply_link( array_merge( $args, array(
								'reply_text' => __( 'Reply', 'flatline' ),
								'depth' => $depth, 'max_depth' => $args['max_depth']
							) ) );
						endif;
					?>
					<?php edit_comment_link( __( 'Edit', 'flatline' ), '| <span class="edit-link">', '</span>' ); ?>
				</footer>
			</article>
		<?php
				break;
		endswitch;
	}
endif; // ends check for flatline_comment()

/**
 * Flatline Subscribe Widget
 * Uses atom feeds - to use RSS2, just change 'atom' to 'rss2'.
*/
function widget_flatline_subscribe( $args ) {
	extract( $args );
	echo "\n$before_widget\n";
	echo $before_title . __( 'Subscribe', 'flatline' ) . $after_title . "\n"; ?>
		<p><?php _e( 'RSS Feeds:', 'flatline' ); ?></p>
		<ul class="rss">
			<li><a href="<?php bloginfo('rss2_url'); ?>">
				<?php printf( __( '%s Feed', 'flatline' ), get_bloginfo( 'name' ) ); ?>
			</a></li>
			<li><a href="<?php bloginfo('comments_rss2_url'); ?>">
				<?php _e( 'Comments Feed', 'flatline' ); ?>
			</a></li>
			<?php
				if ( is_single() ) {
					// add comments feed on single-post pages
					print '<li><a href="' . get_post_comments_feed_link( get_the_ID() ) . '">';
					printf( __( 'Comments on "%s"', 'flatline' ), get_the_title() );
					print '</a></li>';
				} elseif ( is_category() ) {
					// add category feed on category archives
					print '<li><a href="' . get_category_feed_link( get_query_var( 'cat' ) ) . '">';
					printf( __( 'Posts in the %s category', 'flatline' ), single_cat_title( '', false ) );
					print '</a></li>';
				} elseif ( is_tag() ) {
					// add tag feed on tag archives
					print '<li><a href="' . get_tag_feed_link( get_query_var( 'tag_id' ) ) . '">';
					printf( __( 'Posts tagged with %s', 'flatline' ), single_tag_title( '', false ) );
					print '</a></li>';
				} elseif ( is_author() ) {
					// add author feed on author pages
					print '<li><a href="' . get_author_feed_link( get_query_var( 'author' ) ) . '">';
					printf( __( 'Posts by %s', 'flatline' ), get_the_author() );
					print '</a></li>';
				} elseif ( is_search() ) {
					// add search feed on search pages
					print '<li><a href="' . get_search_feed_link( get_query_var( 's' ) ) . '">';
					printf( __( 'Search results for "%s"', 'flatline' ), get_search_query() );
					print '</a></li>';
				}
			?>
		</ul>
	<?php echo "$after_widget\n";
}
wp_register_sidebar_widget(
	'flatline_subscribe_widget',
	'Subscribe',
	'widget_flatline_subscribe',
	array( 'description' => 'RSS Feeds for your site' )
);

/**
 * A pagination function
 * @param integer $range: The range of the slider, works best with even numbers
 *
 * Used WP functions:
 * get_pagenum_link($i) - creates the link, e.g. http://site.com/page/4
 * previous_posts_link(' « '); - returns the Previous page link
 * next_posts_link(' » '); - returns the Next page link
 *
 * @see http://robertbasic.com/blog/wordpress-paging-navigation/
*/
function flatline_get_pagination( $range = 4, $show_first_link = true, $show_last_link = true ) {
	// allow child themes to override the default and parent theme settings
	$range = apply_filters( 'flatline_pagination_range', $range );
	$show_first_link = apply_filters( 'flatline_pagination_show_first_link', $show_first_link );
	$show_last_link = apply_filters( 'flatline_pagination_show_last_link', $show_last_link );
	// $paged - number of the current page
	global $paged, $wp_query;
	// How many pages do we have?
	if ( !isset( $max_page ) || empty( $max_page ) ) {
		$max_page = $wp_query->max_num_pages;
	}
	// We need the pagination only if there are more than 1 page
	if ( $max_page > 1 ) {
		if ( !$paged ) {
			$paged = 1;
		}
		echo '<ul>';
		// On the first page, don't put the First page link
		if ( $paged != 1 && $show_first_link ) {
			echo '<li class="first"><a href="' . get_pagenum_link( 1 ) . '">' . __( 'First', 'flatline' ) . '</a></li>';
		}
		// To the previous page
		if ( $next = get_previous_posts_link( __( 'Newer', 'flatline' ) ) ) {
			print '<li class="next">' . $next . '</li>';
		}
		// We need the sliding effect only if there are more pages than is the sliding range
		if ( $max_page > $range ) {
			// When closer to the beginning
			if ( $paged < $range ) {
				for ( $i = 1; $i <= ( $range + 1 ); $i++ ) {
					flatline_get_pagination_link( $paged, $i );
				}
				echo '<li class="ellipsis">&hellip;</li>';
			}
			// When closer to the end
			elseif ( $paged >= ( $max_page - ceil( ( $range/2 ) ) ) ) {
				echo '<li class="ellipsis">&hellip;</li>';
				for ( $i = $max_page - $range; $i <= $max_page; $i++ ) {
					flatline_get_pagination_link( $paged, $i );
				}
			}
			// Somewhere in the middle
			elseif ( $paged >= $range && $paged < ( $max_page - ceil( ( $range/2 ) ) ) ) {
				echo '<li class="ellipsis">&hellip;</li>';
				for ( $i = ( $paged - ceil( $range/2 ) ); $i <= ( $paged + ceil( ( $range/2 ) ) ); $i++ ) {
					flatline_get_pagination_link( $paged, $i );
				}
				echo '<li class="ellipsis">&hellip;</li>';
			}
		}
		// Less pages than the range, no sliding effect needed
		else {
			for ( $i = 1; $i <= $max_page; $i++ ) {
				flatline_get_pagination_link( $paged, $i );
			}
		}
		// Next page
		if ( $previous = get_next_posts_link( __( 'Older', 'flatline' ) ) ) {
			print '<li class="previous">' . $previous . '</li>';
		}
		// On the last page, don't put the Last page link
		if ( $paged != $max_page && $show_last_link ) {
			echo '<li class="last"><a href="' . get_pagenum_link( $max_page ) . '">' . __( 'Last', 'flatline' ) . '</a></li>';
		}
		echo '</ul>';
	}
}

/**
 * Helper function for flatline_get_pagination()
 * Just pulling this bit of repeated logic out to DRY things up
 */
function flatline_get_pagination_link( $paged, $i ) {
	echo '<li class="page"><a href="' . get_pagenum_link( $i ) .'"';
	if ( $i==$paged ) echo ' class="current"';
	echo ">$i</a></li>";
}

/**
 * Modification of wp_link_pages() with an extra element to highlight the current page.
 *
 * @param  array $args
 * @return void
 */
function numbered_in_page_links( $args = array () ) {
	$defaults = array(
		'before'      => '<p>' . __('Pages:')
		,   'after'       => '</p>'
		,   'link_before' => ''
		,   'link_after'  => ''
		,   'pagelink'    => '%'
		,   'echo'        => 1
		// element for the current page
	,   'highlight'   => 'span'
		);
	$r = wp_parse_args( $args, $defaults );
	$r = apply_filters( 'wp_link_pages_args', $r );
	extract( $r, EXTR_SKIP );
	global $page, $numpages, $multipage, $more, $pagenow;
	if ( ! $multipage ) {
		return;
	}
	$output = $before;
	for ( $i = 1; $i < ( $numpages + 1 ); $i++ ) {
		$j       = str_replace( '%', $i, $pagelink );
		$output .= ' ';
		if ( $i != $page || ( ! $more && 1 == $page ) ) {
			$output .= _wp_link_page( $i ) . "{$link_before}{$j}{$link_after}</a>";
		} else {   // highlight the current page
			// not sure if we need $link_before and $link_after
			$output .= "<$highlight>{$link_before}{$j}{$link_after}</$highlight>";
		}
	}
	print $output . $after;
}
add_action( 'numbered_in_page_links', 'numbered_in_page_links', 10, 1 );
