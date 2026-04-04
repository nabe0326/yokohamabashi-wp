<?php
/**
 * テンプレート用ヘルパー
 *
 * @package Yokohamabashi_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 投稿（お知らせ）一覧ページのパーマリンクを返す。
 *
 * 管理画面「設定」→「表示設定」で「投稿ページ」に固定ページを指定したときに有効。
 * フロントページを固定ページにしている場合は、投稿用の固定ページ（中身は空で可）を別に作り、
 * 同画面の「投稿ページ」にそのページを割り当てる。
 *
 * @return string URL。未設定で取得できない場合は空文字。
 */
function yokohamabashi_get_posts_page_url() {
	$posts_page_id = (int) get_option( 'page_for_posts' );
	if ( $posts_page_id > 0 ) {
		$url = get_permalink( $posts_page_id );
		return $url ? $url : '';
	}
	if ( 'posts' === get_option( 'show_on_front' ) ) {
		return home_url( '/' );
	}
	return '';
}
