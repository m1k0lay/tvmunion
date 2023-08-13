<?php
/**
 * The template for displaying image attachments.
 *
 */

get_header();
?>
<section id="main-container" class="main-container">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php
					if ( have_posts() ) :
						while ( have_posts() ) :
							the_post();
				?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div id="image-navigation" class="d-flex mb-4 justify-content-between">
							<div><?php previous_image_link( 'large', '<span aria-hidden="true">&larr;</span> ' . esc_html__( 'Предыдущее изображение', 'them-es-starter-theme-bootstrap-5' ) ); ?></div>
							<div><?php next_image_link( 'large', esc_html__( 'Следующее изображение', 'them-es-starter-theme-bootstrap-5' ) . ' <span aria-hidden="true">&rarr;</span>' ); ?></div>
						</div><!-- /.d-flex -->
						<header class="entry-header">
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						</header><!-- /.entry-header -->
						<div class="entry-content">
							<div class="entry-attachment">
								<?php
									echo wp_get_attachment_image( get_the_ID(), 'large', false, array( 'class' => 'img-fluid' ) );

									if ( has_excerpt() ) :
								?>
									<div class="entry-caption">
										<?php
											the_excerpt();
										?>
									</div><!-- /.entry-caption -->
								<?php
									endif;
								?>
							</div><!-- /.entry-attachment -->
							<?php
								the_content();

								wp_link_pages(
									array(
										'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Страницы:', 'them-es-starter-theme-bootstrap-5' ) . '</span>',
										'after'       => '</div>',
										'link_before' => '<span>',
										'link_after'  => '</span>',
										'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Страница', 'them-es-starter-theme-bootstrap-5' ) . ' </span>%',
										'separator'   => '<span class="screen-reader-text">, </span>',
									)
								);
							?>
						</div><!-- /.entry-content -->
						<footer class="entry-footer">
							<?php edit_post_link( esc_html__( 'Изменить', 'them-es-starter-theme-bootstrap-5' ), '<span class="edit-link">', '</span>' ); ?>
						</footer><!-- /.entry-footer -->
					</article><!-- /#post-## -->

					<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

						// Parent post navigation.
						the_post_navigation(
							array(
								'prev_text'  => esc_html_x( 'Опубликовано в %title', 'Ссылка на родительский пост', 'them-es-starter-theme-bootstrap-5' ),
								'aria_label' => esc_html__( 'Родительский пост', 'them-es-starter-theme-bootstrap-5' ),
							)
						);
						endwhile;
					endif;
					wp_reset_postdata(); // End of the loop.
				?>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</section>
<?php
get_footer();
