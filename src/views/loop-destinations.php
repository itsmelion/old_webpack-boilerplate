<section class="text-center layout-column flex caroussel-section destinations-section">
  <h2>Check our destinations</h2>

<div class="slick-container">

<?php $my_query = new WP_Query( array( 'post_type' => 'destinations') );
  if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>

 <article id="post-<?php the_ID(); ?>" <?php post_class('layout-column-forcenowrap-center'); ?> >

	<?php if ( has_post_thumbnail()) : ?>
		<a class="layout-row-center" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail('thumbnail'); // Declare pixel size you need inside the array ?>
		</a>
	<?php endif; ?>

  <h3><?php the_title(); ?></h3>
 	
 	</article>

 <?php endwhile; else : ?>

 	<p><?php esc_html_e( 'Oh, No destinations available at the moment. :/' ); ?></p>

 <?php endif; wp_reset_postdata(); ?>
</div>
</section>
