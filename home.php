<?php
/**
 * ブログ投稿一覧（表示設定で「投稿ページ」に指定した固定ページのURL）
 *
 * テンプレート階層上、投稿ページは home.php → index.php のため、
 * archive.php と同じレイアウトをここから読み込む。
 *
 * @package Yokohamabashi_Theme
 */

locate_template( 'archive.php', true );
