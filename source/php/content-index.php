<?php
/**
 * The template for displaying content in the index.php template.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
	<div class="post-body">
		<header class="entry-header">
			<h2 class="entry-title card-title">
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Ссылка %s', 'them-es-starter-theme-bootstrap-5' ), the_title_attribute( array( 'echo' => false ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
			<?php
				if ( 'post' === get_post_type() ) :
			?>
				<div class="card-text post-meta">
					<?php
						themes_starter_article_posted_on();

						$num_comments = get_comments_number();
						if ( comments_open() && $num_comments >= 1 ) :
							echo ' <i class="far fa-comment"></i><a href="' . esc_url( get_comments_link() ) . '" class="post-comment" title="' . esc_attr( sprintf( _n( '%s Комментарий', '%s Комментариев', $num_comments, 'them-es-starter-theme-bootstrap-5' ), $num_comments ) ) . '">' . esc_attr( sprintf( _n( '%s Комментарий', '%s Комментариев', $num_comments, 'them-es-starter-theme-bootstrap-5' ), $num_comments ) ) . '</a>';
						endif;
					?>
				</div><!-- /.entry-meta -->
			<?php
				endif;
			?>
		</header>

		<div class="card-body">
			<div class="card-text entry-content">
				<?php
					if ( has_post_thumbnail() ) {
						echo '<div class="post-thumbnail">' . get_the_post_thumbnail( get_the_ID(), 'large' ) . '</div>';
					}

					if ( is_search() ) {
						the_excerpt();
					} else {
						the_content();
					}
				?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . esc_html__( 'Страниц:', 'them-es-starter-theme-bootstrap-5' ) . '</span>', 'after' => '</div>' ) ); ?>
			</div><!-- /.card-text -->

			<footer class="entry-meta post-footer">
				<a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php esc_html_e( 'Далее', 'them-es-starter-theme-bootstrap-5' ); ?></a>
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
				?>
			</footer><!-- /.entry-meta -->
		</div><!-- /.card-body -->
	</div><!-- /.col -->
</article><!-- /#post-<?php the_ID(); ?> -->
