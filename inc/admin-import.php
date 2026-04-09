<?php
/**
 * 店舗CSVインポート 管理画面ページ
 *
 * 管理画面 > ツール > 店舗CSVインポート からCSVファイルをアップロードして
 * 店舗情報を一括登録できます。
 *
 * @package Yokohamabashi_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 管理メニューに「店舗CSVインポート」を追加
 */
function yokohamabashi_register_import_page() {
	add_management_page(
		'店舗CSVインポート',
		'店舗CSVインポート',
		'manage_options',
		'yokohamabashi-shop-import',
		'yokohamabashi_import_page_html'
	);
}
add_action( 'admin_menu', 'yokohamabashi_register_import_page' );

/**
 * インポートページのHTML出力
 */
function yokohamabashi_import_page_html() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$log_lines = array();
	$results   = null;
	$error_msg = '';
	$dry_run   = false;

	// フォーム送信処理
	if ( isset( $_POST['yokohamabashi_import_submit'] ) ) {
		check_admin_referer( 'yokohamabashi_shop_import' );

		$dry_run = ! empty( $_POST['dry_run'] );

		// ファイルアップロード確認
		if ( empty( $_FILES['shop_csv'] ) || UPLOAD_ERR_OK !== $_FILES['shop_csv']['error'] ) {
			$upload_errors = array(
				UPLOAD_ERR_INI_SIZE   => 'ファイルサイズがphp.iniの上限を超えています。',
				UPLOAD_ERR_FORM_SIZE  => 'ファイルサイズがフォームの上限を超えています。',
				UPLOAD_ERR_PARTIAL    => 'ファイルが途中までしかアップロードされませんでした。',
				UPLOAD_ERR_NO_FILE    => 'CSVファイルが選択されていません。',
				UPLOAD_ERR_NO_TMP_DIR => 'テンポラリフォルダが見つかりません。',
				UPLOAD_ERR_CANT_WRITE => 'ファイルの書き込みに失敗しました。',
			);
			$err_code  = $_FILES['shop_csv']['error'] ?? UPLOAD_ERR_NO_FILE;
			$error_msg = $upload_errors[ $err_code ] ?? 'アップロードに失敗しました。';
		} else {
			$file     = $_FILES['shop_csv'];
			$file_ext = strtolower( pathinfo( $file['name'], PATHINFO_EXTENSION ) );

			if ( 'csv' !== $file_ext ) {
				$error_msg = 'CSVファイル（.csv）のみアップロードできます。';
			} elseif ( ! is_uploaded_file( $file['tmp_name'] ) ) {
				$error_msg = '不正なファイルです。';
			} else {
				// 一時ファイルとして保存
				$tmp_csv = wp_tempnam( 'shop-import-' ) . '.csv';

				if ( move_uploaded_file( $file['tmp_name'], $tmp_csv ) ) {
					// インポータークラスをロード（WP-CLI自動実行ブロックを回避）
					if ( ! class_exists( 'Yokohamabashi_Shop_Importer' ) ) {
						require get_template_directory() . '/tools/shop-import.php';
					}

					// ログをキャプチャしながら実行
					ob_start();
					$importer = new Yokohamabashi_Shop_Importer( $tmp_csv );
					$importer->run( $dry_run );
					$raw_log = ob_get_clean();

					// 一時ファイルを削除
					wp_delete_file( $tmp_csv );

					// ログを行ごとに分割
					$log_lines = array_filter( explode( "\n", $raw_log ) );
					$results   = $importer->get_results();
				} else {
					$error_msg = '一時ファイルの保存に失敗しました。';
				}
			}
		}
	}
	?>
	<div class="wrap">
		<h1>店舗CSVインポート</h1>
		<p>CSVファイルをアップロードして、店舗情報を一括登録します。同名の店舗が既に存在する場合はスキップされます。</p>

		<?php if ( $error_msg ) : ?>
		<div class="notice notice-error">
			<p><?php echo esc_html( $error_msg ); ?></p>
		</div>
		<?php endif; ?>

		<?php if ( null !== $results ) : ?>
		<div class="notice notice-<?php echo 0 === $results['failed'] ? 'success' : 'warning'; ?>">
			<p>
				<?php if ( $dry_run ) : ?>
				<strong>【ドライランモード】実際の登録は行いませんでした。</strong><br>
				<?php endif; ?>
				✅ 成功: <strong><?php echo esc_html( $results['success'] ); ?> 件</strong>
				⏭️ スキップ: <strong><?php echo esc_html( $results['skipped'] ); ?> 件</strong>
				❌ 失敗: <strong><?php echo esc_html( $results['failed'] ); ?> 件</strong>
			</p>
		</div>
		<?php endif; ?>

		<!-- アップロードフォーム -->
		<div class="card" style="max-width:640px; padding:20px; margin-bottom:24px;">
			<form method="post" enctype="multipart/form-data">
				<?php wp_nonce_field( 'yokohamabashi_shop_import' ); ?>

				<table class="form-table" role="presentation">
					<tr>
						<th scope="row"><label for="shop_csv">CSVファイル</label></th>
						<td>
							<input type="file" id="shop_csv" name="shop_csv" accept=".csv" required>
							<p class="description">文字コード UTF-8（BOM付き可）のCSVをアップロードしてください。</p>
						</td>
					</tr>
					<tr>
						<th scope="row">ドライラン</th>
						<td>
							<label>
								<input type="checkbox" name="dry_run" value="1">
								チェックを入れると実際の登録は行わず、件数の確認のみ行います
							</label>
						</td>
					</tr>
				</table>

				<?php submit_button( 'インポート開始', 'primary', 'yokohamabashi_import_submit' ); ?>
			</form>
		</div>

		<?php if ( ! empty( $log_lines ) ) : ?>
		<!-- 実行ログ -->
		<h2>実行ログ</h2>
		<div style="background:#1d2327; color:#f0f0f0; padding:16px; border-radius:4px; max-width:800px; max-height:480px; overflow-y:auto; font-family:monospace; font-size:13px; line-height:1.7;">
			<?php foreach ( $log_lines as $line ) : ?>
				<?php
				if ( str_contains( $line, 'エラー' ) || str_contains( $line, '失敗' ) ) {
					$color = '#f87171'; // 赤
				} elseif ( str_contains( $line, '警告' ) || str_contains( $line, 'スキップ' ) ) {
					$color = '#fbbf24'; // 黄
				} elseif ( str_contains( $line, '完了' ) || str_contains( $line, '成功' ) ) {
					$color = '#4ade80'; // 緑
				} else {
					$color = 'inherit';
				}
				?>
				<div style="color:<?php echo esc_attr( $color ); ?>"><?php echo esc_html( $line ); ?></div>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>

		<!-- CSVフォーマット説明 -->
		<h2 style="margin-top:32px;">CSVフォーマット</h2>
		<div class="card" style="max-width:760px; padding:20px;">
			<p>1行目はヘッダー行として以下の列名を記載してください。</p>
			<table class="widefat striped" style="margin-bottom:16px;">
				<thead>
					<tr>
						<th>列名</th>
						<th>内容</th>
						<th>必須</th>
					</tr>
				</thead>
				<tbody>
					<tr><td><code>shop_name</code></td><td>店舗名</td><td>✅</td></tr>
					<tr><td><code>shop_category</code></td><td>業種（例：食料品、衣料品）</td><td></td></tr>
					<tr><td><code>shop_hours</code></td><td>営業時間</td><td></td></tr>
					<tr><td><code>shop_holiday</code></td><td>定休日</td><td></td></tr>
					<tr><td><code>shop_tel</code></td><td>電話番号</td><td></td></tr>
					<tr><td><code>shop_address</code></td><td>住所</td><td></td></tr>
					<tr><td><code>shop_description</code></td><td>一言紹介</td><td></td></tr>
					<tr><td><code>shop_map_embed</code></td><td>Google Map iframeコード</td><td></td></tr>
					<tr><td><code>shop_video</code></td><td>紹介動画YouTube URL</td><td></td></tr>
					<tr><td><code>shop_image</code></td><td>画像ファイル名（※下記参照）</td><td></td></tr>
				</tbody>
			</table>
			<p>
				<strong>🖼️ 店舗画像について：</strong><br>
				画像ファイルは事前に <code>wp-content/uploads/shop-import/</code> フォルダに配置してください。<br>
				<code>shop_image</code> 列にはファイル名のみ記載します（例：<code>yamada-fish.jpg</code>）。
			</p>
			<p>
				<strong>📥 サンプルCSV：</strong>
				<a href="<?php echo esc_url( admin_url( 'tools.php?page=yokohamabashi-shop-import&action=download_sample' ) ); ?>">
					サンプルCSVをダウンロード
				</a>
			</p>
		</div>
	</div>
	<?php
}

/**
 * サンプルCSVダウンロード
 */
function yokohamabashi_download_sample_csv() {
	if (
		! isset( $_GET['page'], $_GET['action'] ) ||
		'yokohamabashi-shop-import' !== $_GET['page'] ||
		'download_sample' !== $_GET['action'] ||
		! current_user_can( 'manage_options' )
	) {
		return;
	}

	$filename = 'shops-sample.csv';
	$rows     = array(
		array( 'shop_name', 'shop_category', 'shop_hours', 'shop_holiday', 'shop_tel', 'shop_address', 'shop_description', 'shop_map_embed', 'shop_video', 'shop_image' ),
		array( '山田鮮魚店', '鮮魚', '9:00〜18:00', '水曜日', '045-000-0001', '神奈川県横浜市南区浦舟町3丁目', '毎朝仕入れる新鮮な魚介類が自慢です', '', '', 'yamada-fish.jpg' ),
		array( '花よし', '花屋', '10:00〜19:00', '月曜日', '045-000-0002', '神奈川県横浜市南区浦舟町3丁目', '季節の花束をご用意しています', '', '', '' ),
	);

	header( 'Content-Type: text/csv; charset=UTF-8' );
	header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
	header( 'Pragma: no-cache' );
	header( 'Expires: 0' );

	$output = fopen( 'php://output', 'w' );
	// UTF-8 BOM
	fputs( $output, "\xef\xbb\xbf" );
	foreach ( $rows as $row ) {
		fputcsv( $output, $row );
	}
	fclose( $output );
	exit;
}
add_action( 'admin_init', 'yokohamabashi_download_sample_csv' );
