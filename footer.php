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
