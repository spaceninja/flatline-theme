<!doctype html>
<?php
	/**
	 * The Header for our theme.
	 *
	 * Displays all of the <head> section and everything up till <div id="content">
	 *
	 * A Word On Source Order
	 *
	 * As recommended by the HTML5 spec, add your charset declaration early to
	 * avoid a potential encoding-related security issue in IE. It should come
	 * in the first 1024 bytes, and before the <title> tag, due to potential
	 * XSS vectors.
	 *
	 * The meta tag for IE compatibility mode needs to be before all elements
	 * except title & meta. And that same meta tag, can only be invoked for
	 * Chrome Frame if it is within the first 1024 bytes.
	 *
	 * @see https://github.com/paulirish/html5-boilerplate/wiki/The-markup
	 */
?>
<?php /* @see paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither */ ?>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php // Construct the page title

		wp_title( '-', true, 'right' ); // Add the page title

		bloginfo( 'name' ); // Add the site name

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			print " - $site_description";

		// Add a page number if necessary:
		global $page, $paged;
		if ( $paged >= 2 || $page >= 2 )
			print ' - ' . sprintf( __( 'Page %s', 'flatline' ), max( $paged, $page ) );

	?></title>
	<?php /* Use the latest IE rendering engine, and Chrome frame if available */ ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<link rel="stylesheet" media="screen" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
		wp_head();
	?>
</head>

<body <?php body_class(); ?>>
	<div id="page">

		<header id="site-header" role="banner">
			<h1 id="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo apply_filters( 'flatline_site_title', get_bloginfo( 'name' ) ); ?></a>
			</h1>
			<?php if ( get_bloginfo( 'description' ) ) : // do we have a description? ?>
				<p id="site-description"><?php bloginfo( 'description' ); ?></p>
			<?php endif; ?>
			<p id="skip-link"><em><a href="#navigation"><?php print _e( 'Jump to Navigation', 'dojo' ); ?></a></em> &darr;</p>
		</header>

		<div id="main">
			<div id="content" role="main">
