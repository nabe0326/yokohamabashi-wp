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
	<section class="page-header-band">
		<div class="container page-header-band__inner">
			<span class="page-header-band__eyebrow">Access</span>
			<h1 class="page-header-band__title">アクセス</h1>
			<p class="page-header-band__lead">電車・バス・お車でのご来場方法をご案内します。</p>
		</div>
	</section>
	<div class="container page-main-content">

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
			<h2 class="page-section-title">所在地</h2>
			<address class="access-address">
				〒232-0024<br>
				神奈川県横浜市南区浦舟町3丁目
			</address>
		</section>

		<!-- 交通アクセス -->
		<section class="access-directions">
			<h2 class="page-section-title">交通アクセス</h2>

			<div class="direction-item">
				<h3 class="direction-item__title">電車でお越しの方</h3>
				<ul class="direction-item__list">
					<li>横浜市営地下鉄ブルーライン「阪東橋駅」より徒歩3分</li>
					<li>JR根岸線・横浜市営地下鉄「関内駅」南口より徒歩約15分</li>
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

		<!-- 各方面からの行き方（写真付き） -->
		<section class="access-routes">
			<h2 class="page-section-title">各方面からの行き方</h2>

			<?php
			// 阪東橋駅
			$bando_photo = get_field( 'access_bando_photo' );
			$bando_desc  = get_field( 'access_bando_desc' );
			?>
			<div class="access-route">
				<div class="access-route__header">
					<h3 class="access-route__title">阪東橋駅から</h3>
					<p class="access-route__lead">横浜市営地下鉄ブルーライン「阪東橋駅」1番出口より徒歩約3分</p>
				</div>
				<?php if ( $bando_photo ) : ?>
				<figure class="access-route__photo">
					<img
						src="<?php echo esc_url( $bando_photo['url'] ); ?>"
						alt="<?php echo esc_attr( $bando_photo['alt'] ? $bando_photo['alt'] : '阪東橋駅からのルート' ); ?>"
						width="<?php echo esc_attr( $bando_photo['width'] ); ?>"
						height="<?php echo esc_attr( $bando_photo['height'] ); ?>"
						loading="lazy"
					>
				</figure>
				<?php else : ?>
				<div class="access-route__photo-placeholder">写真は準備中です</div>
				<?php endif; ?>
				<?php if ( $bando_desc ) : ?>
				<div class="access-route__desc">
					<p><?php echo nl2br( esc_html( $bando_desc ) ); ?></p>
				</div>
				<?php endif; ?>
			</div>

			<?php
			// 関内駅
			$kannai_photo = get_field( 'access_kannai_photo' );
			$kannai_desc  = get_field( 'access_kannai_desc' );
			?>
			<div class="access-route">
				<div class="access-route__header">
					<h3 class="access-route__title">関内駅から</h3>
					<p class="access-route__lead">JR根岸線・横浜市営地下鉄「関内駅」南口より徒歩約15分</p>
				</div>
				<?php if ( $kannai_photo ) : ?>
				<figure class="access-route__photo">
					<img
						src="<?php echo esc_url( $kannai_photo['url'] ); ?>"
						alt="<?php echo esc_attr( $kannai_photo['alt'] ? $kannai_photo['alt'] : '関内駅からのルート' ); ?>"
						width="<?php echo esc_attr( $kannai_photo['width'] ); ?>"
						height="<?php echo esc_attr( $kannai_photo['height'] ); ?>"
						loading="lazy"
					>
				</figure>
				<?php else : ?>
				<div class="access-route__photo-placeholder">写真は準備中です</div>
				<?php endif; ?>
				<?php if ( $kannai_desc ) : ?>
				<div class="access-route__desc">
					<p><?php echo nl2br( esc_html( $kannai_desc ) ); ?></p>
				</div>
				<?php endif; ?>
			</div>

			<?php
			// 関内BASE GATE
			$basegate_photo = get_field( 'access_basegate_photo' );
			$basegate_desc  = get_field( 'access_basegate_desc' );
			?>
			<div class="access-route">
				<div class="access-route__header">
					<h3 class="access-route__title">関内BASE GATEから</h3>
					<p class="access-route__lead">関内BASE GATEより徒歩でお越しいただけます</p>
				</div>
				<?php if ( $basegate_photo ) : ?>
				<figure class="access-route__photo">
					<img
						src="<?php echo esc_url( $basegate_photo['url'] ); ?>"
						alt="<?php echo esc_attr( $basegate_photo['alt'] ? $basegate_photo['alt'] : '関内BASE GATEからのルート' ); ?>"
						width="<?php echo esc_attr( $basegate_photo['width'] ); ?>"
						height="<?php echo esc_attr( $basegate_photo['height'] ); ?>"
						loading="lazy"
					>
				</figure>
				<?php else : ?>
				<div class="access-route__photo-placeholder">写真は準備中です</div>
				<?php endif; ?>
				<?php if ( $basegate_desc ) : ?>
				<div class="access-route__desc">
					<p><?php echo nl2br( esc_html( $basegate_desc ) ); ?></p>
				</div>
				<?php endif; ?>
			</div>
		</section>
	</div>
</main>

<?php
get_footer();
