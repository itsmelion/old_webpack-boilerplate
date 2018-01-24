<?php get_header() ?>

<section class="layout-row-nowrap destinations-header" >
  <article class="flex layout-column">
    <h1><?php the_title(); ?></h1>
    <p><?php the_field('paragraph'); ?></p>
  </article>
  <?php $image = get_field('region-image'); ?>
  <div class="dual-img-container" style="background-image: url('<?php echo $image; ?>');"></div>

</section>

<?php include 'src/components/destinations-content.php'; ?>

<!-- get_template_part('loop', 'tips'); -->
<?php if(get_field('crm-opportunities')): ?>
<section class="layout-column-center destinations-cta background parallax" data-img-width="1200" data-img-height="698" data-diff="200">
  <h2>Apply NOW for a job in <?php the_title(); ?></h2>

  <iframe class="destination-jobs" src="<?php the_field('crm-opportunities'); ?>" frameborder="0">
      <p>Your Browser is not cool. It Doesn't support iFrames</p>
  </iframe>

</section>
<?php endif; ?>

<?php $other_destinations = get_field('other_destinations');
	if( $other_destinations ): ?>
<section class="layout-column-center other-destinations">

  <h2>Other Destinations</h2>

  <div class="layout-row-center">

    <?php foreach( $other_destinations as $post): setup_postdata($post); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('layout-column-nowrap-center'); ?> >

          <?php if ( has_post_thumbnail()) : ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
              <?php the_post_thumbnail('thumbnail'); // Declare pixel size you need inside the array ?>
            </a>
          <?php endif; ?>

          <h3><?php the_title(); ?></h3>

          <span><?php the_content(); ?></span>
          <?php edit_post_link(); ?>
        </article>

    <?php endforeach; ?>
    <?php wp_reset_postdata();?>

  </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>