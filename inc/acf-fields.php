<?php
/**
 * ACFフィールド定義
 *
 * @package Yokohamabashi_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 店舗情報のACFフィールドグループを登録
 */
function yokohamabashi_register_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'      => 'group_shop_info',
			'title'    => '店舗詳細情報',
			'fields'   => array(
				array(
					'key'      => 'field_shop_hours',
					'label'    => '営業時間',
					'name'     => 'shop_hours',
					'type'     => 'text',
					'required' => 1,
				),
				array(
					'key'      => 'field_shop_holiday',
					'label'    => '定休日',
					'name'     => 'shop_holiday',
					'type'     => 'text',
					'required' => 0,
				),
				array(
					'key'      => 'field_shop_tel',
					'label'    => '電話番号',
					'name'     => 'shop_tel',
					'type'     => 'text',
					'required' => 0,
				),
				array(
					'key'           => 'field_shop_image',
					'label'         => '店舗写真',
					'name'          => 'shop_image',
					'type'          => 'image',
					'required'      => 1,
					'return_format' => 'array',
					'preview_size'  => 'medium',
				),
				array(
					'key'      => 'field_shop_address',
					'label'    => '住所',
					'name'     => 'shop_address',
					'type'     => 'text',
					'required' => 0,
				),
				array(
					'key'         => 'field_shop_map_embed',
					'label'       => 'Google Map埋め込み',
					'name'        => 'shop_map_embed',
					'type'        => 'textarea',
					'required'    => 0,
					'rows'        => 4,
					'instructions' => 'Google Mapのiframe埋め込みコードを貼り付けてください',
				),
				array(
					'key'      => 'field_shop_description',
					'label'    => '一言紹介',
					'name'     => 'shop_description',
					'type'     => 'textarea',
					'required' => 0,
					'rows'     => 3,
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'shop',
					),
				),
			),
		)
	);
}
add_action( 'acf/init', 'yokohamabashi_register_acf_fields' );
