/**
 * Navigation - ハンバーガーメニュー制御
 *
 * @package Yokohamabashi_Theme
 */

(function() {
	'use strict';

	const hamburger = document.querySelector('.hamburger');
	const drawer = document.getElementById('mobile-drawer');
	const closeButton = document.querySelector('.mobile-drawer__close');
	const overlay = document.querySelector('.mobile-drawer__overlay');

	if (!hamburger || !drawer) {
		return;
	}

	/**
	 * ドロワーを開く
	 */
	function openDrawer() {
		hamburger.setAttribute('aria-expanded', 'true');
		drawer.setAttribute('aria-hidden', 'false');
		document.body.style.overflow = 'hidden';
	}

	/**
	 * ドロワーを閉じる
	 */
	function closeDrawer() {
		hamburger.setAttribute('aria-expanded', 'false');
		drawer.setAttribute('aria-hidden', 'true');
		document.body.style.overflow = '';
	}

	/**
	 * ドロワーが開いているかチェック
	 */
	function isDrawerOpen() {
		return drawer.getAttribute('aria-hidden') === 'false';
	}

	// ハンバーガーボタンクリック
	hamburger.addEventListener('click', function() {
		if (isDrawerOpen()) {
			closeDrawer();
		} else {
			openDrawer();
		}
	});

	// 閉じるボタンクリック
	if (closeButton) {
		closeButton.addEventListener('click', closeDrawer);
	}

	// オーバーレイクリック
	if (overlay) {
		overlay.addEventListener('click', closeDrawer);
	}

	// ESCキーで閉じる
	document.addEventListener('keydown', function(e) {
		if (e.key === 'Escape' && isDrawerOpen()) {
			closeDrawer();
			hamburger.focus();
		}
	});

	// リサイズ時にドロワーを閉じる（デスクトップサイズになった場合）
	let resizeTimer;
	window.addEventListener('resize', function() {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(function() {
			if (window.innerWidth >= 1024 && isDrawerOpen()) {
				closeDrawer();
			}
		}, 100);
	});
})();
