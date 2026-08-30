/**
 * Any Digital - Standard Invitation Cover Widget Script (Berdasarkan wellcome.php elkit)
 */

(function ($) {
	'use strict';

	function initStandardCoverModal() {
		var $modal = $('.modalx');

		if (!$modal.length) return;

		// Jika dalam mode Elementor Editor preview, jangan mengunci body scroll
		if ($('body').hasClass('elementor-editor-active')) {
			return;
		}

		// Background image fallback dari data-sampul jika inline style belum terpasang
		var sampulbg = $modal.data('sampul');
		if (sampulbg && !$modal.css('background-image')) {
			$modal.css('background-image', 'url(' + sampulbg + ')');
		}

		// Lock body scroll
		$('body').addClass('any-digital-cover-active');

		$(document).off('click.anyDigitalCoverBtn', '.wdp-button-wrapper button')
			.on('click.anyDigitalCoverBtn', '.wdp-button-wrapper button', function (e) {
				e.preventDefault();

				$modal.addClass('removeModals');
				$('body').removeClass('any-digital-cover-active');

				// Trigger pemutaran audio/musik jika elemen #song atau audio ada di halaman
				try {
					var audioSong = document.getElementById('song') || document.querySelector('audio');
					if (audioSong && typeof audioSong.play === 'function') {
						audioSong.play().catch(function (err) {
							console.log('Audio autoplay blocked or unavailable:', err);
						});
					} else if (typeof window.player !== 'undefined' && typeof window.player.playVideo === 'function') {
						window.player.playVideo();
					}
				} catch (err) {
					console.log('Error playing music on cover open:', err);
				}
			});
	}

	$(document).ready(function () {
		initStandardCoverModal();
	});

	$(window).on('elementor/frontend/init', function () {
		if (!elementorFrontend.isEditMode()) {
			elementorFrontend.hooks.addAction('frontend/element_ready/any-digital-cover.default', function ($scope) {
				initStandardCoverModal();
			});
		}
	});

})(jQuery);
