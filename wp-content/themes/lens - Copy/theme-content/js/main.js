/* ====== SHARED VARS ====== */

var phone, touch, ltie9, lteie9, wh, ww, dh, ar, fonts, ieMobile;

var ua = navigator.userAgent;
var winLoc = window.location.toString();

var is_webkit = ua.match(/webkit/i);
var is_firefox = ua.match(/gecko/i);
var is_newer_ie = ua.match(/msie (9|([1-9][0-9]))/i);
var is_older_ie = ua.match(/msie/i) && !is_newer_ie;
var is_ancient_ie = ua.match(/msie 6/i);
var is_mobile = ua.match(/mobile/i);
var is_OSX = (ua.match(/(iPad|iPhone|iPod|Macintosh)/g) ? true : false);

var nua = navigator.userAgent;
var is_android = ((nua.indexOf('Mozilla/5.0') > -1 && nua.indexOf('Android ') > -1 && nua.indexOf('AppleWebKit') > -1) && !(nua.indexOf('Chrome') > -1));

var useTransform = true;
var use2DTransform = (ua.match(/msie 9/i) || winLoc.match(/transform\=2d/i));
// 
// To be used like this
// 
// if (!use2DTransform) {
//     transformParam = 'translate3d(...)';
// } else {
//     transformParam = 'translateY(...)';
// }
var transform;

// setting up transform prefixes
var prefixes = {
	webkit: 'webkitTransform',
	firefox: 'MozTransform',
	ie: 'msTransform',
	w3c: 'transform'
};

if (useTransform) {
	if (is_webkit) {
		transform = prefixes.webkit;
	} else if (is_firefox) {
		transform = prefixes.firefox;
	} else if (is_newer_ie) {
		transform = prefixes.ie;
	}
}

/* --- To enable verbose debug add to Theme Options > Custom Code footer -> globalDebug=true; --- */
var globalDebug = false,
	timestamp;

(function($,window,undefined) {

	/* --- DETECT VIEWPORT SIZE --- */

	function browserSize(){
		wh = $(window).height();
		ww = $(window).width();
		dh = $(document).height();
		ar = ww/wh;
	}


	/* --- DETECT PLATFORM --- */

	function platformDetect(){
		$.support.touch = 'ontouchend' in document;
		var navUA = navigator.userAgent.toLowerCase(),
			navPlat = navigator.platform.toLowerCase();	


		var isiPhone = navPlat.indexOf("iphone"),
			isiPod = navPlat.indexOf("ipod"),
			isAndroidPhone = navPlat.indexOf("android"),
			safari = (navUA.indexOf('safari') != -1 && navUA.indexOf('chrome') == -1) ? true : false,
			svgSupport = (window.SVGAngle) ? true : false,
			svgSupportAlt = (document.implementation.hasFeature("http://www.w3.org/TR/SVG11/feature#BasicStructure", "1.1")) ? true : false,
			ff3x = (/gecko/i.test(navUA) && /rv:1.9/i.test(navUA)) ? true : false;

		phone = (isiPhone > -1 || isiPod > -1 || isAndroidPhone > -1) ? true : false;
		touch = $.support.touch ? true : false;
		ltie9 = $.support.leadingWhitespace ? false : true;
		lteie9 = typeof window.atob === 'undefined' ? true : false;

		ieMobile = navigator.userAgent.match(/Windows Phone/i) ? true : false;



		var $bod = $('body');

		if (touch || ieMobile) {
			$('html').addClass('touch');
		}
		if (safari) $bod.addClass('safari');
		if (phone) $bod.addClass('phone');

	}

/* --- Magnific Popup Initialization --- */

function magnificPopupInit() {
	if (globalDebug) {console.log("Magnific Popup - Init");}

	$('.js-gallery').each(function() { // the containers for all your galleries should have the class gallery
		$(this).magnificPopup({
			delegate: '.mosaic__item.magnific-link a, .masonry__item--image__container a', // the container for each your gallery items
			removalDelay: 500,
			mainClass: 'mfp-fade',
			image: {
				titleSrc: function (item){
					var output = '';
					if ( typeof item.el.attr('data-title') !== "undefined" && item.el.attr('data-title') !== "") {
						output = item.el.attr('data-title');
					}
					if ( typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
						output += '<small>'+item.el.attr('data-alt')+'</small>';
					}
					return output;
				}
			},
			iframe: {
				markup:
					'<div class="mfp-figure mfp-figure--video">'+
						'<button class="mfp-close"></button>'+
						'<div>'+
						'<div class="mfp-iframe-scaler">'+
						'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
						'</div>'+
						'</div>'+
						'<div class="mfp-bottom-bar">'+
						'<div class="mfp-title mfp-title--video"></div>'+
						'<div class="mfp-counter"></div>'+
						'</div>'+
						'</div>',
				patterns: {
					youtube: {
						index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
						id: function(url){
							var video_id = url.split('v=')[1];
							var ampersandPosition = video_id.indexOf('&');
							if(ampersandPosition != -1) {
								video_id = video_id.substring(0, ampersandPosition);
							}

							return video_id;
						}, // String that splits URL in a two parts, second part should be %id%
						// Or null - full URL will be returned
						// Or a function that should return %id%, for example:
						// id: function(url) { return 'parsed id'; }
						src: '//www.youtube.com/embed/%id%' // URL that will be set as a source for iframe.
					},
					youtu_be: {
						index: 'youtu.be/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
						id: '.be/', // String that splits URL in a two parts, second part should be %id%
						// Or null - full URL will be returned
						// Or a function that should return %id%, for example:
						// id: function(url) { return 'parsed id'; }
						src: '//www.youtube.com/embed/%id%' // URL that will be set as a source for iframe.
					},

					vimeo: {
						index: 'vimeo.com/',
						id: '/',
						src: '//player.vimeo.com/video/%id%'
					},
					gmaps: {
						index: '//maps.google.',
						src: '%id%&output=embed'
					}
					// you may add here more sources
				},
				srcAction: 'iframe_src' // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
			},
			gallery:{
				enabled:true,
				navigateByImgClick: true,
				// arrowMarkup: '<a href="#" class="mfp-arrow mfp-arrow-%dir% control-item arrow-button arrow-button--%dir%"></a>',
				tPrev: 'Previous (Left arrow key)', // title for left button
				tNext: 'Next (Right arrow key)', // title for right button
				// tCounter: '<div class="gallery-control gallery-control--popup"><div class="control-item count js-gallery-current-slide"><span class="js-unit">%curr%</span><sup class="js-gallery-slides-total">%total%</sup></div></div>'
				tCounter: '<div class="gallery-control gallery-control--popup"><a href="#" class="control-item arrow-button arrow-button--left js-arrow-popup-prev"></a><div class="control-item count js-gallery-current-slide"><span class="js-unit">%curr%</span><sup class="js-gallery-slides-total">%total%</sup></div><a href="#" class="control-item arrow-button arrow-button--right js-arrow-popup-next"></a></div>'
			},
			callbacks:{
				elementParse: function(item) {
					$(item).find('iframe').each(function(){
						var url = $(this).attr("src");
						$(this).attr("src", setQueryParameter(url, "wmode", "transparent"));
					});

					if(this.currItem != undefined){
						item = this.currItem;
					}

					var output = '';
					if ( typeof item.el.attr('data-title') !== "undefined" && item.el.attr('data-title') !== "") {
						output = item.el.attr('data-title');
					}
					if ( typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
						output += '<small>'+item.el.attr('data-alt')+'</small>';
					}

					$('.mfp-title--video').html(output);
				},
				change: function(item) {
					$(this.content).find('iframe').each(function(){
						var url = $(this).attr("src");
						$(this).attr("src", setQueryParameter(url, "wmode", "transparent"));
					});

					var output = '';
					if ( typeof item.el.attr('data-title') !== "undefined" && item.el.attr('data-title') !== "") {
						output = item.el.attr('data-title');
					}
					if ( typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
						output += '<small>'+item.el.attr('data-alt')+'</small>';
					}

					$('.mfp-title--video').html(output);
				}
			}
		});
	});

	// hide title on hover over images so we don't have that ugly tooltip
	// replace when hover leaves
	var tempGalleryTitle = '';
	$('.js-gallery a').hover(
		function () {
			tempGalleryTitle = $(this).attr('title');
			$(this).attr({'title':''});
		},
		function () {
			$(this).attr({'title':tempGalleryTitle});
		}
	);

	$('.js-project-gallery').each(function() { // the containers for all your galleries should have the class gallery
		$(this).magnificPopup({
			delegate: 'a[href$=".jpg"], a[href$=".png"], a[href$=".gif"], .mfp-iframe', // the container for each your gallery items
			type: 'image',
			removalDelay: 500,
			mainClass: 'mfp-fade',
			image: {
				titleSrc: function (item){
					var output = '';
					if ( typeof item.el.attr('data-title') !== "undefined" && item.el.attr('data-title') !== "") {
						output = item.el.attr('data-title');
					}
					if ( typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
						output += '<small>'+item.el.attr('data-alt')+'</small>';
					}
					return output;
				}
			},
			iframe: {
				markup:
					'<div class="mfp-figure mfp-figure--video">'+
						'<div>'+
						'<div class="mfp-close"></div>'+
						'<div class="mfp-iframe-scaler">'+
						'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
						'</div>'+
						'</div>'+
						'<div class="mfp-bottom-bar">'+
						'<div class="mfp-title mfp-title--video"></div>'+
						'<div class="mfp-counter"></div>'+
						'</div>'+
						'</div>',
				patterns: {
					youtube: {
						index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
						id: 'v=', // String that splits URL in a two parts, second part should be %id%
						// Or null - full URL will be returned
						// Or a function that should return %id%, for example:
						// id: function(url) { return 'parsed id'; }
						src: '//www.youtube.com/embed/%id%' // URL that will be set as a source for iframe.
					},
					vimeo: {
						index: 'vimeo.com/',
						id: '/',
						src: '//player.vimeo.com/video/%id%'
					},
					gmaps: {
						index: '//maps.google.',
						src: '%id%&output=embed'
					}
					// you may add here more sources
				},
				srcAction: 'iframe_src' // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
			},
			gallery:{
				enabled:true,
				navigateByImgClick: true,
				tPrev: 'Previous (Left arrow key)', // title for left button
				tNext: 'Next (Right arrow key)', // title for right button
				tCounter: '<div class="gallery-control gallery-control--popup"><a href="#" class="control-item arrow-button arrow-button--left js-arrow-popup-prev"></a><div class="control-item count js-gallery-current-slide"><span class="js-unit">%curr%</span><sup class="js-gallery-slides-total">%total%</sup></div><a href="#" class="control-item arrow-button arrow-button--right js-arrow-popup-next"></a></div>'
			},
			callbacks:{
				elementParse: function(item) {
					$(item).find('iframe').each(function(){
						var url = $(this).attr("src");
						$(this).attr("src", url+"?wmode=transparent");
					});

					if(this.currItem != undefined){
						item = this.currItem;
					}

					var output = '';
					if ( typeof item.el.attr('data-title') !== "undefined" && item.el.attr('data-title') !== "") {
						output = item.el.attr('data-title');
					}
					if ( typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
						output += '<small>'+item.el.attr('data-alt')+'</small>';
					}

					$('.mfp-title--video').html(output);
				},
				change: function(item) {
					$(this.content).find('iframe').each(function(){
						var url = $(this).attr("src");
						$(this).attr("src", url+"?wmode=transparent");
					});

					var output = '';
					if ( typeof item.el.attr('data-title') !== "undefined" && item.el.attr('data-title') !== "") {
						output = item.el.attr('data-title');
					}
					if ( typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
						output += '<small>'+item.el.attr('data-alt')+'</small>';
					}

					$('.mfp-title--video').html(output);
				}
			}
		});
	});

	//Magnific Popup for any other <a> tag that links to an image
	function blog_posts_popup(e) {
		if (jQuery().magnificPopup) {
			e.magnificPopup({
				type: 'image',
				closeOnContentClick: false,
				closeBtnInside: false,
				removalDelay: 500,
				mainClass: 'mfp-fade',
				image: {
					titleSrc: function (item){
						var output = '';
						if ( typeof item.el.attr('data-title') !== "undefined" && item.el.attr('data-title') !== "") {
							output = item.el.attr('data-title');
						}
						if ( typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
							output += '<small>'+item.el.attr('data-alt')+'</small>';
						}
						return output;
					}
				},
				gallery: {
					enabled:true,
					navigateByImgClick: true,
					tPrev: 'Previous (Left arrow key)', // title for left button
					tNext: 'Next (Right arrow key)', // title for right button
					tCounter: '<div class="gallery-control gallery-control--popup"><a href="#" class="control-item arrow-button arrow-button--left js-arrow-popup-prev"></a><div class="control-item count js-gallery-current-slide"><span class="js-unit">%curr%</span><sup class="js-gallery-slides-total">%total%</sup></div><a href="#" class="control-item arrow-button arrow-button--right js-arrow-popup-next"></a></div>'
				},
				callbacks:{
					elementParse: function(item) {
						$(item).find('iframe').each(function(){
							var url = $(this).attr("src");
							$(this).attr("src", url+"?wmode=transparent");
						});

						if(this.currItem != undefined){
							item = this.currItem;
						}

						var output = '';
						if ( typeof item.el.attr('data-title') !== "undefined" && item.el.attr('data-title') !== "") {
							output = item.el.attr('data-title');
						}
						if ( typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
							output += '<small>'+item.el.attr('data-alt')+'</small>';
						}

						$('.mfp-title--video').html(output);
					},
					change: function(item) {
						$(this.content).find('iframe').each(function(){
							var url = $(this).attr("src");
							$(this).attr("src", url+"?wmode=transparent");
						});

						var output = '';
						if ( typeof item.el.attr('data-title') !== "undefined" && item.el.attr('data-title') !== "") {
							output = item.el.attr('data-title');
						}
						if ( typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
							output += '<small>'+item.el.attr('data-alt')+'</small>';
						}

						$('.mfp-title--video').html(output);
					}
				}
			});
		}
	}

	var blog_posts_images = $('.post a[href$=".jpg"], .post a[href$=".png"], .post a[href$=".gif"], .page a[href$=".jpg"], .page a[href$=".png"], .page a[href$=".gif"]');
	if(blog_posts_images.length) { blog_posts_popup(blog_posts_images); }

	$('.popup-video').magnificPopup({
		type: 'iframe',
		closeOnContentClick: false,
		closeBtnInside: false,
		removalDelay: 500,
		mainClass: 'mfp-fade',

		iframe: {
			markup:
				'<div class="mfp-figure mfp-figure--video">'+
					'<div>'+
					'<div class="mfp-close"></div>'+
					'<div class="mfp-iframe-scaler">'+
					'<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
					'</div>'+
					'</div>'+
					'<div class="mfp-bottom-bar">'+
					'<div class="mfp-title mfp-title--video"></div>'+
					'<div class="mfp-counter"></div>'+
					'</div>'+
					'</div>',
			patterns: {
				youtube: {
					index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).
					id: 'v=', // String that splits URL in a two parts, second part should be %id%
					// Or null - full URL will be returned
					// Or a function that should return %id%, for example:
					// id: function(url) { return 'parsed id'; }
					src: '//www.youtube.com/embed/%id%' // URL that will be set as a source for iframe.
				},
				vimeo: {
					index: 'vimeo.com/',
					id: '/',
					src: '//player.vimeo.com/video/%id%'
				},
				gmaps: {
					index: '//maps.google.',
					src: '%id%&output=embed'
				}
				// you may add here more sources
			},
			srcAction: 'iframe_src' // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
		},
		callbacks:{
//			elementParse: function(item) {
//				$(item).find('iframe').each(function(){
//					var url = $(this).attr("src");
//					$(this).attr("src", url+"?wmode=transparent");
//				});
//
//				if(this.currItem != undefined){
//					item = this.currItem;
//				}
//
//				var output = '';
//				var $image = $(item.el).children("img:first");
//				if ($image.length) {
//					if ( typeof $image.attr('title') !== "undefined" && $image.attr('title') !== "") {
//						output = $image.attr('title');
//					}
//					if ( typeof $image.attr('alt') !== "undefined" && $image.attr('alt') !== "") {
//						output += '<small>'+$image.attr('alt')+'</small>';
//					}
//				}
//
//				$('.mfp-title--video').html(output);
//			},
//			change: function(item) {
//				$(this.content).find('iframe').each(function(){
//					var url = $(this).attr("src");
//					$(this).attr("src", url+"?wmode=transparent");
//				});
//
//				var output = '';
//				if ( typeof item.el.attr('data-title') !== "undefined" && item.el.attr('data-title') !== "") {
//					output = item.el.attr('data-title');
//				}
//				if ( typeof item.el.attr('data-alt') !== "undefined" && item.el.attr('data-alt') !== "") {
//					output += '<small>'+item.el.attr('data-alt')+'</small>';
//				}
//
//				$('.mfp-title--video').html(output);
//			}
		}
	});

	// hide title on hover over images so we don't have that ugly tooltip
	// replace when hover leaves
	var tempProjectTitle = '';
	$('.js-project-gallery a').hover(
		function () {
			tempProjectTitle = $(this).attr('title');
			$(this).attr({'title':''});
		},
		function () {
			$(this).attr({'title':tempProjectTitle});
		}
	);

	//for the PixProof galleries in case they are used
	$('.js-pixproof-lens-gallery').each(function() { // the containers for all your galleries should have the class gallery
		$(this).magnificPopup({
			delegate: 'a.zoom-action', // the container for each your gallery items
			type: 'image',
			mainClass: 'mfp-fade',
			closeOnBgClick: false,
			image: {
				markup: '<button class="mfp-close">x</button>'+
					'<div class="mfp-figure">'+
					'<div class="mfp-img"></div>'+
					'</div>'+
					'<div class="mfp-bottom-bar">'+
					'<div class="mfp-title"></div>'+
					'<div class="mfp-counter"></div>'+
					'</div>',
				titleSrc: function(item) {
					var text = $('#' + item.el.data('photoid')).hasClass('selected') == true ? 'Deselect' : 'Select';

					return '<a class="meta__action  meta__action--popup  select-action"  id="popup-selector" href="#" data-photoid="' + item.el.data('photoid') + '"><span class="button-text">' + text + '</span></a>';
				}
			},
			gallery:{
				enabled:true,
				navigateByImgClick: true,
				tPrev: 'Previous (Left arrow key)', // title for left button
				tNext: 'Next (Right arrow key)', // title for right button
				tCounter: '<div class="gallery-control gallery-control--popup"><a href="#" class="control-item arrow-button arrow-button--left js-arrow-popup-prev"></a><a href="#" class="control-item arrow-button arrow-button--right js-arrow-popup-next"></a></div>'
			}
		});
	});
}


/* --- Royal Slider Init --- */

function royalSliderInit() {
	if (globalDebug) {console.log("Royal Slider - Init");}

	// Helper function
	// examples
	// console.log(padLeft(23,5));       //=> '00023'
	// console.log(padLeft(23,5,'>>'));  //=> '>>>>>>23'
	function padLeft(nr, n, str){
		return Array(n-String(nr).length+1).join(str||'0')+nr;
	}

	// create the markup for the slider from the gallery shortcode
	// take all the images and insert them in the .gallery <div>
	$('.wp-gallery').each(function() {
		var $old_gallery = $(this),
			$images = $old_gallery.find('img'),
			$new_gallery = $('<div class="pixslider js-pixslider">');
		$images.prependTo($new_gallery).addClass('rsImg');
		$old_gallery.replaceWith($new_gallery);

		var gallery_data = $(this).data();
		$new_gallery.data(gallery_data);
	});

	$('.js-pixslider').each(function(){

		var $slider = $(this),
			rs_arrows = typeof $slider.data('arrows') !== "undefined",
			rs_bullets = typeof $slider.data('bullets') !== "undefined" ? "bullets" : "none",
			rs_autoheight = typeof $slider.data('autoheight') !== "undefined",
			rs_customArrows = typeof $slider.data('customarrows') !== "undefined",
			rs_slidesSpacing = typeof $slider.data('slidesspacing') !== "undefined" ? parseInt($slider.data('slidesspacing')) : 0,
			rs_keyboardNav  = typeof $slider.data('fullscreen') !== "undefined",
			rs_enableCaption = typeof $slider.data('enablecaption') !== "undefined",
			rs_imageScale  = typeof $slider.data('imagescale') !== "undefined" && $slider.data('imagescale') != '' ? $slider.data('imagescale') : 'fill',
			rs_imageAlignCenter  = typeof $slider.data('imagealigncenter') !== "undefined",
			rs_transition = typeof $slider.data('slidertransition') !== "undefined" && $slider.data('slidertransition') != '' ? $slider.data('slidertransition') : 'move',
			rs_autoPlay = typeof $slider.data('sliderautoplay') !== "undefined" ? true : false,
			rs_delay = typeof $slider.data('sliderdelay') !== "undefined" && $slider.data('sliderdelay') != '' ? $slider.data('sliderdelay') : '1000',
			rs_pauseOnHover = typeof $slider.data('sliderpauseonhover') !== "undefined" ? true : false,
			rs_visibleNearby = typeof $slider.data('visiblenearby') !== "undefined" ? true : false,
			rs_drag = true;


		var $children = $(this).children();

		if($children.length == 1){
			rs_arrows = false;
			rs_bullets = 'none';
			rs_customArrows = false;
			rs_keyboardNav = false;
			rs_drag = false;
			rs_transition = 'fade';
			// rs_enable_caption = false;
		}

		// make sure default arrows won't appear if customArrows is set
		if (rs_customArrows) arrows = false;

		//the main params for Royal Slider
		var royalSliderParams = {
			loop: true,
			imageScaleMode: rs_imageScale,
			imageAlignCenter: rs_imageAlignCenter,
			slidesSpacing: rs_slidesSpacing,
			arrowsNav: rs_arrows,
			controlNavigation: rs_bullets,
			keyboardNavEnabled: rs_keyboardNav,
			arrowsNavAutoHide: false,
			sliderDrag: rs_drag,
			transitionType: rs_transition,
			globalCaption: rs_enableCaption,
			numImagesToPreload: 2,
			autoPlay: {
				enabled: rs_autoPlay,
				stopAtAction: true,
				pauseOnHover: rs_pauseOnHover,
				delay: rs_delay
			},
			video: {
				// stop showing related videos at the end
				youTubeCode: '<iframe src="http://www.youtube.com/embed/%id%?rel=0&autoplay=1&showinfo=0&wmode=transparent" frameborder="no"></iframe>'
			}
		};

		if (rs_autoheight) {
            royalSliderParams['autoHeight'] = true;
            royalSliderParams['autoScaleSlider'] = false;
            royalSliderParams['imageScaleMode'] = 'none';
            royalSliderParams['imageAlignCenter'] = false;
		} else {
			royalSliderParams['autoHeight'] = false;
			royalSliderParams['autoScaleSlider'] = true;
		}

		if (rs_visibleNearby) {
			royalSliderParams['visibleNearby'] = {
				enabled: true,
//				centerArea: 0.7,
//				center: true,
				breakpoint: 650,
				breakpointCenterArea: 0.64,
				navigateByCenterClick: false
			}
		}

		//fire it up!!!!
		$slider.royalSlider(royalSliderParams);

		var royalSlider = $slider.data('royalSlider');
		var slidesNumber = royalSlider.numSlides;

		if(slidesNumber == 1) $slider.addClass('single-slide');

		// create the markup for the customArrows
		if(slidesNumber > 1)
			if (royalSlider && rs_customArrows) {
				var $gallery_control = $(
					'<div class="gallery-control js-gallery-control">' +
						'<a href="#" class="control-item arrow-button arrow-button--left js-slider-arrow-prev"></a>' +
						'<div class="control-item count js-gallery-current-slide">' +
						'<span class="highlighted js-decimal">0</span><span class="js-unit">1</span>' +
						'<sup class="js-gallery-slides-total">0</sup>' +
						'</div>' +
						'<a href="#" class="control-item arrow-button arrow-button--right js-slider-arrow-next"></a>'+
						'</div>'
				);

				if ($slider.data('customarrows') == "left") {
					$gallery_control.addClass('gallery-control--left');
				}

				$gallery_control.insertAfter($slider);

				// write the total number of slides inside the markup created above
				// make sure it is left padded with 0 in case it is lower than 10
				slidesNumber = (slidesNumber < 10) ? padLeft(slidesNumber, 2) : slidesNumber;
				$gallery_control.find('.js-gallery-slides-total').html(slidesNumber);

				// add event listener to change the current slide number on slide change
				royalSlider.ev.on('rsBeforeAnimStart', function(event) {
					var currentSlide = royalSlider.currSlideId + 1;
					if(currentSlide < 10){
						$gallery_control.find('.js-gallery-current-slide .js-decimal').html('0');
						$gallery_control.find('.js-gallery-current-slide .js-unit').html(currentSlide);
					} else {
						$gallery_control.find('.js-gallery-current-slide .js-decimal').html(Math.floor(currentSlide / 10));
						$gallery_control.find('.js-gallery-current-slide .js-unit').html(currentSlide % 10);
					}
				});

				$gallery_control.on('click', '.js-slider-arrow-prev', function(event){
					event.preventDefault();
					royalSlider.prev();
				});

				$gallery_control.on('click', '.js-slider-arrow-next', function(event){
					event.preventDefault();
					royalSlider.next();
				});
			}

		royalSlider.ev.on('rsVideoPlay', function() {

			if($('.single-gallery-fullscreen').length) {
				$('html').addClass('video-active');
			}

			var $frameHolder = $('.rsVideoFrameHolder');
			var top = Math.abs(parseInt($frameHolder.siblings('.rsMainSlideImage').css('margin-top'), 10));

			if(rs_imageScale == "fill"){
				$frameHolder
					.height($('.rsContainer').height())
					.css('top', top + 'px');
			}

		});

		royalSlider.ev.on('rsVideoStop', function() {
			if($('.single-gallery-fullscreen').length)
				$('html').removeClass('video-active');
		});

	});

	// While watching a video in RoyalSlider on gallery fullscreen,
	// if directly navigating without stopping using RoyalSlider,
	// to allow the event written above ^ to take place,
	// the <html/> has the class .video-active, making the header transparent.
	// So it needs to be removed.
	if($('html').hasClass('video-active')) $('html').removeClass('video-active');
};


/* --- MOSAIC INIT --- */


//global mosaic variables
var $mosaic_container,
	max_mosaic_pages,
	is_everything_loaded,
	mosaic_page_counter;

function mosaicInit() {
	if (globalDebug) {console.log("Mosaic - Init");}

	//initialize global variables
	$mosaic_container = $('.mosaic');

	if ( !empty($mosaic_container)) {
		max_mosaic_pages = $mosaic_container.data('maxpages');
		is_everything_loaded = false;
	}

	mixitUpRun();

	//force the infinite scroll to wait for the first images to lead before doing it's thing
	if ($mosaic_container.hasClass('infinite_scroll')) {
//		$mosaic_container.imagesLoaded(function(){
		mosaicInfiniteScrollingInit($mosaic_container);
//		});
	}

	// Call Direction Aware Hover Effect
	if(!touch) {
		$('.mosaic__item .image_item-meta--portfolio .image_item-table').each(function() {
			$(this).hoverdir();
		});
	}
}

/* --- Mosaic Update --- */

function mosaicUpdateLayout() {
	if (globalDebug) {console.log("Mosaic Update Layout");}

	if ( !empty($mosaic_container) && $mosaic_container.length ) {
		$mosaic_container.isotope( 'layout');
	}
}

/* --- Mosaic Destroy --- */

function mosaicDestroy() {
	if (globalDebug) {console.log("Mosaic Destroy");}

	if ( !empty($mosaic_container) && $mosaic_container.length ) {
		$mosaic_container.isotope( 'destroy');
	}
}


/* --- Layout Refresh --- */

function layoutRefresh() {
	if (globalDebug) {console.log("Mosaic Layout Refresh");}

	mosaicUpdateLayout();
}

/* --- MixitUp Run --- */

function mixitUpRun() {
	if (!empty($mosaic_container) && $mosaic_container.length) {
		if (globalDebug) {console.log("Mosaic Initialization (mixitUpRun)");}
		// MixitUp init
		$mosaic_container.mixitup({
			targetSelector: '.mosaic__item',
			filterSelector: '.mosaic__filter-item',
			effects: ['fade','scale'],
			easing: 'snap',
			transitionSpeed: 850
		});

		//Mixitup 2 config
//		$mosaic_container.mixItUp({
//			selectors: {
//				target: '.mosaic__item',
//				filter: '.mosaic__filter-item'
//			},
//			animation:  {
//				enable: true,
//				effects: 'fade scale',
//				easing: 'snap',
//				duration: 850
//			}
//
//		});

	}
}

/* -- Mosaic Infinite Scrolling Initialization --- */

function mosaicInfiniteScrollingInit($container) {
	if (globalDebug) {console.log("Mosaic Infinite Scroll Init");}

	max_mosaic_pages = $container.data('maxpages');
	mosaic_page_counter = 1;

	$container.infinitescroll({
			navSelector  : '.mosaic__pagination',    // selector for the paged navigation
			nextSelector : '.mosaic__pagination a.next',  // selector for the NEXT link
			itemSelector : '.mosaic__item',     // selector for all items you'll retrieve
			loading: {
				finished: undefined,
				finishedMsg: '',
				img: '',
				msg: null,
				msgText: '',
				selector: null,
				speed: 'fast',
				start: undefined
			},
			debug: globalDebug,
			//animate      : true,
			//extraScrollPx: 500,
			prefill: true,
			maxPage: max_mosaic_pages,
			errorCallback: function(){
				$('html').removeClass('loading');
			},
			startCallback: function(){
				$('html').addClass('loading');
			}
			// called when a requested page 404's or when there is no more content
			// new in 1.2
		},
		// a callback when all is fetched
		function( newElements ) {

			var $newElems = $( newElements );

			//refresh all there is to refresh
			infiniteScrollingRefreshComponents($container);

			if (globalDebug) {console.log("Mosaic Infinite Scroll - Adding new "+$newElems.length+" items to the DOM");}

			if (globalDebug) {console.log("Mosaic Infinite Scroll Loaded Next Page");}

			mosaic_page_counter++;

			if (mosaic_page_counter == max_mosaic_pages) {
				$('.load-more__container').fadeOut('slow');
			} else {
				$('.load-more__container .load-more__button').removeClass('loading');
			}

			$('html').removeClass('loading');
		});

	if ($container.hasClass('infinite_scroll_with_button')) {
		infiniteScrollingOnClick($container);
	}
}

function infiniteScrollingOnClick($container) {
	if (globalDebug) {console.log("Infinite Scroll Init - ON CLICK");}

	// unbind normal behavior. needs to occur after normal infinite scroll setup.
	$(window).unbind('.infscr');

	$('.load-more__container .load-more__button').click(function(){

		$('html').addClass('loading');

		$container.infinitescroll('retrieve');

		return false;
	});

	// remove the paginator when we're done.
	$(document).ajaxError(function(e,xhr,opt){
		if (xhr.status == 404) {
			$('.load-more__container').fadeOut('slow');
		}
	});
}

//in case you need to control infinitescroll
function infiniteScrollingPause() {
	if (globalDebug) {console.log("Infinite Scroll Pause");}

	$mosaic_container.infinitescroll('pause');
}
function infiniteScrollingResume() {
	if (globalDebug) {console.log("Infinite Scroll Resume");}

	$mosaic_container.infinitescroll('resume');
}
function infiniteScrollingDestroy() {
	if (globalDebug) {console.log("Infinite Scroll Destroy");}

	$mosaic_container.infinitescroll('destroy');
}

function infiniteScrollingRefreshComponents($container) {
	if (globalDebug) {console.log("Infinite Scroll - Refresh Components");}

	lazyLoad();

	mixitUpRun();

	// Call Direction Aware Hover Effect
	if(!touch) {
		$('.mosaic__item .image_item-meta--portfolio .image_item-table').each(function() {
			$(this).hoverdir();
		});
	}

	animateGallery('in');
}

/* --- GMAP Init --- */

function gmapInit() {
	if ($('#gmap').length) {

		var gmap_link, gmap_variables, gmap_zoom, gmap_style;
		gmap_link = $('#gmap').data('url');
		gmap_style = typeof $('#gmap').data('customstyle') !== "undefined" ? "style1" : google.maps.MapTypeId.ROADMAP;

		// Overwrite Math.log to accept a second optional parameter as base for logarhitm
		Math.log = (function() {
			var log = Math.log;
			return function(n, base) {
				return log(n)/(base ? log(base) : 1);
			};
		})();

		function get_url_parameter(needed_param, gmap_url) {
			var sURLVariables = (gmap_url.split('?'))[1];
			if (typeof sURLVariables === "undefined") {
				return sURLVariables;
			}
			sURLVariables = sURLVariables.split('&');
			for (var i = 0; i < sURLVariables.length; i++)  {
				var sParameterName = sURLVariables[i].split('=');
				if (sParameterName[0] == needed_param) {
					return sParameterName[1];
				}
			}
		}

		var gmap_coordinates = [],
			gmap_zoom;

		if (gmap_link) {
			//Parse the URL and load variables (ll = latitude/longitude; z = zoom)
			var gmap_variables = get_url_parameter('ll', gmap_link);
			if (typeof gmap_variables === "undefined") {
				gmap_variables = get_url_parameter('sll', gmap_link);
			}
			// if gmap_variables is still undefined that means the url was pasted from the new version of google maps
			if (typeof gmap_variables === "undefined") {

				if(gmap_link.split('!3d') != gmap_link){
					//new google maps old link type

					var split, lt, ln, dist, z;
					split = gmap_link.split('!3d');
					lt = split[1];
					split = split[0].split('!2d');
					ln = split[1];
					split = split[0].split('!1d');
					dist = split[1];
					gmap_zoom = 21 - Math.round(Math.log(Math.round(dist/218), 2));
					gmap_coordinates = [lt, ln];

				} else {
					//new google maps new link type

					var gmap_link_l;

					gmap_link_l = gmap_link.split('@')[1];
					gmap_link_l = gmap_link_l.split('z/')[0];

					gmap_link_l = gmap_link_l.split(',');

					var latitude = gmap_link_l[0];
					var longitude = gmap_link_l[1];
					var zoom = gmap_link_l[2];

					if(zoom.indexOf('z') >= 0)
						zoom = zoom.substring(0, zoom.length-1);

					gmap_coordinates[0] = latitude;
					gmap_coordinates[1] = longitude;
					gmap_zoom = zoom;
				}



			} else {
				gmap_zoom = get_url_parameter('z', gmap_link);
				if (typeof gmap_zoom === "undefined") {
					gmap_zoom = 10;
				}
				gmap_coordinates = gmap_variables.split(',');
			}
		}

		$("#gmap").gmap3({
			map:{
				options:{
					center: new google.maps.LatLng(gmap_coordinates[0], gmap_coordinates[1]),
					zoom: parseInt(gmap_zoom),
					mapTypeId: gmap_style,
					mapTypeControlOptions: {mapTypeIds: []},
					scrollwheel: false
				}
			},
			overlay:{
				latLng: new google.maps.LatLng(gmap_coordinates[0], gmap_coordinates[1]),
				options:{
					content:  '<div class="pin_ring pin_ring--outer">' +
						'<div class="pin_ring pin_ring--inner"></div>' +
						'</div>'
				}
			},
			styledmaptype:{
				id: "style1",
				options:{
					name: "Style 1"
				},
				styles: [
					{
						stylers: [
							{ saturation: -100 }
						]
					}
				]
			}
		});
	}
}


/* ====== INITIALIZE ====== */


function init() {
	if (globalDebug) {console.group("Init");}

	/* GLOBAL VARS */
	touch = false;

	/* GET BROWSER DIMENSIONS */
	browserSize();

	/* DETECT PLATFORM */
	platformDetect();

	/* INSTANTIATE DJAX */
	if ($('body').data('ajaxloading') !== undefined) {

		var djax_transition = function($newEl) {
			if (globalDebug) {console.group("djax Transition");}

			var $oldEl = this;
			$oldEl.replaceWith($newEl);
			// we should make sure initial transition ended

			$('html').removeClass('is--gallery-fullscreen');
			$('html').removeClass('is--gallery-grid');

			if(!empty($newEl.find('.pixslider--gallery-fs'))){
				$('html').addClass('is--gallery-fullscreen');
			}

			if(!empty($newEl.find('.gallery-grid'))){
				$('html').addClass('is--gallery-grid');
			}

			setTimeout(function() {
				$('html').removeClass('loading');
			});

			if (globalDebug) {console.groupEnd();}
		}

		$('body').djax('.djax-updatable', ['.pdf','.doc','.eps','.png','.zip','admin','wp-','wp-admin','feed','#', '?lang=', '&lang=', '&add-to-cart=', '?add-to-cart=', '?remove_item'], djax_transition);

	}

	if (is_android || window.opera) {
		$('html').addClass('android-browser').removeClass('no-android-browser');
	}

	var is_retina = (window.retina || window.devicePixelRatio > 1);

	if (is_retina && $('.site-logo--image-2x').length) {
		var image = $('.site-logo--image-2x').find('img');

		if (image.data('logo2x') !== undefined) {
			image.attr('src', image.data('logo2x'));
		}
	}

    $('html').addClass('loaded');

	var h = $(window).height(),
		sh = $('.site-header__branding').outerHeight(true),
		hh = $('.site-header').outerHeight(true),
		fh = $('.site-footer').outerHeight(true);

	if (h < hh + sh + fh) {
		$('.site-footer').css({
			"position": "static",
			"margin-left": 0,
//			"padding-right": "24px"
		});
	}

	if(!empty($('.pixslider--gallery-fs'))) {
		$('html').addClass('is--gallery-fullscreen');
	}

	if(!empty($('.gallery-grid'))){
		$('html').addClass('is--gallery-grid');
	}

	FastClick.attach(document.body);

	/* ONE TIME EVENT HANDLERS */
	eventHandlersOnce();

	/* INSTANTIATE EVENT HANDLERS */
	eventHandlers();

	if (globalDebug) {console.groupEnd();}
};


/* ====== CONDITIONAL LOADING ====== */

function loadUp(){
	if (globalDebug) {console.group("LoadUp");}

	// always
    niceScrollInit();
	initVideos();
	resizeVideos();
	progressbarInit();

	//Set textarea from contact page to autoresize
	if($("textarea").length) { $("textarea").autosize(); }

	// if blog archive
	if ($('.masonry').length && !lteie9 && !is_android) {
		salvattoreStart();
	}

	// royal slider must initialize after salavottre
	// for the layout to show up properly
	royalSliderInit();

	// if gallery
	magnificPopupInit();

	// if gallery grid or portfolio
	mosaicInit();

	// if contact
	gmapInit();

	$(".pixcode-tabs").tab();


	/* --- ANIMATE STUFF IN --- */
	animateGallery('in');
	animateBlog('in');

	if (globalDebug) {console.groupEnd();}
}


/* ====== EVENT HANDLERS ====== */

function eventHandlersOnce() {
	if (globalDebug) {console.group("Event Handlers Once");}

	// $('.js-nav-trigger').on('click', function(e) {
	//        var hh = $('.header').height(),
	//            ch = $('.navigation--mobile').height(),
	//            max = Math.max(wh,ch,hh);
	//            // console.log(max);
	//        if ($('html').hasClass('navigation--is-visible')) {
	//            $('#page').css({'height': ''});
	//        } else {
	//            $('#page').css({'height': max});
	//        }

	//        $('html').toggleClass('navigation--is-visible');
	//    });

	var windowHeigth = $(window).height();

	$('.js-nav-trigger').bind('click', function(e) {
		e.preventDefault();
		e.stopPropagation();

		if($('html').hasClass('navigation--is-visible')){
			$('#page').css('height', '');
			$('html').removeClass('navigation--is-visible');

		} else {
			$('#page').height(windowHeigth);
			$('html').addClass('navigation--is-visible');
		}
	});

	$('.wrapper').bind('click', function(e) {
		if ($('html').hasClass('navigation--is-visible')) {

			e.preventDefault();
			e.stopPropagation();

			$('#page').css('height', '');
			$('html').removeClass('navigation--is-visible');
		}
	});

    copyrightOverlayInit();


//	if (typeof once_woocommerce_events_handlers == 'function') {
//		once_woocommerce_events_handlers();
//	}

	if (globalDebug) {console.groupEnd();}
};


function likeBoxAnimation(){
	$(document).on('click', '.can_like .like-link', function(e){
		e.preventDefault();
		var $iElem = $(this).find('i');
		$iElem.addClass('animate-like').delay(1000).queue(function(){$(this).addClass('like-complete');});
		// $(this).addClass('animate-like');
	});
}


/* --- GLOBAL EVENT HANDLERS --- */

function magnificPrev(e) {
	if (globalDebug) {console.log("Magnific Popup Prev");}

	e.preventDefault();
	var magnificPopup = $.magnificPopup.instance;
	magnificPopup.prev();
	return false;
}

function magnificNext(e) {
	if (globalDebug) {console.log("Magnific Popup Next");}

	e.preventDefault();
	var magnificPopup = $.magnificPopup.instance;
	magnificPopup.next();
	return false;
}

$(window).bind('beforeunload', function(event) {
	if (globalDebug) {console.log("ON BEFORE UNLOAD");}

//	event.stopPropagation();

//	animateBlog('out');
});

function eventHandlers() {
	if (globalDebug) {console.group("Event Handlers");}

	/*
	 * Woocommerce Events support
	 * */

	if (typeof woocommerce_events_handlers == 'function') {
		woocommerce_events_handlers();
		// needed for the floating ajax cart
		$('body').trigger('added_to_cart');
	}

	$('body').off('click', '.js-arrow-popup-prev', magnificPrev).on('click', '.js-arrow-popup-prev', magnificPrev);
	$('body').off('click', '.js-arrow-popup-next', magnificNext).on('click', '.js-arrow-popup-next', magnificNext);

	/* @todo: change classes so style and js don't interfere */
	$('.menu-item--parent').hoverIntent({
		over: function() {
			$(this).addClass('js--is-active');
			$(this).children('.site-navigation__sub-menu').slideDown(200, 'easeInOutSine', function(){
				placeFooter();
			});
		},
		out: function() {
			if(!($(this).hasClass('current-menu-item')) &&
				!($(this).hasClass('current-menu-ancestor')) &&
				!($(this).hasClass('current-menu-parent'))){
				$(this).removeClass('js--is-active');
				$(this).children('.site-navigation__sub-menu').slideUp(200, 'easeInOutSine');
			}
		},
		timeout: 1000
	});


	likeBoxAnimation();

	var filterHandler;

	if(touch) {
		filterHandler = 'click';
	} else {
		filterHandler = 'hover';
	}

	if(ieMobile) filterHandler = 'click';

	$('.sticky-button__btn').on(filterHandler, function(){
		$(this).toggleClass('sticky-button--active');
	});

	$('.cart__btn1').on(filterHandler, function(){
		$(this).toggleClass('cart--active');
	});

	if (globalDebug) {console.groupEnd();}
};



/* ====== ON DOCU READY ====== */

$(function(){
	if (globalDebug) {console.group("OnDocumentReady");}

	/* --- INITIALIZE --- */

	init();

	/* --- CONDITIONAL LOADING --- */

	loadUp();

	/* --- VISUAL LOADING --- */


	if (globalDebug) {console.groupEnd();}
});





/* --- $LAZY LOADING INIT --- */

/**
 *
 * When an image finished loaded add class to parent for
 * the image to fade in
 *
 **/
function lazyLoad() {

	var $images = $('.js-lazy-load');

	$images.each(function(){

		var $img = $(this),
			src = $img.attr('data-src');

		$img.on('load', function() {
			$img.closest('.mosaic__item').addClass('js--is-loaded');
		});

		$img.attr('src', src);
	});
};



/* ====== ON WINDOW LOAD ====== */

$(window).load(function(){
	if (globalDebug) {console.group("OnWindowLoad");}

	lazyLoad();

	$('html').removeClass('loading');

	if (globalDebug) {console.groupEnd();}
});


/* --- Animation Functions --- */

function animateGallery(direction) {
	if (globalDebug) {console.log("Animate Gallery " + direction);}

	direction = direction == "in" ? direction : "out";

	$('.mosaic__item').each(function(){
		var $item = $(this);
		setTimeout(function() {
			$item.addClass('slide-' + direction);
		}, 80 * Math.floor((Math.random()*5)+1));
	});

}


function animateBlog(direction) {
	if (globalDebug) {console.log("Animate Blog " + direction);}

	if (!is_android) {

		direction = direction == "in" ? direction : "out";

		var sizes = new Array();
		var columns = new Array();
		var items = $('.masonry .span .masonry__item').length;

		$('.masonry .span').each(function(i, e){
			columns[i] = $(this).children('.masonry__item');
			sizes[i] = columns[i].length;
		});

		var max = Math.max.apply(null, sizes);

		for (var item = 0; item < max; item++) {

			$(columns).each(function(column) {

				if (columns[column][item] !== undefined) {

					if (direction == "in") {

						var $item = $(columns[column][item]),
							timeout = item * columns.length + column;

						setTimeout(function() {
							$item.addClass('is-loaded');
						}, 100 * timeout);

					} else {

						var $item = $(columns[column][item]),
							timeout = items - (item * columns.length + column);

						setTimeout(function() {
							$item.removeClass('is-loaded');
						}, 100 * timeout);
					}
				}
			});
		}
	}
}





/* ====== ON DJAX REQUEST ====== */

$(window).bind('djaxClick', function(e, data) {
	if (globalDebug) {console.group("On-dJaxClick");}

    $('html').removeClass('noanims');

	$('html').addClass('loading');
	$('html, body').animate({scrollTop: 0}, 300);

	if ($('html').hasClass('navigation--is-visible')) {
		$('#page').css({'height': ''});
		$('html').removeClass('navigation--is-visible');
		// $(window).trigger('resize');
	}

	/* --- ANIMATE STUFF OUT --- */
	animateGallery('out');
	animateBlog('out');

	if (globalDebug) {console.groupEnd();}
});





/* ====== ON DJAX LOAD ====== */

$(window).bind('djaxLoad', function(e, data) {
	if (globalDebug) {console.group("On-dJaxLoad");}

	// get data and replace the body tag with a nobody tag
	// because jquery strips the body tag when creating objects from data
	data = data.response.replace(/(<\/?)body( .+?)?>/gi,'$1NOTBODY$2>', data);
	// get the nobody tag's classes
	var nobodyClass = $(data).filter('notbody').attr("class");
	// set it to current body tag
	$('body').attr("class", nobodyClass);
	// let the party begin
	$('html').removeClass('loading');

    setTimeout(function(){
        $('html').addClass('noanims');
    }, 700);

	// progressbars ?

	eventHandlers();

	browserSize();
	resizeVideos();

	lazyLoad();
	loadUp();

	//need to get the id from the data
	var curpostid = $(data).filter('notbody').data("curpostid");
	if (curpostid !== undefined) {
		adminBarEditFix(curpostid);
	}

	//lets do some Google Analytics Tracking
	if (window._gaq) {
		_gaq.push(['_trackPageview']);
	}

	if (globalDebug) {console.groupEnd();}
});




// /* ====== ON DJAX LOADING!!! ====== */

$(window).bind('djaxLoading', function(e, data) {
	if (globalDebug) {console.group("On-dJaxLoading");}

	cleanupBeforeDJax();

	if (globalDebug) {console.groupEnd();}
});




/* ====== ON RESIZE ====== */

$(window).on("debouncedresize", function(e){
	if (globalDebug) {console.group("OnResize");}

	browserSize();

	resizeVideos();

    placeFooter();

    if (ww < 901) {
        $('html').removeClass('nicescroll');
        $('[data-smoothscrolling]').getNiceScroll().hide();
    } else {
        $('html').addClass('nicescroll');
        niceScrollInit();
    }

	if (globalDebug) {console.groupEnd();}
});






/* ====== ON SCROLL ======  */

$(window).scroll(function(e){


	if ($('.entry__likes').length) {

		var likes = $('.entry__likes'),
			likesOffset = likes.offset(),
			likesh = likes.height(),
			likesTop = likesOffset.top,
			likesBottom = likesTop + likesh,
			post = $('.post .entry__wrap'),
			posth = post.height(),
			postOffset = post.offset(),
			postTop = postOffset.top,
			postBottom = postTop + posth,
			scroll = $('body').scrollTop();

		if (ww > 1599) {

			// hacky way to get scroll consisten in chrome / firefox
			if (scroll == 0) scroll = $('html').scrollTop();

			// if scrolled past the top of the container but not below the bottom of it
			if (scroll > postTop && scroll + likesh < postBottom) {

				// insert after content for fixed position to work properly
				// set left value to the box's initial left offset
				likes.insertAfter('.content').css({
					position: 'fixed',
					top: 0,
					left: likesOffset.left
				});

				// the box should follow scroll anymore
			} else {

				// we are below the container's bottom
				// so we have to move to box back up while scrolling down
				if (scroll + likesh > postBottom) {

					likes.insertAfter('.content').css({
						top: postBottom - scroll - likesh
					});

					// we are back up so we must put the box back in it's place
				} else {

					likes.prependTo('.entry__wrap').css({
						position: '',
						top: 0,
						left: ''
					});

				}
			}

		} else {

			// make sure that the box is in it's lace when resizing the browser
			likes.prependTo('.entry__wrap').css({
				position: '',
				top: 0,
				left: ''
			});

		}
	}
});

/* === Functions that require jQuery but have no place on this Earth, yet === */

/* --- NICESCROLL INIT--- */

function niceScrollInit() {
	if (globalDebug) {console.log("NiceScroll - Init");}

	var smoothScroll = $('body').data('smoothscrolling') !== undefined;

	if ($('.site-navigation').length) {
		var offset = $('.site-navigation').offset();
		mobile = offset.left > ww;
	}

	if (smoothScroll && ww > 899 && !touch && !is_OSX) {
		$('html').addClass('nicescroll');
		$('[data-smoothscrolling]').niceScroll({
			zindex: 9999,
			cursoropacitymin: 0.3,
			cursorwidth: 7,
			cursorborder: 0,
			mousescrollstep: 40,
			scrollspeed: 100,
			cursorcolor: '#000000'
		});
	}
}

/* --- PROGRESSBAR INIT --- */

function progressbarInit() {
	if (globalDebug) {console.log("ProgressBar - Init");}

	var progressbar_shc = $('.progressbar');
	progressbar_shc.addClass('is-visible');
	if (progressbar_shc.length) {
		progressbar_shc.each(function() {
			var self = $(this).find('.progressbar__progress');
			self.css({'width': self.data('value')});
		});;
	}
}

/* --- $VIDEOS --- */

function initVideos() {
	if (globalDebug) {console.log("Videos - Init");}

	var videos = $('.video-wrap iframe, .entry__wrap iframe, video');

	// Figure out and save aspect ratio for each video
	videos.each(function() {
		$(this).data('aspectRatio', this.width / this.height)
			// and remove the hard coded width/height
			.removeAttr('height')
			.removeAttr('width');
	});

	// Firefox Opacity Video Hack
	$('.video-wrap iframe').each(function(){
		var url = $(this).attr("src");

		$(this).attr("src", setQueryParameter(url, "wmode", "transparent"));
	});
}


function resizeVideos() {

	var videos = $('.video-wrap iframe, .entry__wrap iframe, video');

	videos.each(function() {
		var video = $(this),
			ratio = video.data('aspectRatio'),
			w = video.css('width', '100%').width(),
			h = w/ratio;
		video.height(h);
	});
}

/* --- FOOTER VOODOO MAGIC --- */

function placeFooter() {

	var sh = $('.sidebar--header').outerHeight(true),
		hh = $('.site-header').outerHeight(true),
		fh = $('.site-footer').outerHeight(true);

	if (wh < hh + fh + sh) {
		$('.site-footer').css({
			"position": "static",
			"margin-left": 0,
//			"padding-right": "24px"
		});
	} else {
		$('.site-footer').css({
			"position": "",
			"margin-left": "",
			"padding-right": ""
		});
	}
}

/* --- DJAX CLEANUP - Do all the cleanup that is needed when going to another page with dJax --- */

function cleanupBeforeDJax() {
	if (globalDebug) {console.group("CleanUp before dJax");}

	/* --- KILL ROYALSLIDER ---*/
	var sliders = $('.js-pixslider');
	if (!empty(sliders)) {
		sliders.each(function() {
			var slider = $(this).data('royalSlider');
			slider.destroy();
		});
	}

	/* --- KILL MAGNIFIC POPUP ---*/
	//when hitting back or forward we need to make sure that there is no rezidual Magnific Popup
	$.magnificPopup.close(); // Close popup that is currently opened (shorthand)

	infiniteScrollingDestroy();
}

//here we change the link of the Edit button in the Admin Bar
//to make sure it reflects the current page
function adminBarEditFix(id) {
	//get the admin ajax url and clean it
	var baseURL = ajaxurl.replace('admin-ajax.php','post.php');

	$('#wp-admin-bar-edit a').attr('href',baseURL + '?post='+ id +'&action=edit');
}

function copyrightOverlayAnimation(direction, x, y){
    switch (direction){
        case 'in':{
            if (globalDebug) {timestamp = ' [' + Date.now() + ']';console.log("Animate Copyright Overlay - IN"+timestamp);}

                    $('.copyright-overlay').css({top: y, left: x});
                    $('body').addClass('is--active-copyright-overlay');
                    $('.copyright-overlay').fadeIn();

            break;
        }

        case 'out':{
            if (globalDebug) {timestamp = ' [' + Date.now() + ']';console.log("Animate Copyright Overlay - OUT"+timestamp);}

                    $('.copyright-overlay').fadeOut();
                    $('body').removeClass('is--active-copyright-overlay');

            break;
        }

        default: break;
    }
}

function copyrightOverlayInit(){
    $(document).on('contextmenu', '.pixslider--gallery.js-pixslider, .mfp-container, .mosaic-wrapper, img, a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"], a[href$=".gif"]', function(e){
        if( !empty($('.copyright-overlay'))){
            e.preventDefault();
            e.stopPropagation();

            copyrightOverlayAnimation('in', e.clientX, event.clientY);
        }
    });

    $(document).on('mousedown', function(){
        if($('body').hasClass('is--active-copyright-overlay'))
            copyrightOverlayAnimation('out');
    });
}


})(jQuery, window);

// /* ====== HELPER FUNCTIONS ====== */

//similar to PHP's empty function
function empty(data)
{
    if(typeof(data) == 'number' || typeof(data) == 'boolean')
    {
        return false;
    }
    if(typeof(data) == 'undefined' || data === null)
    {
        return true;
    }
    if(typeof(data.length) != 'undefined')
    {
        return data.length === 0;
    }
    var count = 0;
    for(var i in data)
    {
        // if(data.hasOwnProperty(i))
        // 
        // This doesn't work in ie8/ie9 due the fact that hasOwnProperty works only on native objects.
        // http://stackoverflow.com/questions/8157700/object-has-no-hasownproperty-method-i-e-its-undefined-ie8
        // 
        // for hosts objects we do this
        if(Object.prototype.hasOwnProperty.call(data,i))
        {
            count ++;
        }
    }
    return count === 0;
}

/* --- Set Query Parameter--- */
function setQueryParameter(uri, key, value) {
	var re = new RegExp("([?|&])" + key + "=.*?(&|$)", "i");
	separator = uri.indexOf('?') !== -1 ? "&" : "?";
	if (uri.match(re)) {
		return uri.replace(re, '$1' + key + "=" + value + '$2');
	}
	else {
		return uri + separator + key + "=" + value;
	}
}