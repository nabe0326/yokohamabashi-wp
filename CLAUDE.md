# 横浜橋商店街 公式HP - WordPress自作テーマ

## ビルド・検証コマンド
- PHP構文チェック: `find . -name "*.php" -exec php -l {} \;`
- テーマ有効化確認: `wp theme activate yokohamabashi-theme`
- 単一ファイルチェック: `php -l <file>`

## 技術スタック
- WordPress 6.x クラシックテーマ（ブロックテーマ/FSEは使わない）
- PHP 8.x / 素のCSS / jQuery最小限（WP同梱のみ）
- ACF無料版（フィールドはPHPで登録。JSON同期しない）
- Google Map は iframe埋め込み（JavaScript API 不使用）
- Contact Form 7（お問い合わせ）

## コードスタイル
- WordPress Coding Standards に従う
- インデントはタブ（PHP, CSS, JS すべて）
- CSS変数でカラー管理: `--color-primary: #D32F2F` / `--color-secondary: #1565C0` / `--color-white: #FFFFFF`
- BEMライクなクラス命名: `.shop-card`, `.shop-card__title`, `.shop-card--featured`
- 出力は必ずエスケープ: `esc_html()`, `esc_attr()`, `esc_url()`, `wp_kses_post()`
- CSS/JSは `wp_enqueue_style` / `wp_enqueue_script` で読み込む（直接linkタグを書かない）
- 画像パスは `get_template_directory_uri()` を使う

## アーキテクチャ判断
- カスタム投稿タイプ `shop` + タクソノミー `shop_category` で120店舗を管理
- お知らせはWP標準の「投稿」。商店街の人がブロックエディタで更新する前提
- ACFフィールド: shop_hours, shop_holiday, shop_tel, shop_image, shop_address, shop_map_embed, shop_description
- 店舗一覧の業種フィルタはJSで実装（data-category属性で表示/非表示切替）
- CSSファイルはページ別に分割し、該当ページでのみ読み込む

## やらないこと
- ブロックテーマ（FSE）、Tailwind/SCSS、WooCommerce、多言語対応、Google Maps API
