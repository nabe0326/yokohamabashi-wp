<?php
/**
 * トップページテンプレート
 *
 * @package Yokohamabashi_Theme
 */

get_header();

$front_settings_id = (int) get_option( 'page_on_front' );
$acf_ok            = $front_settings_id > 0 && function_exists( 'get_field' );

$hero_image = ( $acf_ok ) ? get_field( 'front_hero_image', $front_settings_id ) : null;
if ( ! is_array( $hero_image ) || empty( $hero_image['url'] ) ) {
	$hero_image = null;
}

$hero_lead = ( $acf_ok ) ? get_field( 'front_hero_lead', $front_settings_id ) : '';
if ( ! is_string( $hero_lead ) ) {
	$hero_lead = '';
}

$intro_title = ( $acf_ok ) ? get_field( 'front_intro_title', $front_settings_id ) : '';
if ( ! is_string( $intro_title ) || '' === trim( $intro_title ) ) {
	$intro_title = '暮らしの幸せが集まる場所';
}

$intro_body = ( $acf_ok ) ? get_field( 'front_intro_body', $front_settings_id ) : '';
if ( ! is_string( $intro_body ) || '' === trim( $intro_body ) ) {
	$intro_body = "横浜橋通り沿いに広がる商店街。食料品・日用品・飲食店まで、暮らしに役立つお店が揃います。地域の皆さまに親しまれてきたまちのにぎわいを、ぜひのぞいてみてください。";
}

$pickup_raw = ( $acf_ok ) ? get_field( 'front_pickup_shops', $front_settings_id ) : false;
$pickup_ids = array();
if ( is_array( $pickup_raw ) ) {
	$pickup_ids = array_values( array_filter( array_map( 'absint', $pickup_raw ) ) );
} elseif ( is_numeric( $pickup_raw ) ) {
	$pickup_ids = array( absint( $pickup_raw ) );
}

$shop_counts = wp_count_posts( 'shop' );
$shop_total  = ( $shop_counts && isset( $shop_counts->publish ) ) ? (int) $shop_counts->publish : 0;

$shop_archive_url = get_post_type_archive_link( 'shop' );
$access_page_obj  = get_page_by_path( 'access' );
$about_page_obj   = get_page_by_path( 'about' );
$access_url       = ( $access_page_obj && isset( $access_page_obj->ID ) ) ? get_permalink( $access_page_obj ) : '';
$about_url        = ( $about_page_obj && isset( $about_page_obj->ID ) ) ? get_permalink( $about_page_obj ) : '';

$hero_section_class = 'hero';
if ( $hero_image ) {
	$hero_section_class .= ' hero--has-image';
}
?>

<main class="front-page">
	<!-- ヒーローセクション -->
	<section class="<?php echo esc_attr( $hero_section_class ); ?>">
		<?php if ( $hero_image ) : ?>
			<div class="hero__media" aria-hidden="true">
				<img
					class="hero__media-img"
					src="<?php echo esc_url( $hero_image['url'] ); ?>"
					alt=""
					<?php
					if ( ! empty( $hero_image['width'] ) && ! empty( $hero_image['height'] ) ) {
						echo ' width="' . esc_attr( (string) $hero_image['width'] ) . '" height="' . esc_attr( (string) $hero_image['height'] ) . '"';
					}
					?>
					decoding="async"
					fetchpriority="high"
				>
			</div>
			<div class="hero__overlay" aria-hidden="true"></div>
		<?php endif; ?>
		<div class="hero__inner">
			<p class="hero__eyebrow">地域に根ざした商店街</p>
			<h1 class="hero__title">横浜橋商店街</h1>
			<p class="hero__catchcopy">毎日が、お買い得。</p>
			<?php if ( '' !== trim( $hero_lead ) ) : ?>
				<p class="hero__lead"><?php echo esc_html( $hero_lead ); ?></p>
			<?php endif; ?>
			<div class="hero__actions">
				<?php if ( $shop_archive_url ) : ?>
					<a href="<?php echo esc_url( $shop_archive_url ); ?>" class="hero__cta hero__cta--primary">店舗を見る</a>
				<?php endif; ?>
				<?php if ( $access_url ) : ?>
					<a href="<?php echo esc_url( $access_url ); ?>" class="hero__cta hero__cta--secondary">アクセス</a>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- イントロ -->
	<section class="intro-section" aria-labelledby="intro-section-heading">
		<div class="container intro-section__grid">
			<div class="intro-section__main">
				<h2 id="intro-section-heading" class="intro-section__title"><?php echo esc_html( $intro_title ); ?></h2>
				<div class="intro-section__body">
					<?php echo wp_kses_post( nl2br( esc_html( $intro_body ), false ) ); ?>
				</div>
			</div>
			<aside class="intro-section__aside" aria-label="<?php esc_attr_e( '商店街のハイライト', 'yokohamabashi-theme' ); ?>">
				<ul class="highlight-cards">
					<li class="highlight-cards__item">
						<span class="highlight-cards__value" aria-hidden="true"><?php echo esc_html( (string) $shop_total ); ?></span>
						<span class="highlight-cards__unit" aria-hidden="true">店舗</span>
						<span class="highlight-cards__label">掲載のお店（随時更新）</span>
					</li>
					<li class="highlight-cards__item highlight-cards__item--soft">
						<span class="highlight-cards__head">業種多彩</span>
						<span class="highlight-cards__label">食料品・飲食・サービスなど</span>
					</li>
					<li class="highlight-cards__item highlight-cards__item--soft">
						<span class="highlight-cards__head">見つける・楽しむ</span>
						<span class="highlight-cards__label">歩いてまちを体感できます</span>
					</li>
				</ul>
			</aside>
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
				if ( count( $pickup_ids ) > 0 ) {
					$shop_query = new WP_Query(
						array(
							'post_type'      => 'shop',
							'post__in'       => $pickup_ids,
							'orderby'        => 'post__in',
							'posts_per_page' => count( $pickup_ids ),
						)
					);
				} else {
					$shop_query = new WP_Query(
						array(
							'post_type'      => 'shop',
							'posts_per_page' => 6,
						)
					);
				}

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
			<?php if ( $shop_archive_url ) : ?>
			<a href="<?php echo esc_url( $shop_archive_url ); ?>" class="pickup-section__more">店舗一覧へ</a>
			<?php endif; ?>
		</div>
	</section>

	<!-- バナーリンクセクション -->
	<section class="banner-section">
		<div class="container">
			<div class="banner-grid">
				<?php if ( $shop_archive_url ) : ?>
				<a href="<?php echo esc_url( $shop_archive_url ); ?>" class="banner-card banner-card--accent-primary">
					<span class="banner-card__icon dashicons dashicons-store" aria-hidden="true"></span>
					<span class="banner-card__title">お店情報</span>
					<span class="banner-card__hint">一覧から探す</span>
				</a>
				<?php endif; ?>
				<?php if ( $access_url ) : ?>
				<a href="<?php echo esc_url( $access_url ); ?>" class="banner-card banner-card--accent-secondary">
					<span class="banner-card__icon dashicons dashicons-location" aria-hidden="true"></span>
					<span class="banner-card__title">アクセス</span>
					<span class="banner-card__hint">行き方を見る</span>
				</a>
				<?php endif; ?>
				<?php if ( $about_url ) : ?>
				<a href="<?php echo esc_url( $about_url ); ?>" class="banner-card banner-card--accent-warm">
					<span class="banner-card__icon dashicons dashicons-info" aria-hidden="true"></span>
					<span class="banner-card__title">商店街について</span>
					<span class="banner-card__hint">歴史・活動</span>
				</a>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- SNS・関連リンクセクション -->
	<section class="links-section">
		<div class="container">
			<h2 class="section-title">SNS・関連リンク</h2>
			<div class="links-grid">
				<a href="#" class="link-card" target="_blank" rel="noopener noreferrer">
					<span class="link-card__icon dashicons dashicons-facebook" aria-hidden="true"></span>
					<span class="link-card__title">Facebook</span>
				</a>
				<a href="#" class="link-card link-card--instagram" target="_blank" rel="noopener noreferrer">
					<span class="link-card__icon dashicons dashicons-instagram" aria-hidden="true"></span>
					<span class="link-card__title">Instagram</span>
				</a>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
