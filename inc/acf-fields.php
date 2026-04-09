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
					'key'           => 'field_shop_video',
					'label'         => '紹介動画（YouTube）',
					'name'          => 'shop_video',
					'type'          => 'oembed',
					'required'      => 0,
					'instructions'  => 'YouTubeの動画URLを貼り付けてください',
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

	acf_add_local_field_group(
		array(
			'key'                   => 'group_front_page',
			'title'                 => 'トップページ（フロントページ）',
			'fields'                => array(
				array(
					'key'           => 'field_front_hero_image',
					'label'         => 'ヒーロー背景画像',
					'name'          => 'front_hero_image',
					'type'          => 'image',
					'required'      => 0,
					'return_format' => 'array',
					'preview_size'  => 'large',
					'instructions'  => '未設定の場合はグラデーションのみ表示されます。',
				),
				array(
					'key'          => 'field_front_hero_lead',
					'label'        => 'ヒーロー補足文',
					'name'         => 'front_hero_lead',
					'type'         => 'textarea',
					'required'     => 0,
					'rows'         => 2,
					'instructions' => 'キャッチコピーの下に表示する短い文章（任意）',
				),
				array(
					'key'         => 'field_front_intro_title',
					'label'       => 'イントロ見出し',
					'name'        => 'front_intro_title',
					'type'        => 'text',
					'required'    => 0,
					'placeholder' => '未入力時はデフォルト文を表示',
				),
				array(
					'key'          => 'field_front_intro_body',
					'label'        => 'イントロ本文',
					'name'         => 'front_intro_body',
					'type'         => 'textarea',
					'required'     => 0,
					'rows'         => 5,
					'instructions' => '未入力時はデフォルト文を表示',
				),
				array(
					'key'           => 'field_front_pickup_shops',
					'label'         => 'ピックアップ店舗',
					'name'          => 'front_pickup_shops',
					'type'          => 'post_object',
					'post_type'     => array( 'shop' ),
					'multiple'      => 1,
					'return_format' => 'id',
					'min'           => 0,
					'max'           => 6,
					'instructions'  => '最大6件。未選択の場合は新しい順に6件表示します。',
				),
				array(
					'key'          => 'field_front_x_url',
					'label'        => 'X（旧Twitter）URL',
					'name'         => 'front_x_url',
					'type'         => 'url',
					'required'     => 0,
					'instructions' => 'XアカウントのプロフィールURLを入力してください',
				),
				array(
					'key'          => 'field_front_tiktok_url',
					'label'        => 'TikTok URL',
					'name'         => 'front_tiktok_url',
					'type'         => 'url',
					'required'     => 0,
					'instructions' => 'TikTokアカウントのプロフィールURLを入力してください',
				),
				array(
					'key'          => 'field_front_instagram_url',
					'label'        => 'Instagram URL',
					'name'         => 'front_instagram_url',
					'type'         => 'url',
					'required'     => 0,
					'instructions' => 'InstagramアカウントのプロフィールURLを入力してください',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_type',
						'operator' => '==',
						'value'    => 'front_page',
					),
				),
			),
			'position'              => 'acf_after_title',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
		)
	);
	acf_add_local_field_group(
		array(
			'key'    => 'group_access_page',
			'title'  => 'アクセスページ（各ルート写真・説明）',
			'fields' => array(
				array(
					'key'           => 'field_access_bando_photo',
					'label'         => '阪東橋駅からの写真',
					'name'          => 'access_bando_photo',
					'type'          => 'image',
					'required'      => 0,
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'instructions'  => '阪東橋駅から商店街までのルート写真',
				),
				array(
					'key'          => 'field_access_bando_desc',
					'label'        => '阪東橋駅からの説明',
					'name'         => 'access_bando_desc',
					'type'         => 'textarea',
					'required'     => 0,
					'rows'         => 3,
					'instructions' => '未入力時はデフォルト文を表示します',
				),
				array(
					'key'           => 'field_access_kannai_photo',
					'label'         => '関内駅からの写真',
					'name'          => 'access_kannai_photo',
					'type'          => 'image',
					'required'      => 0,
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'instructions'  => '関内駅から商店街までのルート写真',
				),
				array(
					'key'          => 'field_access_kannai_desc',
					'label'        => '関内駅からの説明',
					'name'         => 'access_kannai_desc',
					'type'         => 'textarea',
					'required'     => 0,
					'rows'         => 3,
					'instructions' => '未入力時はデフォルト文を表示します',
				),
				array(
					'key'           => 'field_access_basegate_photo',
					'label'         => '関内BASE GATEからの写真',
					'name'          => 'access_basegate_photo',
					'type'          => 'image',
					'required'      => 0,
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'instructions'  => '関内BASE GATEから商店街までのルート写真',
				),
				array(
					'key'          => 'field_access_basegate_desc',
					'label'        => '関内BASE GATEからの説明',
					'name'         => 'access_basegate_desc',
					'type'         => 'textarea',
					'required'     => 0,
					'rows'         => 3,
					'instructions' => '未入力時はデフォルト文を表示します',
				),
			),
			'location' => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-access.php',
					),
				),
			),
			'position'              => 'acf_after_title',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
		)
	);
}
add_action( 'acf/init', 'yokohamabashi_register_acf_fields' );
