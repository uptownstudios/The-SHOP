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
			$('input#impact-all').click();
		});
		$('.close-project-filters a').click(function() {
			$('#projects-list.show-filters').removeClass('show-filters');
		});
		$heightOnLoad = $('.home-hero-wrapper.vc_row.vc_row-o-full-height').height();
		// console.log($heightOnLoad);
		$(window).resize(function() {
			$('body.mobile .home-hero-wrapper.vc_row.vc_row-o-full-height').css({'min-height':$heightOnLoad});
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
			$('#preloader.loaded').delay(250).slideUp(1000, function() {
				$(this).hide();
			});
		});

		$(window).imagesLoaded(function() {

			// Site Preloader
			$('#preloader').addClass('loaded')
			// $('#preloader img').fadeIn('fast');
			// $('#preloader .spinner').addClass('loaded');
			// $('#preloader img').addClass('loaded');
			$('#preloader.loaded').delay(250).slideUp(1000, function() {
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
        classie.add(header,"shrink-logo");
      } else {
        if (classie.has(header,"shrink-logo")) {
          classie.remove(header,"shrink-logo");
        }
      }
  	});
	}
	window.onload = init();

	// Light header switch Waypoint script
	// shrinkOn = jQuery('#masthead').height();
	//
	// var sharewaypoint = new Waypoint({
	// 	element: document.getElementById('init-header-change'),
	// 	handler: function(direction) {
	// 		jQuery('#masthead').toggleClass('reverse-header');
	// 		jQuery('#masthead.reverse-header .top-bar .top-bar-left a.custom-logo-link img').attr('src','<?php bloginfo('url'); ?>/wp-content/uploads/2016/05/logo-color.svg');
	// 		jQuery('#masthead .top-bar .top-bar-left a.custom-logo-link img').attr('src','<?php bloginfo('url'); ?>/wp-content/uploads/2016/04/logo.svg');
	//
	// 	},
	// 	offset: shrinkOn
	// });

	jQuery(function($) {
		// Scroll to hash on click
	  $('a[href*="#"]:not([href="#"])').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var target = $(this.hash);
				console.log(target);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        $('html, body').animate({
	          scrollTop: target.offset().top - topScrollOffset
	        }, 1000);
	        return false;
	      }
	    }
	  });

	});

</script>

<?php do_action( 'foundationpress_before_closing_body' ); ?>
<script id="__bs_script__">//<![CDATA[document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.2.12.3.js'><\/script>".replace("HOST", location.hostname));
//]]></script>
</body>
</html>
