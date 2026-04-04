/**
 * 店舗一覧 業種フィルタ
 *
 * @package Yokohamabashi_Theme
 */

(function() {
	'use strict';

	document.addEventListener('DOMContentLoaded', function() {
		var filterButtons = document.querySelectorAll('.shop-filter__btn');
		var shopCards = document.querySelectorAll('.shop-card');

		if (filterButtons.length === 0 || shopCards.length === 0) {
			return;
		}

		filterButtons.forEach(function(button) {
			button.addEventListener('click', function() {
				var filter = this.getAttribute('data-filter');

				// ボタンのアクティブ状態を切り替え
				filterButtons.forEach(function(btn) {
					btn.classList.remove('is-active');
				});
				this.classList.add('is-active');

				// カードの表示/非表示を切り替え
				shopCards.forEach(function(card) {
					var categories = card.getAttribute('data-category');

					if (filter === 'all') {
						card.classList.remove('is-hidden');
					} else if (categories && categories.indexOf(filter) !== -1) {
						card.classList.remove('is-hidden');
					} else {
						card.classList.add('is-hidden');
					}
				});
			});
		});
	});
})();
