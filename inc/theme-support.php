<?php
/**
 * Theme Support - テーマ機能の有効化
 *
 * @package Yokohamabashi_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * テーマサポートを設定
 */
function yokohamabashi_setup() {
	// タイトルタグの自動出力
	add_theme_support( 'title-tag' );

	// アイキャッチ画像
	add_theme_support( 'post-thumbnails' );

	// HTML5マークアップ
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// カスタムロゴ
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 70,
			'width'       => 200,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// ナビゲーションメニュー
	register_nav_menus(
		array(
			'primary' => 'メインメニュー',
			'mobile'  => 'モバイルメニュー',
		)
	);
}
add_action( 'after_setup_theme', 'yokohamabashi_setup' );
