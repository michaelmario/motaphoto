<?php
  $terms_pic_category = get_terms(array(
    'taxonomy' => 'categories',
    'hide_empty' => true,
));

$terms_pic_formats = get_terms(array(
    'taxonomy' => 'Formats',
    'hide_empty' => true,
));

    $args = array(
        'post_type' => 'photos',
        'orderby' => 'date',
        'order' => 'ASC',
        'posts_per_page' =>12, // je determine la limite d'affichage ici. Pour afficher tout : -1
        'paged' =>1,
    );
     // my custom query
        $allPhotos = new WP_Query($args);
         //var_dump($allPhotos->the_title());
        
    ?>
    <div class="mainContainer">
        <section>
            <div class="w3-container w3-margin-bottom w3-center" id="sectionSelect">
                <div class="w3-row">
                    <div class="w3-third w3-section">
                        <form id="filter-cat" class="js-filter-form" method="GET">
                            <select name="categories" id="categories-select" class="filters_text letters-transform">
                                <option value="">Catégories</option>                                
                                <?php
                                  $terms_pic_categorie = get_terms('categorie');
                                  foreach ($terms_pic_categorie as  $termCategorie) { ?>                    
                                 <option data-filter="<?php echo $termCategorie->slug; ?>"><?php echo $termCategorie->slug; ?></option>
                                 <?php }                      
                                  ?>
                                  </select>
                            <!-- </div> -->
                        </form>
                    </div>


                    <div class="w3-third w3-section">
                        <form id="filter-formats">
                            <select name="format" id="filter-select" class="filters_text letters-transform">
                                <option value="">Formats</option>
                                <?php
                                  $terms_pic_formats = get_terms('format');
                                  foreach ($terms_pic_formats as  $termFormat) { ?>                    
                                  <option value="<?php  echo $termFormat->slug; ?>"><?php echo $termFormat->name; ?></option>
                                <?php }  ?>
                            </select>
                            <!-- </div> -->
                        </form>
                    </div>
                    <div class="w3-third w3-section">
                        <form id="filter-date">
                            <div class="filter-3">
                                <select name="sort" id="sort-dates" class="filters_text">
                                    <option value="">Trier par</option>
                                    <option value="DESC">Nouveautés</option>
                                    <option value="ASC">Les plus anciens</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
         <section class="display-photo">
         <?php  $posts_per_page = 12;
              $page = 1; 
              $args = array(
        'post_type' => 'photos',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' =>$posts_per_page, // je determine la limite d'affichage ici. Pour afficher tout : -1
        'paged' =>$page,
    );
    
     $allPhotos = new WP_Query($args);        
    ?>
            <?php if ($allPhotos->have_posts()) : ?>
            <div class="photo-grid">
                <?php while ($allPhotos->have_posts()) : $allPhotos->the_post();?>                               
                <div class="img">
                    <!-- Parcourir le tableau des images -->
                    <?php $imgs = get_field('image'); ?>
                    <img src="<?php echo $imgs; ?>" alt="<?php the_title() ?>" class="realImg" data-type="<?php echo $post->ID; ?>">
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
                <?php endwhile; ?>
            </div>
            <?php if ($allPhotos->max_num_pages >1) { ?>
               <div class="w3-container buttonContainer">
                <button class="w3-btn w3-gray" id="load-more">Charger plus</button>
               </div>   
              <?php  }?>
            
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </section>

    </div>
    </div>
    
   