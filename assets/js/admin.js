/**
 * Admin JavaScript for BizzDocMaker
 *
 * @package BizzDocMaker
 * @since 2.0.0
 */

(function($) {
	'use strict';

	/**
	 * Initialize tab navigation
	 */
	function initTabs() {
		$('.bizzdocmaker-settings .nav-tab').on('click', function(e) {
			e.preventDefault();
			
			var target = $(this).attr('href');
			
			// Update active tab
			$('.nav-tab').removeClass('nav-tab-active');
			$(this).addClass('nav-tab-active');
			
			// Show/hide sections
			$('.form-table').hide();
			$(target).show();
		});
	}

	/**
	 * Initialize settings form validation
	 */
	function initFormValidation() {
		$('.bizzdocmaker-settings form').on('submit', function(e) {
			var isValid = true;
			
			// Validate posts per page
			var postsPerPage = $('input[name="bizzdocmaker_options[posts_per_page]"]').val();
			if (postsPerPage !== '' && postsPerPage < -1) {
				alert('Posts per page must be -1 or greater.');
				isValid = false;
			}
			
			if (!isValid) {
				e.preventDefault();
			}
		});
	}

	/**
	 * Initialize copy to clipboard for shortcodes
	 */
	function initCopyShortcode() {
		$('.bizzdocmaker-widget code').on('click', function() {
			var text = $(this).text();
			var $temp = $('<textarea>');
			
			$('body').append($temp);
			$temp.val(text).select();
			document.execCommand('copy');
			$temp.remove();
			
			// Show feedback
			var $feedback = $('<span class="copy-feedback">Copied!</span>');
			$(this).append($feedback);
			
			setTimeout(function() {
				$feedback.fadeOut(function() {
					$(this).remove();
				});
			}, 1500);
		});
		
		// Add pointer cursor
		$('.bizzdocmaker-widget code').css('cursor', 'pointer');
	}

	/**
	 * Initialize tooltips
	 */
	function initTooltips() {
		$('[data-tooltip]').each(function() {
			$(this).attr('title', $(this).data('tooltip'));
		});
	}

	/**
	 * Initialize settings export/import
	 */
	function initSettingsExport() {
		$('#bizzdocmaker-export-settings').on('click', function(e) {
			e.preventDefault();
			
			var settings = {};
			$('form input, form select, form textarea').each(function() {
				var name = $(this).attr('name');
				if (name) {
					settings[name] = $(this).val();
				}
			});
			
			var dataStr = JSON.stringify(settings, null, 2);
			var dataUri = 'data:application/json;charset=utf-8,' + encodeURIComponent(dataStr);
			
			var exportFileDefaultName = 'bizzdocmaker-settings.json';
			
			var linkElement = document.createElement('a');
			linkElement.setAttribute('href', dataUri);
			linkElement.setAttribute('download', exportFileDefaultName);
			linkElement.click();
		});
	}

	/**
	 * Initialize color picker
	 */
	function initColorPicker() {
		if ($.fn.wpColorPicker) {
			$('.bizzdocmaker-color-picker').wpColorPicker();
		}
	}

	/**
	 * Document ready
	 */
	$(document).ready(function() {
		initTabs();
		initFormValidation();
		initCopyShortcode();
		initTooltips();
		initSettingsExport();
		initColorPicker();

		// Custom event for extensibility
		$(document).trigger('bizzdocmaker:admin:ready');
	});

})(jQuery);
