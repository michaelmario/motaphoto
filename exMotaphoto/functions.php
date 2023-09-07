<?php
//====================== Ajouter la prise en charge des images mises en avant =========================== //
add_theme_support('post-thumbnails');
add_image_size('large-custom', 1200, 800, true);

//====================== Ajouter automatiquement le titre du site dans l'en-tête du site ================ //
add_theme_support('title-tag');

function style_motaphoto(){ 
    wp_enqueue_style('style', get_stylesheet_directory_uri() .'/style.css');
    wp_enqueue_style('fonts','https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
    wp_enqueue_style('fontsSwap',"https://fonts.googleapis.com/css2?family=Poppins&display=swap");
    wp_enqueue_style('spaceMono',"https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;1,700&display=swap");
    wp_enqueue_style('w3Style',"https://www.w3schools.com/w3css/4/w3.css");
    wp_enqueue_style('child-style',get_stylesheet_directory_uri() .'./css/newStyle.css');
    wp_enqueue_style('parent-style',get_stylesheet_directory_uri() .'./css/styleParent.css');
    wp_enqueue_style('aosStyle',"https://unpkg.com/aos@2.3.1/dist/aos.css");
    }
add_action('wp_enqueue_scripts', 'style_motaphoto');

//====================== Ajouter le JS  =========================================== //
function my_scripts()
{
    wp_enqueue_script('JQUERY','https://code.jquery.com/jquery-3.4.1.min.js',false ,true);
    // wp_enqueue_script('scriptJson', get_stylesheet_directory_uri() . '/js/DataRender.js', array('JQUERY'), false, true);
    wp_enqueue_script('scriptJson', get_stylesheet_directory_uri() . '/js/getData.js', array('JQUERY'), false, true);
    wp_enqueue_script('script', get_stylesheet_directory_uri() . '/js/script.js', array('JQUERY'), false, true);
    wp_enqueue_script('AosScript',"https://unpkg.com/aos@2.3.1/dist/aos.js", true); 
    // wp_localize_script('scriptJson', 'photos_request_load_js', array('ajax_url' => admin_url('admin-ajax.php'))); 
}
add_action('wp_enqueue_scripts', 'my_scripts');

//========================   Plusieurs menus à rajouter via Admin Panel ============================== //
function register_my_menus()
{
    register_nav_menus(
        array(
            'main-menu' => __('Main Menu'),
            'footer-menu' => __('Menu Footer'),
            'mobile-menu' => __('Mobile-Menu'),
        )
    );
}
add_action('init', 'register_my_menus');

// function photos_request_load() {
//     $posts_per_page = 8;
//     $page = 2; 
//     $args = [
//         'post_type' => 'photos',
//         'posts_per_page' => $posts_per_page,
//         'orderby' => 'date',
//         'order' => 'ASC',
//         'paged' => $paged,
//     ];
//    $allPhotos = new WP_Query($args);
//     if($allPhotos->have_posts()) {
//     $response = $allPhotos;
//     } else {
//     $response = false;
//     }
    
//     wp_send_json($response);
//     wp_die();
//     }

// add_action('wp_ajax_photos_request_load', 'photos_request_load');
// add_action('wp_ajax_nopriv_photos_request_load', 'photos_request_load');

// register_taxonomy('photos_category', array('photos'), array(
//     'hierarchical' => true,
//     'labels' => 'name',
//     'singular_label' => 'Categories',
//     'all_items' => 'Category',
//     'query_var' => true,
//     )
// );

// add_action('register_taxonomy', 'photos_category');

?>