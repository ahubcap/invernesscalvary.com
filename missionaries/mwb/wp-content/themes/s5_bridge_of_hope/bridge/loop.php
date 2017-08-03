<?php
	$comments_disabled = s5_get_option('s5_hide_comments');
	global $s5_loop_tags;
?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<div id="nav-above" class="navigation">
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', $shortname ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', $shortname ) ); ?></div>
	</div><!-- #nav-above -->
<?php endif; ?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<?php
		echo s5_loop_blocks($s5_loop_tags['before_loop']);
		echo s5_loop_blocks($s5_loop_tags['before_post']);
		echo s5_loop_blocks($s5_loop_tags['before_title']);
		?>
			<?php _e( 'Not Found', $shortname ); ?>
		<?php
		echo s5_loop_blocks($s5_loop_tags['after_title']);
		echo s5_loop_blocks($s5_loop_tags['before_content']); ?>
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', $shortname ); ?></p>
			<?php get_search_form(); ?>
		<?php
		echo s5_loop_blocks($s5_loop_tags['after_content']);
		echo s5_loop_blocks($s5_loop_tags['after_post']);
		echo s5_loop_blocks($s5_loop_tags['after_loop']);
		unset($s5_loop_tags['current_post']);
		?>
		<!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php
	/* Start the Loop.
	 *
	 * In Twenty Ten we use the same loop in multiple contexts.
	 * It is broken into three main parts: when we're displaying
	 * posts that are in the gallery category, when we're displaying
	 * posts in the asides category, and finally all other posts.
	 *
	 * Additionally, we sometimes check for whether we are on an
	 * archive page, a search page, etc., allowing for small differences
	 * in the loop on each template without actually duplicating
	 * the rest of the loop that is shared.
	 *
	 * Without further ado, the loop:
	 */ ?>


<?php if (is_home()){echo s5_loop_blocks($s5_loop_tags['blog_heading']);
}?>
<?php while ( have_posts() ) : the_post(); ?>

<?php /* How to display posts in the Gallery category. */ ?>

	<?php if ( in_category( _x('gallery', 'gallery category slug', $shortname) ) ) : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php $s5_loop_tags['current_post'] = $post->ID;
		echo s5_loop_blocks($s5_loop_tags['before_loop']);
		echo s5_loop_blocks($s5_loop_tags['before_post']);
		echo s5_loop_blocks($s5_loop_tags['before_title']);
		?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before' => 'Permalink to: ', 'after' => '')); ?>"><?php the_title(); ?></a>
		<?php
		echo s5_loop_blocks($s5_loop_tags['after_title']);
		?>
			<div class="entry-meta">
				<?php twentyten_posted_on(); ?>
			</div><!-- .entry-meta -->

		<?php
		echo s5_loop_blocks($s5_loop_tags['before_content']); ?>
<?php if ( post_password_required() ) : ?>
				<?php the_content(); ?>
<?php else : ?>
				<?php
					$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
				?>
						<div class="gallery-thumb">
							<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
						</div><!-- .gallery-thumb -->
						<p><em><?php printf( __( 'This gallery contains <a %1$s>%2$s photos</a>.', $shortname ),
								'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', $shortname ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
								$total_images
							); ?></em></p>
				<?php endif; ?>
						<?php the_excerpt(); ?>
<?php endif; ?>
		<?php
		echo s5_loop_blocks($s5_loop_tags['after_content']);
		echo s5_loop_blocks($s5_loop_tags['after_post']);
		echo s5_loop_blocks($s5_loop_tags['after_loop']);
		unset($s5_loop_tags['current_post']);
		?>
		<!-- .entry-content -->

			<div class="entry-utility">
				<a href="<?php echo get_term_link( _x('gallery', 'gallery category slug', $shortname), 'category' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', $shortname ); ?>"><?php _e( 'More Galleries', $shortname ); ?></a>
				<?php if($comments_disabled != 1){?><span class="meta-sep">|</span>
				<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', $shortname ), __( '1 Comment', $shortname ), __( '% Comments', $shortname ) ); ?></span><?php } ?>
				<?php edit_post_link( __( 'Edit', $shortname ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->
		</div><!-- #post-## -->

<?php /* How to display all other posts. */ ?>

	<?php else : ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php $s5_loop_tags['current_post'] = $post->ID;
		echo s5_loop_blocks($s5_loop_tags['before_loop']);
		echo s5_loop_blocks($s5_loop_tags['before_post']);
		echo s5_loop_blocks($s5_loop_tags['before_title']);
		?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before' => 'Permalink to: ', 'after' => '')); ?>"><?php the_title(); ?></a>
		<?php
		echo s5_loop_blocks($s5_loop_tags['after_title']);
		?>
		<?php if (! is_page()){ ?>
			<div class="entry-meta">
				<?php //twentyten_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php } ?>

	<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
		<?php
		echo s5_loop_blocks($s5_loop_tags['before_content']); ?>
				<?php the_excerpt(); ?>
		<?php
		echo s5_loop_blocks($s5_loop_tags['after_content']);
		echo s5_loop_blocks($s5_loop_tags['after_post']);
		echo s5_loop_blocks($s5_loop_tags['after_loop']);
		unset($s5_loop_tags['current_post']);
		?>
			<!-- .entry-summary -->
	<?php else : ?>
		<?php
		echo s5_loop_blocks($s5_loop_tags['before_content']); ?>

				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', $shortname ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', $shortname ), 'after' => '</div>' ) ); ?>
		<?php
		echo s5_loop_blocks($s5_loop_tags['after_content']);
		echo s5_loop_blocks($s5_loop_tags['after_post']);
		echo s5_loop_blocks($s5_loop_tags['after_loop']);
		unset($s5_loop_tags['current_post']);
		?>
		<!-- .entry-content -->
	<?php endif; ?>

			<div class="entry-utility">
<?php if (function_exists('dfrads')) { echo dfrads('5305651'); } ?>
				<?php if ( count( get_the_category() ) ) : ?>
					<span class="cat-links">
						<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', $shortname ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
					</span>
					<span class="meta-sep">&nbsp;</span>
				<?php endif; ?>
				<?php
					$tags_list = get_the_tag_list( '', ', ' );
					if ( $tags_list ):
				?>
					<span class="tag-links">
						<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', $shortname ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
					</span>
					<span class="meta-sep">|</span>
				<?php endif; ?>
				<?php if($comments_disabled != 1){?><span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', $shortname ), __( '1 Comment', $shortname ), __( '% Comments', $shortname ) ); ?></span><?php } ?>
				<?php edit_post_link( __( 'Edit', $shortname ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-utility -->
		</div><!-- #post-## -->
		<?php if($comments_disabled != 1){?>
		<?php comments_template( '', true ); }?>

	<?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>

<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', $shortname ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', $shortname ) ); ?></div>
				</div><!-- #nav-below -->
<?php endif; ?>
