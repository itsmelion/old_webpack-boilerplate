<?php

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'Header Settings',
        'menu_title'	=> 'Header',
		'menu_slug' 	=> 'header-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
        'menu_icon'     => 'dashicons-slides'
    ));

    acf_add_options_page(array(
        'page_title' 	=> 'Footer settings',
        'menu_title'	=> 'Footer',
        'menu_slug' 	=> 'footer-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false,
        'menu_icon'     => 'dashicons-welcome-widgets-menus'
    ));

}

/******************************************************************************\
	Theme support, standard settings, menus and widgets
\******************************************************************************/

// add_theme_support( 'post-formats', array( 'image', 'quote', 'status', 'link' ) );
add_theme_support( 'post-thumbnails' );
add_theme_support('menus');
// add_theme_support( 'automatic-feed-links' );
load_theme_textdomain('html5blank', get_template_directory() . '/languages');
// add_theme_support('html5', array('search-form'));

register_nav_menu( 'main-menu', __( 'Your sites main menu', 'menu' ) );

if ( ! isset( $content_width ) ) $content_width = 1024;


function disable_wp_emojicons() {

    // all actions related to emojis
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

    // filter to remove TinyMCE emojis
    add_filter( 'tiny_mce_plugins', 'disable_emojicons_tinymce' );
    add_filter( 'emoji_svg_url', '__return_false' );
}
add_action( 'init', 'disable_wp_emojicons' );

function disable_emojicons_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}

/******************************************************************************\
	Scripts and Styles
\******************************************************************************/

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
    if (!is_admin()) {
        wp_deregister_script( 'jquery' );                                   // Register as 'empty', because we manually insert our script in header.php
        wp_register_script('jquery', '', '', '', true);
    }

    if(is_page('work-abroad') || is_page('apply')){
        //wp_register_script('crm_vendor', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_register_style('crm_css', '//crm.planetexpat.org/assets/css/app.min.css');
        wp_register_script('crm_app','//crm.planetexpat.org/assets/js/app.min.js'); // Conditional script(s)

        wp_enqueue_style('crm_css');
        wp_enqueue_script('crm_app');
    }

    if(is_page('career-coaching')){
        wp_register_style('scheduling_css', '//scheduling.planetexpat.org/public/assets/css/app.css');
        wp_register_script('scheduling_vendor','//scheduling.planetexpat.org/public/assets/js/vendor.js'); // Conditional script(s)
        wp_register_script('scheduling_app','//scheduling.planetexpat.org/public/assets/js/app.js'); // Conditional script(s)
        wp_register_script('scheduling_templates','//scheduling.planetexpat.org/public/assets/js/templates.js'); // Conditional script(s)

        wp_enqueue_style('scheduling_css');
        wp_enqueue_script('scheduling_vendor');
        wp_enqueue_script('scheduling_app');
        wp_enqueue_script('scheduling_templates');
    }

    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        wp_enqueue_style( 'core', get_stylesheet_uri(), array(), '1.0' );
        wp_enqueue_style( 'extras', get_template_directory_uri().'/extras.css');

        wp_register_script('vendors', get_template_directory_uri() . '/build/scripts/vendors.js', array(), '1.0.0', true);
        // wp_register_script('jquery-ui', '//code.jquery.com/ui/1.12.1/jquery-ui.min.js', false, '1.12.1', true);
        wp_register_script('app', get_template_directory_uri() . '/build/scripts/app.js', array(), '1.0.0', true);
        wp_register_script('lazy', get_template_directory_uri() . '/build/scripts/lazy.js', array(), '1.0.0', true);
        // Enqueue Scripts
        wp_enqueue_script('vendors');
        // wp_enqueue_script('jquery-ui');
        wp_enqueue_script('app');
        wp_enqueue_script('lazy');
    }
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts()
{

}

/******************************************************************************\
	Content functions
\******************************************************************************/

/**
 * Displays meta information for a post
 * @return void
 */
function my_post_meta() {
	if ( get_post_type() == 'post' ) {
		echo sprintf(
			__( 'Posted %s in %s%s by %s. ', 'admin' ),
			get_the_time( get_option( 'date_format' ) ),
			get_the_category_list( ', ' ),
			get_the_tag_list( __( ', <b>Tags</b>: ', 'admin' ), ', ' ),
			get_the_author_link()
		);
	}
	edit_post_link( __( ' (edit)', 'admin' ), '<span class="edit-link">', '</span>' );
}


// HTML5 Blank navigation
function html5blank_nav()
{
    wp_nav_menu(
    array(
        'theme_location'  => 'header-menu',
        'menu'            => '',
        'container'       => false,
        'container_class' => 'menu-{menu slug}-container',
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
        'depth'           => 1,
        'walker'          => ''
        )
    );
}


function register_my_menus() {
    register_nav_menus(
      array(
        'PrimaryMenu' => __( 'Main Menu' ),
        'CategoryMenu' => __( 'Blog Menu' ),
        'an-extra-menu' => __( 'An Extra Menu' )
      )
    );
  }
  add_action( 'init', 'register_my_menus' );

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $defaults = array( 'menu' => '', 'container' => false, 'container_class' => '', 'container_id' => '', 'menu_class' => 'menu', 'menu_id' => '',
    'echo' => true, 'fallback_cb' => 'wp_page_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', 'item_spacing' => 'preserve',
    'depth' => 0, 'walker' => '', 'theme_location' => '' );
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Remove the width and height attributes from inserted images
function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}


// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Blog Post', 'html5blank'),
        'description' => __('Widget column that displays on Single Posts page', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Home Blog', 'html5blank'),
        'description' => __('Widget column that displays on ALL Posts list', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    register_sidebar(array(
        'name' => __('Footer Widgets', 'html5blank'),
        'description' => __('a wide Widget row that displays on Single Posts page before footer', 'html5blank'),
        'id' => 'widget-area-3',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;

    if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
        remove_action('wp_head', array(
            $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
            'recent_comments_style'
        ));
    }
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes) {
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }
    return $classes;
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function get_excerpt($limit, $source = null){
    $source = preg_replace(" (\[.*?\])",'',$source);
    $source = strip_shortcodes($source);
    $source = substr($source, 0, strripos($source, " "));
    $source = substr($source, 0, $limit);
    $source = strip_tags($source);
    // $source = trim(preg_replace( '/\s+/', ' ', $source));
    $source = $source.'...';
    return $source;
}
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return ' ... ';
    // <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}


/*------------------------------------*\
    Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
// add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
// add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
// add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_header_scripts'); // Add Theme Stylesheet
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
// add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'post_destinations');

add_action('init', 'post_pricing');
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
// add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// add_action( 'init', 'my_new_default_post_type', 1 );
// function my_new_default_post_type() {

//     register_post_type( 'post', array(
//         'rewrite' => array( 'slug' => 'blog' ),
//         'labels' => array(
//             'name' => __('Posts', 'html5blank'), // Rename these to suit
//             'singular_name' => __('Post', 'html5blank'),
//             'add_new' => __('New Post', 'html5blank'),
//             'add_new_item' => __('Add Post', 'html5blank'),
//             'edit' => __('Edit Posts', 'html5blank'),
//             'edit_item' => __('Edit Posts', 'html5blank'),
//             'new_item' => __('New Posts', 'html5blank'),
//             'view' => __('See Posts', 'html5blank'),
//             'view_item' => __('See Post', 'html5blank'),
//             'search_items' => __('Find more Posts', 'html5blank'),
//             'not_found' => __('We have no Posts to display by now..', 'html5blank'),
//             'not_found_in_trash' => __('No Posts wasted! :)', 'html5blank')
//         ),
//         'public' => true,
//         'publicly_queryable'  => true,
//         'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
//         'has_archive' => true,
//         'supports' => array(
//             'title',
//             'editor',
//             'thumbnail'
//         ), // Go to Dashboard Custom HTML5 Blank post for supports
//         'can_export' => true, // Allows export in Tools > Export
//         'taxonomies' => array(
//             'post_tag',
//             'category'
//         ) // Add Category and Post Tags support
//     ) );
// };

// Remove Actions
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links
remove_action('wp_head', 'index_rel_link'); // remove link to index page
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'wp_generator'); // remove wordpress version
remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );


// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('post_thumbnail_html', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images
add_filter('image_send_to_editor', 'remove_width_attribute', 10 ); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
// add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
// add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
    Custom Post Types
\*------------------------------------*/

function post_destinations()
{
    register_taxonomy_for_object_type('category', 'destinations'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'destinations');
    register_post_type('destinations', // Register Custom Post Type
        array(
        'rewrite' => array('slug' => 'destinations', 'with_front' => false),
        'labels' => array(
            'name' => __('Destinations', 'html5blank'), // Rename these to suit
            'singular_name' => __('Destination', 'html5blank'),
            'add_new' => __('New destination', 'html5blank'),
            'add_new_item' => __('Add destination', 'html5blank'),
            'edit' => __('Edit destination', 'html5blank'),
            'edit_item' => __('Edit destination', 'html5blank'),
            'new_item' => __('New destination', 'html5blank'),
            'view' => __('See destinations', 'html5blank'),
            'view_item' => __('See destination', 'html5blank'),
            'search_items' => __('Find more destinations', 'html5blank'),
            'not_found' => __('We have no destinations to display by now..', 'html5blank'),
            'not_found_in_trash' => __('No destinations wasted! :)', 'html5blank')
        ),
        'public' => true,
        'publicly_queryable'  => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => false,
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'menu_icon'   => 'dashicons-location-alt',
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}
function destinations_cat( $post_ID ) {
    $post_type = 'destinations';
    $cat_id = 124; // Your reviews category id (for example: 123)
    $post_categories=array($cat_id);

    // check if current post type is movie review
    if(get_post_type($post_ID)==$post_type) {
        // assign a category for this post by default
        wp_set_post_categories( $post_ID, $post_categories );
    }

   return $post_ID;
}
add_action( 'publish_post', 'destinations_cat' );

function post_pricing()
{
    register_taxonomy_for_object_type('category', 'pricing'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'pricing');
    register_post_type('pricing', // Register Custom Post Type
        array(
        'rewrite' => array('with_front' => false),
        'labels' => array(
            'name' => __('Pricings', 'html5blank'), // Rename these to suit
            'singular_name' => __('Pricing', 'html5blank'),
            'add_new' => __('New Plan', 'html5blank'),
            'add_new_item' => __('New plan', 'html5blank'),
            'edit' => __('Edit Plan', 'html5blank'),
            'edit_item' => __('Edit plan', 'html5blank'),
            'new_item' => __('New plan', 'html5blank'),
            'view' => __('See plan', 'html5blank'),
            'view_item' => __('See plan', 'html5blank'),
            'search_items' => __('Find plans', 'html5blank'),
            'not_found' => __('There is no plan found', 'html5blank'),
            'not_found_in_trash' => __('No deleted plan', 'html5blank')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => false,
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'menu_icon'   => 'dashicons-tag',
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}
function pricing_cat( $post_ID ) {
    $post_type = 'pricing';
    $cat_id = 122; // Your reviews category id (for example: 123)
    $post_categories=array($cat_id);

    // check if current post type is movie review
    if(get_post_type($post_ID)==$post_type) {
        // assign a category for this post by default
        wp_set_post_categories( $post_ID, $post_categories );
    }

   return $post_ID;
}
add_action( 'publish_post', 'pricing_cat' );

/* Add External Sitemap to Yoast Sitemap Index
 * Credit: Paul https://wordpress.org/support/users/paulmighty/
 * Last Tested: Aug 25 2017 using Yoast SEO 5.3.2 on WordPress 4.8.1
 *********
 * This code adds two external sitemaps and must be modified before using.
 * Replace http://www.example.com/external-sitemap-#.xml
   with your external sitemap URL.
 * Replace 2017-05-22T23:12:27+00:00
   with the time and date your external sitemap was last updated.
   Format: yyyy-MM-dd'T'HH:mm:ssZ
 * If you have more/less sitemaps, add/remove the additional section.
 *********
 * Please note that changes will be applied upon next sitemap update.
 * To manually refresh the sitemap, please disable and enable the sitemaps.
 */
add_filter( 'wpseo_sitemap_index', 'add_sitemap_custom_items' );
function add_sitemap_custom_items() {
   $sitemap_custom_items = '
<sitemap>
<loc>https://planetexpat.org/sitemap_offers.xml</loc>
<lastmod>'.date('Y-m-d\TH:i:sP').'</lastmod>
</sitemap>';

/* Add Additional Sitemap
 * This section can be removed or reused as needed
 */
  $sitemap_custom_items .= '
<sitemap>
<loc>https://planetexpat.org/sitemap_locations.xml</loc>
<lastmod>'.date('Y-m-d\TH:i:sP').'</lastmod>
</sitemap>';
/* DO NOT REMOVE ANYTHING BELOW THIS LINE
 * Send the information to Yoast SEO
 */
return $sitemap_custom_items;
}

function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display', 19 );
    remove_filter( 'the_excerpt', 'sharing_display', 19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }
}

add_action( 'loop_start', 'jptweak_remove_share' );
