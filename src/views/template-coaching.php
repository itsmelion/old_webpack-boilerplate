<?php /* Template Name: Career Coaching */

$url = 'https://crm.planetexpat.org';

//dev
if(strpos($_SERVER['HTTP_HOST'], 'planetexpat.org') === false){
  $url = 'http://crm.planetexpat.dev';
}

// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url . '/api/candidates/scheduling_form',
    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);

get_header();
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
@media screen and (max-width: 58em){
  .this-header{
    background: url("<?php echo $mobile['sizes']['large']; ?>");
  }
}
</style>

<header id="front-page" class="layout-column-center flex this-header" role="banner">
    <div class="flex layout-row-nowrap-center">
		  <h1><?php the_field('hero') ?></h1>
    </div>
    <div class="flex ctas">
			<?php if(get_field("prime-cta-url")):
				echo '<a class="button" onclick="scrollToCoachingForm()" style="background-color: ' . get_field("prime-cta-color") . '; cursor: pointer; text-decoration: none">' . get_field("prime-cta-text") . '</a>';
			endif; ?>
			<?php if(get_field("alt-cta-url")):
				echo '<a class="button" style="background-color: ' . get_field("alt-cta-color") . '" href="' . get_field("alt-cta-url") . '">' . get_field("alt-cta-text") . '</a>';
			endif; ?>
    </div>

</header>

<main role="main" aria-label="Content">

<?php include 'src/components/sections.php'; ?>

<section id="videoInsight" class="layout-column">
  <div class="videoWrapper">
    <iframe src="https://www.youtube.com/embed/DRftQTxDDkY?rel=0&amp;controls=0&amp;showinfo=0&amp;modestbranding=1" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
  </div>
</section>

<?php get_template_part('loop', 'pricing-coaching'); ?>

<?php // include 'src/components/faq.php'; ?>

<section class="layour-row-center" id="scheduling" style="border-radius: 3px; padding: 10px ;margin-left:5%; margin-bottom: 3rem;" ng-app="scheduling">
  <?= $resp ?>
</section>

<?php include 'src/components/sections-pricings.php'; ?>

</main>

<?php get_footer(); ?>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js"></script>
<script>

   function scrollToCoachingForm() {
       $.scrollTo('#scheduling');
   }

</script>
