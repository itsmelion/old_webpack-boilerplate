<?php /* Template Name: Join */ 

$url = 'https://crm.planetexpat.org';

//dev
if(strpos($_SERVER['HTTP_HOST'], 'planetexpat.org') === false){
  $url = 'http://crm.planetexpat.dev';
}

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
?>

<main role="main" aria-label="Content">
<section class="layout-row-center" style="width: 90%; border-radius: 3px; padding: 10px ;margin-left:5%; background-color: #f7f7f7; margin-bottom: 3rem; margin-top: 4rem" ng-app="crm">
  <?= $resp ?>
</section>

</main>
<span class="flex-grow"></span>

<?php get_footer(); ?>
