<?php
/**
 * 検索結果ページ
 *
 * @package Yokohamabashi_Theme
 */

get_header();
?>

<div class="search-results">
	<div class="container">
		<h1 class="page-title">
			「<?php echo esc_html( get_search_query() ); ?>」の検索結果
		</h1>

		<?php if ( have_posts() ) : ?>
			<p class="search-results__count">
				<?php
				global $wp_query;
				printf(
					esc_html( '%s件の記事が見つかりました' ),
					esc_html( $wp_query->found_posts )
				);
				?>
			</p>

			<div class="news-list">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/news-card' );
				endwhile;
				?>
			</div>

			<nav class="pagination">
				<?php
				the_posts_pagination(
					array(
						'mid_size'  => 2,
						'prev_text' => '&laquo; 前へ',
						'next_text' => '次へ &raquo;',
					)
				);
				?>
			</nav>

		<?php else : ?>
			<div class="search-results__empty">
				<p class="search-results__empty-message">
					「<?php echo esc_html( get_search_query() ); ?>」に一致する記事が見つかりませんでした。
				</p>
				<p class="search-results__empty-suggestion">
					別のキーワードで検索してみてください。
				</p>

				<div class="search-results__search">
					<?php get_search_form(); ?>
				</div>

				<div class="search-results__links">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="back-link">
						トップページへ戻る
					</a>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>

<?php
get_footer();
