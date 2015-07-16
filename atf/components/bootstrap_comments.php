<?php
/**
 * Created by PhpStorm.
 * User: eugen
 * Date: 12/13/13
 * Time: 6:44 PM
 */

if ( ! function_exists( 'twentytwelve_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * To override this walker in a child theme without modifying the comments template
	 * simply create your own twentytwelve_comment(), and that function will be used instead.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since Twenty Twelve 1.0
	 */
	function twentytwelve_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				// Display trackbacks differently than normal comments.
				?>
				<li <?php comment_class('ping'); ?> id="comment-<?php comment_ID(); ?>">
				<p><?php _e( 'Pingback:', 'bootstrap' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'bootstrap' ), '<span class="edit-link">', '</span>' ); ?></p>
				<?php
				break;
			default :
				// Proceed with normal comments.
				global $post;
				?>
					<li <?php comment_class('media'); ?> id="li-comment-<?php comment_ID(); ?>">

					<div class="media-body">
					<article id="comment-<?php comment_ID(); ?>" class="comment row">
						<header class="comment-meta comment-author vcard clearfix col-md-5">
							<h4><?php echo get_comment_author_link();?></h4>


						</header><!-- .comment-meta -->


						<section class="comment-content comment col-md-7">
							<?php if ( '0' == $comment->comment_approved ) : ?>
								<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'bootstrap' ); ?></p>
							<?php endif; ?>

							<?php comment_text(); ?>
							<?php edit_comment_link( __( '<span class="glyphicon glyphicon-edit"></span> Edit', 'bootstrap' ), '<span style="margin-left: 10px">', '</span>' ); ?>

						</section><!-- .comment-content -->
					</article><!-- #comment-## -->

				<?php
				break;
		endswitch; // end comment_type check
	}
endif;

if ( ! function_exists( 'my_comment_form' ) ) :
	function my_comment_form( $args = array(), $post_id = null ) {
		if ( null === $post_id )
			$post_id = get_the_ID();
		else
			$id = $post_id;

		$commenter = wp_get_current_commenter();
		$user = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';

		$args = wp_parse_args( $args );
		if ( ! isset( $args['format'] ) )
			$args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

		$req      = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$html5    = 'html5' === $args['format'];
		$fields   =  array(
			'author' => '<div class="form-group">' . '<label for="author" class="col-md-4">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
				'<div class="col-md-8"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" class="form-control"' . $aria_req . ' /></div></div>',
			'email'  => '<div class="form-group"><label for="email" class="col-md-4">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
				'<div class="col-md-8"><input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" class="form-control"' . $aria_req . ' /></div></div>',
			'url'    => '<div class="form-group"><label for="url"  class="col-md-4">' . __( 'Website' ) . '</label> ' .
				'<div class="col-md-8"><input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" class="form-control" /></div></div>',
		);

		$required_text = sprintf( ' ' . __('Required fields are marked %s'), '<span class="required">*</span>' );
		$defaults = array(
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'        => '<div class="form-group"><label for="comment" class="col-md-4">' . _x( 'Comment', 'noun' ) . '</label>  <div class="col-md-8"><textarea id="comment" name="comment"  class="form-control" cols="45" rows="8" aria-required="true"></textarea></div></div>',
			'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
			'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) . '</p>',
			'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'title_reply'          => __( 'Leave a Reply' ),
			'title_reply_to'       => __( 'Leave a Reply to %s' ),
			'cancel_reply_link'    => __( 'Cancel reply' ),
			'label_submit'         => __( 'Post Comment' ),
			'format'               => 'xhtml',
		);

		$args = wp_parse_args( $args, apply_filters( 'comment_form_defaults', $defaults ) );

		?>
		<?php if ( comments_open( $post_id ) ) : ?>
			<?php do_action( 'comment_form_before' ); ?>
			<div id="respond" class="comment-respond">
				<h3 id="reply-title" class="comment-reply-title"><?php comment_form_title( $args['title_reply'], $args['title_reply_to'] ); ?> <small><?php cancel_comment_reply_link( $args['cancel_reply_link'] ); ?></small></h3>
				<?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
					<?php echo $args['must_log_in']; ?>
					<?php do_action( 'comment_form_must_log_in_after' ); ?>
				<?php else : ?>
					<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post" id="<?php echo esc_attr( $args['id_form'] ); ?>" class="comment-form form-horizontal"<?php echo $html5 ? ' novalidate' : ''; ?>>
						<?php do_action( 'comment_form_top' ); ?>
						<?php if ( is_user_logged_in() ) : ?>
							<?php echo apply_filters( 'comment_form_logged_in', $args['logged_in_as'], $commenter, $user_identity ); ?>
							<?php do_action( 'comment_form_logged_in_after', $commenter, $user_identity ); ?>
						<?php else : ?>
							<?php echo $args['comment_notes_before']; ?>
							<?php
							do_action( 'comment_form_before_fields' );
							foreach ( (array) $args['fields'] as $name => $field ) {
								echo apply_filters( "comment_form_field_{$name}", $field ) . "\n";
							}
							do_action( 'comment_form_after_fields' );
							?>
						<?php endif; ?>
						<?php echo apply_filters( 'comment_form_field_comment', $args['comment_field'] ); ?>
						<?php echo $args['comment_notes_after']; ?>
						<p class="form-submit">
							<button name="submit" class="btn btn-success btn-block btn-large" type="submit" id="<?php echo esc_attr( $args['id_submit'] ); ?>" value="<?php echo esc_attr( $args['label_submit'] ); ?>" />
							<?php echo $args['label_submit']; ?>
							</button>
							<?php comment_id_fields( $post_id ); ?>
						</p>
						<?php do_action( 'comment_form', $post_id ); ?>
					</form>
				<?php endif; ?>
				<script>
					$('#cptch_input').addClass('form-control').css('width', '50px');
				</script>
			</div><!-- #respond -->
			<?php do_action( 'comment_form_after' ); ?>
		<?php else : ?>
			<?php do_action( 'comment_form_comments_closed' ); ?>
		<?php endif; ?>
	<?php
	}
endif;

//проверка на спам start
add_filter('pre_comment_on_post', 'verify_spam');

function verify_spam($commentdata) {
	$spam_test_field = trim($_POST['comment']);
	if(!empty($spam_test_field)) wp_die('Спаму нет!');
	$comment_content = trim($_POST['mfmfllfsdjgh']);
	$_POST['comment'] = $comment_content;
	return $commentdata;
}
//проверка на спам end