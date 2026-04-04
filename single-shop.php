<?php
/**
 * 店舗個別ページテンプレート
 *
 * @package Yokohamabashi_Theme
 */

get_header();

$shop_hours       = function_exists( 'get_field' ) ? get_field( 'shop_hours' ) : '';
$shop_holiday     = function_exists( 'get_field' ) ? get_field( 'shop_holiday' ) : '';
$shop_tel         = function_exists( 'get_field' ) ? get_field( 'shop_tel' ) : '';
$shop_image       = function_exists( 'get_field' ) ? get_field( 'shop_image' ) : null;
$shop_address     = function_exists( 'get_field' ) ? get_field( 'shop_address' ) : '';
$shop_map_embed   = function_exists( 'get_field' ) ? get_field( 'shop_map_embed' ) : '';
// oEmbedはデフォルトget_fieldがHTMLを返すため、第3引数falseでURLのみ取得してwp_oembed_getに渡す。
$shop_video_url   = function_exists( 'get_field' ) ? get_field( 'shop_video', false, false ) : '';
$shop_description = function_exists( 'get_field' ) ? get_field( 'shop_description' ) : '';
$shop_terms            = get_the_terms( get_the_ID(), 'shop_category' );
$shop_info_has_content = $shop_hours || $shop_holiday || $shop_tel || $shop_address;
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

				<?php if ( $shop_info_has_content ) : ?>
					<section class="shop-detail__info-card" aria-labelledby="shop-detail-info-heading">
						<h2 class="shop-detail__info-heading" id="shop-detail-info-heading">店舗情報</h2>
						<div class="shop-detail__info-table-wrap">
							<table class="shop-detail__info-table">
								<tbody>
									<?php if ( $shop_hours ) : ?>
										<tr>
											<th scope="row">営業時間</th>
											<td><?php echo esc_html( $shop_hours ); ?></td>
										</tr>
									<?php endif; ?>

									<?php if ( $shop_holiday ) : ?>
										<tr>
											<th scope="row">定休日</th>
											<td><?php echo esc_html( $shop_holiday ); ?></td>
										</tr>
									<?php endif; ?>

									<?php if ( $shop_tel ) : ?>
										<tr>
											<th scope="row">電話番号</th>
											<td>
												<a class="shop-detail__info-link" href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $shop_tel ) ); ?>"><?php echo esc_html( $shop_tel ); ?></a>
											</td>
										</tr>
									<?php endif; ?>

									<?php if ( $shop_address ) : ?>
										<tr>
											<th scope="row">住所</th>
											<td><?php echo esc_html( $shop_address ); ?></td>
										</tr>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					</section>
				<?php endif; ?>

				<?php
				$shop_video_embed = '';
				if ( $shop_video_url ) {
					$shop_video_embed = wp_oembed_get(
						$shop_video_url,
						array(
							'width'  => 640,
							'height' => 360,
						)
					);
				}
				// 生URLが取れない／oEmbed失敗時はACFの整形済みHTMLにフォールバック
				if ( ! $shop_video_embed && function_exists( 'get_field' ) ) {
					$shop_video_embed = get_field( 'shop_video', false, true );
				}
				?>
				<?php if ( $shop_video_embed ) : ?>
					<div class="shop-detail__video">
						<?php
						$shop_video_allowed = array(
							'div'        => array(
								'class' => true,
								'style' => true,
							),
							'figure'     => array(
								'class' => true,
								'style' => true,
							),
							'figcaption' => array(
								'class' => true,
							),
							'p'          => array(
								'class' => true,
								'style' => true,
							),
							'span'       => array(
								'class' => true,
								'style' => true,
							),
							'iframe'     => array(
								'src'             => true,
								'width'           => true,
								'height'          => true,
								'style'           => true,
								'class'           => true,
								'title'           => true,
								'name'            => true,
								'frameborder'     => true,
								'allowfullscreen' => true,
								'allow'           => true,
								'loading'         => true,
								'referrerpolicy'  => true,
								'sandbox'         => true,
							),
						);
						echo wp_kses( $shop_video_embed, $shop_video_allowed );
						?>
					</div>
				<?php endif; ?>

				<?php if ( $shop_map_embed ) : ?>
					<div class="shop-detail__map">
						<?php
						// Google Maps iframe用の許可タグ
						$allowed_html = array(
							'iframe' => array(
								'src'             => true,
								'width'           => true,
								'height'          => true,
								'style'           => true,
								'frameborder'     => true,
								'allowfullscreen' => true,
								'loading'         => true,
								'referrerpolicy'  => true,
							),
						);
						echo wp_kses( $shop_map_embed, $allowed_html );
						?>
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
