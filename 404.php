<?php
/**
 * 404エラーページ
 *
 * @package Yokohamabashi_Theme
 */

get_header();
?>

<main class="error-404">
	<div class="container">
		<div class="error-404__inner">
			<h1 class="error-404__title">404</h1>
			<p class="error-404__message">お探しのページが見つかりませんでした</p>
			<p class="error-404__description">
				申し訳ありません。お探しのページは移動または削除された可能性があります。<br>
				URLをご確認いただくか、以下のリンクからお探しください。
			</p>

			<div class="error-404__search">
				<p class="error-404__search-label">サイト内検索</p>
				<?php get_search_form(); ?>
			</div>

			<div class="error-404__links">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="error-404__link error-404__link--primary">
					トップページへ戻る
				</a>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'shop' ) ); ?>" class="error-404__link">
					店舗一覧を見る
				</a>
			</div>
		</div>
	</div>
</main>

<?php
get_footer();
