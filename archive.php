<?php
/**
 * お知らせ一覧ページテンプレート
 *
 * @package Yokohamabashi_Theme
 */

get_header();
?>

<main class="news-archive">
	<div class="container">
		<h1 class="page-title">お知らせ</h1>

		<!-- カテゴリフィルタ -->
		<nav class="category-filter">
			<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="category-filter__link <?php echo ! is_category() ? 'is-active' : ''; ?>">すべて</a>
			<?php
			$categories = get_categories( array( 'hide_empty' => true ) );
			foreach ( $categories as $category ) :
				?>
				<a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" class="category-filter__link <?php echo is_category( $category->term_id ) ? 'is-active' : ''; ?>">
					<?php echo esc_html( $category->name ); ?>
				</a>
			<?php endforeach; ?>
		</nav>

		<!-- お知らせ一覧 -->
		<div class="news-list">
			<?php
			if ( have_posts() ) :
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/news-card' );
				endwhile;
			else :
				?>
				<p class="no-posts">お知らせはありません。</p>
			<?php endif; ?>
		</div>

		<!-- ページネーション -->
		<nav class="pagination">
			<?php
			the_posts_pagination(
				array(
					'mid_size'  => 2,
					'prev_text' => '&laquo; 前へ',
					'next_text' => '次へ &raquo;',
				)
			);
			?>
		</nav>
	</div>
</main>

<?php
get_footer();
