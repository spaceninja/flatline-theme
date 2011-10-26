<?php
	/**
	 * The template for displaying the footer.
	 *
	 * Contains the closing of the id=content div and all content
	 * after. Calls sidebar.php for sidebar widgets and 
	 * sidebar-footer.php for bottom widgets.
	 */
?>
			</div> <!-- /#content -->

			<?php get_sidebar(); ?>

		</div> <!-- /#main -->

		<div id="navigation">
			<nav id="primary-nav" role="navigation">
				<?php
					/**
					 * Our navigation menu. The menu assigned to the primary position
					 * is the one used. If none is assigned, the menu with the lowest
					 * ID is used. If one isn't filled out, wp_nav_menu falls back
					 * to wp_page_menu.
					 */
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'container' => false
					) );
				?>
			</nav>
			<?php get_search_form(); ?>
		</div> <!-- /#navigation -->

		<footer id="site-footer" role="contentinfo">
			<?php get_sidebar( 'footer' ); // footer widget area ?>
			<p class="copyright">
				<?php flatline_copyright(); ?>
			</p>
		</footer>

	</div> <!-- /#page -->

	<?php wp_footer(); ?>

</body>
</html>
