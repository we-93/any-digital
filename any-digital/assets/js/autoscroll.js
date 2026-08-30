(function ($) {
    'use strict';

    var CIRCUMFERENCE = 2 * Math.PI * 20; // radius = 20
    var END_THRESHOLD_PX = 2;
    var SPEED_MULTIPLIER = 3;
    var SPEED_BASE = 0.3;
    var PRESS_ANIM_MS = 200;
    var END_NOTIFICATION_MS = 2500;
    var SCROLL_TOP_DELAY_MS = 300;
    var SCROLL_TOP_PROGRESS_MS = 500;
    var SPEED_STEP = 5;

    var AutoScroll = {
        init: function () {
            var containers = document.querySelectorAll('.apeiron-autoscroll-wrap[data-config]');
            containers.forEach(function (container) {
                AutoScroll.initWidget(container);
            });
        },

        /**
         * Destroy a single widget instance (cleanup listeners, cancel rAF).
         */
        destroyWidget: function (container) {
            var instance = container._apeironAutoScroll;
            if (instance) {
                if (instance.autoStartTimer) {
                    clearTimeout(instance.autoStartTimer);
                }
                instance.stop(false);
                if (instance.controller) {
                    instance.controller.abort();
                }
                if (instance.bodyObserver) {
                    instance.bodyObserver.disconnect();
                }
                instance = null;
            }
            container._apeironAutoScroll = null;
            delete container.dataset.apeironAutoInit;
        },

        /**
         * Initialize a single widget instance.
         */
        initWidget: function (container) {
            // Guard: skip if already initialized
            if (container.dataset.apeironAutoInit === 'yes') return;
            container.dataset.apeironAutoInit = 'yes';

            var configRaw = container.getAttribute('data-config');
            if (!configRaw) return;

            var config;
            try {
                config = JSON.parse(configRaw);
            } catch (e) {
                return;
            }

            // ---- DOM references (cached) ----
            var btnContainer = container.querySelector('.apeiron-btn-container');
            var btn = container.querySelector('.apeiron-scroll-btn');
            if (!btn) return;

            var btnIcon = btn.querySelector('.btn-icon');
            var tooltip = container.querySelector('.apeiron-scroll-tooltip');
            var speedControl = container.querySelector('.apeiron-speed-control');
            var speedSlider = container.querySelector('.apeiron-speed-slider');
            var speedValue = container.querySelector('.speed-value');
            var scrollTopBtn = container.querySelector('.apeiron-scroll-top-btn');
            var endNotification = container.querySelector('.apeiron-end-notification');
            var progressRing = container.querySelector('.apeiron-progress-ring .progress');
            var progressBar = container.querySelector('.apeiron-progress-bar .bar-fill');
            var speedMinus = container.querySelector('.speed-minus');
            var speedPlus = container.querySelector('.speed-plus');

            // ---- State ----
            var isScrolling = false;
            var scrollRAF = null;
            var lastTime = 0;
            var currentSpeed = parseInt(config.speed) || 30;
            var scrollCompleted = false;
            var pageHeight = 0;  // cached
            var isAutoScrolling = false; // flag to prevent double updateProgress
            var autoStartTimer = null;

            // ---- AbortController for global listeners ----
            var controller = new AbortController();
            var signal = controller.signal;

            // ---- iOS check ----
            function isIOS() {
                return config.disableOnIOS && (/iPad|iPhone|iPod/.test(navigator.userAgent) ||
                    (navigator.userAgent.includes('Macintosh') && navigator.maxTouchPoints > 1));
            }

            if (isIOS()) {
                container.classList.add('is-hidden');
                storeInstance();
                return;
            }

            // ---- Button appear animation ----
            if (btnContainer && config.buttonAppearAnimation && config.buttonAppearAnimation !== 'none') {
                // Hide first via CSS class, then animate in
                btnContainer.classList.add('await-animation');
                requestAnimationFrame(function () {
                    btnContainer.classList.add('anim-' + config.buttonAppearAnimation);
                });
                if (config.buttonAppearDelay > 0) {
                    setTimeout(function () {
                        btnContainer.style.setProperty('--ak-button-appear-delay', '0s');
                    }, config.buttonAppearDelay);
                }
            }

            // ---- Cache page height ----
            function refreshPageHeight() {
                pageHeight = document.body.scrollHeight;
            }
            refreshPageHeight();

            window.addEventListener('resize', refreshPageHeight, { signal: signal, passive: true });

            // ---- Pause scroll when tab is hidden, resume when visible ----
            document.addEventListener('visibilitychange', function () {
                if (document.hidden && isScrolling) {
                    cancelAnimationFrame(scrollRAF);
                } else if (!document.hidden && isScrolling) {
                    lastTime = 0;
                    scrollRAF = requestAnimationFrame(smoothScroll);
                }
            }, { signal: signal });

            // ---- Scroll helpers ----
            function getScrollProgress() {
                var scrollTop = window.scrollY;
                var docHeight = pageHeight - window.innerHeight;
                if (docHeight <= 0) return 0;
                return Math.min(Math.max(scrollTop / docHeight, 0), 1);
            }

            function getEasingMultiplier(t) {
                switch (config.easing) {
                    case 'ease': return 0.6 + Math.sin(t * Math.PI - Math.PI / 2) * 0.4;
                    case 'ease-in': return 0.5 + t * 0.5;
                    case 'ease-out': return 1.5 - t * 0.5;
                    case 'ease-in-out': return 0.7 + Math.sin((t - 0.5) * Math.PI) * 0.3;
                    default: return 1;
                }
            }

            function isAtEnd() {
                if (config.direction === 'down') {
                    return (window.innerHeight + window.scrollY) >= pageHeight - END_THRESHOLD_PX;
                }
                return window.scrollY <= END_THRESHOLD_PX;
            }

            // ---- Smooth scroll loop (single rAF) ----
            function smoothScroll(timestamp) {
                if (!isScrolling) return;

                if (!lastTime) lastTime = timestamp;
                var delta = timestamp - lastTime;

                var targetFPS = config.smoothness === 'ultra' ? 60 : (config.smoothness === 'smooth' ? 45 : 30);
                var interval = 1000 / targetFPS;

                if (delta >= interval) {
                    lastTime = timestamp - (delta % interval);

                    var scrollAmount = (currentSpeed / 100) * SPEED_MULTIPLIER + SPEED_BASE;

                    if (config.easing !== 'linear') {
                        var progress = getScrollProgress();
                        scrollAmount *= getEasingMultiplier(progress);
                    }

                    if (isAtEnd()) {
                        if (config.loopScroll && config.direction === 'down') {
                            window.scrollTo({ top: 0, behavior: 'instant' });
                        } else {
                            stopScroll(true);
                            showEndNotification();
                            showScrollTopButton();
                            return;
                        }
                    }

                    var direction = config.direction === 'down' ? 1 : -1;
                    window.scrollBy({ top: scrollAmount * direction, behavior: 'instant' });

                    updateProgress();
                }

                if (isScrolling) {
                    scrollRAF = requestAnimationFrame(smoothScroll);
                }
            }

            // ---- Start / Stop / Toggle ----
            function startScroll() {
                if (isScrolling) return;

                refreshPageHeight(); // ensure fresh before starting

                if (isAtEnd() && !config.loopScroll) {
                    showEndNotification();
                    showScrollTopButton();
                    return;
                }

                isScrolling = true;
                isAutoScrolling = true;
                scrollCompleted = false;
                lastTime = 0;

                // Hide scroll top button
                if (scrollTopBtn) scrollTopBtn.classList.remove('show');

                // Button press animation
                btn.classList.add('btn-pressed');
                setTimeout(function () { btn.classList.remove('btn-pressed'); }, PRESS_ANIM_MS);

                // Active state
                btn.classList.add('is-active');
                btn.setAttribute('aria-pressed', 'true');
                if (config.activeAnimation !== 'none') {
                    btn.classList.add('anim-' + config.activeAnimation);
                }
                if (btnIcon) btnIcon.innerHTML = config.iconStop;
                if (tooltip) tooltip.textContent = config.tooltipStop;

                // Ripple
                if (config.rippleEnabled) {
                    var ripples = container.querySelectorAll('.ak-ripple-ring');
                    ripples.forEach(function (r) { r.classList.add('ripple-active'); });
                }

                // Speed control appear
                if (speedControl && config.showSpeedControl) {
                    speedControl.classList.remove(
                        'disappear-fade', 'disappear-slide', 'disappear-scale',
                        'disappear-zoom', 'disappear-flip', 'disappear-slide-up', 'disappear-slide-down'
                    );
                    speedControl.offsetHeight; // force reflow
                    speedControl.classList.add('show');
                    if (config.speedControlShowAnimation === 'yes') {
                        var appearAnim = config.speedControlAppearAnimation || 'scale';
                        speedControl.classList.add('appear-' + appearAnim);
                        var animDuration = (config.speedControlAnimationDuration || 400);
                        setTimeout(function () {
                            speedControl.classList.remove('appear-' + appearAnim);
                        }, animDuration);
                    }
                }

                scrollRAF = requestAnimationFrame(smoothScroll);
            }

            function stopScroll(completed) {
                isScrolling = false;
                isAutoScrolling = false;
                scrollCompleted = completed === true;
                cancelAnimationFrame(scrollRAF);

                // Release animation
                btn.classList.add('btn-released');
                setTimeout(function () { btn.classList.remove('btn-released'); }, PRESS_ANIM_MS);

                // Remove all anim-* classes
                btn.className = btn.className.replace(/\banim-[a-z-]+\b/g, '').replace(/\s+/g, ' ').trim();
                btn.classList.remove('is-active');
                btn.setAttribute('aria-pressed', 'false');
                if (btnIcon) btnIcon.innerHTML = config.iconStart;
                if (tooltip) tooltip.textContent = config.tooltipStart;

                // Hide ripple
                if (config.rippleEnabled) {
                    var ripples = container.querySelectorAll('.ak-ripple-ring');
                    ripples.forEach(function (r) { r.classList.remove('ripple-active'); });
                }

                // Speed control disappear
                if (speedControl) {
                    if (config.speedControlShowAnimation === 'yes') {
                        var disappearAnim = config.speedControlDisappearAnimation || 'scale';
                        speedControl.classList.remove(
                            'appear-fade', 'appear-slide', 'appear-scale', 'appear-bounce',
                            'appear-zoom', 'appear-flip', 'appear-elastic', 'appear-slide-up', 'appear-slide-down'
                        );
                        speedControl.classList.remove(
                            'disappear-fade', 'disappear-slide', 'disappear-scale', 'disappear-bounce',
                            'disappear-zoom', 'disappear-flip', 'disappear-elastic', 'disappear-slide-up', 'disappear-slide-down'
                        );
                        speedControl.offsetHeight; // force reflow
                        speedControl.classList.add('disappear-' + disappearAnim);

                        var animDur = (config.speedControlAnimationDuration || 400);
                        if (disappearAnim === 'bounce' || disappearAnim === 'elastic') {
                            animDur = 500;
                        }

                        var onDisappearEnd = function () {
                            speedControl.classList.remove('show', 'disappear-' + disappearAnim);
                            speedControl.removeEventListener('animationend', onDisappearEnd);
                        };
                        speedControl.addEventListener('animationend', onDisappearEnd, { once: true });
                        setTimeout(onDisappearEnd, animDur + 50); // fallback
                    } else {
                        speedControl.classList.remove('show');
                    }
                }
            }

            function toggleScroll() {
                isScrolling ? stopScroll(false) : startScroll();
            }

            // ---- Notifications ----
            function showEndNotification() {
                if (!endNotification || !config.showEndNotification) return;
                var animType = config.endNotificationAnimation || 'fade';
                endNotification.classList.add('show', 'anim-' + animType);
                setTimeout(function () {
                    endNotification.classList.remove('show', 'anim-' + animType);
                }, END_NOTIFICATION_MS);
            }

            function showScrollTopButton() {
                if (!scrollTopBtn || !config.showScrollTop) return;
                setTimeout(function () {
                    scrollTopBtn.classList.add('show');
                }, SCROLL_TOP_DELAY_MS);
            }

            function hideScrollTopButton() {
                if (scrollTopBtn) scrollTopBtn.classList.remove('show');
            }

            // ---- Progress ----
            function updateProgress() {
                var progress = getScrollProgress();

                if (progressRing) {
                    var offset = CIRCUMFERENCE - (progress * CIRCUMFERENCE);
                    progressRing.style.strokeDasharray = CIRCUMFERENCE;
                    progressRing.style.strokeDashoffset = offset;

                    var svg = progressRing.closest('.apeiron-progress-ring');
                    if (svg && config.progressAnimation && config.progressAnimation !== 'none') {
                        if (!svg.classList.contains('progress-anim-' + config.progressAnimation)) {
                            svg.className.baseVal = svg.className.baseVal.replace(/\bprogress-anim-[a-z-]+\b/g, '').trim();
                            svg.classList.add('progress-anim-' + config.progressAnimation);
                        }
                    }
                }

                if (progressBar) {
                    progressBar.style.width = (progress * 100) + '%';
                }
            }

            // ---- Scroll To Top ----
            function handleScrollToTop() {
                hideScrollTopButton();
                window.scrollTo({ top: 0, behavior: 'smooth' });
                if (isScrolling) stopScroll(false);
                setTimeout(updateProgress, SCROLL_TOP_PROGRESS_MS);
            }

            // ---- Speed Control ----
            function updateSliderProgress() {
                if (speedSlider) {
                    var value = parseInt(speedSlider.value);
                    var min = parseInt(speedSlider.min) || 1;
                    var max = parseInt(speedSlider.max) || 100;
                    var percent = ((value - min) / (max - min)) * 100;
                    speedSlider.style.setProperty('--slider-progress', percent + '%');
                }
            }

            function updateLimitState() {
                if (!speedSlider) return;
                var min = parseInt(speedSlider.min) || 1;
                var max = parseInt(speedSlider.max) || 100;
                if (speedMinus) {
                    speedMinus.classList.toggle('is-limit', currentSpeed <= min);
                }
                if (speedPlus) {
                    speedPlus.classList.toggle('is-limit', currentSpeed >= max);
                }
            }

            // Re-entrancy guard: prevents infinite recursion from dispatchEvent
            var _updatingSpeed = false;

            function updateSpeedFn(newSpeed, triggerElement) {
                if (_updatingSpeed) return;
                _updatingSpeed = true;

                newSpeed = Math.max(1, Math.min(100, parseInt(newSpeed)));
                currentSpeed = newSpeed;

                if (speedSlider) {
                    speedSlider.value = currentSpeed;
                    updateSliderProgress();
                    speedSlider.dispatchEvent(new Event('input', { bubbles: true }));
                }

                if (speedValue) {
                    speedValue.textContent = currentSpeed;
                    var animType = config.speedValueAnimation || 'pulse';
                    if (animType !== 'none') {
                        speedValue.classList.add('anim-' + animType);
                        var animDuration = animType === 'bounce' ? 600 : animType === 'slide' ? 400 : 300;
                        setTimeout(function () {
                            speedValue.classList.remove('anim-' + animType);
                        }, animDuration);
                    }
                }

                updateLimitState();

                if (triggerElement) {
                    triggerElement.classList.add('active');
                    setTimeout(function () {
                        triggerElement.classList.remove('active');
                    }, 200);
                }

                _updatingSpeed = false;
            }

            // ---- Event Listeners ----
            var suppressClick = false; // B1 FIX: prevent click after mouseup in both mode

            // Click → toggle (auto / both modes)
            btn.addEventListener('click', function () {
                if (suppressClick) {
                    suppressClick = false;
                    return;
                }
                if (config.mode === 'auto' || config.mode === 'both') {
                    toggleScroll();
                }
            }, { signal: signal });

            // Manual mode (press & hold)
            if (config.mode === 'manual' || config.mode === 'both') {
                var isHolding = false;
                var holdTimer = null;
                var HOLD_THRESHOLD = 200; // ms to distinguish hold from click

                btn.addEventListener('mousedown', function () {
                    isHolding = false;
                    holdTimer = setTimeout(function () {
                        isHolding = true;
                        startScroll();
                    }, HOLD_THRESHOLD);
                }, { signal: signal });

                btn.addEventListener('mouseup', function () {
                    clearTimeout(holdTimer);
                    if (isHolding) {
                        stopScroll(false);
                        suppressClick = true; // prevent click from re-toggling
                    }
                    isHolding = false;
                }, { signal: signal });

                btn.addEventListener('mouseleave', function () {
                    clearTimeout(holdTimer);
                    if (isHolding) {
                        stopScroll(false);
                    }
                    isHolding = false;
                }, { signal: signal });

                // Touch events
                btn.addEventListener('touchstart', function (e) {
                    e.preventDefault();
                    isHolding = false;
                    holdTimer = setTimeout(function () {
                        isHolding = true;
                        startScroll();
                    }, HOLD_THRESHOLD);
                }, { passive: false, signal: signal });

                btn.addEventListener('touchend', function () {
                    clearTimeout(holdTimer);
                    if (isHolding) {
                        stopScroll(false);
                        suppressClick = true;
                    }
                    isHolding = false;
                }, { signal: signal });
            }

            // Keyboard support
            btn.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    toggleScroll();
                }
            }, { signal: signal });

            // Speed slider
            if (speedSlider) {
                updateSliderProgress();
                updateLimitState();

                speedSlider.addEventListener('input', function (e) {
                    var newSpeed = parseInt(e.target.value);
                    updateSpeedFn(newSpeed, null);
                    updateSliderProgress();
                }, { signal: signal });

                speedSlider.addEventListener('change', function (e) {
                    var newSpeed = parseInt(e.target.value);
                    updateSpeedFn(newSpeed, null);
                    updateSliderProgress();
                }, { signal: signal });

                speedSlider.addEventListener('mousemove', function (e) {
                    if (e.buttons === 1) {
                        updateSliderProgress();
                    }
                }, { signal: signal });
            }

            // Speed arrows
            if (speedMinus) {
                speedMinus.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (speedSlider && currentSpeed > 1) {
                        updateSpeedFn(Math.max(1, currentSpeed - SPEED_STEP), this);
                    }
                }, { signal: signal });

                speedMinus.addEventListener('touchstart', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (speedSlider && currentSpeed > 1) {
                        updateSpeedFn(Math.max(1, currentSpeed - SPEED_STEP), this);
                    }
                }, { passive: false, signal: signal });
            }

            if (speedPlus) {
                speedPlus.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (speedSlider && currentSpeed < 100) {
                        updateSpeedFn(Math.min(100, currentSpeed + SPEED_STEP), this);
                    }
                }, { signal: signal });

                speedPlus.addEventListener('touchstart', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if (speedSlider && currentSpeed < 100) {
                        updateSpeedFn(Math.min(100, currentSpeed + SPEED_STEP), this);
                    }
                }, { passive: false, signal: signal });
            }

            // Escape key closes speed control
            if (speedControl) {
                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape' && speedControl.classList.contains('show')) {
                        stopScroll(false);
                    }
                }, { signal: signal });
            }

            // Draggable speed control
            if (config.speedDraggable && speedControl) {
                var isDragging = false;
                var dragStartX, dragStartY;
                var controlStartX, controlStartY;
                var dragHandle = speedControl.querySelector('.speed-drag-handle');
                var dragTarget = dragHandle || speedControl;

                dragTarget.addEventListener('mousedown', function (e) {
                    if (e.target.closest('.apeiron-speed-slider') || e.target.closest('.speed-arrow')) return;
                    isDragging = true;
                    speedControl.classList.add('is-dragging');
                    dragStartX = e.clientX;
                    dragStartY = e.clientY;
                    var rect = speedControl.getBoundingClientRect();
                    var containerRect = container.getBoundingClientRect();
                    controlStartX = rect.left - containerRect.left;
                    controlStartY = rect.top - containerRect.top;
                    e.preventDefault();
                }, { signal: signal });

                document.addEventListener('mousemove', function (e) {
                    if (!isDragging) return;
                    var deltaX = e.clientX - dragStartX;
                    var deltaY = e.clientY - dragStartY;
                    speedControl.style.left = (controlStartX + deltaX) + 'px';
                    speedControl.style.top = (controlStartY + deltaY) + 'px';
                    speedControl.style.right = 'auto';
                    speedControl.style.bottom = 'auto';
                    speedControl.style.transform = 'none';
                }, { signal: signal });

                document.addEventListener('mouseup', function () {
                    if (isDragging) {
                        isDragging = false;
                        speedControl.classList.remove('is-dragging');
                    }
                }, { signal: signal });

                // Touch drag
                dragTarget.addEventListener('touchstart', function (e) {
                    if (e.target.closest('.apeiron-speed-slider') || e.target.closest('.speed-arrow')) return;
                    isDragging = true;
                    speedControl.classList.add('is-dragging');
                    var touch = e.touches[0];
                    dragStartX = touch.clientX;
                    dragStartY = touch.clientY;
                    var rect = speedControl.getBoundingClientRect();
                    var containerRect = container.getBoundingClientRect();
                    controlStartX = rect.left - containerRect.left;
                    controlStartY = rect.top - containerRect.top;
                }, { passive: true, signal: signal });

                document.addEventListener('touchmove', function (e) {
                    if (!isDragging) return;
                    var touch = e.touches[0];
                    speedControl.style.left = (controlStartX + touch.clientX - dragStartX) + 'px';
                    speedControl.style.top = (controlStartY + touch.clientY - dragStartY) + 'px';
                    speedControl.style.right = 'auto';
                    speedControl.style.bottom = 'auto';
                    speedControl.style.transform = 'none';
                }, { signal: signal, passive: true });

                document.addEventListener('touchend', function () {
                    if (isDragging) {
                        isDragging = false;
                        speedControl.classList.remove('is-dragging');
                    }
                }, { signal: signal });
            }

            // Scroll to top button
            if (scrollTopBtn) {
                scrollTopBtn.addEventListener('click', handleScrollToTop, { signal: signal });
            }

            // Pause on user interaction (with AbortController)
            if (config.pauseOnInteraction) {
                window.addEventListener('wheel', function (e) {
                    if (e.target.closest('.apeiron-speed-control') ||
                        e.target.closest('.apeiron-speed-slider') ||
                        e.target.closest('.speed-arrow') ||
                        e.target.closest('.speed-value')) {
                        return;
                    }
                    if (isScrolling) stopScroll(false);
                }, { signal: signal, passive: true });

                window.addEventListener('touchmove', function (e) {
                    if (e.target.closest('.apeiron-speed-control') ||
                        e.target.closest('.apeiron-speed-slider') ||
                        e.target.closest('.speed-arrow') ||
                        e.target.closest('.speed-value')) {
                        return;
                    }
                    if (isScrolling) stopScroll(false);
                }, { signal: signal, passive: true });
            }

            // Scroll event for progress + scroll-top-after threshold (throttled)
            var _scrollThrottleTimer = null;
            window.addEventListener('scroll', function () {
                if (_scrollThrottleTimer) return;
                _scrollThrottleTimer = setTimeout(function () {
                    _scrollThrottleTimer = null;
                }, 100);
                if (!isAutoScrolling) {
                    updateProgress();
                }
                // B3 FIX: show scroll-to-top based on scrollTopShowAfter threshold
                if (scrollTopBtn && config.showScrollTop && config.scrollTopShowAfter > 0) {
                    var progress = getScrollProgress();
                    if (progress >= config.scrollTopShowAfter && !isScrolling) {
                        scrollTopBtn.classList.add('show');
                    } else if (progress < config.scrollTopShowAfter && !scrollCompleted) {
                        scrollTopBtn.classList.remove('show');
                    }
                }
            }, { signal: signal, passive: true });

            // ---- Editor detection & MutationObserver ----
            function isElementorEditor() {
                return document.body.classList.contains('elementor-editor-active');
            }

            var bodyObserver = null;

            if (typeof MutationObserver !== 'undefined') {
                bodyObserver = new MutationObserver(function () {
                    if (isElementorEditor()) {
                        // Editor active — stop scroll (but keep icon visible)
                        if (isScrolling) stopScroll(false);
                    }
                });
                bodyObserver.observe(document.body, { attributes: true, attributeFilter: ['class'] });
            }

            // Auto start (skip if inside editor)
            if (config.autoStart && !isElementorEditor()) {
                autoStartTimer = setTimeout(function () {
                    startScroll();
                }, config.autoStartDelay);
            }

            // Initial progress update
            updateProgress();

            // ---- Store instance for cleanup ----
            function storeInstance() {
                container._apeironAutoScroll = {
                    stop: stopScroll,
                    controller: controller,
                    autoStartTimer: autoStartTimer,
                    bodyObserver: bodyObserver
                };
            }
            storeInstance();
        }
    };

    // ---- DOMContentLoaded init ----
    document.addEventListener('DOMContentLoaded', function () {
        AutoScroll.init();
    });

    // ---- Elementor Editor Integration ----
    jQuery(window).on('elementor/frontend/init', function () {
        if (typeof elementorFrontend !== 'undefined' && elementorFrontend.hooks) {
            elementorFrontend.hooks.addAction(
                'frontend/element_ready/apeiron-autoscroll.default',
                function ($scope) {
                    var el = $scope[0] || $scope;
                    if (!el) return;
                    el.querySelectorAll('.apeiron-autoscroll-wrap[data-config]').forEach(function (container) {
                        AutoScroll.destroyWidget(container);
                    });
                    AutoScroll.init();
                }
            );
        }
    });
}(jQuery));
