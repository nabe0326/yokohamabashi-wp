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

		<!-- Google Map -->
		<section class="shop-map">
			<iframe
				src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3250.8!2d139.6194!3d35.4344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2z5qiq5rWc5qmL5ZWG5bqX6KGX!5e0!3m2!1sja!2sjp!4v1234567890"
				width="100%"
				height="300"
				style="border:0;"
				allowfullscreen=""
				loading="lazy"
				referrerpolicy="no-referrer-when-downgrade"
			></iframe>
		</section>

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
