<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Sophie Theme
 */

if ( ! function_exists( 'sophie_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function sophie_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'sophie' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'sophie' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'sophie' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'sophie_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function sophie_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'sophie' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'sophie' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'sophie' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'sophie_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function sophie_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( 'Posted on %s', 'post date', 'sophie' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		_x( 'by %s', 'post author', 'sophie' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}
endif;

if ( ! function_exists( 'sophie_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function sophie_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'sophie' ) );
		if ( $categories_list && sophie_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'sophie' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'sophie' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'sophie' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'sophie' ), __( '1 Comment', 'sophie' ), __( '% Comments', 'sophie' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'sophie' ), '<span class="edit-link">', '</span>' );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function sophie_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'sophie_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'sophie_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so sophie_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so sophie_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in sophie_categorized_blog.
 */
function sophie_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'sophie_categories' );
}
add_action( 'edit_category', 'sophie_category_transient_flusher' );
add_action( 'save_post',     'sophie_category_transient_flusher' );

// Social Media Theme Mods Template tag

function sophie_social_media() {
	$wordpress      = get_theme_mod( 'wordpress' );
	$twitter        = get_theme_mod( 'twitter' );
	$facebook       = get_theme_mod( 'facebook' );
	$vimeo          = get_theme_mod( 'vimeo' );
	$youtube        = get_theme_mod( 'youtube' );
	$dribbble       = get_theme_mod( 'dribbble' );
	$flickr         = get_theme_mod( 'flickr' );
	$instagram      = get_theme_mod( 'instagram' );
	$tumblr         = get_theme_mod( 'tumblr' );
	$pinterest      = get_theme_mod( 'pinterest' );
	$rss            = get_theme_mod( 'rss' );

	if ( $wordpress || $twitter || $facebook || $vimeo || $youtube || $dribbble || $flickr || $instagram || $tumblr || $pinterest || $rss ) {?>

		<aside class="social-media widget">
		<h3 class="widget-title"><?php _e( 'Follow Us', 'sophie' ); ?></h3>
	<?php }?>

	<?php  if( $wordpress != '' ) { ?>
		<span class="wordpress social-icon"><a href="<?php echo get_theme_mod( 'wordpress' ); ?>">
				<span class="genericon genericon-wordpress"></span></a></span>
	<?php }?>

	<?php  if( $twitter != '' ) { ?>
		<span class="twitter social-icon"><a href="<?php echo get_theme_mod( 'twitter' ); ?>">
				<span class="genericon genericon-twitter"></span></a></span>
	<?php }?>

	<?php if ( $facebook != '' ) { ?>

		<span class="facebook social-icon"><a href="<?php echo get_theme_mod( 'facebook' ); ?>">
				<span class="genericon genericon-facebook"></span></a></span>

	<?php } ?>

	<?php if ( $vimeo != '' ) { ?>

		<span class="vimeo social-icon"><a href="<?php echo get_theme_mod( 'vimeo' ); ?>">
				<span class="genericon genericon-vimeo"></span></a></span>

	<?php } ?>

	<?php if ( $youtube != '' ) { ?>

		<span class="youtube social-icon"><a href="<?php echo get_theme_mod( 'youtube' ); ?>">
				<span class="genericon genericon-youtube"></span></a></span>

	<?php } ?>

	<?php if ( $dribbble != '' ) { ?>

		<span class="dribbble social-icon"><a href="<?php echo get_theme_mod( 'dribbble' ); ?>">
				<span class="genericon genericon-dribbble"></span></a></span>

	<?php } ?>

	<?php if ( $flickr != '' ) { ?>

		<span class="flickr social-icon"><a href="<?php echo get_theme_mod( 'flickr' ); ?>">
				<span class="genericon genericon-flickr"></span></a></span>

	<?php } ?>

	<?php if ( $instagram != '' ) { ?>

		<span class="instagram social-icon"><a href="<?php echo get_theme_mod( 'instagram' ); ?>">
				<span class="genericon genericon-instagram"></span></a></span>

	<?php } ?>

	<?php if ( $tumblr != '' ) { ?>

		<span class="tumblr social-icon"><a href="<?php echo get_theme_mod( 'tumblr' ); ?>">
				<span class="genericon genericon-tumblr"></span></a></span>

	<?php } ?>

	<?php if ( $pinterest != '' ) { ?>

		<span class="pinterest social-icon"><a href="<?php echo get_theme_mod( 'pinterest' ); ?>">
				<span class="genericon genericon-pinterest-alt"></span></a></span>

	<?php } ?>

	<?php if ( $rss != '' ) { ?>

		<span class="rss social-icon"><a href="<?php echo get_theme_mod( 'rss' ); ?>">
				<span class="genericon genericon-rss"></span></a></span>

	<?php } ?>

	<?php if ( $wordpress || $twitter || $facebook || $vimeo || $youtube || $dribbble || $flickr || $instagram || $tumblr || $pinterest || $rss ) { ?>

		</aside>

	<?php
	}
}

function sophie_homepage_content() {
	$title = get_theme_mod( 'home_title_text' );
	$content = get_theme_mod( 'homepage_textarea' );

	if ( $title ) {?>
		<h2 class="page-title"><?php echo $title;?></h2>
<?php
		if( $content ) {?>
			<p><?php echo $content;?></p>
		<?php }
	}
}