<?php
/**
 * タクソノミー登録
 *
 * @package Yokohamabashi_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * タクソノミー「業種」を登録
 */
function yokohamabashi_register_taxonomies() {
	register_taxonomy(
		'shop_category',
		'shop',
		array(
			'labels'       => array(
				'name'          => '業種',
				'singular_name' => '業種',
				'search_items'  => '業種を検索',
				'all_items'     => 'すべての業種',
				'parent_item'   => '親業種',
				'edit_item'     => '業種を編集',
				'update_item'   => '業種を更新',
				'add_new_item'  => '新しい業種を追加',
				'new_item_name' => '新規業種名',
				'menu_name'     => '業種',
			),
			'hierarchical' => true,
			'rewrite'      => array( 'slug' => 'shop-category' ),
			'show_in_rest' => true,
		)
	);
}
add_action( 'init', 'yokohamabashi_register_taxonomies' );
