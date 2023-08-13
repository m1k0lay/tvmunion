<?php

/**
 * Include Theme Customizer.
 *
 * @since v1.0
 */
$theme_customizer = __DIR__ . '/inc/customizer.php';
if ( is_readable( $theme_customizer ) ) {
	require_once $theme_customizer;
}

if ( ! function_exists( 'themes_starter_setup_theme' ) ) {
	/**
	 * General Theme Settings.
	 *
	 * @since v1.0
	 *
	 * @return void
	 */
	function themes_starter_setup_theme() {
		// Make theme available for translation: Translations can be filed in the /languages/ directory.
		load_theme_textdomain( 'them-es-starter-theme-bootstrap-5', __DIR__ . '/languages' );

		/**
		 * Set the content width based on the theme's design and stylesheet.
		 *
		 * @since v1.0
		 */
		global $content_width;
		if ( ! isset( $content_width ) ) {
			$content_width = 800;
		}

		// Theme Support.
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
				'navigation-widgets',
			)
		);

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );
		// Add support for full and wide alignment.
		add_theme_support( 'align-wide' );
		// Add support for Editor Styles.
		add_theme_support( 'editor-styles' );
		// Enqueue Editor Styles.
		add_theme_support( 'title-tag' );
		// Enable title tag
		add_editor_style( 'style-editor.css' );

		// Default attachment display settings.
		update_option( 'image_default_align', 'none' );
		update_option( 'image_default_link_type', 'none' );
		update_option( 'image_default_size', 'large' );

		// Custom CSS styles of WorPress gallery.
		add_filter( 'use_default_gallery_style', '__return_false' );
	}
	add_action( 'after_setup_theme', 'themes_starter_setup_theme' );

	// Disable Block Directory: https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/filters/editor-filters.md#block-directory
	remove_action( 'enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets' );
	remove_action( 'enqueue_block_editor_assets', 'gutenberg_enqueue_block_editor_assets_block_directory' );
}

if ( ! function_exists( 'wp_body_open' ) ) {
	/**
	 * Fire the wp_body_open action.
	 *
	 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
	 *
	 * @since v2.2
	 *
	 * @return void
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

if ( ! function_exists( 'themes_starter_add_user_fields' ) ) {
	/**
	 * Add new User fields to Userprofile:
	 * get_user_meta( $user->ID, 'facebook_profile', true );
	 *
	 * @since v1.0
	 *
	 * @param array $fields User fields.
	 *
	 * @return array
	 */
	function themes_starter_add_user_fields( $fields ) {
		// Add new fields.
		$fields['vk_profile'] = 'vk URL';
		$fields['telegram_profile']  = 'Telegram URL';
		$fields['Instagram_profile'] = 'Instagram URL';

		return $fields;
	}
	add_filter( 'user_contactmethods', 'themes_starter_add_user_fields' );
}

/**
 * Test if a page is a blog page.
 * if ( is_blog() ) { ... }
 *
 * @since v1.0
 *
 * @return bool
 */
function is_blog() {
	global $post;
	$posttype = get_post_type( $post );

	return ( ( is_archive() || is_author() || is_category() || is_home() || is_single() || ( is_tag() && ( 'post' === $posttype ) ) ) ? true : false );
}

/**
 * Disable comments for Media (Image-Post, Jetpack-Carousel, etc.)
 *
 * @since v1.0
 *
 * @param bool $open    Comments open/closed.
 * @param int  $post_id Post ID.
 *
 * @return bool
 */
function themes_starter_filter_media_comment_status( $open, $post_id = null ) {
	$media_post = get_post( $post_id );

	if ( 'attachment' === $media_post->post_type ) {
		return false;
	}

	return $open;
}
add_filter( 'comments_open', 'themes_starter_filter_media_comment_status', 10, 2 );

/**
 * Style Edit buttons as badges: https://getbootstrap.com/docs/5.0/components/badge
 *
 * @since v1.0
 *
 * @param string $link Post Edit Link.
 *
 * @return string
 */
function themes_starter_custom_edit_post_link( $link ) {
	return str_replace( 'class="post-edit-link"', 'class="post-edit-link badge bg-secondary"', $link );
}
add_filter( 'edit_post_link', 'themes_starter_custom_edit_post_link' );

/**
 * Style Edit buttons as badges: https://getbootstrap.com/docs/5.0/components/badge
 *
 * @since v1.0
 *
 * @param string $link Comment Edit Link.
 */
function themes_starter_custom_edit_comment_link( $link ) {
	return str_replace( 'class="comment-edit-link"', 'class="comment-edit-link badge bg-secondary"', $link );
}
add_filter( 'edit_comment_link', 'themes_starter_custom_edit_comment_link' );

/**
 * Responsive oEmbed filter: https://getbootstrap.com/docs/5.0/helpers/ratio
 *
 * @since v1.0
 *
 * @param string $html Inner HTML.
 *
 * @return string
 */
function themes_starter_oembed_filter( $html ) {
	return '<div class="ratio ratio-16x9">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'themes_starter_oembed_filter', 10 );

if ( ! function_exists( 'themes_starter_content_nav' ) ) {
	/**
	 * Display a navigation to next/previous pages when applicable.
	 *
	 * @since v1.0
	 *
	 * @param string $nav_id Navigation ID.
	 */
	function themes_starter_content_nav( $nav_id ) {
		global $wp_query;

		if ( $wp_query->max_num_pages > 1 ) {
	?>
			<div id="<?php echo esc_attr( $nav_id ); ?>" class="d-flex mb-4 justify-content-between">
				<div><?php next_posts_link( '<span aria-hidden="true">&larr;</span> ' . esc_html__( 'Раньше', 'them-es-starter-theme-bootstrap-5' ) ); ?></div>
				<div><?php previous_posts_link( esc_html__( 'Позже', 'them-es-starter-theme-bootstrap-5' ) . ' <span aria-hidden="true">&rarr;</span>' ); ?></div>
			</div><!-- /.d-flex -->
	<?php
		} else {
			echo '<div class="clearfix"></div>';
		}
	}

	/**
	 * Add Class.
	 *
	 * @since v1.0
	 *
	 * @return string
	 */
	function posts_link_attributes() {
		return 'class="btn btn-secondary btn-lg"';
	}
	add_filter( 'next_posts_link_attributes', 'posts_link_attributes' );
	add_filter( 'previous_posts_link_attributes', 'posts_link_attributes' );
}

/**
 * Init Widget areas in Sidebar.
 *
 * @since v1.0
 *
 * @return void
 */
function themes_starter_widgets_init() {
	// Area 1.
	register_sidebar(
		array(
			'name'          => 'Primary Widget Area (Sidebar)',
			'id'            => 'primary_widget_area',
			// 'class'         => 'sidebar',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	// Area 2.
	register_sidebar(
		array(
			'name'          => 'Secondary Widget Area (Header Navigation)',
			'id'            => 'secondary_widget_area',
			// 'class'         => 'sidebar',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	// Area 3.
	register_sidebar(
		array(
			'name'          => 'Third Widget Area (Footer)',
			'id'            => 'third_widget_area',
			// 'class'         => 'sidebar',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'themes_starter_widgets_init' );

if ( ! function_exists( 'themes_starter_article_posted_on' ) ) {
	/**
	 * "Theme posted on" pattern.
	 *
	 * @since v1.0
	 */
	function themes_starter_article_posted_on() {
		printf(
			wp_kses_post( __( '<span class="post-author"><i class="far fa-user"></i><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span> <span class="post-meta-date"><i class="far fa-calendar"></i><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>', 'them-es-starter-theme-bootstrap-5' ) ),
			esc_url( get_the_permalink() ),
			esc_attr( get_the_date() . ' в ' . get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() . ' в ' . get_the_time() ),
			esc_url( get_author_posts_url( (int) get_the_author_meta( 'ID' ) ) ),
			sprintf( esc_attr__( 'Показать все записи, опубликованные %s', 'them-es-starter-theme-bootstrap-5' ), get_the_author() ),
			get_the_author()
		);
	}
}

/**
 * Template for Password protected post form.
 *
 * @since v1.0
 *
 * @return string
 */
function themes_starter_password_form() {
	global $post;
	$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );

	$output = '<div class="row">';
		$output .= '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">';
		$output .= '<h4 class="col-md-12 alert alert-warning">' . esc_html__( 'Это содержимое защищено паролем. Для просмотра введите свой пароль ниже.', 'them-es-starter-theme-bootstrap-5' ) . '</h4>';
			$output .= '<div class="col-md-6">';
				$output .= '<div class="input-group">';
					$output .= '<input type="password" name="post_password" id="' . esc_attr( $label ) . '" placeholder="' . esc_attr__( 'Пароль', 'them-es-starter-theme-bootstrap-5' ) . '" class="form-control" />';
					$output .= '<div class="input-group-append"><input type="submit" name="submit" class="btn btn-primary" value="' . esc_attr__( 'Отправить', 'them-es-starter-theme-bootstrap-5' ) . '" /></div>';
				$output .= '</div><!-- /.input-group -->';
			$output .= '</div><!-- /.col -->';
		$output .= '</form>';
	$output .= '</div><!-- /.row -->';

	return $output;
}
add_filter( 'the_password_form', 'themes_starter_password_form' );


if ( ! function_exists( 'themes_starter_comment' ) ) {
	/**
	 * Style Reply link.
	 *
	 * @since v1.0
	 *
	 * @param string $class Link class.
	 *
	 * @return string
	 */
	function themes_starter_replace_reply_link_class( $class ) {
		return str_replace( "class='comment-reply-link", "class='comment-reply-link btn btn-outline-secondary", $class );
	}
	add_filter( 'comment_reply_link', 'themes_starter_replace_reply_link_class' );

	/**
	 * Template for comments and pingbacks:
	 * add function to comments.php ... wp_list_comments( array( 'callback' => 'themes_starter_comment' ) );
	 *
	 * @since v1.0
	 *
	 * @param object $comment Comment object.
	 * @param array  $args    Comment args.
	 * @param int    $depth   Comment depth.
	 */
	function themes_starter_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback':
			case 'trackback':
	?>
		<li class="post pingback">
			<p>
				<?php
					esc_html_e( 'Pingback:', 'them-es-starter-theme-bootstrap-5' );
					comment_author_link();
					edit_comment_link( esc_html__( 'Изменить', 'them-es-starter-theme-bootstrap-5' ), '<span class="edit-link">', '</span>' );
				?>
			</p>
	<?php
				break;
			default:
	?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				<footer class="comment-meta">
					<div class="comment-author vcard">
						<?php
							$avatar_size = ( '0' !== $comment->comment_parent ? 68 : 136 );
							echo get_avatar( $comment, $avatar_size );

							/* Translators: 1: Comment author, 2: Date and time */
							printf(
								wp_kses_post( __( '%1$s, %2$s', 'them-es-starter-theme-bootstrap-5' ) ),
								sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
								sprintf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
									esc_url( get_comment_link( $comment->comment_ID ) ),
									get_comment_time( 'c' ),
									/* Translators: 1: Date, 2: Time */
									sprintf( esc_html__( '%1$s ago', 'them-es-starter-theme-bootstrap-5' ), human_time_diff( (int) get_comment_time( 'U' ), current_time( 'timestamp' ) ) )
								)
							);

							edit_comment_link( esc_html__( 'Изменить', 'them-es-starter-theme-bootstrap-5' ), '<span class="edit-link">', '</span>' );
						?>
					</div><!-- .comment-author .vcard -->

					<?php if ( '0' === $comment->comment_approved ) { ?>
						<em class="comment-awaiting-moderation">
							<?php esc_html_e( 'Ваш комментарий ожидает модерации.', 'them-es-starter-theme-bootstrap-5' ); ?>
						</em>
						<br />
					<?php } ?>
				</footer>

				<div class="comment-content"><?php comment_text(); ?></div>

				<div class="reply">
					<?php
						comment_reply_link(
							array_merge(
								$args,
								array(
									'reply_text' => esc_html__( 'Ответить', 'them-es-starter-theme-bootstrap-5' ) . ' <span>&darr;</span>',
									'depth'      => $depth,
									'max_depth'  => $args['max_depth'],
								)
							)
						);
					?>
				</div><!-- /.reply -->
			</article><!-- /#comment-## -->
		<?php
				break;
		endswitch;
	}

	/**
	 * Custom Comment form.
	 *
	 * @since v1.0
	 * @since v1.1: Added 'submit_button' and 'submit_field'
	 * @since v2.0.2: Added '$consent' and 'cookies'
	 *
	 * @param array $args    Form args.
	 * @param int   $post_id Post ID.
	 *
	 * @return array
	 */
	function themes_starter_custom_commentform( $args = array(), $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		$commenter     = wp_get_current_commenter();
		$user          = wp_get_current_user();
		$user_identity = $user->exists() ? $user->display_name : '';

		$args = wp_parse_args( $args );

		$req      = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true' required" : '' );
		$consent  = ( empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"' );
		$fields   = array(
			'author'  => '<div class="form-floating mb-3">
							<input type="text" id="author" name="author" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . esc_html__( 'Имя', 'them-es-starter-theme-bootstrap-5' ) . ( $req ? '*' : '' ) . '"' . $aria_req . ' />
							<label for="author">' . esc_html__( 'Имя', 'them-es-starter-theme-bootstrap-5' ) . ( $req ? '*' : '' ) . '</label>
						</div>',
			'email'   => '<div class="form-floating mb-3">
							<input type="email" id="email" name="email" class="form-control" value="' . esc_attr( $commenter['comment_author_email'] ) . '" placeholder="' . esc_html__( 'Email', 'them-es-starter-theme-bootstrap-5' ) . ( $req ? '*' : '' ) . '"' . $aria_req . ' />
							<label for="email">' . esc_html__( 'Email', 'them-es-starter-theme-bootstrap-5' ) . ( $req ? '*' : '' ) . '</label>
						</div>',
			'url'     => '',
			'cookies' => '<p class="form-check mb-3 comment-form-cookies-consent">
							<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" class="form-check-input" type="checkbox" value="yes"' . $consent . ' />
							<label class="form-check-label" for="wp-comment-cookies-consent">' . esc_html__( 'Сохранить имя, электронную почту и веб-сайт в этом браузере для следующего комментария.', 'them-es-starter-theme-bootstrap-5' ) . '</label>
						</p>',
		);

		$defaults = array(
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			'comment_field'        => '<div class="form-floating mb-3">
											<textarea id="comment" name="comment" class="form-control" aria-required="true" required placeholder="' . esc_attr__( 'Комментарий', 'them-es-starter-theme-bootstrap-5' ) . ( $req ? '*' : '' ) . '"></textarea>
											<label for="comment">' . esc_html__( 'Комментарий', 'them-es-starter-theme-bootstrap-5' ) . '</label>
										</div>',
			/** This filter is documented in wp-includes/link-template.php */
			'must_log_in'          => '<p class="must-log-in">' . sprintf( wp_kses_post( __( 'Вы должны быть <a href="%s">авторизованы</a> для оставления комментария.', 'them-es-starter-theme-bootstrap-5' ) ), wp_login_url( esc_url( get_the_permalink( get_the_ID() ) ) ) ) . '</p>',
			/** This filter is documented in wp-includes/link-template.php */
			'logged_in_as'         => '<p class="logged-in-as">' . sprintf( wp_kses_post( __( 'Вы авторизованы как <a href="%1$s">%2$s</a>. <a href="%3$s" title="Выйти из этой учетной записи">Выйти?</a>', 'them-es-starter-theme-bootstrap-5' ) ), get_edit_user_link(), $user->display_name, wp_logout_url( apply_filters( 'the_permalink', esc_url( get_the_permalink( get_the_ID() ) ) ) ) ) . '</p>',
			'comment_notes_before' => '<p class="small comment-notes">' . esc_html__( 'Ваш Email адрес не будет опубликован.', 'them-es-starter-theme-bootstrap-5' ) . '</p>',
			'comment_notes_after'  => '',
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'class_submit'         => 'btn btn-primary',
			'name_submit'          => 'submit',
			'title_reply'          => '',
			'title_reply_to'       => esc_html__( 'Оставить комментарий %s', 'them-es-starter-theme-bootstrap-5' ),
			'cancel_reply_link'    => esc_html__( 'Отмена', 'them-es-starter-theme-bootstrap-5' ),
			'label_submit'         => esc_html__( 'Опубликовать', 'them-es-starter-theme-bootstrap-5' ),
			'submit_button'        => '<input type="submit" id="%2$s" name="%1$s" class="%3$s" value="%4$s" />',
			'submit_field'         => '<div class="form-submit">%1$s %2$s</div>',
			'format'               => 'html5',
		);

		return $defaults;
	}
	add_filter( 'comment_form_defaults', 'themes_starter_custom_commentform' );
}

if ( function_exists( 'register_nav_menus' ) ) {
	/**
	 * Nav menus.
	 *
	 * @since v1.0
	 *
	 * @return void
	 */
	register_nav_menus(
		array(
			'main-menu'   => 'Main Navigation Menu',
			'footer-menu' => 'Footer Menu',
		)
	);
}

// Custom Nav Walker: wp_bootstrap_navwalker().

$custom_walker = __DIR__ . '/inc/wp-bootstrap-navwalker.php';
if ( is_readable( $custom_walker ) ) {
	require_once $custom_walker;
}

$custom_walker_footer = __DIR__ . '/inc/wp_bootstrap_navwalker_footer.php';
if ( is_readable( $custom_walker_footer ) ) {
	require_once $custom_walker_footer;
}

/**
 * Loading All CSS Stylesheets and Javascript Files.
 *
 * @since v1.0
 *
 * @return void
 */
function themes_starter_scripts_loader() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// 1. Styles.
	wp_enqueue_style( 'style', get_theme_file_uri( 'style.css' ), array(), $theme_version, 'all' );
	wp_enqueue_style( 'bootstrap', get_theme_file_uri( 'plugins/bootstrap/bootstrap.min.css' ), array(), $theme_version, 'all' ); 
	wp_enqueue_style( 'fontawesome', get_theme_file_uri( 'plugins/fontawesome/css/all.min.css' ), array(), $theme_version, 'all' ); 
	wp_enqueue_style( 'animate-css', get_theme_file_uri( 'plugins/animate-css/animate.css' ), array(), $theme_version, 'all' ); 
	wp_enqueue_style( 'slick', get_theme_file_uri( 'plugins/slick/slick.css' ), array(), $theme_version, 'all' );
	wp_enqueue_style( 'slick-theme', get_theme_file_uri( 'plugins/slick/slick-theme.css' ), array(), $theme_version, 'all' ); 
	wp_enqueue_style( 'colorbox', get_theme_file_uri( 'plugins/colorbox/colorbox.css' ), array(), $theme_version, 'all' );
	wp_enqueue_style( 'main', get_theme_file_uri( 'css/main.css' ), array(), $theme_version, 'all' ); // main.scss: Compiled Framework source + custom styles.

	if ( is_rtl() ) {
		wp_enqueue_style( 'rtl', get_theme_file_uri( 'css/rtl.css' ), array(), $theme_version, 'all' );
	}

	// 2. Scripts.
	wp_enqueue_script( 'mainjs', get_theme_file_uri( 'js/main.bundle.js' ), array(), $theme_version, true );
	wp_enqueue_script( 'jquery', get_theme_file_uri( 'plugins/jQuery/jquery.min.js' ), array(), $theme_version, true );
	wp_enqueue_script( 'bootstrap', get_theme_file_uri( 'plugins/bootstrap/bootstrap.min.js' ), array(), $theme_version, true );
  wp_enqueue_script( 'slick', get_theme_file_uri( 'plugins/slick/slick.min.js' ), array(), $theme_version, true );
  wp_enqueue_script( 'slick-animation', get_theme_file_uri( 'plugins/slick/slick-animation.min.js' ), array(), $theme_version, true );
  wp_enqueue_script( 'colorbox', get_theme_file_uri( 'plugins/colorbox/jquery.colorbox.js' ), array(), $theme_version, true );
  wp_enqueue_script( 'shuffle', get_theme_file_uri( 'plugins/shuffle/shuffle.min.js' ), array(), $theme_version, true );
  wp_enqueue_script( 'map', get_theme_file_uri( 'plugins/google-map/map.js' ), array(), $theme_version, true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'themes_starter_scripts_loader' );


/**
 * Generate breadcrumbs
 * @author CodexWorld
 * @authorURL www.codexworld.com
 */
function get_breadcrumb() {
	echo '<a href="'.home_url().'" rel="nofollow">Главная</a>';
	if (is_category() || is_single()) {
			echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
			the_category(' &bull; ');
					if (is_single()) {
							echo " &nbsp;&nbsp;&#187;&nbsp;&nbsp; ";
							the_title();
					}
	} elseif (is_page()) {
			echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
			echo the_title();
	} elseif (is_search()) {
			echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp; Результаты поиска для ...";
			echo '"<em>';
			echo the_search_query();
			echo '</em>"';
	}
}


// Limit of the comments content
add_filter( 'preprocess_comment', 'sebweo_preprocess_comment' );
function sebweo_preprocess_comment($comment) {
 if ( strlen( $comment['comment_content'] ) > 5000 ) {
  wp_die('Комментарий слишком длинный. Ограничьте свой комментарий длиной 5000 символами.');
 }
 if ( strlen( $comment['comment_content'] ) < 20 ) {
  wp_die('По правилам нашего сайта слишком короткие комментарии запрещены. Используйте не менее 20 символов.');
 }
 return $comment;
}

//Recent orders gallery widget
class WP_Widget_Recent_Orders extends WP_Widget {

	/**
	 * Установка идентификатора, заголовка, имени класса и описания для виджета.
	 * Sets up a new Recent Posts widget instance.
	 * @since 2.8.0
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'widget_recent_orders',
			'description'                 => __( 'Недавние заказы' ),
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);
		parent::__construct( 'recent-orders', __( 'Недавние заказы' ), $widget_ops );
		$this->alt_option_name = 'widget_recent_orders';
	}

	/**
	 * Вывод виджета в области виджетов на сайте.
	 * ---
	 * Outputs the content for the current Recent Posts widget instance.
	 * @since 2.8.0
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Recent Posts widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$default_title = __( '' );
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : $default_title;

		/** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		$args['after_widget'] = '<div class="general-btn text-center"><a class="btn btn-primary" href="' . home_url() . '/?posts=all". >Показать все заказы</a></div>';

		$r = new WP_Query(
			/**
			 * Filters the arguments for the Recent Posts widget.
			 *
			 * @since 3.4.0
			 * @since 4.9.0 Added the `$instance` parameter.
			 *
			 * @see WP_Query::get_posts()
			 *
			 * @param array $args     An array of arguments used to retrieve the recent posts.
			 * @param array $instance Array of settings for the current widget.
			 */
			apply_filters(
				'widget_posts_args',
				array(
					'posts_per_page'      => $number,
					'no_found_rows'       => true,
					'post_status'         => 'publish',
					'ignore_sticky_posts' => true,
				),
				$instance
			)
		);

		if ( ! $r->have_posts() ) {
			return;
		}
		?>

		<?php echo $args['before_widget']; ?>

		<?php
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$format = current_theme_supports( 'html5', 'navigation-widgets' ) ? 'html5' : 'xhtml';

		/** This filter is documented in wp-includes/widgets/class-wp-nav-menu-widget.php */
		$format = apply_filters( 'navigation_widgets_format', $format );

		if ( 'html5' === $format ) {
			// The title may be filtered: Strip out HTML and make sure the aria-label is never empty.
			$title      = trim( strip_tags( $title ) );
			$aria_label = $title ? $title : $default_title;
			echo '<nav aria-label="' . esc_attr( $aria_label ) . '">';
		}
		?>

		<?php
			$categories = get_categories( [
				'taxonomy'     => 'category',
				'type'         => 'post',
				'child_of'     => 18,
				'parent'       => '',
				'orderby'      => 'count',
				'order'        => 'DESC',
				'hide_empty'   => 1,
				'hierarchical' => 0,
				'exclude'      => '',
				'include'      => '',
				'number'       => 0,
				'pad_counts'   => false,
			] );
		?>

		<div class="shuffle-btn-group">
			<label class="active" for="all">
				<input type="radio" name="shuffle-filter" id="all" value="all" checked="checked">Все</label>
				<?php
					if( $categories ){
						foreach( $categories as $cat ){
							echo '<label for="' . $cat->slug . '"><input type="radio" name="shuffle-filter" id="' . $cat->slug . '" value="' . $cat->slug . '">' . $cat->name .'</label>';
						}
					}
				?>
		</div><!-- project filter end -->

		<div class="col-1 shuffle-sizer"></div>
		<ul class="row shuffle-wrapper">
			<?php foreach ( $r->posts as $recent_post ) : ?>
				<?php
					$post_title   = get_the_title( $recent_post->ID );
					$title        = ( ! empty( $post_title ) ) ? $post_title : __( '(без заголовка)' );
					$aria_current = '';
					$post_categories = get_the_category( $recent_post->ID );

					if ( get_queried_object_id() === $recent_post->ID ) {
						$aria_current = ' aria-current="page"';
					}

					if ( has_post_thumbnail( $recent_post->ID )) :
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $recent_post->ID ), 'single-post-thumbnail' );
						?>
						<li class="col-lg-4 col-md-6 shuffle-item" data-groups="[
								<?php
									if ( $post_categories ) {
										$len = count( $post_categories );
										foreach ( $post_categories as $key => $cat ) {
											echo '&quot;' . $cat->slug . '&quot;';
											if (!( $key == $len - 1 )) {
												echo ', ';
											}
										}
									} 
								?>
							]">
							<div class="project-img-container">
								<a class="gallery-popup" href="<?php echo $image[0]; ?>" aria-label="project-img">
									<img class="img-fluid" src="<?php echo $image[0]; ?>" alt="project-img">
									<span class="gallery-icon"><i class="fa fa-plus"></i></span>
								</a>
								<div class="project-item-info">
									<div class="project-item-info-content">
										<h3 class="project-item-title">
											<a href="<?php the_permalink( $recent_post->ID ); ?>"<?php echo $aria_current; ?>><?php echo $title; ?></a>
										</h3>
										<p class="project-cat">
											<?php 
												$posttags = get_the_tags( $recent_post->ID );
												if( $posttags ){
													$len = count( $posttags );
													foreach ( $posttags as $key => $tag ) {
														echo $tag->name;
														if (!( $key == $len - 1 )) {
															echo ', ';
														}
													}
												}
											?>
										</p>
									</div>
								</div>
							</div>
						</li>
					<?php endif; ?>
			<?php endforeach; ?>
		</ul><!-- shuffle end -->

		<?php if ( $show_date ) : ?>
			<span class="post-date"><?php echo  get_the_date( '', $recent_post->ID ); ?></span>
		<?php endif; ?>

		<?php
		if ( 'html5' === $format ) {
			echo '</nav>';
		}

		echo $args['after_widget'];
	}

	/**
	 * Обновление настроек виджета в админ-панели.
	 * ---
	 * Handles updating the settings for the current Recent Posts widget instance.
	 * @since 2.8.0
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['title']     = sanitize_text_field( $new_instance['title'] );
		$instance['number']    = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		return $instance;
	}

	/**
	 * Параметры виджета, отображаемые в области администрирования WordPress.
	 * ---
	 * Outputs the settings form for the Recent Posts widget.
	 * @since 2.8.0
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Название:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Количество постов для показа:' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
		</p>

		<p>
			<input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Отображать дату публикации?' ); ?></label>
		</p>
		<?php
	}
}

// Регистрация и активация виджета
function WP_Widget_Recent_Orders_Load() {
	register_widget( 'WP_Widget_Recent_Orders' );
}
add_action( 'widgets_init', 'WP_Widget_Recent_Orders_Load' );