<?php get_header();

$desktop = get_field('background_image_desktop');
$mobile = get_field('background_image_mobile');

if(!$mobile):
  $mobile = get_field('background_image_desktop');
endif;
?>

<style>
.this-header{
  background: url("<?php echo $desktop['sizes']['large']; ?>");
}
</style>

<?php if(!empty(get_field('background_image_desktop'))) : ?>
<header class="layout-column-center flex default this-header" role="banner">
    <div class="flex layout-row-nowrap-center">
		<h1><?php the_field('hero'); ?></h1>
    </div>
    <div class="flex ctas">

			<?php if(get_field("prime-cta-url")):
				echo '<a class="button"
				style="
				background: ' . get_field("prime-cta-color") . ';
				background: -moz-linear-gradient(-30deg, ' . get_field("prime-cta-color") . ' 0%, rgba(255,255,255,.3) 100%);
				background: -webkit-linear-gradient(-30deg, ' . get_field("prime-cta-color") . ' 0%,rgba(255,255,255,.3) 100%);
				background: linear-gradient(120deg, ' . get_field("prime-cta-color") . ' 0%,rgba(255,255,255,.3) 100%);
				filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'' . get_field("prime-cta-color") . '\', endColorstr=\'#ffffff\',GradientType=1 );
				"
				href="' . get_field("prime-cta-url") . '">' . get_field("prime-cta-text") . '</a>';
			endif; ?>
			<?php if(get_field("alt-cta-url")):
				echo '<a class="button" style="background-color: ' . get_field("alt-cta-color") . '" href="' . get_field("alt-cta-url") . '">' . get_field("alt-cta-text") . '</a>';
			endif; ?>
    </div>

</header>
<?php endif; ?>

<main class="flex-grow" role="main" aria-label="Content">

	<?php include 'src/components/sections.php'; ?>

	<div class="contain">
		<section class="layout-column page-default">
		<?php get_template_part('loop', 'pages'); ?>
		</section>
	</div>


</main>

<?php get_footer(); ?>