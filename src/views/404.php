<?php get_header(); ?>

<main class="flex-grow layout-column" role="main" aria-label="Content">
	<section id="error404" class="layout-column-center">
		<h1><?php _e( 'Page not found', 'html5blank' ); ?></h1>
		<h2>Not even our best coach can find this destination</h2>
		<h3>Error: 404 (page not found)</h3>
		<a class=button href="<?php echo home_url(); ?>">
			<?php _e( 'Return home', 'html5blank' ); ?>
		</a>

		<img src="<?php echo get_bloginfo('template_url') ?>/build/images/404.svg" />

	</section>
</main>

<?php wp_footer(); ?>
