<?php
/**
 * 店舗CSVインポートスクリプト
 *
 * 使い方:
 * 1. CSVファイルを tools/shops.csv に配置
 * 2. 画像を wp-content/uploads/shop-import/ に配置
 * 3. WP-CLI で実行: wp eval-file wp-content/themes/yokohamabashi-theme/tools/shop-import.php
 *
 * @package Yokohamabashi_Theme
 */

// WordPress環境外からの直接アクセスを防止（WP-CLI経由のみ許可）
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'このスクリプトはWP-CLI経由で実行してください。' );
}

/**
 * CSVインポートクラス
 */
class Yokohamabashi_Shop_Importer {

	/**
	 * CSVファイルパス
	 *
	 * @var string
	 */
	private $csv_path;

	/**
	 * 画像フォルダパス
	 *
	 * @var string
	 */
	private $image_dir;

	/**
	 * ドライランモード
	 *
	 * @var bool
	 */
	private $dry_run = false;

	/**
	 * 処理結果
	 *
	 * @var array
	 */
	private $results = array(
		'success' => 0,
		'skipped' => 0,
		'failed'  => 0,
		'errors'  => array(),
	);

	/**
	 * コンストラクタ
	 *
	 * @param string|null $csv_path CSVファイルパス。省略時は tools/shops.csv を使用。
	 */
	public function __construct( $csv_path = null ) {
		$this->csv_path  = $csv_path ?? __DIR__ . '/shops.csv';
		$this->image_dir = wp_upload_dir()['basedir'] . '/shop-import/';
	}

	/**
	 * インポート結果を返す
	 *
	 * @return array
	 */
	public function get_results() {
		return $this->results;
	}

	/**
	 * インポート実行
	 *
	 * @param bool $dry_run ドライランモード（trueの場合は実際に登録しない）
	 */
	public function run( $dry_run = false ) {
		$this->dry_run = $dry_run;

		$this->log( '========================================' );
		$this->log( '店舗CSVインポート開始' );
		$this->log( $dry_run ? '【ドライランモード】実際の登録は行いません' : '【本番モード】' );
		$this->log( '========================================' );

		// CSVファイル存在確認
		if ( ! file_exists( $this->csv_path ) ) {
			$this->log( 'エラー: CSVファイルが見つかりません: ' . $this->csv_path );
			return;
		}

		// 画像フォルダ確認
		if ( ! is_dir( $this->image_dir ) ) {
			$this->log( '警告: 画像フォルダが見つかりません: ' . $this->image_dir );
			$this->log( '画像なしでインポートを続行します。' );
		}

		// CSV読み込み
		$rows = $this->read_csv();
		if ( empty( $rows ) ) {
			$this->log( 'エラー: CSVにデータがありません。' );
			return;
		}

		$this->log( sprintf( '%d 件の店舗データを読み込みました。', count( $rows ) ) );
		$this->log( '----------------------------------------' );

		// 各行を処理
		foreach ( $rows as $index => $row ) {
			$row_num = $index + 2; // ヘッダー行 + 0始まり
			$this->process_row( $row, $row_num );
		}

		// 結果表示
		$this->show_results();
	}

	/**
	 * CSV読み込み
	 *
	 * @return array
	 */
	private function read_csv() {
		$rows   = array();
		$handle = fopen( $this->csv_path, 'r' );

		if ( false === $handle ) {
			return $rows;
		}

		// BOM除去
		$bom = fread( $handle, 3 );
		if ( "\xef\xbb\xbf" !== $bom ) {
			rewind( $handle );
		}

		// ヘッダー行取得
		$headers = fgetcsv( $handle );
		if ( false === $headers ) {
			fclose( $handle );
			return $rows;
		}

		// ヘッダーをトリム
		$headers = array_map( 'trim', $headers );

		// データ行読み込み
		while ( ( $data = fgetcsv( $handle ) ) !== false ) {
			// 空行スキップ
			if ( empty( array_filter( $data ) ) ) {
				continue;
			}

			// ヘッダーとデータを組み合わせて連想配列に
			$row = array();
			foreach ( $headers as $i => $header ) {
				$row[ $header ] = isset( $data[ $i ] ) ? trim( $data[ $i ] ) : '';
			}
			$rows[] = $row;
		}

		fclose( $handle );
		return $rows;
	}

	/**
	 * 1行処理
	 *
	 * @param array $row     CSVの1行データ
	 * @param int   $row_num 行番号
	 */
	private function process_row( $row, $row_num ) {
		// 必須フィールドチェック
		if ( empty( $row['shop_name'] ) ) {
			$this->log( sprintf( '行%d: スキップ（店舗名が空）', $row_num ) );
			$this->results['skipped']++;
			return;
		}

		$shop_name = $row['shop_name'];
		$this->log( sprintf( '行%d: %s を処理中...', $row_num, $shop_name ) );

		// 重複チェック
		$existing = get_posts(
			array(
				'post_type'   => 'shop',
				'title'       => $shop_name,
				'post_status' => 'any',
				'numberposts' => 1,
			)
		);

		if ( ! empty( $existing ) ) {
			$this->log( sprintf( '  -> スキップ: 同名の店舗が既に存在します（ID: %d）', $existing[0]->ID ) );
			$this->results['skipped']++;
			return;
		}

		// ドライランの場合はここで終了
		if ( $this->dry_run ) {
			$this->log( '  -> [ドライラン] 登録予定' );
			$this->results['success']++;
			return;
		}

		// 投稿作成
		$post_id = wp_insert_post(
			array(
				'post_type'   => 'shop',
				'post_title'  => $shop_name,
				'post_status' => 'publish',
			)
		);

		if ( is_wp_error( $post_id ) ) {
			$this->log( sprintf( '  -> エラー: %s', $post_id->get_error_message() ) );
			$this->results['failed']++;
			$this->results['errors'][] = sprintf( '行%d: %s - %s', $row_num, $shop_name, $post_id->get_error_message() );
			return;
		}

		// タクソノミー（業種）設定
		if ( ! empty( $row['shop_category'] ) ) {
			$this->set_taxonomy( $post_id, $row['shop_category'] );
		}

		// ACFフィールド設定
		$this->set_acf_fields( $post_id, $row );

		// 画像設定
		if ( ! empty( $row['shop_image'] ) ) {
			$this->set_image( $post_id, $row['shop_image'] );
		}

		$this->log( sprintf( '  -> 登録完了（ID: %d）', $post_id ) );
		$this->results['success']++;
	}

	/**
	 * タクソノミー設定
	 *
	 * @param int    $post_id  投稿ID
	 * @param string $category 業種名
	 */
	private function set_taxonomy( $post_id, $category ) {
		// 業種が存在しなければ作成
		$term = term_exists( $category, 'shop_category' );
		if ( ! $term ) {
			$term = wp_insert_term( $category, 'shop_category' );
		}

		if ( ! is_wp_error( $term ) ) {
			wp_set_post_terms( $post_id, array( (int) $term['term_id'] ), 'shop_category' );
		}
	}

	/**
	 * ACFフィールド設定
	 *
	 * @param int   $post_id 投稿ID
	 * @param array $row     CSVデータ
	 */
	private function set_acf_fields( $post_id, $row ) {
		$fields = array(
			'shop_hours'       => 'shop_hours',
			'shop_holiday'     => 'shop_holiday',
			'shop_tel'         => 'shop_tel',
			'shop_address'     => 'shop_address',
			'shop_description' => 'shop_description',
			'shop_map_embed'   => 'shop_map_embed',
			'shop_video'       => 'shop_video',
		);

		foreach ( $fields as $csv_col => $acf_field ) {
			if ( ! empty( $row[ $csv_col ] ) ) {
				update_field( $acf_field, $row[ $csv_col ], $post_id );
			}
		}
	}

	/**
	 * 画像設定
	 *
	 * @param int    $post_id    投稿ID
	 * @param string $image_file 画像ファイル名
	 */
	private function set_image( $post_id, $image_file ) {
		$image_path = $this->image_dir . $image_file;

		if ( ! file_exists( $image_path ) ) {
			$this->log( sprintf( '  -> 警告: 画像ファイルが見つかりません: %s', $image_file ) );
			return;
		}

		// メディアライブラリにアップロード
		$attachment_id = $this->upload_image( $image_path, $post_id );

		if ( $attachment_id ) {
			update_field( 'shop_image', $attachment_id, $post_id );
			$this->log( sprintf( '  -> 画像を登録（Attachment ID: %d）', $attachment_id ) );
		}
	}

	/**
	 * 画像をメディアライブラリにアップロード
	 *
	 * @param string $image_path 画像パス
	 * @param int    $post_id    紐付ける投稿ID
	 * @return int|false Attachment ID or false
	 */
	private function upload_image( $image_path, $post_id ) {
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';
		require_once ABSPATH . 'wp-admin/includes/image.php';

		$filetype   = wp_check_filetype( basename( $image_path ) );
		$upload_dir = wp_upload_dir();

		// uploadsフォルダにコピー
		$filename     = wp_unique_filename( $upload_dir['path'], basename( $image_path ) );
		$new_filepath = $upload_dir['path'] . '/' . $filename;

		if ( ! copy( $image_path, $new_filepath ) ) {
			$this->log( '  -> エラー: 画像のコピーに失敗' );
			return false;
		}

		// アタッチメント作成
		$attachment = array(
			'guid'           => $upload_dir['url'] . '/' . $filename,
			'post_mime_type' => $filetype['type'],
			'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $image_path ) ),
			'post_content'   => '',
			'post_status'    => 'inherit',
		);

		$attachment_id = wp_insert_attachment( $attachment, $new_filepath, $post_id );

		if ( is_wp_error( $attachment_id ) ) {
			return false;
		}

		// メタデータ生成
		$metadata = wp_generate_attachment_metadata( $attachment_id, $new_filepath );
		wp_update_attachment_metadata( $attachment_id, $metadata );

		return $attachment_id;
	}

	/**
	 * ログ出力
	 *
	 * @param string $message メッセージ
	 */
	private function log( $message ) {
		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			WP_CLI::log( $message );
		} else {
			echo $message . "\n";
		}
	}

	/**
	 * 結果表示
	 */
	private function show_results() {
		$this->log( '========================================' );
		$this->log( 'インポート完了' );
		$this->log( '----------------------------------------' );
		$this->log( sprintf( '成功: %d 件', $this->results['success'] ) );
		$this->log( sprintf( 'スキップ: %d 件', $this->results['skipped'] ) );
		$this->log( sprintf( '失敗: %d 件', $this->results['failed'] ) );

		if ( ! empty( $this->results['errors'] ) ) {
			$this->log( '----------------------------------------' );
			$this->log( 'エラー詳細:' );
			foreach ( $this->results['errors'] as $error ) {
				$this->log( '  ' . $error );
			}
		}
		$this->log( '========================================' );
	}
}

// WP-CLI経由のみ自動実行（管理画面からincludeした場合は実行しない）
if ( defined( 'WP_CLI' ) && WP_CLI ) {
	$dry_run  = in_array( '--dry-run', $argv ?? array(), true );
	$importer = new Yokohamabashi_Shop_Importer();
	$importer->run( $dry_run );
}
