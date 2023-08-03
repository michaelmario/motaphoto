<!-- 
    Fichier qui détermine la mise en forme des posts individuels.
    Template dédiée à l’affichage d’un seul Post.
-->
<?php get_header(); ?>

<?php while (have_posts()) : the_post() ?>
    <?php
    global $wp_query;
    ?>
    <div class="page-container">

    <!-- section du haut -->
    <section class="main-content">
        <div class="content-body">
            <div class="title-type">
                <p class="pic-title"><?php echo get_the_title() ?></p>
                <p>Référence : <span class="ref-val"><?php echo get_field('reference'); ?></span></p>
                <p>Catégorie : <?php echo get_field('category'); ?></p>
                <p>Format : <?php echo get_field('format'); ?></p>
                <p>Type : <?php echo get_field('type'); ?></p>
                <p>Année : <?php echo get_the_date('Y'); ?></p>
            </div>

            <div class="photo-container">
                <img src="<?php
                            $pic = get_field('image');
                            echo $pic['url'];
                            ?>" alt="image de marriage">
            </div>
        </div>
    </section>

    <!-- section middle -->
    <section class="contact-carrousel">
        <div class="contact-btn">
            <h4>Cette photo vous intéresse ?</h4>
            <button id="contact-filled">Contact</button>
        </div>
        <?php
        // initializing variables
        $next_item = get_next_post();
        $previous_item = get_previous_post();
                
        $next_image = get_the_post_thumbnail($next_item->ID);
        $previous_image = get_the_post_thumbnail($previous_item->ID);
                
        $permalink_next = get_the_permalink($next_item->ID);
        $permalink_prev = get_the_permalink($previous_item->ID);
        ?>
        <div class="photo-navigation">
            <div class="image">
                <?php 
                echo $next_image; 
                ?>
            </div>

            <div class="arrows">
                
                <?php if(!empty($previous_item)){
                    $previous_image = get_the_post_thumbnail($previous_item->ID);
                    $permalink_prev = get_the_permalink($previous_item->ID);
                    ?>
                    <a href="<?php echo $permalink_prev; ?>"><img src="<?php echo get_template_directory_uri() . '/assets/images/larr.svg' ?>" alt="fleche gauche"></a>

                <?php
                } 
                ?>
                <!-- right / next -->
                <?php if(!empty($next_item)){
                    $next_image = get_the_post_thumbnail($next_item->ID);
                    $permalink_next = get_the_permalink($next_item->ID);
                    ?>
                    <a href="<?php echo $permalink_next; ?>"><img id="right-arrow" src="<?php echo get_template_directory_uri() . '/assets/images/rarr.svg' ?>" alt="fleche droite"></a>

                <?php
                } 
                ?>

            </div>
        </div>
    </section>

    <!-- section bas -->
    <section class="suggested-photo-container">
        <h3 class="text-in-upper-case">Vous aimerez AUSSI</h3>

        <div class="photo-suggestions">
            <!-- recuperer les photos -->
            <?php
            $category = get_field('category');
            $current_post_id = get_the_ID();
            // var_dump($current_post);
            // var_dump($category);
            $args = array(
                'post_type' => 'photo',
                'meta_key' => 'category',
                'meta_value' => $category,
                'posts_per_page' => 2, // afficher tous les images : -1 || afficher que 2 (selon la demande technique)
                'paged' => 1,
                'post__not_in'=> array($current_post_id)
            );
            // lancement de query
            $suggestionPhoto = new WP_Query($args);
            // var_dump($suggestionPhoto);
            ?>

            <!-- Loop -->
            <?php if ($suggestionPhoto->have_posts()) : ?>
                <?php while ($suggestionPhoto->have_posts()) : $suggestionPhoto->the_post(); ?>
                    <div class="pic-suggested">
                        <img src="<?php
                                    $img = get_field('image');
                                    echo $img['url'];
                                    ?>" alt="">
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>

        </div>
        <?php $archivePage = get_post_type_archive_link( 'photo' ); ?>
        <div class="link-to-all-pics">
            <a id="load-all-photos" href="<?php echo get_site_url(); ?>">Toutes les photos</a>
        </div>

    </section>

    <!-- section ZONE DES TESTS  -->
    
    <?php
    // $archivePage = get_post_type_archive_link( 'photo' );
    // var_dump($archivePage);
    ?>
    </div>
    <!-- section ZONE DES TESTS  -->
    
<?php endwhile ?>
<?php get_footer(); ?>