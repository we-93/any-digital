/**
 * Any Digital - Copy Text Widget Script
 */

(function ($) {
	'use strict';

	function copyToClipboard(text) {
		if (navigator.clipboard && window.isSecureContext) {
			return navigator.clipboard.writeText(text);
		} else {
			return new Promise(function (resolve, reject) {
				var $temp = $('<textarea>');
				$('body').append($temp);
				$temp.val(text).select();
				try {
					document.execCommand('copy');
					$temp.remove();
					resolve();
				} catch (err) {
					$temp.remove();
					reject(err);
				}
			});
		}
	}

	$(document).on('click', '.any-digital-copy-button', function (e) {
		e.preventDefault();

		var $btn = $(this);
		var textToCopy = $btn.attr('data-clipboard-text') || '';
		var successMessage = $btn.attr('data-message') || 'Berhasil disalin!';
		var originalText = $btn.attr('data-original-text') || $btn.find('.elementor-button-text').text();

		if (!textToCopy) {
			var $wrapper = $btn.closest('.any-digital-copy-wrapper');
			textToCopy = $wrapper.find('.any-digital-clipboard-text').text().trim();
		}

		if (!textToCopy) return;

		copyToClipboard(textToCopy).then(function () {
			$btn.addClass('copied');
			$btn.find('.elementor-button-text').text(successMessage);

			setTimeout(function () {
				$btn.find('.elementor-button-text').text(originalText);
				$btn.removeClass('copied');
			}, 2000);
		}).catch(function (err) {
			console.error('Copy failed:', err);
		});
	});

})(jQuery);
