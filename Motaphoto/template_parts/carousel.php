<?php
$args = array(
    'post_type' => 'photos',
    'posts_per_page'=>'15'
     );
$allPhotos = new WP_Query($args);

    if ($allPhotos->have_posts()) {
        $displayedPosts = array(); // Initializing empty array
        while ($allPhotos->have_posts()) {
                $allPhotos->the_post();
                // Checking if post has already been displayed
                if (in_array(get_the_ID(), $displayedPosts)) {
                    continue; // Skip this post
                }
               
                  $pic = get_field('image'); 
               ?>

            <div class="container  mySlides">
              <img src="<?php echo $pic; ?>" class="imgSlide">
              <h1 class="hero-title"><?php the_title() ?></h1>          
           </div>
           <?php
              $displayedPosts[] = get_the_ID(); // Add post ID to array              
        } 
         
      
    } 
  
?>