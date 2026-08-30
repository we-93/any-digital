/**
 * Any Digital - Timeline Story Widget Script
 */

(function ($) {
	'use strict';

	function initTimeline() {
		$('.any-digital-timeline-wrapper').each(function () {
			var $wrapper = $(this);
			// Extra interactive or animation handlers if needed
		});
	}

	$(document).ready(function () {
		initTimeline();
	});

	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/any-digital-timeline.default', function ($scope) {
			initTimeline();
		});
	});

})(jQuery);
