<?php
/**
 * 検索フォーム
 *
 * @package Yokohamabashi_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="search-form__label">
		<span class="visually-hidden"><?php echo esc_html_x( '検索:', 'label', 'yokohamabashi' ); ?></span>
		<input
			type="search"
			class="search-form__input"
			placeholder="<?php echo esc_attr_x( 'キーワードを入力...', 'placeholder', 'yokohamabashi' ); ?>"
			value="<?php echo get_search_query(); ?>"
			name="s"
		>
	</label>
	<button type="submit" class="search-form__submit">
		<span class="visually-hidden"><?php echo esc_html_x( '検索', 'submit button', 'yokohamabashi' ); ?></span>
		<svg class="search-form__icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
			<circle cx="11" cy="11" r="8"></circle>
			<path d="m21 21-4.35-4.35"></path>
		</svg>
	</button>
</form>
