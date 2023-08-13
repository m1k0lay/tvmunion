<?php
/**
 * Template Name: Blog Index
 * Description: The template for displaying the Blog index /blog.
 *
 */

get_header();

$page_id = get_option( 'page_for_posts' );
?>
<section id="main-container" class="main-container">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php
					echo apply_filters( 'the_content', get_post_field( 'post_content', $page_id ) );
					edit_post_link( __( 'Изменить', 'them-es-starter-theme-bootstrap-5' ), '<span class="edit-link">', '</span>', $page_id );
				?>
			</div>
			<div class="col-md-12">
				<?php
					get_template_part( 'archive', 'loop' );
				?>
			</div>
		</div><!-- /.row -->
	</div>
</section>

<script>
	document.querySelector('.banner-title').innerText = document.querySelector('.last-item').innerText;
</script>

<?php
get_footer();
