const showMessage = (code, message, redirectTo = null) => {
	switch (code) {
		case 200:
			Swal.fire({ title: 'สำเร็จ', text: message, type: 'success' }).then(function() {
				if (redirectTo) location.href = redirectTo
			})
			break
		case 409:
			Swal.fire({ title: 'เกิดข้อผิดพลาด', text: message, type: 'error' })
			break
		default:
			break
	}
}
$(function() {
	'use strict'
	$(function() {
		$('.preloader').fadeOut()
	}),
		jQuery(document).on('click', '.mega-dropdown', function(a) {
			a.stopPropagation()
		})
	var a = function() {
		;(window.innerWidth > 0 ? window.innerWidth : this.screen.width) < 1170
			? ($('body').addClass('mini-sidebar'),
				$('.navbar-brand span').hide(),
				$('.sidebartoggler i').addClass('ti-menu'))
			: ($('body').removeClass('mini-sidebar'), $('.navbar-brand span').show())
		var a = (window.innerHeight > 0 ? window.innerHeight : this.screen.height) - 1
	}
	$(window).ready(a),
		$(window).on('resize', a),
		$('.sidebartoggler').on('click', function() {
			$('body').hasClass('mini-sidebar')
				? ($('body').trigger('resize'), $('body').removeClass('mini-sidebar'), $('.navbar-brand span').show())
				: ($('body').trigger('resize'), $('body').addClass('mini-sidebar'), $('.navbar-brand span').hide())
		}),
		$('.nav-toggler').click(function() {
			$('body').toggleClass('show-sidebar'),
				$('.nav-toggler i').toggleClass('ti-menu'),
				$('.nav-toggler i').addClass('ti-close')
		}),
		$('.search-box a, .search-box .app-search .srh-btn').on('click', function() {
			$('.app-search').toggle(200)
		}),
		$('.right-side-toggle').click(function() {
			$('.right-sidebar').slideDown(50), $('.right-sidebar').toggleClass('shw-rside')
		}),
		$('.floating-labels .form-control')
			.on('focus blur', function(a) {
				$(this).parents('.form-group').toggleClass('focused', 'focus' === a.type || this.value.length > 0)
			})
			.trigger('blur'),
		$(function() {
			for (
				var a = window.location,
					i = $('ul#sidebarnav a')
						.filter(function() {
							return this.href == a
						})
						.addClass('active')
						.parent()
						.addClass('active');
				i.is('li');

			)
				i = i.parent().addClass('in').parent().addClass('active')
		}),
		$(function() {
			$('[data-toggle="tooltip"]').tooltip()
		}),
		$(function() {
			$('[data-toggle="popover"]').popover()
		}),
		$(function() {
			// $('#sidebarnav').AdminMenu()
		}),
		// $('.scroll-sidebar, .right-side-panel, .message-center, .right-sidebar').perfectScrollbar(),
		$('body').trigger('resize'),
		$('.list-task li label').click(function() {
			$(this).toggleClass('task-done')
		}),
		$('a[data-action="collapse"]').on('click', function(a) {
			a.preventDefault(),
				$(this).closest('.card').find('[data-action="collapse"] i').toggleClass('ti-minus ti-plus'),
				$(this).closest('.card').children('.card-body').collapse('toggle')
		}),
		$('a[data-action="expand"]').on('click', function(a) {
			a.preventDefault(),
				$(this)
					.closest('.card')
					.find('[data-action="expand"] i')
					.toggleClass('mdi-arrow-expand mdi-arrow-compress'),
				$(this).closest('.card').toggleClass('card-fullscreen')
		}),
		$('a[data-action="close"]').on('click', function() {
			$(this).closest('.card').removeClass().slideUp('fast')
		}),
		$('.custom-file-input').on('change', function() {
			var a = $(this).val()
			$(this).next('.custom-file-label').html(a)
		})
})
