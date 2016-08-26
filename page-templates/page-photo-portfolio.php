<?php
/*
Template Name: Photo Portfolio
*/
get_header();

$args = array( 'post_type' => 'photo-portfolio', 'posts_per_page' => -1 );
$loop = new WP_Query( $args );
$thumb = get_field('photo_portfolio_album_cover');

?>

<?php get_template_part( 'template-parts/title-bar' ); ?>

<div id="page-full-width" class="portfolio-wrapper" role="main">

<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
  <article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">

      <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
      <div class="entry-content">
        <div class="article-wrapper">
          <div class="small-12 large-12 columns portfolio-page-thumbs-wrapper" role="main">
            <?php /* Start loop */ ?>
            <div class="lazy-isotope-wrapper" style="margin-top: 40px;">
              <div class="portfolio-container bs-isotope lazy-isotope">
                <?php while ( $loop->have_posts()) : $loop->the_post(); ?>
                <?php
                  $thumb = get_field('photo_portfolio_album_cover');
                  //$image_id = get_post_thumbnail_id();
                  //$image_url = wp_get_attachment_image_src($image_id,'full', true);
                ?>
                  <div class="single-portfolio-item bs-isotope-item">
                    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
                      <a href="<?php the_permalink();?>" class="single-portfolio-link" title="<?php the_title();?>">
                        <section class="entry-content">
                          <h4 class="portfolio-title"><?php the_title(); ?></h4>
                          <img src="<?php echo $thumb['url']; ?>" class="lazyload portfolio-thumbnail" alt="<?php the_title();?> portfolio thumbnail" />
                          <span class="cat-link">+</span>
                          <canvas class="portfolio-overlay"></canvas>
                        </section>
                      </a>
                    </article>
                  </div>
                <?php endwhile; // End the loop ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer>
          <?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
          <!-- <p><?php the_tags(); ?></p> -->
      </footer>
      <?php do_action( 'foundationpress_page_before_comments' ); ?>
      <?php /* comments_template(); */ ?>
      <?php do_action( 'foundationpress_page_after_comments' ); ?>
  </article>
<?php endwhile;?>

<?php do_action( 'foundationpress_after_content' ); ?>

</div>

<?php get_footer();
