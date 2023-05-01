<?php
/**
 * The Template for displaying Search Results pages.
 */

get_header();
?>

<?php
	if ( have_posts() ) :
		get_template_part( 'archive', 'loop' );
	else :
?>
<section id="main-container" class="main-container">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php esc_html_e( 'Ничего не найдено', 'them-es-starter-theme-bootstrap-5' ); ?></h1>
					</header><!-- /.entry-header -->
					<p><?php esc_html_e( 'Извините, но материалов, соответствующих вашим критериям поиска, найти не удалось. Пожалуйста, попробуйте еще раз, используя другие ключевые слова.', 'them-es-starter-theme-bootstrap-5' ); ?></p>
				</article><!-- /#post-0 -->
			</div>
		</div>
	</div>
</section>
<?php
	endif;
	wp_reset_postdata();

get_footer();
