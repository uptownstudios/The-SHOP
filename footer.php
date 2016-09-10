<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

		</section>
		<div id="footer-container">
			<footer id="footer">
				<?php do_action( 'foundationpress_before_footer' ); ?>
				<?php dynamic_sidebar( 'footer-widgets' ); ?>
				<?php do_action( 'foundationpress_after_footer' ); ?>
			</footer>

			<footer id="copyright">
				<?php if( get_theme_mod('copyright')): ?>
					<p>&copy; <?php echo date('Y'); ?> <?php echo get_theme_mod('copyright','default'); ?></p>
				<?php else: ?>
					<p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
				<?php endif; ?>
			</footer>
		</div>
		<div id="back-top">
  		<a href="#" title="Back to top"><i class="fa fa-chevron-up"></i></a>
		</div>

		<?php do_action( 'foundationpress_layout_end' ); ?>

<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) == 'offcanvas' ) : ?>
		</div><!-- Close off-canvas wrapper inner -->
	</div><!-- Close off-canvas wrapper -->
</div><!-- Close off-canvas content wrapper -->
<?php endif; ?>


<?php wp_footer(); ?>

<script type="text/javascript">

	var windowWidth;
	var headerHeight;
	var topScrollOffset;
	var windowWidth = jQuery(window).width();
	var headerHeight = jQuery('#masthead').height();
	if(windowWidth > 640) {
		var topScrollOffset = '112';
	} else {
		var topScrollOffset = '0';
	}

	jQuery(document).ready(function($) {
		// $('input[type="checkbox"]').click(function() {
		// 	var inputID = $(this).attr('id');
		//  	$('label[for="' + inputID + '"]').toggleClass('checked');
		// });
		$('ul.project-filters li.projects a').click(function() {
			$('#projects-list').addClass('show-filters');
			$('body').addClass('filters-open');
			$('input#impact-all').click();
			return false;
		});
		$('.close-project-filters a').click(function() {
			$('#projects-list.show-filters').removeClass('show-filters');
			$('body').removeClass('filters-open');
			return false;
		});
		$heightOnLoad = $('#home-hero-wrapper').height();
		// console.log($heightOnLoad);
		$(window).resize(function() {
			$('body.mobile #home-hero-wrapper').css({'min-height':$heightOnLoad});
		});
	});

	jQuery(document).ready(function($) {
		$('#preloader img').delay(10).show();
		$('.home #video-iframe-1').delay(500).load(function() {

			// Site Preloader
			$('#preloader').addClass('loaded')
			// $('#preloader img').fadeIn('fast');
			// $('#preloader .spinner').addClass('loaded');
			// $('#preloader img').addClass('loaded');
			$('#preloader.loaded').delay(250).fadeOut(1000, function() {
				$(this).hide();
			});
		});

		$(window).imagesLoaded(function() {

			// Site Preloader
			$('#preloader').addClass('loaded')
			// $('#preloader img').fadeIn('fast');
			// $('#preloader .spinner').addClass('loaded');
			// $('#preloader img').addClass('loaded');
			$('#preloader.loaded').delay(250).fadeOut(1000, function() {
				$(this).hide();
			});

		});

	  // Back to top script
	  $('#back-top').hide();
	  $(function () {
	    $(window).scroll(function () {
	      if ($(this).scrollTop() > 800) {
	        $('#back-top').fadeIn();
	      } else {
	        $('#back-top').fadeOut();
	      }
	    });
			if($('body').hasClass('mobile')) {
				// do nothing
			} else {
		    $('#back-top a').click(function () {
		      $('body,html').animate({ scrollTop: '0px' }, 'slow');
		      return false;
		    });
			}
	  });

	});

	// Masonry Layout for Portfolio, Blog Posts, and Events
	// (function ($) {
	// 	var $container = $('.bs-isotope');
	// 	$container.imagesLoaded(function() {
	// 		$container.isotope({
	// 			itemSelector: '.bs-isotope-item',
	// 			layoutMode: 'masonry'
	// 		});
	// 		$container.isotope('layout').isotope();
	// 	});
	// 	$(window).trigger('resize');
	// }(jQuery));

	var $container;
	var qsRegex;
	var filters = {};
	var comboFilter = {};

	$(function(){

	  $container = $('#container');

	  $container.isotope();
	  // do stuff when checkbox change
	  $('#options').on( 'change', function( jQEvent ) {
	    var $checkbox = $( jQEvent.target );
	    manageCheckbox( $checkbox );

	    comboFilter = getComboFilter( filters );

			$container.isotope({
				itemSelector: '.bs-isotope-item',
				layoutMode: 'fitRows',
				getSortData: {
					impact: '.impact',
					category: '.category',
					status: '.status',
					alpha: '.alpha'
				},
				filter: function() {
					var $this = $(this),
					comboResult = $this.is(comboFilter),
					searchResult = qsRegex ? $this.text().match( qsRegex ) : true;
					return (comboResult || comboFilter=='') && searchResult;
				},
				sortBy: ['impact','category','status','alpha']
			});

	  });

		$container.on('layoutComplete', function( event, laidOutItems ) {
		  console.log( 'Isotope layout completed on ' +
		  laidOutItems.length + ' items' );
		  if( laidOutItems.length == 0 ) {
		    console.log( 'No results returend' );
		    $('.nothing-to-show').fadeIn('slow');
		  } else {
				$('.nothing-to-show').fadeOut('fast');
			}
		});

	});

	$container = $('#container');
	$container.isotope({
		itemSelector: '.bs-isotope-item',
		layoutMode: 'fitRows',
		getSortData: {
			impact: '.impact',
			category: '.category',
			status: '.status',
			alpha: '.alpha'
		}
	});
	$('#sorts').on( 'click', 'button', function() {
		var sortByValue = $(this).attr('data-sort-by');
		sortByValue = sortByValue.split(',');
		console.log("Sorting button click",sortByValue);
		$('button.button.active').not(this).removeClass('active');
		$(this).addClass('active');
		$container.isotope({ sortBy: sortByValue });
	});


	$('button.clear-search').click(function() {
		$('#search').val('').keyup();
	});

	$('button.reset-all-filters').click(function() {
		$('button.clear-search').click();
		$('input#impact-all').click();
		$('input#category-all').click();
		$('input#status-all').click();
		$('button[data-sort-by="impact"]').click();
	});

	function getComboFilter( filters ) {
	  var i = 0;
	  var comboFilters = [];
	  var message = [];

	  for ( var prop in filters ) {
	    message.push( filters[ prop ].join(' ') );
	    var filterGroup = filters[ prop ];
	    // skip to next filter group if it doesn't have any values
	    if ( !filterGroup.length ) {
	      continue;
	    }
	    if ( i === 0 ) {
	      // copy to new array
	      comboFilters = filterGroup.slice(0);
	    } else {
	      var filterSelectors = [];
	      // copy to fresh array
	      var groupCombo = comboFilters.slice(0); // [ A, B ]
	      // merge filter Groups
	      for (var k=0, len3 = filterGroup.length; k < len3; k++) {
	        for (var j=0, len2 = groupCombo.length; j < len2; j++) {
	          filterSelectors.push( groupCombo[j] + filterGroup[k] ); // [ 1, 2 ]
	        }

	      }
	      // apply filter selectors to combo filters for next group
	      comboFilters = filterSelectors;
	    }
	    i++;
	  }

	  var comboFilter = comboFilters.join(', ');
	  return comboFilter;
	}

	function manageCheckbox( $checkbox ) {
	  var checkbox = $checkbox[0];

	  var group = $checkbox.parents('.option-set').attr('data-group');
	  // create array for filter group, if not there yet
	  var filterGroup = filters[ group ];
	  if ( !filterGroup ) {
	    filterGroup = filters[ group ] = [];
	  }

	  var isAll = $checkbox.hasClass('all');
	  // reset filter group if the all box was checked
	  if ( isAll ) {
	    delete filters[ group ];
	    if ( !checkbox.checked ) {
	      checkbox.checked = 'checked';
	    }
	  }
	  // index of
	  var index = $.inArray( checkbox.value, filterGroup );

	  if ( checkbox.checked ) {
	    var selector = isAll ? 'input' : 'input.all';
	    $checkbox.siblings( selector ).removeAttr('checked');


	    if ( !isAll && index === -1 ) {
	      // add filter to group
	      filters[ group ].push( checkbox.value );
	    }

	  } else if ( !isAll ) {
	    // remove filter from group
	    filters[ group ].splice( index, 1 );
	    // if unchecked the last box, check the all
	    if ( !$checkbox.siblings('[checked]').length ) {
	      $checkbox.siblings('input.all').attr('checked', 'checked');
	    }
	  }

	}

	var $search = $('#search').keyup( debounce( function() {
		qsRegex = new RegExp( $search.val(), 'gi' );
		if ( $search.val() !== '' ) {
			$('button.clear-search').addClass('show');
		} else {
			$('button.clear-search').removeClass('show');
		}
		$container.isotope();
	}) );

	// debounce so filtering doesn't happen every millisecond
	function debounce( fn, threshold ) {
	  var timeout;
	  return function debounced() {
		if ( timeout ) {
		  clearTimeout( timeout );
		}
		function delayed() {
		  fn();
		  timeout = null;
		}
		timeout = setTimeout( delayed, threshold || 100 );
	  }
	}

	// var projectsListHeight = $('.projects-list-scroll-wrapper').height();
	// $('.projects-list-inner').css({'max-height':projectsListHeight});

	// Lazy Load with Isotope/Masonry Layout
	$('.lazy-isotope-wrapper').each(function(){

		var $isotope = $('.lazy-isotope', this);

		$isotope.isotope({
			itemSelector: '.bs-isotope-item',
			layoutMode: 'masonry'
		});

	  $isotope[0].addEventListener('load', (function(){
	    var runs;
	    var update = function(){
	      $isotope.isotope('layout');
	      runs = false;
	    };
	    return function(){
	      if(!runs){
	        runs = true;
	        setTimeout(update, 33);
	      }
	    };
	  }()), true);

	});

	// Shrink logo Classie script
	function init() {
    window.addEventListener('scroll', function(e){
      var distanceY = window.pageYOffset || document.documentElement.scrollTop,
        shrinkOn = jQuery('#masthead').height(),
        header = document.querySelector("body");
      if (distanceY > shrinkOn) {
        classie.add(header,"darken-header");
      } else {
        if (classie.has(header,"darken-header")) {
          classie.remove(header,"darken-header");
        }
      }
  	});
	}
	window.onload = init();

	$('.bs-carousel').slick({
  dots: false,
  infinite: false,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 1,
	arrows: true,
	prevArrow: '<button aria-hidden="true" role="presentation" type="button" class="slick-prev"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/prev-arrow.svg" alt="Previous Arrow" width="20" /></button>',
	nextArrow: '<button aria-hidden="true" role="presentation" type="button" class="slick-next"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/next-arrow.svg" alt="Next Arrow" width="20" /></button>',
  responsive: [{
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
      }
    },{
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },{
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }]
	});

	;( function( $ ) {
		$( '.swipebox' ).swipebox( {
			useCSS : true, // false will force the use of jQuery for animations
			useSVG : true, // false to force the use of png for buttons
			initialIndexOnArray : 0, // which image index to init when a array is passed
			hideCloseButtonOnMobile : false, // true will hide the close button on mobile devices
			removeBarsOnMobile : true, // false will show top bar on mobile devices
			hideBarsDelay : 3000000, // delay before hiding bars on desktop
			videoMaxWidth : 1140, // videos max width
			beforeOpen: function() {}, // called before opening
			afterOpen: null, // called after opening
			afterClose: function() {}, // called after closing
			loopAtEnd: false // true will return to the first image after the last image is reached
		} );
	} )( jQuery );

	jQuery(function($) {
		// Scroll to hash on click
	  $('a[href*="#"]:not([href="#"])').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var target = $(this.hash);
				console.log(target);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
					$('.top-bar-right .menu li.active').removeClass('active');
					$(this).addClass('active');
	        $('html, body').animate({
	          // scrollTop: target.offset().top - topScrollOffset
						scrollTop: target.offset().top
	        }, 1000);
	        return false;
	      }
	    }
	  });

	});

	//Light header switch Waypoint script
	shrinkOn = jQuery('#masthead').height() * 2;

	var sharewaypoint = new Waypoint({
		element: document.getElementById('mission'),
		handler: function(direction) {
			jQuery('#masthead').toggleClass('reverse-header');
			jQuery('.down-arrow').removeClass('animated');
		},
		offset: shrinkOn
	});

</script>

<?php do_action( 'foundationpress_before_closing_body' ); ?>
<script id="__bs_script__">//<![CDATA[document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.2.12.3.js'><\/script>".replace("HOST", location.hostname));
//]]></script>
</body>
</html>
