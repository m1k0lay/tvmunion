<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <!-- Basic Page Needs
================================================== -->
  <meta charset="<?php bloginfo( 'charset' ); ?>">

  <!-- Mobile Specific Metas
================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
	<meta name="yandex-verification" content="14753dc4db9cb755" />
	<meta name="mailru-domain" content="qbnMQFJKAyp9WTEz" />

  <?php wp_head();?>
</head>

<?php
	$navbar_scheme   = get_theme_mod( 'navbar_scheme', 'navbar-light bg-light' ); // Get custom meta-value.
	$navbar_position = get_theme_mod( 'navbar_position', 'static' ); // Get custom meta-value.
	$search_enabled  = get_theme_mod( 'search_enabled', '1' ); // Get custom meta-value.
?>

<body <?php body_class(); ?>>

  <div class="body-inner">
    <div id="top-bar" class="top-bar">
        <div class="container">
          <div class="row">
              <div class="col-lg-8 col-md-8">
                <ul class="top-info text-md-left">
                    <li><i class="fas fa-map-marker-alt"></i> <p class="info-text">г. Ростов-на-Дону, пр. Космонавтов, д. 2, оф. 1002</p>
                    </li>
                </ul>
              </div>
              <!--/ Top info end -->

              <div class="col-lg-4 col-md-4 top-social text-md-right">
                <!-- <ul class="list-unstyled">
                    <li>
                      <a title="VK" href="https://vk.com/tvmunion">
                          <span class="social-icon"><i class="fab fa-vk-f"></i></span>
                      </a>
                      <a title="Instagram" href="https://instagram.com/tvmunion">
                          <span class="social-icon"><i class="fab fa-instagram"></i></span>
                      </a>
                    </li>
                </ul> -->
              </div>
              <!--/ Top social end -->
          </div>
          <!--/ Content row end -->
        </div>
        <!--/ Container end -->
    </div>
    <!--/ Topbar end -->

<!-- Header start -->
		<header id="header" class="header-one">
			<div class="bg-white">
				<div class="container">
					<div class="logo-area">
							<div class="row align-items-center">
								<div class="logo col-lg-3 text-center text-lg-left mb-3 mb-md-5 mb-lg-0">
										<a class="d-block" href="/">
											<img loading="lazy" src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" alt="ТВМ">
										</a>
								</div><!-- logo end -->

								<div class="col-lg-9 header-right">
										<ul class="top-info-box">
											<li>
												<div class="info-box">
													<div class="info-box-content">
															<p class="info-box-title">Позвонить</p>
															<a class="info-box-subtitle" href="tel:+79183968727">+7 (918) 396-87-27</a>
													</div>
												</div>
											</li>
											<li class="last">
												<div class="info-box last">
													<div class="info-box-content">
															<p class="info-box-title">Отправить письмо</p>
															<a class="info-box-subtitle" href="mailto:office@tvmunion.ru">office@tvmunion.ru</a>
													</div>
												</div>
											</li>
											<li >
												<!-- <div class="info-box last">
													<div class="info-box-content">
															<p class="info-box-title">Сертификат</p>
															<p class="info-box-subtitle"> --- </p>
													</div>
												</div> -->
											</li>
											<li class="header-get-a-quote">
												<a class="btn btn-primary" href="/contacts#m3">Написать нам</a>
											</li>
										</ul><!-- Ul end -->
								</div><!-- header right end -->
							</div><!-- logo area end -->

					</div><!-- Row end -->
				</div><!-- Container end -->
			</div>
			<div class="site-navigation">
				<div class="container">
						<div class="row">
							<div class="col-lg-8">
									<nav class="navbar navbar-expand-lg navbar-dark p-0">
										<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
												<span class="navbar-toggler-icon"></span>
										</button>
										<?php wp_nav_menu( array(
												'menu'            => '', // (string) название выводимого меню (указывается в админке при создании меню, приоритетнее, чем указанное местоположение theme_location - если указано, то параметр theme_location игнорируется)
												'container'       => 'div', // (string) контейнер меню. Обёртка ul. Указывается тег контейнера (по умолчанию тег div)
												'container_class' => 'collapse navbar-collapse', // (string) class контейнера (div тега)
												'container_id'    => 'navbar-collapse', // (string) id контейнера (div тега)
												'menu_class'      => 'nav navbar-nav mr-auto', // (string) class самого меню (ul тега)
												'menu_id'         => '', // (string) id самого меню (ul тега)
												'echo'            => true, // (boolean) выводить на экран или возвращать для обработки
												'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback', // (string) используемая (резервная) функция, если меню не существует (не удалось получить)
												'before'          => '', // (string) текст перед <a> каждой ссылки
												'after'           => '', // (string) текст после </a> каждой ссылки
												'link_before'     => '', // (string) текст перед анкором (текстом) ссылки
												'link_after'      => '', // (string) текст после анкора (текста) ссылки
												'depth'           => 0, // (integer) глубина вложенности (0 - неограничена, 2 - двухуровневое меню)
												'walker'          => new WP_Bootstrap_Navwalker(), // (object) класс собирающий меню. Default: new Walker_Nav_Menu
												'theme_location'  => 'main-menu' // (string) расположение меню в шаблоне. (указывается ключ которым было зарегистрировано меню в функции register_nav_menus)
											) );
										?>
									</nav>
							</div>
							<div class="col-lg-4">
									<nav class="navbar navbar-expand-lg navbar-dark p-0 user-navbar">
										<?php wp_nav_menu( array(
												'menu'            => 'user-menu', // (string) название выводимого меню (указывается в админке при создании меню, приоритетнее, чем указанное местоположение theme_location - если указано, то параметр theme_location игнорируется)
												'container'       => 'div', // (string) контейнер меню. Обёртка ul. Указывается тег контейнера (по умолчанию тег div)
												'container_class' => 'collapse navbar-collapse', // (string) class контейнера (div тега)
												'container_id'    => 'navbar-collapse', // (string) id контейнера (div тега)
												'menu_class'      => 'nav navbar-nav mr-auto', // (string) class самого меню (ul тега)
												'menu_id'         => 'user-menu', // (string) id самого меню (ul тега)
												'echo'            => true, // (boolean) выводить на экран или возвращать для обработки
												'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback', // (string) используемая (резервная) функция, если меню не существует (не удалось получить)
												'before'          => '', // (string) текст перед <a> каждой ссылки
												'after'           => '', // (string) текст после </a> каждой ссылки
												'link_before'     => '', // (string) текст перед анкором (текстом) ссылки
												'link_after'      => '', // (string) текст после анкора (текста) ссылки
												'depth'           => 0, // (integer) глубина вложенности (0 - неограничена, 2 - двухуровневое меню)
												'walker'          => new WP_Bootstrap_Navwalker(), // (object) класс собирающий меню. Default: new Walker_Nav_Menu
												'theme_location'  => '' // (string) расположение меню в шаблоне. (указывается ключ которым было зарегистрировано меню в функции register_nav_menus)
											) );
										?>
									</nav>
							</div>
							<!--/ Col end -->
						</div>
						<!--/ Row end -->
						<div class="nav-search">
							<span id="search"><i class="fa fa-search"></i></span>
						</div><!-- Search end -->
						<?php
							if ( '1' === $search_enabled ) {
								get_search_form();
							}
						?>
				</div>
				<!--/ Container end -->
			</div>
			<!--/ Navigation end -->
		</header>
<!--/ Header end -->

<?php
	if ( !is_front_page() ) :
?>
	<div id="banner-area" class="banner-area" style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/img/banner/banner1.jpg)">
		<div class="banner-text">
			<div class="container">
					<div class="row">
						<div class="col-lg-12">
								<div class="banner-heading">								
									<header class="page-header">
										<h1 class="entry-title banner-title page-title">
											<?php 
												if ( is_home() || is_single() || is_page() ) {
													printf( esc_html__( wp_title( "", true ) ) );
												}
												elseif ( is_search() ) {
													printf( esc_html__( 'Результаты поиска: %s', 'them-es-starter-theme-bootstrap-5' ), get_search_query() );
												}
												elseif ( is_tag() ) {
													printf( esc_html__( 'Тег: %s', 'them-es-starter-theme-bootstrap-5' ), single_tag_title( '', false ) );
												}
												elseif ( is_category() ) {
													printf( esc_html__( 'Архив категории: %s', 'them-es-starter-theme-bootstrap-5' ), single_cat_title( '', false ) );
												}
												elseif ( is_author() ) {
													printf( esc_html__( 'Архивы автора: %s', 'them-es-starter-theme-bootstrap-5' ), get_the_author() );
												}
												elseif ( is_archive() ) {
													if ( is_day() ) :
														printf( esc_html__( 'Дневные архивы: %s', 'them-es-starter-theme-bootstrap-5' ), get_the_date() );
													elseif ( is_month() ) :
														printf( esc_html__( 'Месячные архивы: %s', 'them-es-starter-theme-bootstrap-5' ), get_the_date( _x( 'F Y', 'формат даты для месячных архивов', 'them-es-starter-theme-bootstrap-5' ) ) );
													elseif ( is_year() ) :
														printf( esc_html__( 'Годовые архивы: %s', 'them-es-starter-theme-bootstrap-5' ), get_the_date( _x( 'Y', 'формат даты для годовых архивов', 'them-es-starter-theme-bootstrap-5' ) ) );
													else :
														esc_html_e( 'Архивы блога', 'them-es-starter-theme-bootstrap-5' );
													endif;
												}
											?>
										</h1>
										<?php
											if ( is_category() ) {
												$category_description = category_description();
												if ( ! empty( $category_description ) ) :
													echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
												endif;
											}
											elseif ( is_tag() ) {
												$tag_description = tag_description();
												if ( ! empty( $tag_description ) ) :
													echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' );
												endif;
											}
										?>
									</header>
									<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
										<?php if( function_exists( 'bcn_display' ) ){
											bcn_display();
										}?>
									</div>
								</div>
						</div><!-- Col end -->
					</div><!-- Row end -->
			</div><!-- Container end -->
		</div><!-- Banner text end -->
	</div><!-- Banner area end -->
	<?php
	endif;
?>

<?php
	// If Single or Archive (Category, Tag, Author or a Date based page).
	if ( is_single() || is_archive() ) :
?>
<section id="main-container" class="main-container">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 order-sm-first col-md-9 order-md-first">
<?php
	endif;
?>