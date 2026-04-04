<?php
/**
 * トップページテンプレート
 *
 * @package Yokohamabashi_Theme
 */

get_header();
?>

<main class="front-page">
	<!-- ヒーローセクション -->
	<section class="hero">
		<div class="hero__inner">
			<h1 class="hero__title">横浜橋商店街</h1>
			<p class="hero__catchcopy">毎日が、お買い得。</p>
		</div>
	</section>

	<!-- お知らせセクション -->
	<section class="news-section">
		<div class="container">
			<h2 class="section-title">お知らせ</h2>
			<div class="news-list">
				<?php
				$news_query = new WP_Query(
					array(
						'post_type'      => 'post',
						'posts_per_page' => 5,
					)
				);

				if ( $news_query->have_posts() ) :
					while ( $news_query->have_posts() ) :
						$news_query->the_post();
						get_template_part( 'template-parts/news-card' );
					endwhile;
					wp_reset_postdata();
				else :
					?>
					<p>お知らせはありません。</p>
				<?php endif; ?>
			</div>
			<?php
			$posts_page_url = yokohamabashi_get_posts_page_url();
			if ( $posts_page_url ) :
				?>
			<a href="<?php echo esc_url( $posts_page_url ); ?>" class="news-section__more">お知らせ一覧へ</a>
				<?php
			endif;
			?>
		</div>
	</section>

	<!-- ピックアップ店舗セクション -->
	<section class="pickup-section">
		<div class="container">
			<h2 class="section-title">ピックアップ店舗</h2>
			<div class="pickup-grid">
				<?php
				$shop_query = new WP_Query(
					array(
						'post_type'      => 'shop',
						'posts_per_page' => 6,
					)
				);

				if ( $shop_query->have_posts() ) :
					while ( $shop_query->have_posts() ) :
						$shop_query->the_post();
						get_template_part( 'template-parts/shop-card' );
					endwhile;
					wp_reset_postdata();
				else :
					?>
					<p>店舗情報はありません。</p>
				<?php endif; ?>
			</div>
			<a href="<?php echo esc_url( get_post_type_archive_link( 'shop' ) ); ?>" class="pickup-section__more">店舗一覧へ</a>
		</div>
	</section>

	<!-- バナーリンクセクション -->
	<section class="banner-section">
		<div class="container">
			<div class="banner-grid">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'shop' ) ); ?>" class="banner-card">
					<span class="banner-card__icon dashicons dashicons-store"></span>
					<span class="banner-card__title">お店情報</span>
				</a>
				<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'access' ) ) ); ?>" class="banner-card">
					<span class="banner-card__icon dashicons dashicons-location"></span>
					<span class="banner-card__title">アクセス</span>
				</a>
				<a href="<?php echo esc_url( get_permalink( get_page_by_path( 'about' ) ) ); ?>" class="banner-card">
					<span class="banner-card__icon dashicons dashicons-info"></span>
					<span class="banner-card__title">商店街について</span>
				</a>
			</div>
		</div>
	</section>

	<!-- SNS・関連リンクセクション -->
	<section class="links-section">
		<div class="container">
			<h2 class="section-title">SNS・関連リンク</h2>
			<div class="links-grid">
				<a href="#" class="link-card" target="_blank" rel="noopener noreferrer">
					<span class="link-card__icon dashicons dashicons-facebook"></span>
					<span class="link-card__title">Facebook</span>
				</a>
				<a href="#" class="link-card" target="_blank" rel="noopener noreferrer">
					<span class="link-card__icon dashicons dashicons-instagram"></span>
					<span class="link-card__title">Instagram</span>
				</a>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
