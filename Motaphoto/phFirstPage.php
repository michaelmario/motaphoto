<?php
/*
Template Name: Custom Page
*/

get_header();// Include the header
?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post() ?>
<div class="W3-container">
    <!-- La partie photo en bg + title de hero header >
    <div class="hero-header">
         <h1 class="hero-title"><php the_title(); ?></h1>
    </div>-->
    <!----------------------------------------------------------------- ici je rajoute la partie filtres ------------------------------------------->

    <!-- declaring variables and get_terms() for each filter -->
   <?php
    $args = array(
        'post_type' => 'photos',
        'orderby' => 'date',
        'order' => 'ASC',
        'posts_per_page' => 12, // je determine la limite d'affichage ici. Pour afficher tout : -1
        'paged' => 1,
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
                        <form id="filter-cat" class="js-filter-form">
                            <!-- <div class="filter-cat"> -->
                            <label for="category" class="letters-transform ">Catégories</label>
                            <select name="categories" id="categories-select" class="filters_text">
                                <option></option>
                                <option value="">Toutes les photos</option>
                                <?php
                                  $terms_pic_categorie = get_terms('categorie');
                                  foreach ($terms_pic_categorie as  $termCategorie) { ?>
                    
                                 <option value="<?php echo $termCategorie->slug; ?>"><?php echo $termCategorie->slug; ?></option>
                                 <?php }                      
                                  ?>
                                  </select>
                            <!-- </div> -->
                        </form>
                    </div>


                    <div class="w3-third w3-section">
                        <form id="filter-formats">
                            <label for="formats" class="letters-transform">Formats</label>
                            <select name="format" id="filter-select" class="filters_text">
                                <option></option>
                                <option value="">Toutes les photos</option>
                                <?php
                                  $terms_pic_formats = get_terms('format');
                                  foreach ($terms_pic_formats as  $termFormat) { ?>
                    
                        <option value="<?php  echo $termFormat->slug; ?>"><?php echo $termFormat->name; ?></option>
                      <?php }                      
                    ?>
                            </select>
                            <!-- </div> -->
                        </form>
                    </div>
                    <div class="w3-third w3-section">
                        <form id="filter-date">
                            <div class="filter-3">
                                <label for="sort-by" class="letters-transform">Trier par</label>
                                <select name="sort" id="sort-dates" class="filters_text">
                                    <option value=""></option>
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
            <?php if ($allPhotos->have_posts()) : ?>
            <div class="photo-grid">
                <?php while ($allPhotos->have_posts()) : $allPhotos->the_post(); ?>
                <div class="img">
                    <!-- Parcourir le tableau des images -->
                    <?php
                            $imgs = get_field('image'); ?>
                    <img src="<?php echo $imgs; ?>" alt="image de marriage">
                    <div class="overlay">
                    <div class="open-fullscreen" dataset-link="<?php echo $imgs; ?>">
                        <img rel="<?php echo $imgs; ?>" class="fullscreen" src="<?php echo get_template_directory_uri(); ?>/assets/images/images/fullscreen.svg" alt="Fullscreen">
                    </div>
                    
                    <div class="eye">
                    <a href="<?php echo get_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/images/picture-eye.svg" alt="Eye"></a>
                    </div>
                    <div class="links">
                        <p class="titleName"><?php echo the_title(); ?></p>
                        <p class="categorie"><?php echo get_field('categorie'); ?></p>
                    </div>
                  </div>
                </div>
                <?php endwhile; ?>
            </div>
            <div class="w3-container buttonContainer">
                <button class="w3-btn w3-gray" id="load-more">Charger plus</button>
            </div>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </section>

    </div>
    </div>
    <?php endwhile; ?>
    <?php endif; ?>
    <?php get_footer(); ?>