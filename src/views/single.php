<?php get_header();

if ( has_post_thumbnail() ) : ?>
<style>
	.this-header {
		background: url("<?php the_post_thumbnail_url(); ?>");
	}
</style>
<?php endif; ?>



<header class="layout-column-center flex default this-header" role="banner">
	<div class="contain flex layout-row-nowrap-center">
		<h1>
			<?php the_title(); ?>
		</h1>
	</div>

</header>

<div class="layout-row-nowrap contain">
	<main class="flex-grow blog-post-single" role="main" aria-label="Content">
		<!-- section -->
		<section class="contain layout-column-nowrap">

			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >

				<div>
					<?php the_content(); ?>
				</div>

				<div>
					<?php if ( function_exists( 'wpsabox_author_box' ) ) echo wpsabox_author_box(); ?>
				</div>
			</article>

			<?php endwhile; ?>

			<?php else: ?>

			<!-- article -->
			<article>

				<h1>
					<?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?>
				</h1>

			</article>
			<!-- /article -->
			
			<?php

                	//Get current URL
			$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

			?>

			<div class="fb-comments" data-href="<?= $actual_link ?>" data-numposts="5"></div>

			<?php endif; ?>

		</section>
		<!-- /section -->
	</main>

	<!-- sidebar -->
	<aside class="flex-none layout-column-nowrap widget-area sidebar" role="complementary">

		<?php // get_template_part('searchform'); ?>

		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-1')): ?>
		<div class="sidebar-widget">
		</div>
		<?php endif; ?>
		
		<?php

		    if (function_exists('sharing_display')) {
			sharing_display('', true);
		    }

		    ?>

	</aside>
	<!-- /sidebar -->
</div>




<?php get_footer(); ?>
