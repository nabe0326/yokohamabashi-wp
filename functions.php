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
