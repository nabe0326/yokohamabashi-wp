<?php
/**
 * お知らせカードテンプレート
 *
 * @package Yokohamabashi_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article class="news-card">
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="news-card__thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'medium' ); ?>
			</a>
		</div>
	<?php endif; ?>
	<div class="news-card__content">
		<time class="news-card__date" datetime="<?php echo esc_attr( get_the_date( 'Y-m-d' ) ); ?>">
			<?php echo esc_html( get_the_date() ); ?>
		</time>
		<h3 class="news-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h3>
		<p class="news-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
	</div>
</article>
