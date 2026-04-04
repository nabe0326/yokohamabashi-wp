<?php
/**
 * 商店街についてページテンプレート
 * スラッグ「about」の固定ページに自動適用
 *
 * @package Yokohamabashi_Theme
 */

get_header();
?>

<main class="page-about">
	<section class="page-header-band">
		<div class="container page-header-band__inner">
			<span class="page-header-band__eyebrow">About</span>
			<h1 class="page-header-band__title">商店街について</h1>
			<p class="page-header-band__lead">横浜橋商店街の歩みと、地域で育まれてきた魅力をご紹介します。</p>
		</div>
	</section>
	<div class="container page-main-content">

		<!-- 概要 -->
		<section class="about-section">
			<h2 class="page-section-title">横浜橋商店街とは</h2>
			<div class="about-content">
				<p>
					横浜橋商店街は、横浜市南区に位置する活気あふれる商店街です。
					約350メートルのアーケード街に、食料品店、飲食店、衣料品店など約120店舗が軒を連ねています。
				</p>
				<p>
					新鮮な魚介類や野菜、精肉をはじめ、日用品まで何でも揃う「暮らしの台所」として、
					地元の方々に長年愛され続けています。
				</p>
			</div>
		</section>

		<!-- 歴史 -->
		<section class="about-section">
			<h2 class="page-section-title">商店街の歴史</h2>
			<div class="about-content">
				<p>
					横浜橋商店街の歴史は古く、戦後の闇市から始まりました。
					1950年代に現在のアーケード街として整備され、以来70年以上にわたり地域の台所として親しまれています。
				</p>
				<p>
					近年では若い世代の出店も増え、伝統と新しさが融合した魅力的な商店街として進化を続けています。
				</p>
			</div>
		</section>

		<!-- 組織情報 -->
		<section class="about-section">
			<h2 class="page-section-title">組織情報</h2>
			<dl class="about-info">
				<dt>名称</dt>
				<dd>横浜橋商店街協同組合</dd>

				<dt>所在地</dt>
				<dd>〒232-0024 神奈川県横浜市南区浦舟町3丁目</dd>

				<dt>設立</dt>
				<dd>1953年</dd>

				<dt>加盟店舗数</dt>
				<dd>約120店舗</dd>
			</dl>
		</section>
	</div>
</main>

<?php
get_footer();
