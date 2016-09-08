<?php
	$port_args = array( 'post_type' => 'portfolio', 'posts_per_page' => -1 );
	$port_loop = new WP_Query( $port_args );
?>
<div class="projects-list-wrapper">

	<div class="close-project-filters"><a href="#" title="Close Filters Overlay"><span class="x-close">x</span><span class="x-alt-close"></span></a></div>

	<div class="projects-list-scroll-wrapper">
		<div class="projects-list-filters">
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

			<div class="search-filter">
				<label for="search">Search</label><input type="text" name="search" id="search" value="" placeholder="what are you looking for?" />
				<button class="clear-search"><i class="fa fa-times" aria-hidden="true"></i></button>
			</div>

			<div id="sorts" class="button-group">
				<h3>Sort by</h3>
				<button class="button active" data-sort-by="impact">Impact</button><br>
				<button class="button" data-sort-by="category">Category</button><br>
				<button class="button" data-sort-by="status">Status</button><br>
				<button class="button" data-sort-by="alpha">Alpha</button>
			</div>

			<div id="options">
				<h3>Filter by Area of Impact</h3>
				<div class="project-list-filter filter-projects-impact option-set filter" data-group="impact">
		      <?php
		        foreach ($tax_impact_terms as $tax_impact_term) {
		          $filter_impact_text .= '<input id="' . $tax_impact_term->slug . '" type="checkbox" title="' . sprintf( __( "View all posts in %s" ), $tax_impact_term->name ) . '" value=".' . $tax_impact_term->slug . '" ' . '/ ><label for="' . $tax_impact_term->slug . '"><span>' . $tax_impact_term->name.'</span></label><br>';
		        }
		        $filter_impact_text = '<input id="impact-all" value="" class="all" type="checkbox" title="View All" checked /><label for="impact-all"><span>All</span></label><br>' . $filter_impact_text;
		        echo $filter_impact_text;

		      ?>
		  	</div>

				<h3>Category</h3>
				<div class="project-list-filter filter-projects-category option-set filter" data-group="category">
		      <?php
		        foreach ($tax_cat_terms as $tax_cat_term) {
		          $filter_cat_text .= '<input id="' . $tax_cat_term->slug . '" type="checkbox" title="' . sprintf( __( "View all posts in %s" ), $tax_cat_term->name ) . '" value=".' . $tax_cat_term->slug . '" ' . '/ ><label for="' . $tax_cat_term->slug . '"><span>' . $tax_cat_term->name.'</span></label><br>';
		        }
		        $filter_cat_text = '<input id="cat-all" value="" class="all" type="checkbox" title="View All" checked /><label for="cat-all"><span>All</span></label><br>' . $filter_cat_text;
		        echo $filter_cat_text;

		      ?>
		  	</div>


				<h3>Status</h3>
				<div class="project-list-filter filter-projects-status option-set filter" data-group="status">
		      <?php
		        foreach ($tax_status_terms as $tax_status_term) {
		          $filter_status_text .= '<input id="' . $tax_status_term->slug . '" type="checkbox" title="' . sprintf( __( "View all posts in %s" ), $tax_status_term->name ) . '" value=".' . $tax_status_term->slug . '" ' . '/ ><label for="' . $tax_status_term->slug . '"><span>' . $tax_status_term->name.'</span></label><br>';
		        }
		        $filter_status_text = '<input id="status-all" value="" class="all" type="checkbox" title="View All" checked /><label for="status-all"><span>All</span></label><br>' . $filter_status_text;
		        echo $filter_status_text;

		      ?>
		  	</div>

				<div class="reset-filters">
					<button class="reset-all-filters">Reset Filters</button>
				</div>

			</div>
		</div>

		<div id="container" class="projects-list-inner bs-isotope lazy-isotope">
			<?php
				while ( $port_loop->have_posts()) : $port_loop->the_post();
				$teaser = get_field('project_teaser');
				$images = get_field('project_images');
				$image_id = get_post_thumbnail_id();
	      $image_url = wp_get_attachment_image_src($image_id,'full', true);

			?>
				<div class="single-project bs-isotope-item item <?php $tax_impact_terms = get_the_terms( $post->ID , 'portfolio-impact' ); foreach ($tax_impact_terms as $tax_impact_term) { echo ' ' . $tax_impact_term->slug; } ?> <?php $tax_cat_terms = get_the_terms( $post->ID , 'portfolio-cat' ); foreach ($tax_cat_terms as $tax_cat_term) { echo ' ' . $tax_cat_term->slug; } ?> <?php $tax_status_terms = get_the_terms( $post->ID , 'portfolio-status' ); foreach ($tax_status_terms as $tax_status_term) { echo ' ' . $tax_status_term->slug; } ?>">
					<div class="single-project-left">
						<h2 class="alpha"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
						<div class="project-meta">
							<div class="impact-list">
								<ul>
									<?php $impact_terms = get_the_terms( $post->ID , 'portfolio-impact' ); if ( $impact_terms ) { foreach ( $impact_terms as $impact_term ) { echo '<li class="impact">' . $impact_term->name . '</li>'; } } ?>
								</ul>
							</div>
							<div class="category-list">
								<?php $cat_terms = get_the_terms( $post->ID , 'portfolio-cat' ); if ( $cat_terms ) { ?><strong>Category</strong> <?php foreach ( $cat_terms as $cat_term ) { echo '<span class="category">' . $cat_term->name . '</span>'; } } ?>
							</div>
							<div class="status-list">
								<?php $status_terms = get_the_terms( $post->ID , 'portfolio-status' ); if ( $status_terms ) { ?><strong>Status</strong> <?php foreach ( $status_terms as $status_term ) { echo '<span class="status">' . $status_term->name . '</span>'; } } ?>
							</div>

						</div>
						<div class="project-teaser">
							<?php echo $teaser; ?>
						</div>
					</div>
					<div class="single-project-right">
						<img class="lazyload" data-sizes="auto" data-src="<?php echo $image_url[0]; ?>" />
					</div>
				</div>

			<?php endwhile; ?>

		</div>

		<div class="nothing-to-show projects-list-inner" style="display: none;"><p>Sorry, your search returned no results.</p></div>

	</div>

</div>
