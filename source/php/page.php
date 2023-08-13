<?php
/**
 * Template Name: Page (Default)
 * Description: Page template with Sidebar on the right side.
 *
 */

get_header();

the_post();
?>
<section id="main-container" class="main-container">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 order-sm-first col-md-9 order-md-first">
        <div id="post-<?php the_ID(); ?>" <?php post_class( 'content' ); ?> class="post entry-content">
          <div class="entry-header"><h1 class="entry-title"><?php the_title(); ?></h1></div>
            <?php
              the_content();

              wp_link_pages(
                array(
                  'before'   => '<nav class="page-links" aria-label="' . esc_attr__( 'Страница', 'them-es-starter-theme-bootstrap-5' ) . '">',
                  'after'    => '</nav>',
                  'pagelink' => esc_html__( 'Страница %', 'them-es-starter-theme-bootstrap-5' ),
                )
              );
              edit_post_link(
                esc_attr__( 'Изменить', 'them-es-starter-theme-bootstrap-5' ),
                '<span class="edit-link">',
                '</span>'
              );
            ?>
        </div><!-- /#post-<?php the_ID(); ?> -->
        <?php
          // If comments are open or we have at least one comment, load up the comment template.
          if ( comments_open() || get_comments_number() ) {
            comments_template();
          }
        ?>
      </div><!-- Content Col end -->
      <?php
        get_sidebar();
      ?>
    </div><!-- Main row end -->
  </div><!-- Container row end -->
</section> <!-- Section row end -->

<?php
  get_footer();
?>
