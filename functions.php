<?php
/**
 * Functions - テーマ機能ファイル
 *
 * @package Yokohamabashi_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// テーマサポート
require get_template_directory() . '/inc/theme-support.php';

// CSS/JS 読み込み
require get_template_directory() . '/inc/enqueue.php';

// カスタム投稿タイプ
require get_template_directory() . '/inc/custom-post-types.php';

// タクソノミー
require get_template_directory() . '/inc/taxonomies.php';

// ACFフィールド
require get_template_directory() . '/inc/acf-fields.php';

// テンプレートヘルパー
require get_template_directory() . '/inc/template-tags.php';

// Customizer設定
require get_template_directory() . '/inc/customizer.php';

// 店舗CSVインポート（管理画面のみ）
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin-import.php';
}
