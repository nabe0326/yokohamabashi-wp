<?php
/**
 * 店舗一覧ページテンプレート
 *
 * @package Yokohamabashi_Theme
 */

get_header();
?>

<main class="shop-archive">
	<section class="page-header-band">
		<div class="container page-header-band__inner">
			<span class="page-header-band__eyebrow">Shop Guide</span>
			<h1 class="page-header-band__title">店舗一覧</h1>
			<p class="page-header-band__lead">業種で絞り込みながら、気になるお店を見つけてください。</p>
		</div>
	</section>
	<div class="container page-main-content">

		<!-- 商店街イラストマップ -->
		<?php $map_image = get_theme_mod( 'shop_illustrated_map', '' ); ?>
		<?php if ( $map_image ) : ?>
		<section class="shop-map">
			<img
				src="<?php echo esc_url( $map_image ); ?>"
				alt="横浜橋商店街マップ"
				class="shop-map__image"
				loading="lazy"
			>
		</section>
		<?php else : ?>
		<section class="shop-map shop-map--empty">
			<p class="shop-map__placeholder">※ 外観 &gt; カスタマイズ の「商店街マップ画像」から画像を設定してください。</p>
		</section>
		<?php endif; ?>

		<!-- 検索・フィルタ -->
		<div class="shop-search">
			<label for="shop-search-input" class="visually-hidden">店舗名で検索</label>
			<input
				type="search"
				id="shop-search-input"
				class="shop-search__input"
				placeholder="店舗名で検索..."
			>
		</div>

		<!-- 業種フィルタ -->
		<section class="shop-filter">
			<button class="shop-filter__btn is-active" data-filter="all">すべて</button>
			<?php
			$terms = get_terms(
				array(
					'taxonomy'   => 'shop_category',
					'hide_empty' => true,
				)
			);

			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
				foreach ( $terms as $term ) :
					?>
					<button class="shop-filter__btn" data-filter="<?php echo esc_attr( $term->slug ); ?>">
						<?php echo esc_html( $term->name ); ?>
					</button>
					<?php
				endforeach;
			endif;
			?>
		</section>

		<!-- 店舗カードグリッド -->
		<section class="shop-grid">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/shop-card' );
				endwhile;
			else :
				?>
				<p class="no-shops">店舗情報がありません。</p>
			<?php endif; ?>
			<p class="shop-grid__no-results" style="display: none;">該当する店舗が見つかりませんでした。</p>
		</section>

		<!-- ページネーション -->
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
	</div>
</main>

<?php
get_footer();
