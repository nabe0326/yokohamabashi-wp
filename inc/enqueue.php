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

	// ページ別CSS（後のタスクで追加）
	// if ( is_front_page() ) {
	// 	wp_enqueue_style( 'yokohamabashi-front-page', ... );
	// }
}
add_action( 'wp_enqueue_scripts', 'yokohamabashi_enqueue_assets' );
