<aside class="flex-inital layout-column-nowrap widget-area sidebar" role="complementary">

	<?php // get_template_part('searchform'); ?>

	<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-1')): ?>
	<div class="sidebar-widget">
	</div>
	<?php endif; ?>

	<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-2')): ?>
	<div class="sidebar-widget">
	</div>
	<?php endif; ?>

</aside>