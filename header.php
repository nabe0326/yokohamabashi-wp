<?php
/**
 * Header - 共通ヘッダー
 *
 * @package Yokohamabashi_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
	<div class="site-header__inner container">
		<div class="site-header__logo">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-header__logo-link">
					<?php bloginfo( 'name' ); ?>
				</a>
			<?php endif; ?>
		</div>

		<nav class="site-nav" aria-label="メインナビゲーション">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'site-nav__list',
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>

		<button
			class="hamburger"
			type="button"
			aria-controls="mobile-drawer"
			aria-expanded="false"
			aria-label="メニューを開く"
		>
			<span class="hamburger__line"></span>
			<span class="hamburger__line"></span>
			<span class="hamburger__line"></span>
		</button>
	</div>
</header>

<div id="mobile-drawer" class="mobile-drawer" aria-hidden="true">
	<div class="mobile-drawer__overlay"></div>
	<div class="mobile-drawer__content">
		<button
			class="mobile-drawer__close"
			type="button"
			aria-label="メニューを閉じる"
		>
			<span class="mobile-drawer__close-icon"></span>
		</button>
		<nav class="mobile-nav" aria-label="モバイルナビゲーション">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'mobile',
					'container'      => false,
					'menu_class'     => 'mobile-nav__list',
					'fallback_cb'    => function() {
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'container'      => false,
								'menu_class'     => 'mobile-nav__list',
								'fallback_cb'    => false,
							)
						);
					},
				)
			);
			?>
		</nav>
	</div>
</div>
