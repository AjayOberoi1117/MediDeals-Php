(function() {

"use strict";

var medlife = {
	init: function() {
		var self = this;
		self.cacheDom();
		self.bindEvents();
		self.checkWinPhone(); // Windows Phone js
		self.appointmentForm(); // Appointment Form Focus
		self.enableMailchimpForm(); // init mailchimp
		self.initContactForm(); //init contact form
		self.loginModal(); // Forgot Password Toggle
		self.initDatePicker(); // Date picker initialization
		self.initBackToTop(); // Back to top button
		self.initCounerElement(); //Counter elem initialization
		self.addRellaxAnimation(); // Rellax animation
		self.addParallax(); // Parallax animation
		self.initSlider(); // Init slider

	},
	cacheDom: function() {
		this.toTop = $('.back-to-top');
		this.fancyBox = $('.fancybox');
	},
	bindEvents: function() {
		var self = this;
		$(document).on('click','.h-history-policy .burger a', self.toggleHistory); // Toggle History-policy
		$(document).on('click', '.yamm .dropdown-menu', function(e) {e.stopPropagation();}); //Single-Shop-Carousel Slider
		$('select').selectric({disableOnMobile: false}); // Selectric
		$(document).on('hover','#dialog-link, #icons li', function() {
			$(this).addClass("ui-state-hover");
		}, function() {
			$(this).removeClass("ui-state-hover");
		}); // Hover states on the static widgets
		objectFitImages(); //Object Fit Cover
		$('#dl-menu').dlmenu();
		if(this.fancyBox && this.fancyBox.length > 0) {
			this.fancyBox.fancybox();
		}
	},
	initCounerElement: function() {
		var counterElem = $('.counter');
		if(counterElem && counterElem.length > 0) {
			counterElem.counterUp({
				delay: 10,
				time: 1000
			});
		}
	},
	addParallax: function() {
		var parallax = $('.parallax-window');
		if(parallax && parallax.length > 0) {
			parallax.parallax({
				speed: 0.7,
			});
		}
	},
	addRellaxAnimation: function() {
		var rellaxElem = '.rellax',
				selector = $(rellaxElem);
		if(selector && selector.length > 0) {
			if ($(window).width() > 768) {
				var rellax = new Rellax(rellaxElem, {
					speed: -2,
					center: true,
					round: true
				});
			}
		}
	},
	initSlider: function() {
		// slick slider
		$('.clinic-staff-carousel').slick({
			dots: false,
			infinite: true,
			speed: 300,
			slidesToShow: 3,
			slidesToScroll: 3,
			responsive: [{
				breakpoint: 1199,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2,
					infinite: true,
					dots: true
				}
			}, {
				breakpoint: 991,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			}, {
				breakpoint: 767,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1
				}
			}]
		});
		// range slider
		$(".range-slider").slider({
			range: true,
			min: 12,
			max: 149,
			values: [12, 149],
			slide: function(event, ui) {
				$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
			}
		});
		$("#amount").val("$" + $(".range-slider").slider("values", 0) + " - $" + $(".range-slider").slider("values", 1));
	},
	initBackToTop: function() {

		var self = this;
		/* totop button animation */
		if(self.toTop && self.toTop.length > 0){
			/* Show totop button*/
			$(window).scroll(function(){
				var toTopOffset = self.toTop.offset().top;
				var toTopHidden = 1000;
				if (toTopOffset > toTopHidden) {
					self.toTop.addClass('display');
				} else {
					self.toTop.removeClass('display');
				}
			});
			self.toTop.on('click',function (e){
				e.preventDefault();
				$( 'html, body').animate( {scrollTop: 0 }, 'slow' );
			});
		}
	},
	initDatePicker: function() {
		var datepickerID = $("#datepicker");
		if (typeof(datepickerID) === 'undefined') {
			return;
		}
		$(datepickerID).datepicker({
			inline: true,
			showOtherMonths: true,
			selectOtherMonths: true
		});
		$('#time').timepicker();
	},
	loginModal: function() {
		$('.login-modal .forgot-password a').on('click', function() {
			$('.login-modal .login-block').addClass('hide');
			$('.login-modal .forgot-password-block').addClass('open');
		});
		$('.login-modal .close').on('click', function() {
			$('.login-modal .login-block').removeClass('hide');
			$('.login-modal .forgot-password-block').removeClass('open');
		});
	},
	appointmentForm: function() {
		$(".appointment-form .form-control").focus(function() {
			$(this).parent().addClass('focus is-val');
		});
		$(".appointment-form .form-control").blur(function() {
			$(this).parent().removeClass('focus');
			if (!$(this).val()) $(this).parent().removeClass('is-val');
		});
	},
	toggleHistory: function() {
		$('.h-history-policy ul').toggleClass('open');
	},
	checkWinPhone: function() {
		if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
			var msViewportStyle = document.createElement('style');
			msViewportStyle.appendChild(document.createTextNode('@-ms-viewport{width:auto!important}'));
			document.querySelector('head').appendChild(msViewportStyle);
		}
	},
	enableMailchimpForm: function() {
		$('.md__newsletter-form').on('submit', function(event) {
			// Prevent the default
			event.preventDefault();
			var responseContainer = $(this).find('.md__newsletter-message');
			// Clear the message container
			responseContainer.html('').removeClass('has-error is-valid');
			var data = {};
			var dataArray = $(this).serializeArray();
			$.each(dataArray, function(index, item) {
				data[item.name] = item.value;
			});
			var url = $(this).attr('action').replace('/post?', '/post-json?').concat('&c=?');
			$.ajax({
				url: url,
				data: data,
				cache: false,
				dataType: 'jsonp',
				error: function(data) {
					alert('There was an error submitting your request. Please try again in a few minutes.');
				},
				success: function(data) {
					if (data.result.length) {
						if (data.result === 'error') {
							responseContainer.html(data.msg).addClass('has-error');
						} else if (data.result === 'success') {
							responseContainer.html(data.msg).addClass('is-valid');
						}
					} else {
						alert('There was an error submitting your request. Please try again in a few minutes.');
					}
				}
			});
		});
	},
	initContactForm: function() {
		var contactForm = $('.md__contactForm');
		if (typeof(contactForm) === 'undefined') {
			return;
		}
		contactForm.on('submit', function(e) {
			e.preventDefault();
			e.stopPropagation();
			var self = $(this),
				submitButton = self.find('.md__submitBtn');
			//#! Disable repetitive clicks on the submit button. Prevents postbacks
			self.addClass('js-disable-action');
			submitButton.addClass('js-disable-action');
			//#! Redirect to the specified url on success, ONLY if a url is present in the input value
			var redirectToInput = self.find('.md__redirect-to'),
				redirectTo = (typeof(redirectToInput) !== 'undefined' ? redirectToInput.val() : ''),
				//#! Holds the reference to the wrapper displaying the result message
				responseWrapper = self.find('.js-cf-message');
			//#! Clear message
			responseWrapper.empty().hide();
			var fields = self.find('input, textarea, select');
			var data = {
				'isAjaxForm': true
			};
			fields.each(function(i, field) {
				data[field.name] = $(field).val();
			});
			//#! Execute the ajax request
			$.ajax({
				url: self.attr('action'),
				method: 'POST',
				cache: false,
				timeout: 20000,
				async: true,
				data: data
			}).done(function(response) {
				responseWrapper.removeClass('js-response-success js-response-error');
				if (response && typeof(response.data) !== 'undefined') {
					responseWrapper.empty();
					if (!response.success) {
						responseWrapper.addClass('js-response-error');
						$.each(response.data, function(i, err) {
							responseWrapper.append('<p>' + err + '<\/p>');
						});
					} else {
						responseWrapper.addClass('js-response-success').append('<p>' + response.data + '<\/p>');
						//#! Clear the form
						self.find('.md__input').val('');
						//#! Redirect on success (maybe to a Thank you page, whatever)
						if (redirectTo.length > 0) {
							window.setTimeout(function() {
								window.location.href = redirectTo;
							}, 2000);
						}
					}
					responseWrapper.fadeIn();
				} else {
					responseWrapper.removeClass('js-response-success');
					responseWrapper.empty().addClass('js-response-error').append('<p>An error occurred. Please try again in a few seconds.<\/p>').fadeIn();
				}
			}).fail(function(txt, err) {
				responseWrapper.empty().addClass('js-response-error').append('<p>An error occurred: ' + txt + ' Err:' + err + '. Please try again in a few seconds.<\/p>').fadeIn();
			}).always(function() {
				self.removeClass('js-disable-action');
				submitButton.removeClass('js-disable-action');
			});
		});
	},
};

medlife.init();

})();
