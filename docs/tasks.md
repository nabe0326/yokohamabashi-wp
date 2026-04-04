# タスク一覧 - 横浜橋商店街 公式HP

実装順に記載。1タスク完了ごとに動作確認→コミット。
設計の詳細は `docs/design.md` を参照。

## Task 1: テーマ骨格 + CSS基盤
- [x] style.css にテーマ情報ヘッダーを記述
- [x] functions.php で inc/ の各ファイルを require
- [x] inc/theme-support.php（title-tag, post-thumbnails, html5, custom-logo, register_nav_menus）
- [x] inc/enqueue.php（CSS/JS の wp_enqueue、ページ別条件分岐）
- [x] assets/css/common.css（リセット、CSS変数、.container、ベースタイポグラフィ）
- [x] 検証: テーマ有効化してエラーなし、CSS変数が効いている

## Task 2: ヘッダー・フッター
- [x] header.php（ロゴ、デスクトップナビ、ハンバーガーボタン、モバイルドロワー）
- [x] footer.php（SNSリンク、コピーライト、wp_footer）
- [x] assets/css/header.css, footer.css
- [x] assets/js/navigation.js（ハンバーガー開閉、外クリック閉じ、ESC閉じ）
- [x] 検証: デスクトップでナビ横並び、モバイルでハンバーガー動作

## Task 3: カスタム投稿タイプ + ACF
- [x] inc/custom-post-types.php（shop 登録）
- [x] inc/taxonomies.php（shop_category 登録）
- [x] inc/acf-fields.php（acf_add_local_field_group で全フィールド定義）
- [x] 検証: 管理画面に「店舗情報」表示、編集画面にACFフィールド表示

## Task 4: トップページ
- [x] front-page.php（ヒーロー、お知らせ、バナー、SNS、関連リンク）
- [x] template-parts/news-card.php（日付、タイトル、抜粋、アイキャッチ）
- [x] assets/css/front-page.css
- [x] 検証: 全セクション表示、お知らせが投稿から取得されている

## Task 5: 店舗一覧ページ
- [x] archive-shop.php（Map iframe、フィルタボタン、カードグリッド、ページネーション）
- [x] template-parts/shop-card.php（写真、店舗名、業種タグ、営業時間、電話番号、data-category属性）
- [x] assets/css/shop.css（グリッド: 1列→2列→3列）
- [x] assets/js/shop-filter.js（カテゴリボタンで表示/非表示切替）
- [x] 検証: グリッド表示、フィルタ動作、レスポンシブで列数変化

## Task 6: 店舗個別ページ
- [ ] single-shop.php（全ACFフィールド表示、Map iframe、戻りリンク）
- [ ] shop.css に追記
- [ ] 検証: 全フィールドが正しく出力される

## Task 7: アクセス・商店街について・お問い合わせ
- [ ] page-access.php（Map iframe、住所、動線写真+テキスト）
- [ ] page-about.php（概要、歴史、組織情報）
- [ ] page-contact.php（連絡先情報、CF7ショートコード）
- [ ] assets/css/page.css
- [ ] 検証: 全ページ表示、モバイルでレイアウト崩れなし

## Task 8: お知らせ一覧・個別ページ
- [ ] archive.php（news-card一覧、カテゴリフィルタ、ページネーション）
- [ ] single.php（タイトル、日付、カテゴリ、本文、前後リンク、戻りリンク）
- [ ] assets/css/archive.css
- [ ] 検証: 一覧・個別ともに正常表示

## Task 9: 404 + 全体仕上げ
- [ ] 404.php（メッセージ、トップリンク、検索フォーム）
- [ ] searchform.php
- [ ] 全ページレスポンシブ確認（320px/375px/768px/1024px/1440px）
- [ ] エスケープ処理の全テンプレート確認
- [ ] 不要なWPヘッダー情報の削除
- [ ] `find . -name "*.php" -exec php -l {} \;` で構文チェック
- [ ] 検証: 全ページ正常、PHP構文エラーなし
