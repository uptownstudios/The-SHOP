<?php
/**
 * Template part for off canvas menu
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<nav class="off-canvas position-right" id="mobile-menu" data-off-canvas data-position="right" role="navigation">
  <?php if ( function_exists( 'the_custom_logo' ) ) { the_custom_logo(); } ?>
  <?php foundationpress_mobile_nav(); ?>
  <?php get_template_part('template-parts/social-media'); ?>
</nav>

<div class="off-canvas-content" data-off-canvas-content>
