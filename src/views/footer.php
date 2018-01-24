<!-- <section class="layout-column footer-form">
	<h2>Join</h2>
	<form class="layout-row-center" action="/send">
		<input type="text" name="name" placeholder="John Doe" />
		<input type="email" name="email" placeholder="john.doe@example.com"/>
		<button type="submit" class="button" placeholder="john.doe@example.com">Submit</button>
	</form>
</section> -->

<section class="wide-widget-area" role="complementary">
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-3')): ?>
		<div class="widebar-widget"></div>
		<?php endif; ?>
</section>

<footer class="layout-column" role="contentinfo">

	<div class="layout-row-between-nowrap">

		<div class="brand">
			<li class="pe-footer-logo">
				<a title="<?php bloginfo( 'description' ); ?>" href="<?php echo home_url();?>">
					<img src="<?php echo get_bloginfo('template_url') ?>/build/images/logo-alt.png" alt="<?php bloginfo( 'name' ); ?>" />
				</a>
			</li>
			<li class="social">
				<a href="//facebook.com/PlanetExpat/" target="_blank" title="Facebook">
					<img src="<?php echo get_bloginfo('template_url') ?>/build/images/social-facebook.svg" alt="Facebook"/>
				</a>
				<a href="//twitter.com/PlanetExpat" target="_blank" title="Twitter: @PlanetExpat">
					<img src="<?php echo get_bloginfo('template_url') ?>/build/images/social-twitter.svg" alt="@PlanetExpat"/>
				</a>
				<a href="//linkedin.com/company/2949016/" target="_blank" title="LinkedIn">
					<img src="<?php echo get_bloginfo('template_url') ?>/build/images/social-linkedin.svg" alt="LinkedIn"/>
				</a>
			</li>
		</div>

		<?php while( have_rows('footer_list', 'option') ): the_row(); ?>
			<ul class="footer-links">
				<li><?php echo the_sub_field('list_title');?></li>
				<?php while( have_rows('list_items', 'option') ): the_row(); ?>
				<li><a href="<?php echo the_sub_field('url');?>"><?php echo the_sub_field('text');?></a></li>
				<?php endwhile; ?>
			</ul>
		<?php endwhile; ?>

		<ul class="footer-form">
			<li>Contact</li>
			<?php echo do_shortcode('[contact-form-7 id="13258" title="Contact form 1"]'); ?>
		</ul>
	</div>
 </footer>

<?php wp_footer(); ?>

<!-- analytics -->
</body>
</html>
