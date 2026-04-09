<?php
/**
 * WordPress Customizer 設定
 *
 * @package Yokohamabashi_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Customizerに商店街マップ画像設定を追加
 *
 * @param WP_Customize_Manager $wp_customize Customizerオブジェクト。
 */
function yokohamabashi_customize_register( $wp_customize ) {

	$wp_customize->add_section(
		'yokohamabashi_shop_map',
		array(
			'title'       => '商店街マップ画像',
			'description' => '店舗一覧ページに表示するイラストマップ画像を設定します。',
			'priority'    => 30,
		)
	);

	$wp_customize->add_setting(
		'shop_illustrated_map',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'shop_illustrated_map',
			array(
				'label'       => '商店街イラストマップ画像',
				'description' => '横浜橋商店街のイラストマップ画像をアップロードしてください。',
				'section'     => 'yokohamabashi_shop_map',
			)
		)
	);
}
add_action( 'customize_register', 'yokohamabashi_customize_register' );
