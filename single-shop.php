<?php
/**
 * 店舗個別ページテンプレート
 *
 * @package Yokohamabashi_Theme
 */

get_header();

$shop_hours       = get_field( 'shop_hours' );
$shop_holiday     = get_field( 'shop_holiday' );
$shop_tel         = get_field( 'shop_tel' );
$shop_image       = get_field( 'shop_image' );
$shop_address     = get_field( 'shop_address' );
$shop_map_embed   = get_field( 'shop_map_embed' );
$shop_description = get_field( 'shop_description' );
$shop_terms       = get_the_terms( get_the_ID(), 'shop_category' );
?>

<main class="shop-single">
	<div class="container">
		<article class="shop-detail">
			<!-- 店舗写真 -->
			<div class="shop-detail__image">
				<?php if ( $shop_image ) : ?>
					<img src="<?php echo esc_url( $shop_image['sizes']['large'] ); ?>" alt="<?php echo esc_attr( $shop_image['alt'] ); ?>">
				<?php elseif ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'large' ); ?>
				<?php endif; ?>
			</div>

			<!-- 店舗情報 -->
			<div class="shop-detail__content">
				<h1 class="shop-detail__title"><?php the_title(); ?></h1>

				<?php if ( ! empty( $shop_terms ) && ! is_wp_error( $shop_terms ) ) : ?>
					<div class="shop-detail__tags">
						<?php foreach ( $shop_terms as $term ) : ?>
							<span class="shop-detail__tag"><?php echo esc_html( $term->name ); ?></span>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<?php if ( $shop_description ) : ?>
					<p class="shop-detail__description"><?php echo esc_html( $shop_description ); ?></p>
				<?php endif; ?>

				<dl class="shop-detail__info">
					<?php if ( $shop_hours ) : ?>
						<dt>営業時間</dt>
						<dd><?php echo esc_html( $shop_hours ); ?></dd>
					<?php endif; ?>

					<?php if ( $shop_holiday ) : ?>
						<dt>定休日</dt>
						<dd><?php echo esc_html( $shop_holiday ); ?></dd>
					<?php endif; ?>

					<?php if ( $shop_tel ) : ?>
						<dt>電話番号</dt>
						<dd><a href="tel:<?php echo esc_attr( $shop_tel ); ?>"><?php echo esc_html( $shop_tel ); ?></a></dd>
					<?php endif; ?>

					<?php if ( $shop_address ) : ?>
						<dt>住所</dt>
						<dd><?php echo esc_html( $shop_address ); ?></dd>
					<?php endif; ?>
				</dl>

				<?php if ( $shop_map_embed ) : ?>
					<div class="shop-detail__map">
						<?php echo $shop_map_embed; ?>
					</div>
				<?php endif; ?>
			</div>
		</article>

		<!-- 戻りリンク -->
		<div class="shop-single__back">
			<a href="<?php echo esc_url( get_post_type_archive_link( 'shop' ) ); ?>" class="back-link">
				&larr; 店舗一覧に戻る
			</a>
		</div>
	</div>
</main>

<?php
get_footer();
