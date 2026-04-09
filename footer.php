<?php
/**
 * Footer - 共通フッター
 *
 * @package Yokohamabashi_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<footer class="site-footer">
	<div class="site-footer__top">
		<div class="site-footer__inner container">
			<div class="site-footer__info">
				<p class="site-footer__name"><?php bloginfo( 'name' ); ?></p>
				<address class="site-footer__address">
					〒232-0024 神奈川県横浜市南区浦舟町
				</address>
			</div>

			<nav class="site-footer__nav">
				<a href="<?php echo esc_url( get_post_type_archive_link( 'shop' ) ); ?>">店舗一覧</a>
				<?php
				$about_page   = get_page_by_path( 'about' );
				$access_page  = get_page_by_path( 'access' );
				$contact_page = get_page_by_path( 'contact' );
				?>
				<?php if ( $about_page ) : ?>
					<a href="<?php echo esc_url( get_permalink( $about_page ) ); ?>">商店街について</a>
				<?php endif; ?>
				<?php if ( $access_page ) : ?>
					<a href="<?php echo esc_url( get_permalink( $access_page ) ); ?>">アクセス</a>
				<?php endif; ?>
				<?php if ( $contact_page ) : ?>
					<a href="<?php echo esc_url( get_permalink( $contact_page ) ); ?>">お問い合わせ</a>
				<?php endif; ?>
			</nav>

			<?php
			$front_page_id   = get_option( 'page_on_front' );
			$footer_x_url        = $front_page_id ? get_field( 'front_x_url', $front_page_id ) : '';
			$footer_tiktok_url   = $front_page_id ? get_field( 'front_tiktok_url', $front_page_id ) : '';
			$footer_instagram_url = $front_page_id ? get_field( 'front_instagram_url', $front_page_id ) : '';
			?>
			<div class="site-footer__sns">
				<ul class="sns-list">
					<li class="sns-list__item">
						<a href="<?php echo esc_url( $footer_x_url ? $footer_x_url : '#' ); ?>" class="sns-list__link" aria-label="X（旧Twitter）" target="_blank" rel="noopener noreferrer">
							<svg class="sns-list__icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
								<path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.74l7.73-8.835L1.254 2.25H8.08l4.264 5.636 5.9-5.636zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z"/>
							</svg>
						</a>
					</li>
					<li class="sns-list__item">
						<a href="<?php echo esc_url( $footer_tiktok_url ? $footer_tiktok_url : '#' ); ?>" class="sns-list__link" aria-label="TikTok" target="_blank" rel="noopener noreferrer">
							<svg class="sns-list__icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
								<path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.33 6.33 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V9.28a8.27 8.27 0 0 0 4.84 1.54V7.37a4.85 4.85 0 0 1-1.07-.68z"/>
							</svg>
						</a>
					</li>
					<li class="sns-list__item">
						<a href="<?php echo esc_url( $footer_instagram_url ? $footer_instagram_url : '#' ); ?>" class="sns-list__link" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
							<svg class="sns-list__icon" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
								<path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
							</svg>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="site-footer__bottom">
		<div class="container">
			<p class="site-footer__copyright">
				<small>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></small>
			</p>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
