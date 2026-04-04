# 技術設計書 - 横浜橋商店街 公式HP

## ディレクトリ構成
```
yokohamabashi-theme/
├── style.css                  # テーマ情報 + グローバルスタイル
├── functions.php              # inc/ の読み込みのみ
├── header.php                 # 共通ヘッダー・ナビ
├── footer.php                 # 共通フッター・SNSリンク
├── front-page.php             # トップページ
├── page-access.php            # アクセス
├── page-about.php             # 商店街について
├── page-contact.php           # お問い合わせ
├── archive-shop.php           # 店舗一覧
├── single-shop.php            # 店舗個別
├── archive.php                # お知らせ一覧
├── single.php                 # お知らせ個別
├── 404.php
├── searchform.php
├── assets/
│   ├── css/
│   │   ├── common.css         # リセット, CSS変数, ユーティリティ
│   │   ├── header.css
│   │   ├── footer.css
│   │   ├── front-page.css
│   │   ├── shop.css
│   │   ├── archive.css
│   │   └── page.css
│   ├── js/
│   │   ├── navigation.js      # ハンバーガーメニュー
│   │   └── shop-filter.js     # 業種フィルタ
│   └── images/
├── template-parts/
│   ├── shop-card.php
│   └── news-card.php
└── inc/
    ├── custom-post-types.php
    ├── taxonomies.php
    ├── acf-fields.php
    ├── enqueue.php
    └── theme-support.php
```

## CSS設計

### CSS変数（common.css の :root）
```css
:root {
  --color-primary: #D32F2F;
  --color-secondary: #1565C0;
  --color-white: #FFFFFF;
  --color-bg: #F5F5F5;
  --color-text: #333333;
  --color-text-light: #666666;
  --color-border: #E0E0E0;
  --font-family: "Hiragino Kaku Gothic ProN", "Noto Sans JP", sans-serif;
  --max-width: 1100px;
  --header-height: 70px;
}
```

### レスポンシブ
- モバイルファーストで記述
- `@media (min-width: 768px)` → タブレット
- `@media (min-width: 1024px)` → デスクトップ

## カスタム投稿タイプ: shop
```php
register_post_type('shop', [
  'labels' => ['name' => '店舗情報', 'singular_name' => '店舗',
    'add_new' => '新規店舗追加', 'edit_item' => '店舗を編集', 'all_items' => 'すべての店舗'],
  'public' => true, 'has_archive' => true,
  'rewrite' => ['slug' => 'shop'], 'menu_icon' => 'dashicons-store',
  'supports' => ['title', 'thumbnail'], 'show_in_rest' => true,
]);
```

## タクソノミー: shop_category
```php
register_taxonomy('shop_category', 'shop', [
  'labels' => ['name' => '業種', 'singular_name' => '業種', 'add_new_item' => '新しい業種を追加'],
  'hierarchical' => true, 'rewrite' => ['slug' => 'shop-category'], 'show_in_rest' => true,
]);
```
初期カテゴリ: 飲食 / 食品・生鮮 / 衣料 / 日用品・雑貨 / サービス / 医療・薬局 / その他

## ACFフィールド（acf_add_local_field_group で PHP登録）
| フィールド名 | キー | タイプ | 必須 |
|---|---|---|---|
| 営業時間 | shop_hours | テキスト | ○ |
| 定休日 | shop_holiday | テキスト | - |
| 電話番号 | shop_tel | テキスト | - |
| 店舗写真 | shop_image | 画像（返り値:配列） | ○ |
| 住所 | shop_address | テキスト | - |
| Google Map埋め込み | shop_map_embed | テキストエリア | - |
| 一言紹介 | shop_description | テキストエリア | - |

## ページ別テンプレート構造

### front-page.php（トップページ）
- ヒーローセクション（メインビジュアル + キャッチコピー）
- お知らせ（WP_Query で最新5件、template-parts/news-card.php）
- バナーリンク（お店情報 / アクセス / 商店街について）
- SNSリンク / 関連HPリンク

### archive-shop.php（店舗一覧）
- Google Map iframe（商店街全体）
- 業種フィルタ（shop_categoryのterm一覧をボタン表示）
- 店舗カードグリッド（モバイル1列 / タブレット2列 / デスクトップ3列）
- 各カードに `data-category="term-slug"` を付与
- shop-filter.js でクリック時に表示/非表示切替

### page-access.php / page-about.php / page-contact.php
- 固定ページテンプレート。テキスト+写真のシンプルなレイアウト
- page-contact.php は Contact Form 7 ショートコード埋め込み

## プラグイン
- ACF（店舗フィールド）、Contact Form 7、Yoast SEO、SiteGuard WP Plugin、UpdraftPlus
