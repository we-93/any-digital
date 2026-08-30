/**
 * Any Digital - Countdown Timer Widget Script
 */

(function ($) {
	'use strict';

	function padZero(num) {
		return num < 10 ? '0' + num : num;
	}

	function startCountdown($el) {
		var targetDateStr = $el.attr('data-date');
		if (!targetDateStr) return;

		var targetDate = new Date(targetDateStr);
		if (isNaN(targetDate.getTime())) return;

		function updateTimer() {
			var now = new Date().getTime();
			var distance = targetDate.getTime() - now;

			if (distance <= 0) {
				$el.find('[data-days]').text('00');
				$el.find('[data-hours]').text('00');
				$el.find('[data-minutes]').text('00');
				$el.find('[data-seconds]').text('00');
				return;
			}

			var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			var seconds = Math.floor((distance % (1000 * 60)) / 1000);

			$el.find('[data-days]').text(padZero(days));
			$el.find('[data-hours]').text(padZero(hours));
			$el.find('[data-minutes]').text(padZero(minutes));
			$el.find('[data-seconds]').text(padZero(seconds));
		}

		updateTimer();
		var interval = setInterval(updateTimer, 1000);
		$el.data('countdownInterval', interval);
	}

	function initCountdowns() {
		$('.any-digital-countdown-items').each(function () {
			var $el = $(this);
			if ($el.data('countdownInterval')) {
				clearInterval($el.data('countdownInterval'));
			}
			startCountdown($el);
		});
	}

	$(document).ready(function () {
		initCountdowns();
	});

	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/any-digital-countdown.default', function ($scope) {
			var $el = $scope.find('.any-digital-countdown-items');
			if ($el.length) {
				startCountdown($el);
			}
		});
	});

})(jQuery);
