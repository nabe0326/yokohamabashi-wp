<?php
/**
 * アクセスページテンプレート
 * スラッグ「access」の固定ページに自動適用
 *
 * @package Yokohamabashi_Theme
 */

get_header();
?>

<main class="page-access">
	<div class="container">
		<h1 class="page-title">アクセス</h1>

		<!-- Google Map -->
		<section class="access-map">
			<iframe
				src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3250.8!2d139.6194!3d35.4344!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2z5qiq5rWc5qmL5ZWG5bqX6KGX!5e0!3m2!1sja!2sjp!4v1234567890"
				width="100%"
				height="400"
				style="border:0;"
				allowfullscreen=""
				loading="lazy"
				referrerpolicy="no-referrer-when-downgrade"
			></iframe>
		</section>

		<!-- 住所・基本情報 -->
		<section class="access-info">
			<h2 class="section-title">所在地</h2>
			<address class="access-address">
				〒232-0024<br>
				神奈川県横浜市南区浦舟町3丁目
			</address>
		</section>

		<!-- 交通アクセス -->
		<section class="access-directions">
			<h2 class="section-title">交通アクセス</h2>

			<div class="direction-item">
				<h3 class="direction-item__title">電車でお越しの方</h3>
				<ul class="direction-item__list">
					<li>横浜市営地下鉄ブルーライン「阪東橋駅」より徒歩3分</li>
					<li>京急本線「黄金町駅」より徒歩10分</li>
				</ul>
			</div>

			<div class="direction-item">
				<h3 class="direction-item__title">バスでお越しの方</h3>
				<ul class="direction-item__list">
					<li>横浜市営バス「浦舟町」バス停下車すぐ</li>
				</ul>
			</div>

			<div class="direction-item">
				<h3 class="direction-item__title">お車でお越しの方</h3>
				<p class="direction-item__text">
					商店街周辺にコインパーキングがございます。<br>
					商店街内は歩行者専用となっておりますので、お車でのご来場はご遠慮ください。
				</p>
			</div>
		</section>
	</div>
</main>

<?php
get_footer();
