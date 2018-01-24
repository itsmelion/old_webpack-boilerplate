<?php get_header();

$desktop = get_field('background_image_desktop');
$mobile = get_field('background_image_mobile');

if(!$mobile):
  $mobile = get_field('background_image_desktop');
endif;
?>

<style>
/*
## CUSTOM BACKGROUND
.this-header{
  background: url("<?php echo $desktop['sizes']['large']; ?>");
}
@media screen and (max-width: 58em){
  .this-header{
    background: url("<?php echo $mobile['sizes']['large']; ?>");
  }
} */

.this-header{
  background: url("<?php echo get_bloginfo('template_url') ?>/build/images/blog-wide.jpg");
}
@media screen and (max-width: 58em){
  .this-header{
    background: url("<?php echo get_bloginfo('template_url') ?>/build/images/blog-mobile.jpg");
  }
}
</style>

<?php wp_nav_menu( array( 'theme_location' => 'CategoryMenu','container' => false, 'menu_class' => 'layout-row-start blog-menu' ) ); ?>
<header id="blog-header" class="layout-column-center flex default this-header" role="banner">
    <div class="flex layout-column-nowrap-center">
			<h1 style="font-weight: bold;"><?php single_cat_title(); ?></h1>
    </div>
</header>

<div class="contain layout-row-nowrap-between" style="width:100%">

	<main class="flex-none" role="main" aria-label="Content">


        <section class="layout-column-nowrap-start blog-default">
            <?php get_template_part('loop'); ?>
        </section>

	</main>

	<!-- sidebar -->
	<aside class="flex-none layout-column-nowrap widget-area sidebar" role="complementary">

		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-2')): ?>
		<div class="sidebar-widget">
		</div>
		<?php endif; ?>

	</aside>
	<!-- /sidebar -->
</div>

<?php get_footer(); ?>