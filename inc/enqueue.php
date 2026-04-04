<?php
/**
 * Enqueue - CSS/JS の読み込み
 *
 * @package Yokohamabashi_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * お知らせ一覧・個別用 CSS が必要なテンプレートかどうかを記録する。
 *
 * 表示設定の「投稿ページ」は home.php が使われるが、環境によって is_home() が
 * 期待どおりでない場合があるため、実際に読み込まれたテンプレート名でも判定する。
 *
 * @param string $template 読み込むテンプレートのパス。
 * @return string
 */
function yokohamabashi_mark_archive_styles_template( $template ) {
	$basename = basename( $template );
	if ( in_array( $basename, array( 'home.php', 'archive.php', 'single.php' ), true ) ) {
		$GLOBALS['yokohamabashi_use_archive_styles'] = true;
	}
	return $template;
}
add_filter( 'template_include', 'yokohamabashi_mark_archive_styles_template', 99 );

/**
 * スタイルとスクリプトを読み込む
 */
function yokohamabashi_enqueue_assets() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// 共通CSS
	wp_enqueue_style(
		'yokohamabashi-common',
		get_template_directory_uri() . '/assets/css/common.css',
		array(),
		$theme_version
	);

	// ヘッダーCSS
	wp_enqueue_style(
		'yokohamabashi-header',
		get_template_directory_uri() . '/assets/css/header.css',
		array( 'yokohamabashi-common' ),
		$theme_version
	);

	// フッターCSS
	wp_enqueue_style(
		'yokohamabashi-footer',
		get_template_directory_uri() . '/assets/css/footer.css',
		array( 'yokohamabashi-common' ),
		$theme_version
	);

	// ナビゲーションJS
	wp_enqueue_script(
		'yokohamabashi-navigation',
		get_template_directory_uri() . '/assets/js/navigation.js',
		array(),
		$theme_version,
		true
	);

	// お知らせ一覧・個別・トップのお知らせカード（home.php は template_include フラグでも拾う）
	$use_archive_styles = ! empty( $GLOBALS['yokohamabashi_use_archive_styles'] ?? null )
		|| is_front_page()
		|| is_home()
		|| is_archive()
		|| is_singular( 'post' );
	if ( $use_archive_styles ) {
		wp_enqueue_style(
			'yokohamabashi-archive',
			get_template_directory_uri() . '/assets/css/archive.css',
			array( 'yokohamabashi-common' ),
			$theme_version
		);
	}

	// トップページ（お知らせカードは archive.css に依存。バナー等の dashicons はフロントでは明示読み込みが必要）
	if ( is_front_page() ) {
		wp_enqueue_style(
			'yokohamabashi-front-page',
			get_template_directory_uri() . '/assets/css/front-page.css',
			array( 'dashicons', 'yokohamabashi-common', 'yokohamabashi-archive' ),
			$theme_version
		);
	}

	// 店舗一覧・店舗個別・トップページ（ピックアップ店舗）
	if ( is_front_page() || is_post_type_archive( 'shop' ) || is_singular( 'shop' ) ) {
		wp_enqueue_style(
			'yokohamabashi-shop',
			get_template_directory_uri() . '/assets/css/shop.css',
			array( 'yokohamabashi-common' ),
			$theme_version
		);
	}

	// 店舗一覧のみ（フィルタJS）
	if ( is_post_type_archive( 'shop' ) ) {
		wp_enqueue_script(
			'yokohamabashi-shop-filter',
			get_template_directory_uri() . '/assets/js/shop-filter.js',
			array(),
			$theme_version,
			true
		);
	}

	// 固定ページ（アクセス・商店街について・お問い合わせ）
	if ( is_page( array( 'access', 'about', 'contact' ) ) ) {
		wp_enqueue_style(
			'yokohamabashi-page',
			get_template_directory_uri() . '/assets/css/page.css',
			array( 'yokohamabashi-common' ),
			$theme_version
		);
	}

	// 404エラーページ・検索結果ページ
	if ( is_404() || is_search() ) {
		wp_enqueue_style(
			'yokohamabashi-404',
			get_template_directory_uri() . '/assets/css/404.css',
			array( 'yokohamabashi-common' ),
			$theme_version
		);
	}

	// 検索結果ページでお知らせカードを表示するためのCSS
	if ( is_search() ) {
		wp_enqueue_style(
			'yokohamabashi-archive',
			get_template_directory_uri() . '/assets/css/archive.css',
			array( 'yokohamabashi-common' ),
			$theme_version
		);
	}
}
add_action( 'wp_enqueue_scripts', 'yokohamabashi_enqueue_assets' );

/**
 * 不要なWordPressヘッダー情報を削除
 */
function yokohamabashi_remove_head_items() {
	// WordPressバージョン情報を削除
	remove_action( 'wp_head', 'wp_generator' );

	// Windows Live Writer用のリンクを削除
	remove_action( 'wp_head', 'wlwmanifest_link' );

	// RSD (Really Simple Discovery) リンクを削除
	remove_action( 'wp_head', 'rsd_link' );

	// 短縮URLを削除
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );

	// 絵文字関連のスクリプト・スタイルを削除
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );

	// REST APIのリンクを削除
	remove_action( 'wp_head', 'rest_output_link_wp_head' );

	// oEmbed関連を削除
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'wp_head', 'wp_oembed_add_host_js' );

	// 前後の投稿リンクを削除
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );

	// フィードリンクを削除（必要な場合はコメントアウト）
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
}
add_action( 'after_setup_theme', 'yokohamabashi_remove_head_items' );

/**
 * DNSプリフェッチの絵文字CDNを削除
 */
function yokohamabashi_remove_emoji_dns_prefetch( $urls, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		$urls = array_filter(
			$urls,
			function ( $url ) {
				return false === strpos( $url, 'https://s.w.org/images/core/emoji/' );
			}
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'yokohamabashi_remove_emoji_dns_prefetch', 10, 2 );
