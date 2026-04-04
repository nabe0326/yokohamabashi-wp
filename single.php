<?php
/**
 * お知らせ個別ページテンプレート
 *
 * @package Yokohamabashi_Theme
 */

get_header();
?>

<main class="news-single">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<section class="page-header-band">
			<div class="container page-header-band__inner">
				<span class="page-header-band__eyebrow">News Detail</span>
				<h1 class="page-header-band__title"><?php the_title(); ?></h1>
				<p class="page-header-band__lead">商店街からのお知らせ詳細ページです。</p>
			</div>
		</section>
		<div class="container page-main-content">
			<article class="news-detail">
				<!-- ヘッダー -->
				<header class="news-detail__header">
					<time class="news-detail__date" datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>">
						<?php echo esc_html( get_the_date() ); ?>
					</time>

					<?php
					$categories = get_the_category();
					if ( ! empty( $categories ) ) :
						?>
						<div class="news-detail__categories">
							<?php foreach ( $categories as $category ) : ?>
								<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" class="news-detail__category">
									<?php echo esc_html( $category->name ); ?>
								</a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<h2 class="news-detail__title"><?php the_title(); ?></h2>
				</header>

				<!-- アイキャッチ -->
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="news-detail__thumbnail">
						<?php the_post_thumbnail( 'large' ); ?>
					</div>
				<?php endif; ?>

				<!-- 本文 -->
				<div class="news-detail__content">
					<?php the_content(); ?>
				</div>

				<!-- 前後リンク -->
				<nav class="news-nav">
					<div class="news-nav__prev">
						<?php
						$prev_post = get_previous_post();
						if ( $prev_post ) :
							?>
							<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>">
								<span class="news-nav__label">&larr; 前の記事</span>
								<span class="news-nav__title"><?php echo esc_html( $prev_post->post_title ); ?></span>
							</a>
						<?php endif; ?>
					</div>
					<div class="news-nav__next">
						<?php
						$next_post = get_next_post();
						if ( $next_post ) :
							?>
							<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>">
								<span class="news-nav__label">次の記事 &rarr;</span>
								<span class="news-nav__title"><?php echo esc_html( $next_post->post_title ); ?></span>
							</a>
						<?php endif; ?>
					</div>
				</nav>
			</article>

			<!-- 戻りリンク -->
			<?php
			$posts_page_url = yokohamabashi_get_posts_page_url();
			if ( $posts_page_url ) :
				?>
			<div class="news-single__back">
				<a href="<?php echo esc_url( $posts_page_url ); ?>" class="back-link">
					&larr; お知らせ一覧に戻る
				</a>
			</div>
				<?php
			endif;
			?>
		</div>
	<?php endwhile; endif; ?>
</main>

<?php
get_footer();
