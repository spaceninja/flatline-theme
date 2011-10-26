<?php
	/**
	 * The template for displaying Comments.
	 *
	 * The area of the page that contains both current comments
	 * and the comment form.  The actual display of comments is
	 * handled by a callback to flatline_comment which is
	 * located in the functions.php file.
	 */

	/* Password Protection - DO NOT DELETE!
	 * Stop the rest of comments.php from being processed,
	 * but don't kill the script entirely -- we still have
	 * to fully load the template.
	 */
	if ( post_password_required() ) :
		echo '<p class="nopassword">' . __( 'This post is password protected. Enter the password to view any comments.', 'flatline' ) . '</p>';
		return;
	endif;
	// You can start editing here
?>

<?php
	/* Comments List
	 * Loop through and list the comments. Tell wp_list_comments()
	 * to use flatline_comment() to format the comments.
	 * If you want to overload this in a child theme then you can
	 * define flatline_comment() and that will be used instead.
	 * See flatline_comment() in flatline/functions.php for more.
	 */
?>
<section id="comments">
	<h2 class="comments-title"><?php comments_number(__('No Responses to', 'flatline'), __('One Response to', 'flatline'), __('% Responses to', 'flatline') ); ?> &#8220;<?php the_title(); ?>&#8221;</h2>
	<?php if ( have_comments() ) : ?>
		<ol class="commentlist">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use flatline_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define flatline_comment() and that will be used instead.
				 * See flatline_comment() in flatline/functions.php for more.
				 */
				wp_list_comments( array( 'style' => 'ol', 'callback' => 'flatline_comment' ) );
			?>
		</ol>
		<footer>
			<?php /* Display navigation to next/previous comments when applicable */ ?>
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				<nav class="comment-navigation">
					<ul>
						<li class="previous"><?php previous_comments_link( __( 'Older Comments', 'flatline' ) ); ?></li>
						<li class="next"><?php next_comments_link( __( 'Newer Comments', 'flatline' ) ); ?></li>
					</ul>
				</nav>
			<?php endif; ?>
		</footer>
	<?php else : // there are no comments ?>
		<?php if ( comments_open() ) : ?>
			<p class="nocomments"><?php _e('No one has replied to this post yet.', 'flatline') ?></p>
		<?php else : // comments are closed ?>
			<p class="nocomments"><?php _e('Comments on this post are closed.', 'flatline') ?></p>
		<?php endif; // end comments_open() ?>
	<?php endif; // end have_comments() ?>
</section>

<?php
	/* Comment Form
	 * Normally, we would just use comment_form() to include the stock comment
	 * form, but we want to use HTML5 enhancements. If wordpress ever converts
	 * the stock form to use HTML5, we should really switch back, because
	 * maintaining this is going to be a real bummer.
	 */
	if ( comments_open() ) :
?>
	<section id="respond">
		<h2 class="respond-title">
			<?php comment_form_title( __( 'Leave a Reply', 'flatline' ), __( 'Leave a Reply to %s', 'flatline' ) ); ?>
			<small class="cancel"><?php cancel_comment_reply_link( __( 'Cancel reply', 'flatline' ) ); ?></small>
		</h2>
		<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
			<p class="must-log-in"><?php printf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'flatline' ), wp_login_url( get_permalink() ) ); ?></p>
		<?php else : // login not required or user is logged out ?>
			<form action="<?php echo get_option( 'siteurl' ); ?>/wp-comments-post.php" method="post" id="commentform">
				<?php if ( is_user_logged_in() ) : ?>
					<p class="logged-in-as">
						<?php printf( __( 'Logged in as', 'flatline' ) ); ?>
						<a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>.
						<a href="<?php echo wp_logout_url( get_permalink() ); ?>"><?php _e( 'Log out', 'flatline' ); ?></a>
					</p>
				<?php else : // user is logged out ?>
					<p class="field comment-form-author">
						<label for="author"><?php _e('Name', 'flatline'); ?></label>
						<?php if ($req) echo '<span class="required">*</span>'; ?>
						<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" tabindex="1" <?php if ( $req ) echo 'aria-required="true"'; ?>>
					</p>
					<p class="field comment-form-email">
						<label for="email"><?php _e('Email', 'flatline'); ?></label>
						<?php if ($req) echo '<span class="required">*</span>'; ?>
						<input type="email" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" tabindex="2" <?php if ( $req ) echo 'aria-required="true"'; ?>>
					</p>
					<p class="field comment-form-url">
						<label for="url"><?php _e('Website', 'flatline'); ?></label>
						<input type="url" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" tabindex="3">
					</p>
				<?php endif; // end is_user_logged_in() ?>
				<p class="field comment-form-message">
					<label for="comment"><?php _e('Comment', 'flatline'); ?></label>
					<textarea name="comment" id="comment" tabindex="4" aria-required="true"></textarea>
				</p>
				<p class="actions form-submit">
					<input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'flatline'); ?>">
					<?php comment_id_fields(); ?>
					<?php do_action( 'comment_form', $post->ID ); ?>
				</p>
				<p class="comment-notes"><small>
					<?php _e( 'Your email address will not be published.', 'flatline' ); ?>
				</small></p>
				<p class="form-allowed-tags"><small>
					<?php _e( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:', 'flatline' ); ?>
					<code><?php echo allowed_tags(); ?></code>
				</small></p>
			</form>
		<?php endif; // end check comment requirements ?>
	</section>
<?php endif; // end comments_open() ?>
