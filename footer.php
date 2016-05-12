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
<?php do_action( 'foundationpress_before_closing_body' ); ?>
</body>
</html>
