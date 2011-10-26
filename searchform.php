<?php
	/**
	 * The template for displaying search forms
	 *
	 * Normally, we would just use the stock search form, but we want
	 * to use HTML5 enhancements. If wordpress ever converts the stock
	 * form to use HTML5, we should really switch back, because
	 * maintaining this is going to be a bummer.
	 */
?>
<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<label for="s"><?php _e( 'Search for:', 'flatline' ); ?></label>
	<input type="search" rsults="5" autosave="saved" value="" name="s" id="s">
	<input type="submit" id="searchsubmit" value="<?php _e( 'Search', 'flatline' ); ?>">
</form>