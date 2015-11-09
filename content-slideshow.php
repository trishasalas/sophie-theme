<?php
$cat = get_theme_mod( 'featured_post_cat_setting' );
$args = (array('cat' => $cat));

$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) {?>
<div class="horizontal-slider">
	<?php
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		echo  the_post_thumbnail( 'horizontal-slider' );
	}?>
	</div>
<?php } wp_reset_postdata();
