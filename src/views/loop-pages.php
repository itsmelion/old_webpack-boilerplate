
 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	 <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail(array('thumbnail')); ?>
		</a>
	<?php endif; ?>

	<h2>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
	</h2>


  <div class="entry">
    <?php the_content(); ?>
  </div>

  <!-- <span class="date">
        <time datetime="<?php the_time('Y-m-d'); ?> <?php the_time('H:i'); ?>">
          <?php the_date(); ?> <?php the_time(); ?>
        </time>
      </span> -->
</article>

<?php endwhile; else : ?>

<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>

<?php endif; ?>