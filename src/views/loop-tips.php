<section class="text-center layout-column flex caroussel-section">
  <h2>Tips for your career</h2>
<div class="slick-container">

<?php $my_query = new WP_Query( array( 'post_type' => 'job-tips' ) );
  if ( $my_query->have_posts() ) :
while ( $my_query->have_posts() ) : $my_query->the_post(); ?>

 <article id="post-<?php the_ID(); ?>" <?php post_class('layout-column-nowrap'); ?>>

	 <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail(); // Declare pixel size you need inside the array ?>
		</a>
	<?php endif; ?>

	<h3>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
	</h3>


 		<?php the_content(); ?>

 	</article>

 <?php endwhile; else : ?>

 	<p><?php esc_html_e( 'Oh, we have no tips at the moment. :/' ); ?></p>

 <?php endif; wp_reset_postdata(); ?>

</div>
</section>
