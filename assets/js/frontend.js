/**
 * Frontend JavaScript for BizzDocMaker
 *
 * @package BizzDocMaker
 * @since 2.0.0
 */

(function($) {
	'use strict';

	/**
	 * Initialize accordion functionality
	 */
	function initAccordion() {
		$('.bizzdocmaker-accordion .bizzdocmaker-heading').on('click', function() {
			var section = $(this).closest('.bizzdocmaker-section');
			
			// Toggle collapsed class
			section.toggleClass('collapsed');
			
			// Close other sections if single mode
			if (section.closest('.bizzdocmaker-accordion').hasClass('single-mode')) {
				section.siblings('.bizzdocmaker-section').addClass('collapsed');
			}
		});
	}

	/**
	 * Initialize smooth scrolling for anchor links
	 */
	function initSmoothScroll() {
		$('.bizzdocmaker-wrapper a[href^="#"]').on('click', function(e) {
			var target = $(this.hash);
			
			if (target.length) {
				e.preventDefault();
				
				$('html, body').animate({
					scrollTop: target.offset().top - 100
				}, 500);
			}
		});
	}

	/**
	 * Initialize search functionality
	 */
	function initSearch() {
		$('.bizzdocmaker-search-input').on('keyup', function() {
			var searchTerm = $(this).val().toLowerCase();
			var wrapper = $(this).closest('.bizzdocmaker-wrapper');
			
			wrapper.find('.bizzdocmaker-item').each(function() {
				var text = $(this).text().toLowerCase();
				
				if (text.indexOf(searchTerm) > -1) {
					$(this).show();
				} else {
					$(this).hide();
				}
			});
			
			// Hide/show sections with no visible items
			wrapper.find('.bizzdocmaker-section').each(function() {
				var visibleItems = $(this).find('.bizzdocmaker-item:visible').length;
				
				if (visibleItems > 0) {
					$(this).show();
				} else {
					$(this).hide();
				}
			});
		});
	}

	/**
	 * Initialize highlight active item
	 */
	function highlightActiveItem() {
		var currentUrl = window.location.href;
		
		$('.bizzdocmaker-link').each(function() {
			if (this.href === currentUrl) {
				$(this).closest('.bizzdocmaker-item').addClass('active');
			}
		});
	}

	/**
	 * Initialize lazy loading for images
	 */
	function initLazyLoad() {
		if ('IntersectionObserver' in window) {
			var imageObserver = new IntersectionObserver(function(entries, observer) {
				entries.forEach(function(entry) {
					if (entry.isIntersecting) {
						var img = entry.target;
						img.src = img.dataset.src;
						img.classList.remove('lazy');
						imageObserver.unobserve(img);
					}
				});
			});

			document.querySelectorAll('.bizzdocmaker-wrapper img.lazy').forEach(function(img) {
				imageObserver.observe(img);
			});
		}
	}

	/**
	 * Initialize tab switching
	 */
	function initTabs() {
		$('.bizzdocmaker-tab-nav a').on('click', function(e) {
			e.preventDefault();
			
			var tabId = $(this).attr('href');
			var wrapper = $(this).closest('.bizzdocmaker-tabs');
			
			// Update active tab
			wrapper.find('.bizzdocmaker-tab-nav a').removeClass('active');
			$(this).addClass('active');
			
			// Show corresponding content
			wrapper.find('.bizzdocmaker-tab-content').removeClass('active');
			wrapper.find(tabId).addClass('active');
		});
	}

	/**
	 * Document ready
	 */
	$(document).ready(function() {
		initAccordion();
		initSmoothScroll();
		initSearch();
		highlightActiveItem();
		initLazyLoad();
		initTabs();

		// Custom event for extensibility
		$(document).trigger('bizzdocmaker:ready');
	});

})(jQuery);
