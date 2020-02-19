(function ($) {
	"use strict";
	$.avia_utilities = $.avia_utilities || {};
	$.avia_utilities.supported = {};
	$.avia_utilities.supports = (function () {
		var div = document.createElement('div'),
			vendors = ['Khtml', 'Ms', 'Moz', 'Webkit', 'O'];
		return function (prop, vendor_overwrite) {
			if (div.style.prop !== undefined) {
				return "";
			}
			if (vendor_overwrite !== undefined) {
				vendors = vendor_overwrite;
			}
			prop = prop.replace(/^[a-z]/, function (val) {
				return val.toUpperCase();
			});

			var len = vendors.length;
			while (len--) {
				if (div.style[vendors[len] + prop] !== undefined) {
					return "-" + vendors[len].toLowerCase() + "-";
				}
			}
			return false;
		};
	}());
	
	/*Check Gallery Not All
	var filterValue = $('.thim-widget-gallery .filter-controls div.active').attr('data-filter');
	$('.thim-widget-gallery .grid').isotope({
		itemSelector: '.fancybox',
		filter: filterValue
	});*/

	/* Smartresize */
	(function ($, sr) {
		var debounce = function (func, threshold, execAsap) {
			var timeout;
			return function debounced() {
				var obj = this, args = arguments;

				function delayed() {
					if (!execAsap)
						func.apply(obj, args);
					timeout = null;
				}

				if (timeout)
					clearTimeout(timeout);
				else if (execAsap)
					func.apply(obj, args);
				timeout = setTimeout(delayed, threshold || 100);
			}
		}
		// smartresize
		jQuery.fn[sr] = function (fn) {
			return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr);
		};
	})(jQuery, 'smartresize');

	$(document).ready(function () {
		thim_resca.init();
	});

	var thim_resca = {
		init: function () {
			this.menuMobile();
			this.back_to_top();
			this.menu_mobile_click();
			this.sticky_header();
			this.post_audio();
			this.post_gallery();
			this.thim_quick_view();
			this.miniCartHover();
			this.filter_select();
			this.sub_menu_mobile();
		},

		menuMobile: function () {
			$('.menu-mobile-effect').on('click touchstart', function (e) {
				e.preventDefault();
				$('.wrapper-container').toggleClass('mobile-menu-open');
			});
			$('#main-content').on('click touchstart', function () {
				$('.wrapper-container').removeClass('mobile-menu-open');
			});
		},

		//Back To top
		back_to_top: function () {
			jQuery(window).scroll(function () {
				if (jQuery(this).scrollTop() > 100) {
					jQuery('#back-to-top').css({bottom: "15px"});
				} else {
					jQuery('#back-to-top').css({bottom: "-100px"});
				}
			});
			jQuery('#back-to-top').click(function () {
				jQuery('html, body').animate({scrollTop: '0px'}, 800);
				return false;
			});
		},

		// sticky header
		sticky_header: function () {
			var $header = $('#masthead.sticky-header.header_default');
			var $content_pusher = $('#wrapper-container .content-pusher');
			$header.imagesLoaded(function () {
				var height_sticky_header = $header.outerHeight(true);
				$content_pusher.css({"padding-top": height_sticky_header + 'px'})
				$(window).resize(function () {
					var height_sticky_header = $header.outerHeight(true);
					$content_pusher.css({"padding-top": height_sticky_header + 'px'})
				});
			});

			var height_header = $('.wrapper-header_overlay .site-header').outerHeight(true);
			var height_header_mobile = $('#masthead').height();
			$('.wrapper-header_overlay').find('.top-site-no-image').css({"padding-top": height_header + 40 + 'px'});
			$('.wrapper-header_overlay').find('.top-site-no-image-custom').css({"padding-top": height_header + 'px'});
			if ($(window).width() < 768) {
				$('.wrapper-header_overlay').find('.page-title-wrapper').css({"padding-top": height_header_mobile + 'px'});
			}

			$(window).scroll(function () {
				var $header = $('#masthead.sticky-header');
				if ($(this).scrollTop() > 2) {
					$header.addClass('affix');
					$header.removeClass('affix-top');
				} else {
					$header.removeClass('affix');
					$header.addClass('affix-top');
				}
			});
		},

		menu_mobile_click: function () {
			if ($(window).width() > 768) {
				$('.header_v1 .navbar-nav >li,.header_v1 .navbar-nav li.standard,.header_v1 .navbar-nav li.standard ul li').hover(
					function () {
						$(this).children('.sub-menu').stop(true, false).slideDown(250);
					},
					function () {
						$(this).children('.sub-menu').stop(true, false).slideUp(250);
					}
				);
			}
		},

		/* ****** jp-jplayer  ******/
		post_audio: function () {
			$('.jp-jplayer').each(function () {
				var $this = $(this),
					url = $this.data('audio'),
					type = url.substr(url.lastIndexOf('.') + 1),
					player = '#' + $this.data('player'),
					audio = {};
				audio[type] = url;
				$this.jPlayer({
					ready: function () {
						$this.jPlayer('setMedia', audio);
					},
					swfPath: 'jplayer/',
					cssSelectorAncestor: player
				});
			});
		},

		post_gallery: function () {
			$('article.format-gallery .flexslider').imagesLoaded(function () {
				$('.flexslider').flexslider({
					slideshow: true,
					animation: 'fade',
					pauseOnHover: true,
					animationSpeed: 400,
					smoothHeight: true,
					directionNav: true,
					controlNav: false
				});
			});
		},

		/* ****** PRODUCT QUICK VIEW  ******/
		thim_quick_view: function () {
			$('.quick-view').click(function (e) {
				/* add loader  */
				$('.quick-view a').css('display', 'none');
				$(this).append('<a href="javascript:;" class="loading dark"></a>');
				var product_id = $(this).attr('data-prod');
				var data = {action: 'jck_quickview', product: product_id};
				$.post(ajaxurl, data, function (response) {
					$.magnificPopup.open({
						mainClass: 'my-mfp-zoom-in',
						items: {
							src: '<div class="mfp-iframe-scaler">' + response + '</div>',
							type: 'inline'
						}
					});
					$('.quick-view a').css('display', 'inline-block');
					$('.loading').remove();
					$('.product-card .wrapper').removeClass('animate');
					setTimeout(function () {
						$('.product-lightbox form').wc_variation_form();
					}, 600);
				});
				e.preventDefault();
			});
		},

		miniCartHover: function () {
			jQuery(document).on('mouseover', '.minicart_hover', function () {
				jQuery(this).next('.widget_shopping_cart_content').slideDown();
			}).on('mouseleave', '.minicart_hover', function () {
				jQuery(this).next('.widget_shopping_cart_content').delay(100).stop(true, false).slideUp();
			});
			jQuery(document)
				.on('mouseenter', '.widget_shopping_cart_content', function () {
					jQuery(this).stop(true, false).show()
				})
				.on('mouseleave', '.widget_shopping_cart_content', function () {
					jQuery(this).delay(100).stop(true, false).slideUp()
				});
		},

		// Filter select
		filter_select: function () {
			$('.thim-widget-filter-restaurant-menu .filter-controls, .thim-widget-gallery .filter-controls').on('click', 'div', function () {
				if (!$(this).hasClass('active')) {
					$(this).siblings().removeClass('active');
					$(this).addClass('active');
				}
				var filterValue = $(this).attr('data-filter');
				$('.grid').isotope({filter: filterValue});
			});
		},

		/* sub mobile menu */
		sub_menu_mobile: function () {
			jQuery('.navbar-nav>li.menu-item-has-children >a,.navbar-nav>li.menu-item-has-children >span').after('<span class="icon-toggle"><i class="fa fa-angle-down"></i></span>');
			jQuery('.navbar-nav>li.menu-item-has-children .icon-toggle').click(function () {
				if (jQuery(this).next('ul.sub-menu').is(':hidden')) {
					jQuery(this).next('ul.sub-menu').slideDown(500, 'linear');
					jQuery(this).html('<i class="fa fa-angle-up"></i>');
				}
				else {
					jQuery(this).next('ul.sub-menu').slideUp(500, 'linear');
					jQuery(this).html('<i class="fa fa-angle-down"></i>');
				}
			});
		},
	}

	var counts = $('.tp_event_counter_widget');
	for( var i = 0; i < counts.length; i++ )
	{
		var time = $(counts[i]).attr( 'data-time' );
		var current_time = $(counts[i]).attr( 'data-current-time' );
		time = new Date(time);
		time = new Date(time - thim_custom_script.gmt_offset);
		current_time = new Date(current_time);

		$(counts[i]).countdown({
			labels: [thim_custom_script.year, thim_custom_script.month, thim_custom_script.week, thim_custom_script.day, thim_custom_script.hours, thim_custom_script.minutes, thim_custom_script.seconds],
			until: time,
			format: 'DHMS',
			padZeroes: true,
			serverSync: current_time
		});
	}

	$(function () {
		thim_resca.back_to_top();
		/* Menu Sidebar */
		jQuery('.sliderbar-menu-controller').click(function (e) {
			e.stopPropagation();
			jQuery('.slider-sidebar').toggleClass('opened');
			jQuery('html,body').toggleClass('slider-bar-opened');
		});
		jQuery('#wrapper-container').click(function () {
			jQuery('.slider-sidebar').removeClass('opened');
			jQuery('html,body').removeClass('slider-bar-opened');
		});
		jQuery(document).keyup(function (e) {
			if (e.keyCode === 27) {
				jQuery('.slider-sidebar').removeClass('opened');
				jQuery('html,body').removeClass('slider-bar-opened');
			}
		});


		/* Waypoints magic
		 ---------------------------------------------------------- */
		if (typeof jQuery.fn.waypoint !== 'undefined') {
			jQuery('.wpb_animate_when_almost_visible:not(.wpb_start_animation)').waypoint(function () {
				jQuery(this).addClass('wpb_start_animation');
			}, {offset: '85%'});
		}
	});

	function empty(data) {
		if (typeof(data) == 'number' || typeof(data) == 'boolean') {
			return false;
		}
		if (typeof(data) == 'undefined' || data === null) {
			return true;
		}
		if (typeof(data.length) != 'undefined') {
			return data.length === 0;
		}
		var count = 0;
		for (var i in data) {
			if (Object.prototype.hasOwnProperty.call(data, i)) {
				count++;
			}
		}
		return count === 0;
	}

	var windowWidth = window.innerWidth,
		windowHeight = window.innerHeight,
		$document = $(document),
		orientation = windowWidth > windowHeight ? 'landscape' : 'portrait';
	var TitleAnimation = {
		selector: '.article__parallax',
		initialized: false,
		animated: false,
		initialize: function () {
			var that = this;
			if (this.initialized) {
				return;
			}
			this.initialized = true;
			$(this.selector).each(function (i, header) {
				var windowHeight = window.innerHeight,
					wh = $(window).height(),
					$header = $(header),
					$headline = $header.find('.article_heading'),
					timeline = new pixGS.TimelineMax(),
					$title = $headline.find('.heading__primary'),
					$subtitle = $headline.find('.heading__secondary'),
					headerTop = $header.offset().top,
					headerHeight = $header.outerHeight();
				// ------ A
				timeline.fromTo($title, 0.89, {opacity: 0}, {opacity: 1, ease: pixGS.Expo.easeOut}, '-=0.72');
				timeline.fromTo($title, 1, {'y': 30}, {'y': 0, ease: pixGS.Expo.easeOut}, '-=0.89');
				timeline.fromTo($subtitle, 0.65, {opacity: 0}, {opacity: 1, ease: pixGS.Quint.easeOut}, '-=0.65');
				timeline.fromTo($subtitle, 0.9, {y: 30}, {y: 0, ease: pixGS.Quint.easeOut}, '-=0.65');
				// ------ B
				timeline.addLabel("animatedIn");
				if (i == 0) {
					timeline.to($headline, 1.08, {y: -60, ease: pixGS.Linear.easeNone});
					timeline.to($title, 1.08, {opacity: 0, y: -60, ease: pixGS.Quad.easeIn}, '-=1.08');
				} else {
					timeline.to($title, 1.08, {opacity: 0, y: -60, ease: pixGS.Quad.easeIn});
				}

				timeline.to($subtitle, 1.08, {opacity: 0, y: -90, ease: pixGS.Quad.easeIn}, '-=1.08');
				timeline.addLabel("animatedOut");
				// ------ C
				var animatedInTime = timeline.getLabelTime("animatedIn"),
					animatedOutTime = timeline.getLabelTime("animatedOut"),
					start = headerTop + headerHeight / 2 - wh / 2,
					end = start + headerHeight / 2,
					ab, bc;

				//if (i == 0) {
				//	start = headerTop;
				//	end = start + windowHeight / 2;
				//}

				ab = animatedInTime / animatedOutTime;
				bc = 1 - ab;

				if (Modernizr.touch) {
					timeline.tweenTo("animatedIn");
					return;
				}

				timeline.tweenTo("animatedOut", {
					onComplete: function () {
						$headline.data("animated", true);
					},
					onUpdate: function () {
						var progress = (1 / (end - start)) * (latestScrollY - start),
							partialProgress = progress < 0 ? ab : ab + bc * progress,
							currentProgress = timeline.progress();

						if (Math.abs(partialProgress - currentProgress) < 0.01) {
							$headline.data("animated", true);
							this.kill();
						}
					}
				});

				$headline.data('tween', {
					timeline: timeline,
					ab: ab,
					bc: bc,
					start: start,
					end: end
				});
			});
			this.update();
		},
		update: function () {
			var that = this;
			$(this.selector).each(function (i, element) {
				var $headline = $(element).find('.article_heading'),
					options = $headline.data('tween'),
					progress = 0;
				// some sanity check
				// we wouldn't want to divide by 0 - the Universe might come to an end
				if (!empty(options) && (options.end - options.start) !== 0) {
					progress = (1 / (options.end - options.start)) * (latestScrollY - options.start);
					// point B being labeled as "animated"
					var partialProgress = options.ab + options.bc * progress;
					$headline.data('progress', partialProgress);
					if (!$headline.data("animated") || (Modernizr.touch )) {
						return;
					}
					if (0 > progress) {
						partialProgress = options.ab;
					}
					if (1 > partialProgress) {
						options.timeline.progress(partialProgress);
						return;
					}
					options.timeline.progress(1);
				}
			});
		}
	}
	/* ====== ON RESIZE ====== */
	$(window).load(function () {
		setTimeout(function () {
			TitleAnimation.initialize();
		}, 400);
		if (!empty($('#date-otreservations'))) {
			// Pikaday
			var picker = new Pikaday({
				field: document.getElementById('date-otreservations'),
				format: 'MM/DD/YYYY',
				minDate: moment().toDate(),
				onSelect: function (sday) {
					var esc_time1 = ["3:00am", "3:30am", "4:00am", "4:30am", "5:00am", "5:30am", "6:00am", "6:30am", "7:00am", "7:30am", "8:00am", "8:30am", "9:00am", "9:30am", "10:00am", "10:30am", "11:00am"];
					var esc_time2 = ["12:00am", "12:30am", "1:00am", "1:30am", "2:00am", "2:30am", "3:00am", "3:30am", "4:00am", "4:30am", "5:00am", "5:30am", "6:00am", "6:30am", "7:00am", "7:30am", "8:00am", "8:30am", "9:00am", "9:30am", "10:00am", "10:30am", "11:00am"];
					var dayweek = sday.getDay();
					if (dayweek === 0 || dayweek === 6) {
						jQuery('select#time-otreservations option').each(function (index, el) {
							var evalue = $(el).attr('value');
							if ($.inArray(evalue, esc_time1) != -1) {
								$(el).attr('disabled', 'disabled').css('display', 'none');
							} else {
								$(el).css('display', 'block').removeAttr('disabled');
							}
						});
					} else {
						jQuery('select#time-otreservations option').each(function (index, el) {
							var evalue = $(el).attr('value');
							if ($.inArray(evalue, esc_time2) != -1) {
								$(el).attr('disabled', 'disabled').css('display', 'none');
							} else {
								$(el).css('display', '').removeAttr('disabled');
							}
						});
					}
				}
			});
		}

		if( !empty($('#time-otreservations')) ) {
			$('#time-otreservations').timepicker({
				'minTime': '11:30am',
				'maxTime': '11:30pm',
				'timeFormat': 'h:i a'
			});
		}

		if( !empty($('#reservation_date')) ) {
			var reservation_date = new Pikaday({
				field: document.getElementById('reservation_date'),
				format: 'MM/DD/YYYY',
				minDate: moment().toDate(),
				onSelect: function () {
					//console.log(this.getMoment().format('Do MMMM YYYY'));
				}
			});
			reservation_date.setDate(moment().format('MM/DD/YYYY'));
		}
	})

	$(window).on("debouncedresize", function (e) {
		windowWidth = $(window).width();
		windowHeight = $(window).height();
		TitleAnimation.initialize();
	});

	$(window).on("orientationchange", function (e) {
		setTimeout(function () {
			TitleAnimation.initialize();
		}, 300)
	});

	var latestScrollY = $('html').scrollTop() || $('body').scrollTop(),
		ticking = false;

	function updateAnimation() {
		ticking = false;
		TitleAnimation.update();
	}

	function requestScroll() {
		if (!ticking) {
			requestAnimationFrame(updateAnimation);
		}
		ticking = true;
	}

	$(window).on("scroll", function () {
		latestScrollY = $('html').scrollTop() || $('body').scrollTop();
		requestScroll();
	});

	/* ====== ON DOCUMENT READY ====== */
	$(document).ready(function () {
		if ($(window).width() > 768) {
			$('.article__parallax').each(function (index, el) {
				$(el).parallax("50%", 0.4);
			});
			$('.images_parallax').parallax_images({
				speed: 0.5
			});
			$(window).resize(function () {
				$('.images_parallax').each(function (index, el) {
					$(el).imagesLoaded(function () {
						var parallaxHeight = $(this).find('img').height();
						$(this).height(parallaxHeight);
					});
				});
			}).trigger('resize');
		}
	});

	if (jQuery().owlCarousel) {
		$(".thim-widget-event,.thim-gallery-images").owlCarousel({
			autoPlay: false,
			singleItem: true,
			stopOnHover: true,
			pagination: true,
			autoHeight: false
		});

		$(".thim-list-posts").owlCarousel({
			autoPlay: false,
			singleItem: true,
			stopOnHover: true,
			pagination: false,
			navigation: true,
			autoHeight: false,
			navigationText: ["<span class='pe-7s-angle-left'></span>", "<span class='pe-7s-angle-right'></span>"]
		});
	}

	jQuery(document).delegate('.bg-video-play', "click", function () {
		if (jQuery(".full-screen-video").get(0).paused) {
			jQuery('.full-screen-video').get(0).play();
			jQuery(this).addClass('bg-pause');
		} else {
			jQuery('.full-screen-video').get(0).pause();
			jQuery(this).removeClass('bg-pause');
		}
	});

	jQuery(function ($) {
		var adminbar_height = jQuery('#wpadminbar').outerHeight();
		jQuery('.navbar-nav li a,.arrow-scroll > a').click(function (e) {
			if (parseInt(jQuery(window).scrollTop(), 10) < 2) {
				var height = 47;
			} else height = 0;
			var sticky_height = jQuery('#masthead').outerHeight();
			var menu_anchor = jQuery(this).attr('href');
			if (menu_anchor && menu_anchor.indexOf("#") == 0 && menu_anchor.length > 1) {
				e.preventDefault();
				$('html,body').animate({
					scrollTop: jQuery(menu_anchor).offset().top - adminbar_height - sticky_height + height
				}, 850);
			}
			jQuery('.wrapper-container').removeClass('mobile-menu-open');
		});
	});

	var scrollTimer = false,
		scrollHandler = function () {
			var scrollPosition = parseInt(jQuery(window).scrollTop(), 10);
			jQuery('.navbar-nav li a[href^="#"]').each(function () {
				var thisHref = jQuery(this).attr('href');
				if (jQuery(thisHref).length) {
					var thisTruePosition = parseInt(jQuery(thisHref).offset().top, 10);
					if (jQuery("#wpadminbar").length) {
						var admin_height = jQuery("#wpadminbar").height();
					} else admin_height = 0;
					var thisPosition = thisTruePosition - (jQuery("#masthead").outerHeight() + admin_height);
					if (scrollPosition <= parseInt(jQuery(jQuery('.navbar-nav li a[href^="#"]').first().attr('href')).height(), 10)) {
						if (scrollPosition >= thisPosition) {
							jQuery('.navbar-nav li a[href^="#"]').removeClass('nav-active');
							jQuery('.navbar-nav li a[href="' + thisHref + '"]').addClass('nav-active');
						}
					} else {
						if (scrollPosition >= thisPosition || scrollPosition >= thisPosition) {
							jQuery('.navbar-nav li a[href^="#"]').removeClass('nav-active');
							jQuery('.navbar-nav li a[href="' + thisHref + '"]').addClass('nav-active');
						}
					}
				}
			});
		}
	window.clearTimeout(scrollTimer);
	scrollHandler();
	jQuery(window).scroll(function () {
		window.clearTimeout(scrollTimer);
		scrollTimer = window.setTimeout(function () {
			scrollHandler();
		}, 20);
	});


	function mobilecheck() {
		var check = false;
		(function (a) {
			if (/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4)))check = true
		})(navigator.userAgent || navigator.vendor || window.opera);
		return check;
	}

	if (mobilecheck()) {
		window.addEventListener('load', function () { // on page load
			document.getElementById('main-content').addEventListener("touchstart", function (e) {
				jQuery('.wrapper-container').removeClass('mobile-menu-open');
			});
		}, false)
	}

	// check if share post

	if ($('.single-post .share-post').outerHeight() == 0) {
		$('.single-post .share-post').next('.content-inner').css('width', '100%');
		$('.single-post .comments-area').css('margin-left', '0');
	}

	$(".fancybox").fancybox();

	$(function () {
		/* Icon Box */
		$(".wrapper-box-icon").each(function () {
			var $this = $(this);
			if ($this.attr("data-icon")) {
				var $color_icon = $(".boxes-icon", $this).css('color');
				var $color_icon_change = $this.attr("data-icon");
			}
			if ($this.attr("data-icon-border")) {
				var $color_icon_border = $(".boxes-icon", $this).css('border-color');
				var $color_icon_border_change = $this.attr("data-icon-border");
			}
			if ($this.attr("data-icon-bg")) {
				var $color_bg = $(".boxes-icon", $this).css('background-color');
				var $color_bg_change = $this.attr("data-icon-bg");
			}


			if ($this.attr("data-btn-bg")) {
				var $color_btn_bg = $(".smicon-read", $this).css('background-color');
				var $color_btn_border = $(".smicon-read", $this).css('border-color');
				var $color_btn_bg_text_color = $(".smicon-read", $this).css('color');

				var $color_btn_bg_change = $this.attr("data-btn-bg");
				if ($this.attr("data-text-readmore")) {
					var $color_btn_bg_text_color_change = $this.attr("data-text-readmore");
				} else {
					$color_btn_bg_text_color_change = $color_btn_bg_text_color;
				}
				$(".smicon-read", $this).hover(
					function () {
						/* for select style*/
						if ($("#style_selector_container").length > 0) {
							if ($(".smicon-read", $this).css("background-color") != $color_btn_bg)
								$color_btn_bg = $(".smicon-read", $this).css('background-color');
						}
						$(".smicon-read", $this).css({
							'background-color': $color_btn_bg_change,
							'border-color': $color_btn_bg_change,
							'color': $color_btn_bg_text_color_change
						});
					}, function () {
						$(".smicon-read", $this).css({
							'background-color': $color_btn_bg,
							'border-color': $color_btn_border,
							'color': $color_btn_bg_text_color
						});
					}
				);
			}

			$(".boxes-icon", $this).hover(
				function () {
					if ($this.attr("data-icon")) {
						$(".boxes-icon", $this).css({'color': $color_icon_change});
					}
					if ($this.attr("data-icon-bg")) {
						/* for select style*/
						if ($("#style_selector_container").length > 0) {
							if ($(".boxes-icon", $this).css("background-color") != $color_bg)
								$color_bg = $(".boxes-icon", $this).css('background-color');
						}

						$(".boxes-icon", $this).css({'background-color': $color_bg_change});
					}
					if ($this.attr("data-icon-border")) {
						$(".boxes-icon", $this).css({'border-color': $color_icon_border_change});
					}
				}, function () {
					if ($this.attr("data-icon")) {
						$(".boxes-icon", $this).css({'color': $color_icon});
					}
					if ($this.attr("data-icon-bg")) {
						$(".boxes-icon", $this).css({'background-color': $color_bg});
					}
					if ($this.attr("data-icon-border")) {
						$(".boxes-icon", $this).css({'border-color': $color_icon_border});
					}
				}
			);
		});
		/* End Icon Box */
	});

})(jQuery);

(function($){
	function unique_id() {
		function s4() {
			return Math.floor((1 + Math.random()) * 0x10000)
				.toString(16)
				.substring(1);
		}
		return s4() + s4() + s4() + s4();
	}
	$.fn.RevTextAnim = function( options ){
		return $.each(this, function(){
			var RevTextAnim = $(this).data('RevTextAnim');
			if( $.type( RevTextAnim ) == 'undefined' ){
				RevTextAnim = new $.RevTextAnim( this, options );
				$(this).data('RevTextAnim', RevTextAnim);
			}
			return this;
		});
	}

	$.RevTextAnim = function(elem, options){
		this.options = $.extend({
			items: '>*'
		}, options || {});
		var that = this,
			$window = $(window),
			$element = $(elem);
		$items = $element.find( this.options.items ),
			containerOffset = $element.offset();
		var top = containerOffset.top;
		function initialize(){
			$window.bind('scroll.' + unique_id(), function(){
				var scrollTop = $window.scrollTop(),
					dx = ( scrollTop - ( top - that.options.offset ) ) / ($element.height() / 2);
				$items = $element.find( that.options.items );
				if( scrollTop > 0 ){
					var len = $items.length
					$items.each(function(i){
						var dy = ( (len - i) * dx );
						dy = -( dy * dy * dy ) * 2;
						$(this).css({
							transform: 'translate3d(0px, ' + dy + 'px, 0px)',
							opacity: Math.max( 0, 1 - ( dx / 2 ) ),
							transition: 'initial'
						});
					})

				}else if( scrollTop == 0 ){
					$items.each(function(i){
						$(this)
							.css('transform', '')
							.css('opacity', '');
					})
				}
			});
		}
		initialize();
	}

	$(document).ready(function(){
		setTimeout( function(){
			$('.tp-revslider-mainul >li,.images_parallax').RevTextAnim({
				items: '.heading__secondary, .heading__primary, .show-separator, .tp-caption .tp-button',
				offset: 200
			});
		}, 1000)

		// Restaurant menu and Tab restaurant menu
		
		$('.image-popup').magnificPopup({
			type: 'image',
			closeOnContentClick: true,
			closeBtnInside: false,
			fixedContentPos: true,
			mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
			image: {
				verticalFit: true,
				tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
				titleSrc: function (item) {
					return item.el.attr('data-caption') + '<small>' + item.el.attr('data-desc') + '</small>';
				}
			},
			zoom: {
				enabled: true,
				duration: 300 // don't forget to change the duration also in CSS
			}
		});

		$(document).ready(function() {
			$('.popup-gallery').magnificPopup({
				delegate: 'a',
				type: 'image',
				tLoading: 'Loading image #%curr%...',
				mainClass: 'mfp-img-mobile',
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0,1] // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
					titleSrc: function(item) {
						return item.el.attr('title') + '<small>by Marsel Van Oosten</small>';
					}
				}
			});
		});

	});

	/*
	 Fix IP6
	 */
	jQuery(document).ready(function(){
		if(navigator.userAgent.search('iPhone OS 8')>0){
			jQuery(window).resize(function(){
				jQuery('.content-pusher').height( jQuery(window).height() - jQuery('#wpadminbar').height() );
			});
			jQuery('.content-pusher').height( jQuery(window).height() - jQuery('#wpadminbar').height() ).css('overflow','scroll');
		}
	});

	//// perload
	//jQuery(document).ready(function ($) {
	//    $(window).load(function () {
	//        $('#ip-container').delay(100).fadeOut(500, function () {
	//            $(this).remove();
	//        });
	//    });
	//});

	// filter items on button click

})(jQuery);

/*!
 * classie - class helper functions
 * from bonzo https://github.com/ded/bonzo
 *
 * classie.has( elem, 'my-class' ) -> true/false
 * classie.add( elem, 'my-new-class' )
 * classie.remove( elem, 'my-unwanted-class' )
 * classie.toggle( elem, 'my-class' )
 */

/*jshint browser: true, strict: true, undef: true */
/*global define: false */

( function( window ) {

	'use strict';

// class helper functions from bonzo https://github.com/ded/bonzo

	function classReg( className ) {
		return new RegExp("(^|\\s+)" + className + "(\\s+|$)");
	}

// classList support for class management
// altho to be fair, the api sucks because it won't accept multiple classes at once
	var hasClass, addClass, removeClass;

	if ( 'classList' in document.documentElement ) {
		hasClass = function( elem, c ) {
			return elem.classList.contains( c );
		};
		addClass = function( elem, c ) {
			elem.classList.add( c );
		};
		removeClass = function( elem, c ) {
			elem.classList.remove( c );
		};
	}
	else {
		hasClass = function( elem, c ) {
			return classReg( c ).test( elem.className );
		};
		addClass = function( elem, c ) {
			if ( !hasClass( elem, c ) ) {
				elem.className = elem.className + ' ' + c;
			}
		};
		removeClass = function( elem, c ) {
			elem.className = elem.className.replace( classReg( c ), ' ' );
		};
	}

	function toggleClass( elem, c ) {
		var fn = hasClass( elem, c ) ? removeClass : addClass;
		fn( elem, c );
	}

	var classie = {
		// full names
		hasClass: hasClass,
		addClass: addClass,
		removeClass: removeClass,
		toggleClass: toggleClass,
		// short names
		has: hasClass,
		add: addClass,
		remove: removeClass,
		toggle: toggleClass
	};

// transport
	if ( typeof define === 'function' && define.amd ) {
		// AMD
		define( classie );
	} else {
		// browser global
		window.classie = classie;
	}

})( window );
/**
 * pathLoader.js v1.0.0
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Copyright 2014, Codrops
 * http://www.codrops.com
 */
;( function( window ) {

	'use strict';

	function PathLoader( el ) {
		this.el = el;
		// clear stroke
		this.el.style.strokeDasharray = this.el.style.strokeDashoffset = this.el.getTotalLength();
	}

	PathLoader.prototype._draw = function( val ) {
		this.el.style.strokeDashoffset = this.el.getTotalLength() * ( 1 - val );
	}

	PathLoader.prototype.setProgress = function( val, callback ) {
		this._draw(val);
		if( callback && typeof callback === 'function' ) {
			// give it a time (ideally the same like the transition time) so that the last progress increment animation is still visible.
			setTimeout( callback, 200 );
		}
	}

	PathLoader.prototype.setProgressFn = function( fn ) {
		if( typeof fn === 'function' ) { fn( this ); }
	}

	// add to global namespace
	window.PathLoader = PathLoader;

})( window );
/**
 * main.js
 * http://www.codrops.com
 *
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 *
 * Copyright 2014, Codrops
 * http://www.codrops.com
 */
(function() {

	var support = { animations : Modernizr.cssanimations },
		container = document.getElementById( 'ip-container' ),
		header = container.querySelector( '.ip-header' ),
		loader = new PathLoader( document.getElementById( 'ip-loader-circle' ) ),
		animEndEventNames = { 'WebkitAnimation' : 'webkitAnimationEnd', 'OAnimation' : 'oAnimationEnd', 'msAnimation' : 'MSAnimationEnd', 'animation' : 'animationend' },
	// animation end event name
		animEndEventName = animEndEventNames[ Modernizr.prefixed( 'animation' ) ];

	function init() {
		var onEndInitialAnimation = function() {
			if( support.animations ) {
				this.removeEventListener( animEndEventName, onEndInitialAnimation );
			}

			startLoading();
		};

		// disable scrolling
		//window.addEventListener( 'scroll', noscroll );

		// initial animation
		classie.add( container, 'loading' );

		if( support.animations ) {
			container.addEventListener( animEndEventName, onEndInitialAnimation );
		}
		else {
			onEndInitialAnimation();
		}
	}

	function startLoading() {
		// simulate loading something..
		var simulationFn = function(instance) {
			var progress = 0,
				interval = setInterval( function() {
					progress = Math.min( progress + Math.random() * 0.1, 1 );

					instance.setProgress( progress );

					// reached the end
					if( progress === 1 ) {
						classie.remove( container, 'loading' );
						classie.add( container, 'loaded' );
						clearInterval( interval );

						var onEndHeaderAnimation = function(ev) {
							if( support.animations ) {
								if( ev.target !== header ) return;
								this.removeEventListener( animEndEventName, onEndHeaderAnimation );
							}

							classie.add( document.body, 'layout-switch' );
							window.removeEventListener( 'scroll', noscroll );
						};

						if( support.animations ) {
							header.addEventListener( animEndEventName, onEndHeaderAnimation );
						}
						else {
							onEndHeaderAnimation();
						}
					}
				}, 80 );
		};

		loader.setProgressFn( simulationFn );
	}

	function noscroll() {
		window.scrollTo( 0, 0 );
	}

	init();

})();