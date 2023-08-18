<!-- 
    Fichier qui détermine la mise en forme des posts individuels.
    Template dédiée à l’affichage d’un seul Post.
-->
<?php get_header(); ?>

<?php while (have_posts()) : the_post() ?>
<?php
    global $wp_query;
    
    ?>
<div class="w3-container w3-margin-top page-container">
    <!-- section du haut -->
    <section class="w3-row">
        <div class="w3-half">
            <div class="title-type">
                <h2 class="pic-title"><?php echo get_the_title() ?></h2>
                <p>Référence : <span class="ref-val"><?php echo get_field('reference'); ?></span></p>
                <p>Catégorie : <?php echo get_field('categorie'); ?></p>
                <p>Format : <?php echo get_field('format'); ?></p>
                <p>Type : <?php echo get_field('type'); ?></p>
                <p>Année : <?php echo get_the_date('Y'); ?></p>
            </div>
        </div>
        <div class="w3-half">
            <div class="image_single_container">
            <img src="<?php echo get_field('image'); ?>" alt="<?php echo get_the_title() ?>" class="w3-image">
                    </div>
    </section>

    <!-- section middle -->
    <section class="w3-container w3-border-top w3-border-bottom">
        <div class="w3-col m4">
            <h4>Cette photo vous intéresse ?</h4>
        </div>
        <div class="w3-col m4 ">
            <div class="contact-btn w3-margin-top">
                <button class="w3-button w3-gray" id="contact-filled">Contact</button>
            </div>
        </div>
        <?php
        // initializing variables         
        $next_item = get_next_post();
        $previous_item = get_previous_post();     
        ?>
        <div class="w3-col m4">
            <div class="photo-navigation">
                <div class="image">
                   <?php                 
                   if($next_item){
                     $next_image = get_the_post_thumbnail($previous_item->ID);
                     echo $next_image; 
                   } 
                    try{
                    if($previous_item){
                    $previous_image = get_the_post_thumbnail($next_item);
                     echo $previous_image; 
                   }else if(!$previous_item){
                    echo 'image not found';
                   }
                   }catch (Exception $e) {
                    // Handle file not found exception
                    echo "File not found: " . $e->getMessage();

                   }             
                     ?>
                </div>

                <div class="arrows">

                    <?php if(!empty($previous_item)){
                    $previous_image = get_the_post_thumbnail($previous_item->ID);
                    $permalink_prev = get_the_permalink($previous_item->ID);
                    ?>
                    <a href="<?php echo $permalink_prev; ?>"><img
                            src="<?php echo get_template_directory_uri() . '/assets/images/images/larr.svg' ?>"
                            alt="fleche gauche"></a>

                    <?php
                }
           
                ?>
                    <!-- right / next -->
                    <?php if(!empty($next_item)){
                    $next_image = get_the_post_thumbnail($next_item->ID);
                    $permalink_next = get_the_permalink($next_item->ID);
                    ?>
                    <a href="<?php echo $permalink_next; ?>"><img id="right-arrow"
                            src="<?php echo get_template_directory_uri() . '/assets/images/images/rarr.svg' ?>"
                            alt="fleche droite"></a>

                    <?php
                } 
            
                ?>
                </div>
            </div>
        </div>
</section>

<!-- section bas -->
<section class="suggested-photo-container">
        <h3 class="text-in-upper-case">Vous aimerez AUSSI</h3>

        <div class="photo-suggestions">
            <!-- recuperer les photos -->
            <?php
            $category = get_field('categorie');
            $current_post_id = get_the_ID();
             //var_dump($current_post_id);
            // var_dump($category);
            $superargs = array(
                'post_type' => 'photos',
                //'meta_key' => 'category',
                'meta_value' => $category,
                'posts_per_page' => 2, // afficher tous les images : -1 || afficher que 2 (selon la demande technique)
                'paged' => 1,
                'post__not_in'=> array($current_post_id)
            );
            // lancement de query
            $suggestionPhoto = new WP_Query($superargs);           
            ?>
              
            <!-- Loop --><div class="w3-row">
            <?php if ($suggestionPhoto->have_posts()) : ?>
                <?php while ($suggestionPhoto->have_posts()) : $suggestionPhoto->the_post(); ?>
                  <div class="w3-half">   
                  <div class="pic-suggested">
                    <img src="<?php
                                    $img = get_field('image');
                                    echo $img;
                                    ?>" alt="">
                        
            </div>  
                </div>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>

        </div>
        <?php $archivePage = get_post_type_archive_link( 'photo' ); ?>
        <div class="w3-margin w3-center">
            <a id="load-all-photos" class="w3-button w3-gray" href="<?php echo get_site_url(); ?>">Toutes les photos</a>
        </div>

    </section>    
    </div>
    
</div>


<?php endwhile ?>
<?php get_footer(); ?>