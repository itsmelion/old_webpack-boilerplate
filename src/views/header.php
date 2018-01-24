<!DOCTYPE html>

<head>

<?php if (!WP_DEBUG) { ?>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'//googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-NHVLSFF');</script>
	<!-- End Google Tag Manager -->
<?php } ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title>
        <?php wp_title(''); ?>
        <?php if(wp_title('', false)) { echo ' : '; } ?>
        <?php bloginfo('name'); ?>
    </title>
    <?php if (!WP_DEBUG) { ?>
    <link href="//fonts.googleapis.com" rel="dns-prefetch">
    <?php } ?>

    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="content-language" content="<?php language_attributes(); ?>">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo get_bloginfo('template_url') ?>/build/images/favicons/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_bloginfo('template_url') ?>/build/images/favicons/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_bloginfo('template_url') ?>/build/images/favicons/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_bloginfo('template_url') ?>/build/images/favicons/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php echo get_bloginfo('template_url') ?>/build/images/favicons/apple-touch-icon-60x60.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo get_bloginfo('template_url') ?>/build/images/favicons/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo get_bloginfo('template_url') ?>/build/images/favicons/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo get_bloginfo('template_url') ?>/build/images/favicons/apple-touch-icon-152x152.png" />
    <link rel="icon" type="image/png" href="<?php echo get_bloginfo('template_url') ?>/build/images/favicons/favicon-196x196.png" sizes="196x196" />
    <link rel="icon" type="image/png" href="<?php echo get_bloginfo('template_url') ?>/build/images/favicons/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/png" href="<?php echo get_bloginfo('template_url') ?>/build/images/favicons/favicon-32x32.png" sizes="32x32" />
    <link rel="icon" type="image/png" href="<?php echo get_bloginfo('template_url') ?>/build/images/favicons/favicon-16x16.png" sizes="16x16" />
    <link rel="icon" type="image/png" href="<?php echo get_bloginfo('template_url') ?>/build/images/favicons/favicon-128.png" sizes="128x128" />
    <meta name="application-name" content="Planet Expat"/>
    <meta name="msapplication-TileColor" content="#45ACCF" />
    <meta name="msapplication-TileImage" content="<?php echo get_bloginfo('template_url') ?>/build/images/favicons/mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="<?php echo get_bloginfo('template_url') ?>/build/images/favicons/mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="<?php echo get_bloginfo('template_url') ?>/build/images/favicons/mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="<?php echo get_bloginfo('template_url') ?>/build/images/favicons/mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="<?php echo get_bloginfo('template_url') ?>/build/images/favicons/mstile-310x310.png" />
    <meta name="theme-color" content="#45ACCF" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="no">
    <meta name="apple-mobile-web-status-bar-style" content="black-translucent">

    <meta property="og:type" content="website" />
    <meta property="og:locale" content="<?php language_attributes(); ?>">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
    <meta property="og:title" content="<?php bloginfo('name'); ?>" />
    <meta property="og:description" content="<?php bloginfo('description'); ?>" />
    <meta property="og:url" content="<?php echo get_bloginfo('template_url') ?>" />

    <meta property="twitter:title" content="<?php bloginfo('name'); ?>" />
    <?php if (!WP_DEBUG) { ?>
        <link href="//fonts.googleapis.com/css?family=Montserrat:200,300,300i,600" rel="stylesheet">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <?php } else { ?>
        <script src="<?php echo get_bloginfo('template_url') ?>/node_modules/jquery/dist/jquery.js"></script>
    <?php } ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class( 'layout-column-fill-stretch-forcenowrap'); ?> >
<?php if (!WP_DEBUG) { ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="//googletagmanager.com/ns.html?id=GTM-NHVLSFF"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- Facebook Javascript SDK -->
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<!-- End Facebook Javascript SDK -->
<?php } ?>
<?php if(is_page_template( 'index.php' ) || (basename(__FILE__) == "index.php")){ echo 'noshadow';} ?>
<nav class="layout-row-nowrap-stretch main-menu <?php if ( !is_front_page() && is_home() ) { echo "noshadow";} ?>" id="nav" role="navigation">

    <div class="flex-none menu-logo">
        <a title="<?php bloginfo( 'description' ); ?>" href="<?php echo home_url();?>">
            <img src="<?php echo get_bloginfo('template_url') ?>/build/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" />
        </a>
    </div>
    <span class="flex-grow show-lg hide-sm"></span>

    <?php $args = array(
        'theme_location' => 'PrimaryMenu',
        'menu'            => '',
        'container'       => false,
        'container_id'    => '',
        'menu_class'      => 'menu hide-sm show-lg',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'           => 2,
        'walker'          => ''
        );
        wp_nav_menu( $args );
    ?>
    <div class="flex-none layout-row-forcenowrap-center nav-dull-cta" id="scroll-cta-div">
        <?php
            $row = get_field('nav-cta', 'option');
            foreach ($row as $key => $value) {
                if($value['outline'] == false){
                    $style = 'background:'.$value['color'];
                }
                else{
                    $style = "
                        onMouseOver='this.style.background=\"".$value['color']."\";this.style.color=\"white\"'
                        onMouseOut='this.style.background=\"transparent\";this.style.color=\"".$value['color']."\"'
                        style='
                        background: transparent;
                        border: 1pt solid ".$value['color'].";
                        color:".$value['color'].";
                        '
                    ";
                }
        ?>

        <li class="flex-none show-lg hide-sm">
            <a <?php echo $style; ?> class="button scroll-cta" href="<?php echo $value['url'] ;?>" >
                <?php echo $value['text'] ;?>
            </a>
        </li>

    <?php } ?>
    </div>


    <span class="flex-noshrink hide-lg show-sm"></span>
    <li class="flex-none hide-lg show-sm mobile-menu-toggle">
        <a href="#bottom-sheet" onclick="scrollLock(true)">
            <img src="<?php echo get_bloginfo('template_url') ?>/build/images/hamburguer.svg" alt="<?php bloginfo( 'name' ); ?>" />
        </a>
    </li>
</nav>


<div id="bottom-sheet" class="overlay">
    <aside class="gaveta" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
        <?php
            $args = array(
                'theme_location' => 'PrimaryMenu',
                'menu'            => '',
                'container'       => false,
                'container_id'    => '',
                'menu_class'      => 'menu flex',
                'menu_id'         => '',
                'echo'            => true,
                'fallback_cb'     => 'wp_page_menu',
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth'           => 2,
                'walker'          => ''
                );
            wp_nav_menu( $args );
        ?>
            <a onclick="scrollLock(false)" href="#close" class="btn-close" aria-hidden="true">
                <span class="mdi mdi-close">close</span>
            </a>
    </aside>
</div>


<div id="tetherTarget"></div>
<span class="ghost-nav"></span>
