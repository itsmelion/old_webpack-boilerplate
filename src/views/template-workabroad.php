<?php /* Template Name: Work Abroad */

/* Check if you are Arthur.
(the enviroment variable Arthur:bool is on the wp-config.php file
in your wordpress installation)
*/

// if ( Arthur ) {
//   $url = 'http://crm.planetexpat.dev';
// }else{
//   $url = 'https://crm.planetexpat.org';
// }

$url = 'https://crm.planetexpat.org';

if(isset($_REQUEST['token'])){
  $token = $_REQUEST['token'];

  $curl = curl_init();
  // Set some options - we are passing in a useragent too here
  curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $url . '/api/candidates/work_abroad_form?token=' . $token,
      CURLOPT_USERAGENT => 'Codular Sample cURL Request'
  ));
  // Send the request & save response to $resp
  $resp = curl_exec($curl);
  // Close request to clear up some resources
  curl_close($curl);
}
else{
  // Get cURL resource
  $curl = curl_init();
  // Set some options - we are passing in a useragent too here
  curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => 1,
      CURLOPT_URL => $url . '/api/candidates/pre_apply_form',
      CURLOPT_USERAGENT => 'Codular Sample cURL Request'
  ));
  // Send the request & save response to $resp
  $resp = curl_exec($curl);
  // Close request to clear up some resources
  curl_close($curl);
}

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
    <h1><?php the_field('hero'); ?></h1>
  </div>

  <div class="flex ctas">
    <?php if(get_field("prime-cta-url")):
      echo '<a class="button" style="background-color: ' . get_field("prime-cta-color") . '" href="' . get_field("prime-cta-url") . '">' . get_field("prime-cta-text") . '</a>';
    endif; ?>
    <?php if(get_field("alt-cta-url")):
      echo '<a class="button" style="background-color: ' . get_field("alt-cta-color") . '" href="' . get_field("alt-cta-url") . '">' . get_field("alt-cta-text") . '</a>';
    endif; ?>
  </div>

</header>

<main role="main" aria-label="Content">

<?php include 'src/components/sections.php'; ?>

<?php get_template_part('loop', 'pricing-abroad'); ?>

<?php get_template_part('loop', 'destinations'); ?>

<section class="layout-column-center default" id=SECT3>
  <h2>Afraid your application is not good enough?</h2>
  <a class=button href=/services-pricing/#work-abroad-coaching-pricing>Check our coaching packages</a>
</section>

<section id="form_crm" class="layout-column-center default" style="background-color: #f7f7f7;" ng-app="crm">
  <h2 style="font-weight: 700; margin-bottom: 2rem;">Apply</h2>
  <?= $resp ?>
</section>

<?php include 'src/components/faq.php'; ?>

<?php include 'src/components/flex-internal.php'; ?>

</main>

<?php
get_footer();
if(isset($_REQUEST['token'])){ ?>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js"></script>
<script>

$(document).ready(function(){
	$.scrollTo('#form_crm');
});

</script>

<?php } ?>
