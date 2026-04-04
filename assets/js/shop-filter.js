/**
 * 店舗一覧 検索・フィルタ
 *
 * @package Yokohamabashi_Theme
 */

(function() {
	'use strict';

	document.addEventListener('DOMContentLoaded', function() {
		var searchInput = document.getElementById('shop-search-input');
		var filterButtons = document.querySelectorAll('.shop-filter__btn');
		var shopCards = document.querySelectorAll('.shop-card');
		var noResultsMessage = document.querySelector('.shop-grid__no-results');

		if (shopCards.length === 0) {
			return;
		}

		var currentFilter = 'all';
		var currentSearch = '';

		/**
		 * カードの表示/非表示を更新
		 */
		function updateCards() {
			var visibleCount = 0;

			shopCards.forEach(function(card) {
				var categories = card.getAttribute('data-category') || '';
				var titleElement = card.querySelector('.shop-card__title');
				var title = titleElement ? titleElement.textContent.toLowerCase() : '';

				// カテゴリフィルタ条件
				var matchesCategory = currentFilter === 'all' || categories.indexOf(currentFilter) !== -1;

				// 検索条件
				var matchesSearch = currentSearch === '' || title.indexOf(currentSearch) !== -1;

				// 両方の条件を満たす場合のみ表示
				if (matchesCategory && matchesSearch) {
					card.classList.remove('is-hidden');
					visibleCount++;
				} else {
					card.classList.add('is-hidden');
				}
			});

			// 該当なしメッセージの表示/非表示
			if (noResultsMessage) {
				noResultsMessage.style.display = visibleCount === 0 ? 'block' : 'none';
			}
		}

		// 検索入力イベント
		if (searchInput) {
			searchInput.addEventListener('input', function() {
				currentSearch = this.value.toLowerCase().trim();
				updateCards();
			});
		}

		// カテゴリフィルタボタンイベント
		filterButtons.forEach(function(button) {
			button.addEventListener('click', function() {
				currentFilter = this.getAttribute('data-filter');

				// ボタンのアクティブ状態を切り替え
				filterButtons.forEach(function(btn) {
					btn.classList.remove('is-active');
				});
				this.classList.add('is-active');

				updateCards();
			});
		});
	});
})();
