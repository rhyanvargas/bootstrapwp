<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package bootstrapsasswp
 */

 if ( ! function_exists( 'bsw_posts_navigation' ) ) :
	/**
	 * Creates the blog pagination navigation`
	 */
	function bsw_posts_navigation() {
		// Don't print empty markup if there's only one page.
		if ($GLOBALS['wp_query']->max_num_pages < 2) {
			return;
		}
		?>
		<nav class="navigation paging-navigation" role="navigation">
			<h1 class="sr-only"><?php _e('Posts navigation', 'bootstrapwp');?></h1>
			<ul class="pager">

				<?php if (get_next_posts_link()): ?>
				<li class="previous"><?php next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts', 'bootstrapwp'));?></li>
				<?php endif;?>

				<?php if (get_previous_posts_link()): ?>
				<li class="next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&rarr;</span>', 'bootstrapwp'));?></li>
				<?php endif;?>

			</ul><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
endif;


if ( ! function_exists( 'bsw_post_navigation' ) ) :
	/**
	 * Creates the post pagination navigation`
	 */
	function bsw_post_navigation() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
		$next = get_adjacent_post(false, '', false);

		if (!$next && !$previous) {
			return;
		}
		?>
		<nav class="navigation post-navigation" role="navigation">
			<h1 class="sr-only"><?php _e('Post navigation', 'bootstrapwp');?></h1>
			<ul class="pager">
				<?php
		previous_post_link('<li class="previous">%link</li>', _x('<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'bootstrapwp'));
			next_post_link('<li class="next">%link</li>', _x('%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link', 'bootstrapwp'));
			?>
				</ul><!-- .nav-links -->
			</nav><!-- .navigation -->
			<?php
	}
endif;

if ( ! function_exists( 'bootstrapsasswp_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function bootstrapsasswp_posted_on() {
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
			/* translators: %s: post date. */
			_x( '<i class="fas fa-clock"></i> %s', 'post date', 'bootstrapsasswp' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			/* translators: %s: post author. */
			_x( '<i class="fas fa-user"></i> %s', 'post author', 'bootstrapsasswp' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'bootstrapsasswp_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function bootstrapsasswp_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'bootstrapsasswp' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'bootstrapsasswp' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'bootstrapsasswp' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'bootstrapsasswp' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'bootstrapsasswp' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'bootstrapsasswp' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;
