<?php
/**
 * お問い合わせページテンプレート
 * スラッグ「contact」の固定ページに自動適用
 *
 * @package Yokohamabashi_Theme
 */

get_header();
?>

<main class="page-contact">
	<section class="page-header-band">
		<div class="container page-header-band__inner">
			<span class="page-header-band__eyebrow">Contact</span>
			<h1 class="page-header-band__title">お問い合わせ</h1>
			<p class="page-header-band__lead">ご質問・ご相談はフォームまたはお電話でお気軽にご連絡ください。</p>
		</div>
	</section>
	<div class="container page-main-content">

		<!-- 連絡先情報 -->
		<section class="contact-info">
			<h2 class="page-section-title">連絡先</h2>
			<dl class="contact-list">
				<dt>組合事務所</dt>
				<dd>横浜橋商店街協同組合</dd>

				<dt>所在地</dt>
				<dd>〒232-0024 神奈川県横浜市南区浦舟町3丁目</dd>

				<dt>電話番号</dt>
				<dd><a href="tel:045-XXX-XXXX">045-XXX-XXXX</a></dd>

				<dt>営業時間</dt>
				<dd>10:00〜17:00（土日祝休み）</dd>
			</dl>
		</section>

		<!-- お問い合わせフォーム -->
		<section class="contact-form">
			<h2 class="page-section-title">お問い合わせフォーム</h2>
			<p class="contact-form__note">
				下記フォームよりお問い合わせください。<br>
				通常2〜3営業日以内にご返信いたします。
			</p>
			<div class="contact-form__wrapper">
				<?php
				// Contact Form 7 ショートコード
				// 実際のショートコードはCF7プラグインで作成後に差し替え
				if ( shortcode_exists( 'contact-form-7' ) ) {
					echo do_shortcode( '[contact-form-7 id="contact-form" title="お問い合わせ"]' );
				} else {
					echo '<p class="contact-form__placeholder">お問い合わせフォームは準備中です。</p>';
				}
				?>
			</div>
		</section>
	</div>
</main>

<?php
get_footer();
