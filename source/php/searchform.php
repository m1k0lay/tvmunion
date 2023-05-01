<?php
/**
 * The template for displaying search forms.
 */
?>
<form class="search-form my-2 my-lg-0" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="search-block input-group" style="display: none;">
		<label for="search-field" class="w-100 mb-0">
			<input type="text" id="search-field" name="s" class="form-control" placeholder="<?php esc_attr_e( 'Поиск', 'them-es-starter-theme-bootstrap-5' ); ?>" title="<?php esc_attr_e( 'Поиск', 'them-es-starter-theme-bootstrap-5' ); ?>">
			<!-- <button type="submit" name="submit" class="btn btn-outline-secondary"><?php // esc_html_e( 'Поиск', 'them-es-starter-theme-bootstrap-5' ); ?></button> -->
		</label>
		<span class="search-close">&times;</span>
	</div><!-- Site search end -->
</form>