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
    wp_enqueue_script('scriptJson', get_stylesheet_directory_uri() . '/js/getData.js', array('JQUERY'), false, true);
    wp_enqueue_script('script', get_stylesheet_directory_uri() . '/js/script.js', array('JQUERY'), false, true);
    wp_enqueue_script('AosScript',"https://unpkg.com/aos@2.3.1/dist/aos.js", true);
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


add_action('wp_ajax_load_more', 'load_more');
add_action('wp_ajax_nopriv_load_more', 'load_more');



