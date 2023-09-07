<?php
//====================== Ajouter la prise en charge des images mises en avant =========================== //

function custom_featured_image_action() {
    if (has_post_thumbnail()) {
        $featured_image = get_the_post_thumbnail();
        echo '<div class="custom-featured-image">' . $featured_image . '</div>';
    }
}
add_action('custom_featured_image', 'custom_featured_image_action');


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
   wp_enqueue_script('script', get_stylesheet_directory_uri() . '/js/script.js', array('JQUERY'), '3.4.1', true);
//    wp_enqueue_script('scriptJson', get_stylesheet_directory_uri() . '/js/getData.js', array('JQUERY'), '3.4.1', true);
   wp_enqueue_script('AosScript',"https://unpkg.com/aos@2.3.1/dist/aos.js", true);
   wp_enqueue_script('loadMore', get_stylesheet_directory_uri() . '/js/loadMore.js', array('JQUERY'), '3.4.1', true);
   wp_localize_script('loadMore', 'loadMore_js', array('ajax_url' => admin_url('admin-ajax.php')));

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

//========================  Load more button ================================================= //

function filter_projects() {
    $paged = $_POST['paged'];
    $posts_per_page = 4;

    
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
  $catSlug = $_POST['category'];
$ajaxposts = new WP_Query([
      'post_type' => 'photos',
       'posts_per_page' => $posts_per_page,
       'category_name' => $catSlug,
       'orderby' => 'date',
        'order' => 'ASC',
        'paged' => $paged,
    ]);
    
    $response = '';
  
    if($ajaxposts->have_posts()) {
      while($ajaxposts->have_posts()) : $ajaxposts->the_post(); 
      ?>
            <div class="img">
                    <!-- Parcourir le tableau des images -->
                    <?php $imgs = get_field('image'); ?>
                    <img src="<?php echo $imgs; ?>" alt="image de marriage">
                    <div class="overlay">
                    <div class="open-fullscreen" rel="<?php echo $imgs; ?>">
                        <img rel="<?php echo $imgs; ?>" class="fullscreen" src="http://motaphoto.local/wp-content/uploads/2023/08/fullscreen.png" alt="Fullscreen">
                    </div>                     
                    <div class="eye">
                    <a href="<?php echo get_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/images/picture-eye.svg" alt="Eye"></a>
                    </div>
                    <div class="links">
                        <p class="ref-val"><?php echo get_field('reference'); ?></p>
                        <p class="titleName"><?php echo the_title(); ?></p>
                        <p class="categorie"><?php echo get_field('categorie'); ?></p>
                    </div>
                  </div>
                </div>
      
    <?php  endwhile;
    } else {
      $response = 'empty';
    }
  
    echo $response;
    exit;
  }
  add_action('wp_ajax_filter_projects', 'filter_projects');
  add_action('wp_ajax_nopriv_filter_projects', 'filter_projects');

