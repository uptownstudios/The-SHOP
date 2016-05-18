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
		</div>

		<?php do_action( 'foundationpress_layout_end' ); ?>

<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) == 'offcanvas' ) : ?>
		</div><!-- Close off-canvas wrapper inner -->
	</div><!-- Close off-canvas wrapper -->
</div><!-- Close off-canvas content wrapper -->
<?php endif; ?>


<?php wp_footer(); ?>

<script type="text/javascript">

	jQuery(document).ready(function($) {
		$heightOnLoad = $('.home-hero-wrapper.vc_row.vc_row-o-full-height').height();
		console.log($heightOnLoad);
		$(window).resize(function() {
			$('body.mobile .home-hero-wrapper.vc_row.vc_row-o-full-height').css({
				'min-height':$heightOnLoad
			});
		});
	});

	// Site Preloader
	jQuery(document).ready(function($) {
		$(window).load(function() {
			$('#preloader').addClass('loaded')
			// $('#preloader img').fadeIn('fast');
			// $('#preloader .spinner').addClass('loaded');
			// $('#preloader img').addClass('loaded');
			$('#preloader.loaded').delay(250).slideUp(1000, function() {
				$(this).hide();
			});
		});
	});

	// Isotope/Masonry filtering for Project thumbnails
	(function ($) {
		var $container = $('.portfolio-container'),
			isotope = function () {
				$container.isotope({
					resizable: false,
					itemSelector: '.single-portfolio-item',
					layoutMode: 'masonry',
					fitRows: {
	  					gutter: 20
					}
				});
			};
		isotope();
		$(window).resize();
	}(jQuery));

	jQuery(document).ready(function($) {
		// cache container
		var $container = $('.portfolio-container');
		// filter items when filter link is clicked
		$('#filters a').click(function(){
		  var selector = $(this).attr('data-filter');
		  $container.isotope({ filter: selector });
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

	shrinkOn = jQuery('#masthead').height()
	var sharewaypoint = new Waypoint({
		element: document.getElementById('init-header-change'),
		handler: function(direction) {
			jQuery('#masthead').toggleClass('reverse-header');
			jQuery('#masthead.reverse-header .top-bar .top-bar-left a.custom-logo-link img').attr('src','http://127.0.0.1/newuptown/wp-content/uploads/2016/05/logo-color.svg');
			jQuery('#masthead .top-bar .top-bar-left a.custom-logo-link img').attr('src','http://127.0.0.1/newuptown/wp-content/uploads/2016/04/logo.svg');

		},
		offset: shrinkOn
	});

</script>

<script type="text/javascript">
  var userFeed = new Instafeed({
    get: 'user',
    userId: 31411348,
    accessToken: '609318530.467ede5.02e8a5cec1e54170a1eae5c20fb8c0dd',
    limit: 24,
    resolution: 'standard_resolution',
    template: '<a class="instagram-image" href="{{link}}" target="_blank" title="{{caption}}"><img class="instafeed-img" src="{{image}}" /><span class="ig-caption">{{caption}}<br /><i class="fa fa-heart"></i> {{likes}} &nbsp;•&nbsp; <i class="fa fa-comment"></i> {{comments}}</span></a>',
    after: function() {
      jQuery('#instafeed').slick({
        infinite: true,
        slidesToShow: 6,
        slidesToScroll: 6,
        rows: 1,
        centerPadding: '0px',
        arrows: false,
        autoplay: false,
        autoplaySpeed: 5000,
        easing: 'ease-out-back',
        dots: true,
        arrows: true,
        prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></a>',
        nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></a>',
        responsive: [{
          breakpoint: 600,
          settings: {
            autoplay: false,
          }
        }],
      });
		(function($) {
			$('a.instafeed-link').swipebox({
				hideBarsDelay : 5000,
				loopAtEnd: true,
				removeBarsOnMobile: false
			});
		})(jQuery);
      }
  });
  userFeed.run();
</script>

<?php do_action( 'foundationpress_before_closing_body' ); ?>
<script id="__bs_script__">//<![CDATA[document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.2.12.3.js'><\/script>".replace("HOST", location.hostname));
//]]></script>
</body>
</html>
