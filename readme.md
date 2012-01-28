# Flatline WordPress Theme [spaceninja.com/flatline](http://spaceninja.com/flatline)

## Summary:

Flatline is a base theme for WordPress with HTML5 awesomesauce added. It includes only a few lines of layout-driven CSS, and markup that is search engine optimized.

Flatline uses the new HTML5 doctype and semantic elements, such as Article, Header, Footer, and Section. As a result, it provides an excellent foundation for theme developers to build child themes, and leaves you positioned to take advantage of new HTML5 features as they come into vogue.

## Requirements:

Flatline requires at least WordPress 3.0 (released June 2010). Sorry if you haven't updated yet, but dropping support for the 2.x versions let me get this theme developed in a *much* faster.

## Features:

* Mobile viewport set to `width=device-width; initial-scale=1.0`
* IE compatibility set to `IE=edge,chrome=1` (uses latest IE and chrome frame if available)
* jQuery loaded using Google cached version (with local fallback) to increase speed
* Included CSS is minimal and easily overridden by child themes
* Heavily commented for easy maintenance (yes, this is a feature)

### WordPress Features:

* Full support for child themes
* Post metadata broken into function so child themes can easily override
* Author profile on author and single-post pages (if one exists)
* Category and tag descriptions on cat/tag archive pages
* Post/comment navigation elements hidden when not in use
* More posts displayed on archive pages (defaults to 25)
* Support for paged comments, threaded comments, and gravatars
* Archives page template included (lists all pages, monthly archives, and categories)
* Paged navigation on archive pages (first, next, 1, 2, 3, 4, prev, last)
* Post thumbnail support

### HTML5 Features:

* HTML5 `doctype` and `content-type`
* Header and footer sections marked up with `header`/`footer` elements
* Navigation marked up with `nav` elements
* Sidebar marked up with `aside` element
* Posts, pages, and comments marked up with `article` elements with nested `header`/`footer` elements.
* Widgets marked up with `section` elements
* HTML5 shim script added for full IE compatability
* Search form uses new `search` input type
* Comment form uses new `email` and `url` input types
* WAI-ARIA accessibility roles added to primary elements

### Coming Soon:

* Post format support
* Custom header image support (maybe)
* Navigation menu support

## Recommended Plugins

* [Use Google Libraries](http://wordpress.org/extend/plugins/use-google-libraries/) - Configures WordPress to use the Google CDN-hosted copy of jQuery, instead of WordPress' built-in copy. Your users may already have this version cached in their browsers, and Google's CDN is likely far faster than your server. More info: [6,953 reasons why I still let Google host jQuery for me](6,953 reasons why I still let Google host jQuery for me).

## Child Theme Tips:

* [How to add CSS, JS, and favicons in a WordPress child theme ](http://themeshaper.com/2008/07/02/functions-php-wordpress-child-themes/)
* [WordPress Child Themes](http://codex.wordpress.org/Child_Themes)

## Contributors:

[Scott Vandehey](http://spaceninja.com/)

## License:

[GNU General Public License v3.0](http://www.gnu.org/licenses/gpl-3.0.html)

## Changelog:

### 1.0: October 17th, 2011

* Initial release