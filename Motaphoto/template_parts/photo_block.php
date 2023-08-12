<?php
function load_more()
{
$paged = $_POST['paged'];
    $posts_per_page = 4;

    $args = [
        'post_type' => 'photos',
        'posts_per_page' => $posts_per_page,
        'orderby' => 'date',
        'order' => 'ASC',
        'paged' => $paged,
    ];

    if (!empty($_POST['categorie'])) {
        $args['tax_query'][] = [
            'taxonomy' => 'categorie',
            'field' => 'slug',
            'terms' => $_POST['categorie'],
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
                        <img src="<?php echo $pic; ?>" alt="image de mariage">
                    </a>
                

                <div class="overlay">
                    <div class="open-fullscreen" rel="">
                        <img rel="<?php echo get_field('image'); ?>" class="fullscreen" src="<?php echo get_template_directory_uri(); ?>/assets/images/images/fullscreen.svg" alt="Fullscreen">
                    </div>
                    
                    <div class="eye">
                    <a href="<?php echo get_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/images/picture-eye.svg" alt="Eye"></a>
                    </div>
                    <div class="links">
                        <p><?php echo the_title(); ?></p>
                        <p><?php echo get_field('categorie'); ?></p>
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

?>
