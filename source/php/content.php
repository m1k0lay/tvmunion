<?php
/**
 * The default template for displaying content.
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			if ( is_sticky() ) :
		?>
			<hgroup>
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Ссылка на %s', 'them-es-starter-theme-bootstrap-5' ), the_title_attribute( array( 'echo' => false ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h2>
				<h3 class="entry-format"><?php esc_html_e( 'Популярное', 'them-es-starter-theme-bootstrap-5' ); ?></h3>
			</hgroup>
		<?php
			else :
		?>
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Ссылка на %s', 'them-es-starter-theme-bootstrap-5' ), the_title_attribute( array( 'echo' => false ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
		<?php
			endif;

			if ( 'post' === get_post_type() ) :
		?>
			<div class="entry-meta">
				<?php themes_starter_article_posted_on(); ?>
			</div><!-- /.entry-meta -->
		<?php
			endif;
		?>
	</header><!-- /.entry-header -->

	<?php
		if ( is_search() ) : // Only display Excerpts for Search.
	?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- /.entry-summary -->
	<?php
		else :
	?>
		<div class="entry-content">
			<?php the_content( __( 'Далее <span class="meta-nav">&rarr;</span>', 'them-es-starter-theme-bootstrap-5' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Страниц:', 'them-es-starter-theme-bootstrap-5' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- /.entry-content -->
	<?php
		endif;
	?>

	<footer class="entry-meta">
		<?php
			$show_sep = false;
			if ( 'post' === get_post_type() ) : // Hide category and tag text for pages on Search.

				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'them-es-starter-theme-bootstrap-5' ) );
				if ( $categories_list ) :
			?>
					<span class="cat-links">
						<?php
							printf( __( '<span class="%1$s">Опубликовано в</span> %2$s', 'them-es-starter-theme-bootstrap-5' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
							$show_sep = true;
						?>
					</span>
			<?php
				endif;

				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'them-es-starter-theme-bootstrap-5' ) );
				if ( $tags_list ) :
					if ( $show_sep ) :
			?>
					<span class="sep"> | </span>
				<?php
					endif;
				?>
					<span class="tag-links">
						<?php
							printf( __( '<span class="%1$s">Отмечено</span> %2$s', 'them-es-starter-theme-bootstrap-5' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
							$show_sep = true;
						?>
					</span>
				<?php
				endif;
			endif;

			if ( comments_open() ) :
				if ( $show_sep ) :
		?>
				<span class="sep"> | </span>
			<?php
				endif;
			?>
			<span class="comments-link">
				<?php
					printf(
						esc_html__( 'Оставить комментарий', 'them-es-starter-theme-bootstrap-5' ),
						get_the_title()
					);
				?>
			</span>
		<?php
			endif;
		?>

		<a href="<?php the_permalink(); ?>" class="btn btn-secondary"><?php esc_html_e( 'Далее', 'them-es-starter-theme-bootstrap-5' ); ?></a>

		<?php edit_post_link( __( 'Изменить', 'them-es-starter-theme-bootstrap-5' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- /.entry-meta -->
</article><!-- /#post-<?php the_ID(); ?> -->
