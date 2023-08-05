<?php
//====================== Ajouter la prise en charge des images mises en avant =========================== //
add_theme_support('post-thumbnails');

//====================== Ajouter automatiquement le titre du site dans l'en-tête du site ================ //
add_theme_support('title-tag');

function style_motaphoto(){
    wp_enqueue_style('fonts','https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
    wp_enqueue_style('style', get_stylesheet_directory_uri() .'/style.css');
    wp_enqueue_style('w3Style',"https://www.w3schools.com/w3css/4/w3.css");
    wp_enqueue_style('styleParent',get_stylesheet_directory_uri() .'./css/styleParent.css');
    
}
add_action('wp_enqueue_scripts', 'style_motaphoto');

//====================== Ajouter le JS  =========================================== //
function my_scripts()
{
    wp_enqueue_script('script', get_stylesheet_directory_uri() . '/js/script.js', array('jquery'), false, true);
}
add_action('wp_enqueue_scripts', 'my_scripts');

//========================   Plusieurs menus à rajouter via Admin Panel ============================== //
function register_my_menus()
{
    register_nav_menus(
        array(
            'main-menu' => __('Main Menu'),
            'footer-menu' => __('Menu Footer'),
        )
    );
}
add_action('init', 'register_my_menus');

//========================  Load more button ================================================= //
function load_more()
{
    $paged = $_POST['paged'];
    $posts_per_page = 4;

    $args = [
        'post_type' => 'photo',
        'posts_per_page' => $posts_per_page,
        'orderby' => 'date',
        'order' => 'ASC',
        'paged' => $paged,
    ];

    if (!empty($_POST['category'])) {
        $args['tax_query'][] = [
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $_POST['category'],
        ];
    }

    if (!empty($_POST['format'])) {
        $args['tax_query'][] = [
            'taxonomy' => 'format',
            'field' => 'slug',
            'terms' => $_POST['format'],
        ];
    }

    if (!empty($_POST['sort'])) {
        $args['order'] = $_POST['sort'];
    }

    $allPhotos = new WP_Query($args);

    if ($allPhotos->have_posts()) {
        $displayedPosts = array(); // Initializing empty array
        while ($allPhotos->have_posts()) {
                $allPhotos->the_post();
                // Checking if post has already been displayed
                if (in_array(get_the_ID(), $displayedPosts)) {
                    continue; // Skip this post
                }

                $permalink = get_the_permalink();
                $pic = get_field('image');

                ?>
                <div class="img">
                    <a href="<?php echo $permalink; ?>">
                        <img src="<?php echo $pic['url']; ?>" alt="image de mariage">
                    </a>
                

                <div class="overlay">
                    <div class="open-fullscreen" rel="">
                        <img rel="<?php echo $pic['url']; ?>" class="fullscreen" src="<?php echo get_template_directory_uri(); ?>/assets/images/fullscreen.svg" alt="Fullscreen">
                    </div>
                    
                    <div class="eye">
                    <a href="<?php echo get_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/picture-eye.svg" alt="Eye"></a>
                    </div>
                    <div class="links">
                        <p><?php echo the_title(); ?></p>
                        <p><?php echo get_field('category'); ?></p>
                    </div>
                </div>
            </div>
            
            <?php
                $displayedPosts[] = get_the_ID(); // Add post ID to array
                // var_dump($displayedPosts) ;
             // fin de for
        } //fin du while
    } else {
        echo '';
    }

    wp_reset_postdata();
    exit;
}

add_action('wp_ajax_load_more', 'load_more');
add_action('wp_ajax_nopriv_load_more', 'load_more');



