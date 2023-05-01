<?php
/**
 * The template for displaying "not found" content in the Blog Archives.
 */

$search_enabled = get_theme_mod( 'search_enabled', '1' ); // Get custom meta-value.
?>
<article id="post-0" class="post no-results not-found">
	<header class="entry-header">
		<h1 class="entry-title"><?php esc_html_e( 'Ничего не найдено', 'them-es-starter-theme-bootstrap-5' ); ?></h1>
	</header><!-- /.entry-header -->
	<div class="entry-content">
		<p><?php esc_html_e( 'Извините, но по данному запросу ничего найти не удалось.', 'them-es-starter-theme-bootstrap-5' ); ?></p>
	</div><!-- /.entry-content -->
</article><!-- /#post-0 -->
