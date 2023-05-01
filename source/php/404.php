<?php
/**
 * Template Name: Not found
 * Description: Page template 404 Not found.
 *
 */

get_header();

$search_enabled = get_theme_mod( 'search_enabled', '1' ); // Get custom meta-value.
?>

<section id="main-container" class="main-container">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="error-page text-center">
          <div class="error-code">
            <h2><strong>404</strong></h2>
          </div>
          <div class="error-message">
            <h3>Ой... Страница не найдена!</h3>
          </div>
          <div class="error-body">
            Попробуйте использовать кнопку ниже для возврата на главную страницу <br>
            <a href="/" class="btn btn-primary">Вернуться на главную страницу</a>
          </div>
        </div>
      </div>
    </div><!-- Content row -->
  </div><!-- Conatiner end -->
</section><!-- Main container end -->

<?php
get_footer();
