<?php
/**
 * 店舗カードテンプレート
 *
 * @package Yokohamabashi_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$shop_hours = function_exists( 'get_field' ) ? get_field( 'shop_hours' ) : '';
$shop_tel   = function_exists( 'get_field' ) ? get_field( 'shop_tel' ) : '';
$shop_image = function_exists( 'get_field' ) ? get_field( 'shop_image' ) : null;
$shop_terms   = get_the_terms( get_the_ID(), 'shop_category' );
$category_slugs = array();

if ( ! empty( $shop_terms ) && ! is_wp_error( $shop_terms ) ) {
	foreach ( $shop_terms as $term ) {
		$category_slugs[] = $term->slug;
	}
}
?>

<article class="shop-card" data-category="<?php echo esc_attr( implode( ' ', $category_slugs ) ); ?>">
	<a href="<?php the_permalink(); ?>" class="shop-card__link">
		<div class="shop-card__thumbnail">
			<?php
			$shop_image_alt = ! empty( $shop_image['alt'] ) ? $shop_image['alt'] : get_the_title();
			?>
			<?php if ( $shop_image ) : ?>
				<img src="<?php echo esc_url( $shop_image['sizes']['medium'] ); ?>" alt="<?php echo esc_attr( $shop_image_alt ); ?>">
			<?php elseif ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'medium' ); ?>
			<?php else : ?>
				<div class="shop-card__no-image">No Image</div>
			<?php endif; ?>
		</div>

		<div class="shop-card__content">
			<h2 class="shop-card__title"><?php the_title(); ?></h2>

			<?php if ( ! empty( $shop_terms ) && ! is_wp_error( $shop_terms ) ) : ?>
				<div class="shop-card__tags">
					<?php foreach ( $shop_terms as $term ) : ?>
						<span class="shop-card__tag"><?php echo esc_html( $term->name ); ?></span>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php if ( $shop_hours ) : ?>
				<p class="shop-card__hours">
					<span class="shop-card__label">営業時間:</span>
					<?php echo esc_html( $shop_hours ); ?>
				</p>
			<?php endif; ?>

			<?php if ( $shop_tel ) : ?>
				<p class="shop-card__tel">
					<span class="shop-card__label">TEL:</span>
					<?php echo esc_html( $shop_tel ); ?>
				</p>
			<?php endif; ?>
		</div>
	</a>
</article>
