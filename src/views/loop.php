
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<article href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

	<span class="date">
		<time datetime="<?php the_time('Y-m-d'); ?> <?php the_time('H:i'); ?>">
			<?php the_date(); ?> <?php the_time(); ?>
		</time>
	</span>

	<?php html5wp_excerpt('html5wp_custom_post'); ?>
	<a class="button view-article" href="<?php the_permalink(); ?>"><?php echo __('View Article', 'html5blank'); ?></a>
</article> 

<?php endwhile; else : ?>

<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>

<?php endif; ?>