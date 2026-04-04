<?php
/**
 * お知らせ個別ページテンプレート
 *
 * @package Yokohamabashi_Theme
 */

get_header();
?>

<main class="news-single">
	<div class="container">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
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

					<h1 class="news-detail__title"><?php the_title(); ?></h1>
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
		<?php endwhile; endif; ?>

		<!-- 戻りリンク -->
		<div class="news-single__back">
			<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="back-link">
				&larr; お知らせ一覧に戻る
			</a>
		</div>
	</div>
</main>

<?php
get_footer();
