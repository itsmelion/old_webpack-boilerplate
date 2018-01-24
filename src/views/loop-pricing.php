<section class="text-center layout-column flex pricings-section">
    <h2>Work Abroad Coaching Programs</h2>

    <div class="layout-row">
        <?php $my_query = new WP_Query( array( 'post_type' => 'pricing', 'ignore_sticky_posts' => 1 ) );
    if ( $my_query->have_posts() ) : while ( $my_query->have_posts() ) : $my_query->the_post(); ?>

        <?php if(empty(get_field('highlighted'))):
      $highlight = 'normal';
    else:
      $highlight = 'highlight';
    endif;
    ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'layout-column-nowrap price ' . $highlight ); ?> >
            <div>
                <p>
                    <?php the_field('pre-text'); ?>
                </p>
                <h1>
                    <?php the_title(); ?>
                </h1>
                <h1 class="value">
                    <?php the_field('value'); ?>
                </h1>
            </div>

            <ol>
                <?php if( have_rows('benefits') ): while ( have_rows('benefits') ) : the_row(); ?>
                <li>
                    <?php the_sub_field('benefit'); ?>
                </li>
                <?php endwhile; endif; ?>
            </ol>
            <a href="<?php the_field('call_to_action_url'); ?>" class="button">
                <?php the_field('call_to_action_text'); ?>
            </a>
        </article>

        <?php endwhile; else : ?>

        <p>
            <?php esc_html_e( 'Oh, No plans available at the moment. :/' ); ?>
        </p>

        <?php endif; wp_reset_postdata(); ?>
    </div>
</section>