<?php
/*
Template Name: Events Page Template
*/

global $post;
get_header(); ?>

<?php get_template_part( 'template-parts/title-bar' ); ?>

<div id="page-full-width" role="main">

<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
  <article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
      <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
      <div class="entry-content">
        <div class="uptown-events-wrapper lazy-isotope-wrapper">
          <div class="list-style-events-wrapper bs-isotope lazy-isotope">
            <?php
              $events = EM_Events::get( apply_filters('em_content_events_args', $args) );
              $events_count = EM_Events::count( apply_filters( 'em_content_events_args', $args) );
              $args['orderby'] = 'event_start_date,event_start_time';
              $args['limit'] = 6;
              $args['page'] = (!empty($_REQUEST['pno']) && is_numeric($_REQUEST['pno']) )? $_REQUEST['pno'] : 1;
              $args['page'] = (!empty($_REQUEST['pno']) && is_numeric($_REQUEST['pno']) )? $_REQUEST['pno'] : $args['page'];
              $args['offset'] = ($args['page']-1) * $args['limit'];
              foreach ( $events as $event ) :

                // $EM_Event = em_get_event($post->ID, 'post_id');
                $image_id = get_post_thumbnail_id($event->post_id);
  							$image_url = wp_get_attachment_image_src($image_id, 'large');
                $image_srcset = wp_get_attachment_image_srcset($image_id);
                $imagealt = get_post_meta( get_post_thumbnail_id( $event->post_id ), '_wp_attachment_image_alt', true );

              ?>
              <div class="list-style-events-single-event bs-isotope-item">

                <div class="event-featured-image">
                  <a href="<?php echo $event->output('#_EVENTURL'); ?>"><img alt="<?php echo $imagealt; ?>" data-sizes="auto" data-srcset="<?php echo $image_srcset; ?>" data-src="<?php echo $image_url[0]; ?>" class="lazyload" /><noscript><img alt="<?php echo $imagealt; ?>" src="<?php echo $image_url[0]; ?>" /></noscript></a>
                </div>

                <div class="event-details">
                  <h3><?php echo $event->output('#_EVENTLINK'); ?></h3>
                  <span class="event-meta"><span class="event-meta-inner"><em><?php echo $event->output('#F #j, #Y'); ?> <span class="bullet-separator">•</span> <?php echo $event->output('#_EVENTTIMES'); ?></em></span></span><span class="event-excerpt"><?php echo $event->output('#_EVENTEXCERPT{10,...}'); ?></span></div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php if( !empty($args['limit']) && $events_count > $args['limit'] ) { ?>
        <div class="events-pagination">
          <?php
            $search_args = array_merge(EM_Events::get_post_search(), array('pno'=>'%PAGE%','action'=>'search_events','search'=>null, 'em_search'=>$args['search']));
            $page_link_template = em_add_get_params($_SERVER['REQUEST_URI'], $search_args, false); //don't html encode, so em_paginate does its thing
            echo apply_filters('em_events_output_pagination', em_paginate( $page_link_template, $events_count, $args['limit'], $args['pno']), $page_link_template, $events_count, $args['limit'], $args['pno']);
          ?>
        </div>
        <?php } ?>
      </div>
      <?php do_action( 'foundationpress_page_before_comments' ); ?>
      <?php comments_template(); ?>
      <?php do_action( 'foundationpress_page_after_comments' ); ?>
  </article>
<?php endwhile;?>

<?php do_action( 'foundationpress_after_content' ); ?>

</div>

<?php get_footer();
