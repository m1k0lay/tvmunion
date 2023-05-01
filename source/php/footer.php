<?php
	// If Single or Archive (Category, Tag, Author or a Date based page).
	if ( is_single() || is_archive() ) :
?>
			</div><!-- /.col -->
		<?php
			get_sidebar();
		?>
		</div><!-- /.row -->
	</div><!-- /.container -->
</section>
<?php
	endif;
?>
	<footer id="footer" class="footer bg-overlay">
		<div class="footer-main">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-4 col-md-6 footer-widget footer-about">
						<h3 class="widget-title">О нас</h3>
						<img loading="lazy" width="200px" class="footer-logo" src="<?php echo get_stylesheet_directory_uri(); ?>/img/footer-logo.png" alt="ТВМ">
						<p>Мы - команда профессионалов с 20 летним стажем в области обслуживания инженерных систем.</p>
						<div class="footer-social">
							<!-- <ul>
								<li><a href="https://vk.com/tvmunion" aria-label="VK"><i
											class="fab fa-vk-f"></i></a></li>
								<li><a href="https://instagram.com/tvmunion" aria-label="Instagram"><i
											class="fab fa-instagram"></i></a></li>
							</ul> -->
						</div><!-- Footer social end -->
					</div><!-- Col end -->

					<div class="col-lg-4 col-md-6 footer-widget mt-5 mt-md-0">
						<h3 class="widget-title">Рабочие часы</h3>
						<div class="working-hours">
							Мы работаем 7 дней в неделю, каждый день, кроме больших праздников. Свяжитесь с нами, если у Вас чрезвычайная ситуация, по телефону или через контактную форму.
							<br><br> Понедельник - Пятница: <span class="text-right">10:00 - 18:00</span>
							<br> Суббота и Воскресенье: <span class="text-right">10:00 - 14:00</span>
						</div>
					</div><!-- Col end -->

					<?php
						$categories = get_categories( [
							'taxonomy'     => 'category',
							'type'         => 'post',
							'child_of'     => 0,
							'parent'       => 134,
							'orderby'      => 'count',
							'order'        => 'DESC',
							'hide_empty'   => 0,
							'hierarchical' => 0,
							'exclude'      => '',
							'include'      => '',
							'number'       => 5,
							'pad_counts'   => false,
						] );
					?>

					<div class="col-lg-3 col-md-6 mt-5 mt-lg-0 footer-widget">
						<h3 class="widget-title">Услуги</h3>
						<ul class="list-arrow">
							<?php
								if( $categories ){
									foreach( $categories as $cat ){
										echo '<li><a href="' . get_category_link( $cat->term_id ) . '">' . $cat->name .'</a></li>';
									}
								}
							?>
						</ul>
					</div><!-- project filter end -->
				</div><!-- Row end -->
			</div><!-- Container end -->
		</div><!-- Footer main end -->

		<div class="copyright">
			<div class="container">
				<div class="row align-items-center">
					<!-- <div class="col-md-6">
						<div class="copyright-info">
							<span>Copyright &copy; <script>
									document.write(new Date().getFullYear())
								</script>, Designed &amp; Developed by <a href="...">...</a></span>
						</div>
					</div> -->

					<div class="col-md-12">
						<?php wp_nav_menu( array(
								'menu'            => 'Footer menu', // (string) название выводимого меню (указывается в админке при создании меню, приоритетнее, чем указанное местоположение theme_location - если указано, то параметр theme_location игнорируется)
								'container'       => 'div', // (string) контейнер меню. Обёртка ul. Указывается тег контейнера (по умолчанию тег div)
								'container_class' => 'footer-menu text-center text-md-right', // (string) class контейнера (div тега)
								'container_id'    => 'navbar-collapse', // (string) id контейнера (div тега)
								'menu_class'      => 'list-unstyled', // (string) class самого меню (ul тега)
								'menu_id'         => '', // (string) id самого меню (ul тега)
								'echo'            => true, // (boolean) выводить на экран или возвращать для обработки
								'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback', // (string) используемая (резервная) функция, если меню не существует (не удалось получить)
								'before'          => '', // (string) текст перед <a> каждой ссылки
								'after'           => '', // (string) текст после </a> каждой ссылки
								'link_before'     => '', // (string) текст перед анкором (текстом) ссылки
								'link_after'      => '', // (string) текст после анкора (текста) ссылки
								'depth'           => 0, // (integer) глубина вложенности (0 - неограничена, 2 - двухуровневое меню)
								'walker'          => new WP_Bootstrap_Navwalker(), // (object) класс собирающий меню. Default: new Walker_Nav_Menu
								'theme_location'  => 'footer-menu' // (string) расположение меню в шаблоне. (указывается ключ которым было зарегистрировано меню в функции register_nav_menus)
							) );
						?>
					</div>
				</div><!-- Row end -->

				<div id="back-to-top" data-spy="affix" data-offset-top="10" class="back-to-top position-fixed">
					<button class="btn btn-primary" title="Back to Top">
						<i class="fa fa-angle-double-up"></i>
					</button>
				</div>
			</div><!-- Container end -->
		</div><!-- Copyright end -->
	</footer><!-- Footer end -->
</div><!-- Body inner end -->
<?php wp_footer();?>
</body>
</html>