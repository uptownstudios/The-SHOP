<?php
	$port_args = array( 'post_type' => 'portfolio', 'posts_per_page' => -1 );
	$port_loop = new WP_Query( $port_args );
?>
<div class="projects-list-wrapper">

	<div class="close-project-filters"><a href="#" title="Close Filters Overlay">x</a></div>
	
	<div id="filters" class="projects-list-filters">
		<?php
			$tax_impact = 'portfolio-impact';
			$tax_impact_terms = get_terms($tax_impact);
			$all_impact_terms;
			$filter_impact_text = '';

      $tax_cat = 'portfolio-cat';
      $tax_cat_terms = get_terms($tax_cat);
      $all_cat_terms;
      $filter_cat_text = '';

			$tax_status = 'portfolio-status';
			$tax_status_terms = get_terms($tax_status);
			$all_status_terms;
			$filter_status_text = '';
    ?>
		<div class="project-list-filter">
			<h3>Filter by Area of Impact</h3>
			<div class="filter-projects-impact option-set filter">
	      <?php
	        foreach ($tax_impact_terms as $tax_impact_term) {
	          $filter_impact_text .= '<label for="' . $tax_impact_term->slug . '"><input id="' . $tax_impact_term->slug . '" class="filter" type="checkbox" title="' . sprintf( __( "View all posts in %s" ), $tax_impact_term->name ) . '" value=".' . $tax_impact_term->slug . '" ' . '/ ><span>' . $tax_impact_term->name.'</span></label>';
	        }
	        $filter_impact_text = '<label for="impact-all" class="checked"><input id="impact-all" value="" class="all" type="checkbox" title="View All" checked /><span>All</span></label>' . $filter_impact_text;
	        echo $filter_impact_text;

	      ?>
	  	</div>
		</div>

		<div class="project-list-filter">
			<h3>Category</h3>
			<div class="filter-projects-category option-set filter">
	      <?php
	        foreach ($tax_cat_terms as $tax_cat_term) {
	          $filter_cat_text .= '<label for="' . $tax_cat_term->slug . '"><input id="' . $tax_cat_term->slug . '" class="filter" type="checkbox" title="' . sprintf( __( "View all posts in %s" ), $tax_cat_term->name ) . '" value=".' . $tax_cat_term->slug . '" ' . '/ ><span>' . $tax_cat_term->name.'</span></label>';
	        }
	        $filter_cat_text = '<label for="impact-all" class="checked"><input id="impact-all" value="" class="all" type="checkbox" title="View All" checked /><span>All</span></label>' . $filter_cat_text;
	        echo $filter_cat_text;

	      ?>
	  	</div>
		</div>

		<div class="project-list-filter">
			<h3>Status</h3>
			<div class="filter-projects-status option-set filter">
	      <?php
	        foreach ($tax_status_terms as $tax_status_term) {
	          $filter_status_text .= '<label for="' . $tax_status_term->slug . '"><input id="' . $tax_status_term->slug . '" class="filter" type="checkbox" title="' . sprintf( __( "View all posts in %s" ), $tax_status_term->name ) . '" value=".' . $tax_status_term->slug . '" ' . '/ ><span>' . $tax_status_term->name.'</span></label>';
	        }
	        $filter_status_text = '<label for="impact-all" class="checked"><input id="impact-all" value="" class="all" type="checkbox" title="View All" checked /><span>All</span></label>' . $filter_status_text;
	        echo $filter_status_text;

	      ?>
	  	</div>
		</div>
	</div>

	<div class="projects-list-inner bs-isotope lazy-isotope">
		<?php
			while ( $port_loop->have_posts()) : $port_loop->the_post();
			$teaser = get_field('project_teaser');
			$images = get_field('project_images');
			$image_id = get_post_thumbnail_id();
      $image_url = wp_get_attachment_image_src($image_id,'full', true);

		?>

			<div class="single-project">
				<div class="single-project-left">
					<h2><?php the_title(); ?></h2>
					<div class="project-meta">
						<div class="impact-list">
							<ul>
								<?php $impact_terms = get_the_terms( $post->ID , 'portfolio-impact' ); foreach ( $impact_terms as $impact_term ) { echo '<li>' . $impact_term->name . '</li>'; } ?>
							</ul>
						</div>
						<div class="category-list">
							<strong>Category</strong> <?php $impact_cats = get_the_terms( $post->ID , 'portfolio-cat' ); foreach ( $impact_cats as $impact_cat ) { echo '<span>' . $impact_cat->name . '</span>'; } ?>
						</div>
						<div class="status-list">
							<strong>Status</strong> <?php $impact_stats = get_the_terms( $post->ID , 'portfolio-status' ); foreach ( $impact_stats as $impact_stat ) { echo '<span>' . $impact_stat->name . '</span>'; } ?>
						</div>

					</div>
					<div class="project-teaser">
						<?php echo $teaser; ?>
					</div>
				</div>
				<div class="single-project-right">
					<img src="<?php echo $image_url[0]; ?>" />
				</div>
			</div>

		<?php endwhile; ?>

	</div>

</div>
