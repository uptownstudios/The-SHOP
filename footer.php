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
		$heightOnLoad = $('.home-hero-wrapper.vc_row.vc_row-o-full-height').height();
		console.log($heightOnLoad);
		$(window).resize(function() {
			$('body.mobile .home-hero-wrapper.vc_row.vc_row-o-full-height').css({'min-height':$heightOnLoad});
		});
	});

	jQuery(document).ready(function($) {
		$(window).imagesLoaded(function() {

			// Site Preloader
			$('#preloader').addClass('loaded')
			// $('#preloader img').fadeIn('fast');
			// $('#preloader .spinner').addClass('loaded');
			// $('#preloader img').addClass('loaded');
			$('#preloader.loaded').delay(250).slideUp(1000, function() {
				$(this).hide();
			});

			// Portfolio/Event left/right height function
			var portlefthalf = jQuery('.portfolio-main-image').height();
			var portrighthalf = jQuery('.portfolio-description-inner').height();
			var eventlefthalf = jQuery('.event-main-image').height();
			var eventrighthalf = jQuery('.event-description-inner').height();
			if(portlefthalf > portrighthalf) {
				$('.portfolio-main-image').addClass('alignmiddle');
				$('.portfolio-description').addClass('alignmiddle');
			}
			if(eventlefthalf > eventrighthalf) {
				$('.event-main-image').addClass('alignmiddle');
				$('.event-description').addClass('alignmiddle');
			}
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
	    $('#back-top a').click(function () {
	      $('body,html').animate({
	        scrollTop: 0
	      }, 1200);
	      return false;
	    });
	  });

		// Float Labels
		function floatLabel(inputType) {
			$(inputType).each(function(){
					var $this = $(this);
					$this.focus(function(){
						$this.closest('li.gfield').find('label').attr("data-attr","active");
					});
					$this.blur(function(){
						if($this.val() === '' || $this.val() === 'blank'){
							$this.closest('li.gfield').find('label').attr("data-attr","");
						}
					});
			});
		}
		floatLabel(".floatLabel input");
		floatLabel(".floatLabel textarea");
	});

	// Masonry Layout for Portfolio, Blog Posts, and Events
	(function ($) {
		var $container = $('.bs-isotope');
		$container.imagesLoaded(function() {
			$container.isotope({
				resizable: false,
				itemSelector: '.bs-isotope-item',
				layoutMode: 'masonry',
				fitRows: {
	  				gutter: 20
				}
			});
			$container.isotope('reloadItems');
		});
		$(window).trigger('resize');
	}(jQuery));

	// Isotope Filters for Portfolio
	jQuery(document).ready(function($) {
		// cache container
		var $container = $('.portfolio-container');
		// filter items when filter link is clicked
		$('#filters a').click(function(){
		  var selector = $(this).attr('data-filter');
		  $container.isotope({ filter: selector });
			$('#filters a.active').not(this).removeClass('active');
			$(this).addClass('active');
		  return false;
		});
		$('.title-bar .menu-icon').click(function() {
			$('body').toggleClass('off-canvas-open');
		});
		jQuery('.portfolio-filter-toggle a').click(function() {
			$('#filters').slideToggle('fast');
			return false;
		});
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
	shrinkOn = jQuery('#masthead').height();

	var sharewaypoint = new Waypoint({
		element: document.getElementById('init-header-change'),
		handler: function(direction) {
			jQuery('#masthead').toggleClass('reverse-header');
			jQuery('#masthead.reverse-header .top-bar .top-bar-left a.custom-logo-link img').attr('src','http://<?php bloginfo('url'); ?>/wp-content/uploads/2016/05/logo-color.svg');
			jQuery('#masthead .top-bar .top-bar-left a.custom-logo-link img').attr('src','http://<?php bloginfo('url'); ?>/wp-content/uploads/2016/04/logo.svg');

		},
		offset: shrinkOn
	});

	//Show title waypoint
	$('.single-tm-outer').each(function() {
		$(this).waypoint(function() {
			$(this).toggleClass('showtitle');
		}, {
			offset: '40%'
		});
	});

	jQuery(function($) {
		// Scroll to hash on click
	  $('a[href*="#"]:not([href="#"])').click(function() {
	    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	      if (target.length) {
	        $('html, body').animate({
	          scrollTop: target.offset().top - topScrollOffset
	        }, 1000);
	        return false;
	      }
	    }
	  });

		// Quote Modal Script
		$('a.bs-quote-modal').click(function() {
			$(this).parents('.single-service-content').find('.bs-quote-modal-wrapper').addClass('show-modal');
			$('body').addClass('modal-active');
			return false;
		});
		$('.bs-quote-modal-close').click(function() {
			$('.bs-quote-modal-wrapper.show-modal').removeClass('show-modal');
			$('body').removeClass('modal-active');
			return false;
		});
		$(document).keyup(function(e) {
    	if (e.keyCode == 27) { // escape key maps to keycode `27`
      	$('.bs-quote-modal-wrapper.show-modal').removeClass('show-modal');
				$('body').removeClass('modal-active');
    	}
		});

	});

	// initiating the isotope page
	jQuery(window).load(function($) {

	    // Store # parameter and add "." before hash
	    var hashID = "." + window.location.hash.substring(1);

	    //  the current version of isotope, the hack works in v2 also
	    var $container = jQuery('.portfolio-container');

	    $container.imagesLoaded(function(){
	        $container.isotope({
	            itemSelector: ".single-portfolio-item",
	            filter: hashID, // the variable filter hack
	        });
					jQuery('#filters a.active').removeClass('active');
					jQuery('#filters a[data-filter="' + hashID + '"]').addClass('active');
	    });

	});

	// Scroll to service on page load after all images are loaded
  jQuery(function($){
  $('a.go-to-service, .go-to-service a').on('click', scroller.hashLinkClicked);
    scroller.loaded();
  });

  (function($){

    scroller = {
			scrollTiming: 1000,
      pageLoadScrollDelay: 1000,
      hashLinkClicked: function(e){

        // current path
        var temp    = window.location.pathname.split('#');
        var curPath = scroller.addTrailingSlash(temp[0]);

        // target path
        var link       = $(this).attr('href');
        var linkArray  = link.split('#');
        var navId      = (typeof linkArray[1] !== 'undefined') ? linkArray[1] : null;
        var targetPath = scroller.addTrailingSlash(linkArray[0]);

        // scrollTo the hash id if the target is on the same page
        if (targetPath == curPath && navId) {
          e.preventDefault();
          scroller.scrollToElement('#'+navId);
          window.location.hash = scroller.generateTempNavId(navId);

        // otherwise add '_' to hash
        } else if (navId) {
          e.preventDefault();
          navId = scroller.generateTempNavId(navId);
          window.location = targetPath+'#'+navId;
        }
      },
      addTrailingSlash: function(str){
        lastChar = str.substring(str.length-1, str.length);
        if (lastChar != '/')
          str = str+'/';
        return str;
      },
      scrollToElement: function(whereTo){
        jQuery('html, body').animate({ scrollTop: jQuery(whereTo).offset().top - topScrollOffset }, scroller.scrollTiming);
      },
      generateTempNavId: function(navId){
        return '_'+navId;
      },
      getNavIdFromHash: function(){
        var hash = window.location.hash;

        if (scroller.hashIsTempNavId()) {
          hash = hash.substring(2);
        }

        return hash;
      },
      hashIsTempNavId: function(){
        var hash = window.location.hash;

        return hash.substring(0,2) === '#_';
      },

      loaded: function(){

        if (scroller.hashIsTempNavId()) {
          setTimeout(function() {
            scroller.scrollToElement('#'+scroller.getNavIdFromHash());
          },scroller.pageLoadScrollDelay);
          var hash = window.location.hash;
        }
      }
    };

  })(jQuery);

</script>

<?php do_action( 'foundationpress_before_closing_body' ); ?>
<script id="__bs_script__">//<![CDATA[document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.2.12.3.js'><\/script>".replace("HOST", location.hostname));
//]]></script>
</body>
</html>
