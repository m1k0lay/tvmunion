<?php
/**
 * The template for displaying Comments.
 */

/**
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div id="comments">
	<?php
		if ( comments_open() && ! have_comments() ) :
	?>
		<h2 id="comments-title">
			<?php
				esc_html_e( 'Нет комментариев', 'them-es-starter-theme-bootstrap-5' );
			?>
		</h2>
	<?php
		endif;

		if ( have_comments() ) :
	?>
		<h2 id="comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( '1' === $comments_number ) {
					printf( _x( 'Ответить &ldquo;%s&rdquo;', 'comments title', 'them-es-starter-theme-bootstrap-5' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s Ответить &ldquo;%2$s&rdquo;',
							'%1$s Ответы &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'them-es-starter-theme-bootstrap-5'
						),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
		</h2>
		<?php
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav id="comment-nav-above">
			<h1 class="assistive-text"><?php esc_html_e( 'Навигация по комментариям', 'them-es-starter-theme-bootstrap-5' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Ранние комментарии', 'them-es-starter-theme-bootstrap-5' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Поздние комментарии &rarr;', 'them-es-starter-theme-bootstrap-5' ) ); ?></div>
		</nav>
		<?php
			endif;
		?>
		<ol class="commentlist">
			<?php
				/**
				 * Loop through and list the comments. Tell wp_list_comments()
				 * to use theme_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define theme_comment() and that will be used instead.
				 * See theme_comment() in them-es-starter-theme-bootstrap-5/functions.php for more.
				 */
				wp_list_comments( array( 'callback' => 'themes_starter_comment' ) );
			?>
		</ol>
		<?php
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav id="comment-nav-below">
			<h1 class="assistive-text"><?php esc_html_e( 'Навигация по комментариям', 'them-es-starter-theme-bootstrap-5' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Ранние комментарии', 'them-es-starter-theme-bootstrap-5' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Поздние комментарии &rarr;', 'them-es-starter-theme-bootstrap-5' ) ); ?></div>
		</nav>
		<?php
			endif;

		/**
		 * If there are no comments and comments are closed, let's leave a little note, shall we?
		 * But we don't want the note on pages or post types that do not support comments.
		 */
		elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<h2 id="comments-title" class="nocomments"><?php esc_html_e( 'Комментарии отключены', 'them-es-starter-theme-bootstrap-5' ); ?></h2>
	<?php
		endif;

		// Show Comment Form (customized in functions.php).
		comment_form();
	?>
</div><!-- /#comments -->
