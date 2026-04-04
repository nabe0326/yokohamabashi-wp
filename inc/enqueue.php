<?php
/**
 * Enqueue - CSS/JS の読み込み
 *
 * @package Yokohamabashi_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * スタイルとスクリプトを読み込む
 */
function yokohamabashi_enqueue_assets() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// 共通CSS
	wp_enqueue_style(
		'yokohamabashi-common',
		get_template_directory_uri() . '/assets/css/common.css',
		array(),
		$theme_version
	);

	// ヘッダーCSS
	wp_enqueue_style(
		'yokohamabashi-header',
		get_template_directory_uri() . '/assets/css/header.css',
		array( 'yokohamabashi-common' ),
		$theme_version
	);

	// フッターCSS
	wp_enqueue_style(
		'yokohamabashi-footer',
		get_template_directory_uri() . '/assets/css/footer.css',
		array( 'yokohamabashi-common' ),
		$theme_version
	);

	// ナビゲーションJS
	wp_enqueue_script(
		'yokohamabashi-navigation',
		get_template_directory_uri() . '/assets/js/navigation.js',
		array(),
		$theme_version,
		true
	);

	// トップページ
	if ( is_front_page() ) {
		wp_enqueue_style(
			'yokohamabashi-front-page',
			get_template_directory_uri() . '/assets/css/front-page.css',
			array( 'yokohamabashi-common' ),
			$theme_version
		);
	}

	// 店舗一覧・店舗個別・トップページ（ピックアップ店舗）
	if ( is_front_page() || is_post_type_archive( 'shop' ) || is_singular( 'shop' ) ) {
		wp_enqueue_style(
			'yokohamabashi-shop',
			get_template_directory_uri() . '/assets/css/shop.css',
			array( 'yokohamabashi-common' ),
			$theme_version
		);
	}

	// 店舗一覧のみ（フィルタJS）
	if ( is_post_type_archive( 'shop' ) ) {
		wp_enqueue_script(
			'yokohamabashi-shop-filter',
			get_template_directory_uri() . '/assets/js/shop-filter.js',
			array(),
			$theme_version,
			true
		);
	}

	// 固定ページ（アクセス・商店街について・お問い合わせ）
	if ( is_page( array( 'access', 'about', 'contact' ) ) ) {
		wp_enqueue_style(
			'yokohamabashi-page',
			get_template_directory_uri() . '/assets/css/page.css',
			array( 'yokohamabashi-common' ),
			$theme_version
		);
	}

	// お知らせ一覧・個別
	if ( is_home() || is_archive() || is_singular( 'post' ) ) {
		wp_enqueue_style(
			'yokohamabashi-archive',
			get_template_directory_uri() . '/assets/css/archive.css',
			array( 'yokohamabashi-common' ),
			$theme_version
		);
	}
}
add_action( 'wp_enqueue_scripts', 'yokohamabashi_enqueue_assets' );
