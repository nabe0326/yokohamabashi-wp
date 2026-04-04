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
