<?php get_header(); ?>

<div class="layout-row-nowrap">
	<main class="layout-column contain" role="main" aria-label="Content" style="margin-top: 4rem">

		<h1><?php echo sprintf( __( '%s Search Results for ', 'html5blank' ), $wp_query->found_posts ); echo get_search_query(); ?></h1>

		<div class="search-results">
		<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_post_thumbnail("thumbnail"); // Declare pixel size you need inside the array ?>
				</a>
			<?php endif; ?>
			<div class="details">
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<span class="black3 date"><?php the_time('F j, Y'); ?></span><br>
			<span class="black3 author"><?php _e( 'Published by', 'html5blank' ); ?> <?php the_author_posts_link(); ?></span><br>
			<?php html5wp_excerpt('html5wp_index'); ?>
			<?php edit_post_link(); ?>
			</div>
		</article>
		<?php endwhile; ?>
<?php else: ?>

    <!-- article -->
    <article>
        <h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>
    </article>
    <!-- /article -->

<?php endif; ?>


		</div>

	</main>

	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>