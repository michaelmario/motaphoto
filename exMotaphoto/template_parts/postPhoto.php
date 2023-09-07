<div class="mainContainer">
        <section>
            <div class="w3-container w3-margin-bottom w3-center">
                <div class="w3-row">
                    <div class="w3-third w3-section">
                    <form id="filter-cat" class="js-filter-form" method="GET">
                            <select name="categories" id="categories-select" class="w3-select w3-padding letters-transform w3-border">
                                <option class="w3-margin" value="">Catégories</option>
                                 <?php
                                  $terms_pic_categorie = get_terms('categorie');
                                  foreach ($terms_pic_categorie as  $termCategorie) { ?>
                    
                                 <option class="w3-margin" data-filter="<?php echo $termCategorie->slug; ?>"><?php echo $termCategorie->name; ?></option>
                                 <?php }                      
                                  ?>
                                  </select>
                            <!-- </div> -->
                        </form>
                    </div>

                    <div class="w3-third w3-section">
                    <form id="filter-formats" method="GET">
                            <select name="format" id="filter-select" class="w3-select w3-padding letters-transform w3-border">
                                <option class="w3-margin" value="">Formats</option>
                                <?php
                                  $terms_pic_formats = get_terms('format');
                                  foreach ($terms_pic_formats as  $termFormat) { ?>                    
                                  <option class="w3-margin" data-filter="<?php  echo $termFormat->slug; ?>"><?php echo $termFormat->name; ?></option>
                                <?php }  ?>
                            </select>
                            <!-- </div> -->
                        </form>
                    </div>
                    <div class="w3-third w3-section">
                        <form id="filter-date" method="GET">
                            <div class="filter-3">
                                <select name="sort" id="sort-dates" class="w3-select w3-padding letters-transform w3-border">
                                    <option class="w3-margin" value="">Trier par</option>
                                    <option class="w3-margin" value="date">Nouveautés</option>
                                    <option class="w3-margin" value="DESC">Les plus anciens</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="w3-container">
            <div class="image-container">                
                <div class="display-photo">
              <?php  $posts_per_page = 12;
              $page = 1; 
    $args = array(
        'post_type' => 'photos',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' =>$posts_per_page, // je determine la limite d'affichage ici. Pour afficher tout : -1
        'paged' =>$page,
    );
     // my custom query
        $allPhotos = new WP_Query($args);
         //var_dump($allPhotos->the_title());
        ?>          
                    <div class="photo-grid">
                        <?php while ($allPhotos->have_posts()) : $allPhotos->the_post();
                                //   var_dump($post);                 
                            ?> 
                        
                        <div class="img"  dataset-request='<?php echo  $post->ID; ?>'>
                            <!-- Parcourir le tableau des images -->

                            <a href="<?php echo get_permalink(); ?>">
                                <img src="<?php the_post_thumbnail_url() ?>" alt="<?php the_title() ?>">
                            </a>


                            <div class="overlay">
                                <div class="open-fullscreen" rel="<?php echo get_field('image'); ?>">
                                    <img rel="<?php echo get_field('image'); ?>" class="fullscreen"
                                        src="<?php echo get_template_directory_uri(); ?>/assets/images/images/fullscreen.svg"
                                        alt="Fullscreen">
                                </div>

                                <div class="eye">
                                    <a href="<?php echo get_permalink(); ?>">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/images/picture-eye.svg"
                                            alt="Eye"></a>
                                </div>
                                <div class="infos">
                                    <p><?php echo the_title(); ?></p>
                                    <p><?php echo get_field('categorie'); ?></p>
                                </div>
                            </div>
                        </div>
                      
                       
                        <?php endwhile; ?>
                    </div>
                    <button id="load-more">Charger plus</button>
                   
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </section>