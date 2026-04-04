<?php
/**
 * カスタム投稿タイプ登録
 *
 * @package Yokohamabashi_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * カスタム投稿タイプ「店舗情報」を登録
 */
function yokohamabashi_register_post_types() {
	register_post_type(
		'shop',
		array(
			'labels'       => array(
				'name'               => '店舗情報',
				'singular_name'      => '店舗',
				'add_new'            => '新規店舗追加',
				'add_new_item'       => '新規店舗を追加',
				'edit_item'          => '店舗を編集',
				'new_item'           => '新規店舗',
				'view_item'          => '店舗を表示',
				'search_items'       => '店舗を検索',
				'not_found'          => '店舗が見つかりません',
				'not_found_in_trash' => 'ゴミ箱に店舗はありません',
				'all_items'          => 'すべての店舗',
				'menu_name'          => '店舗情報',
			),
			'public'       => true,
			'has_archive'  => true,
			'rewrite'      => array( 'slug' => 'shop' ),
			'menu_icon'    => 'dashicons-store',
			'supports'     => array( 'title', 'thumbnail' ),
			'show_in_rest' => true,
		)
	);
}
add_action( 'init', 'yokohamabashi_register_post_types' );
