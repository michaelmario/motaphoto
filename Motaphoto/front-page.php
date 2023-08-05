<?php get_header();

?><?php
$terms_pic_category = get_terms(array(
    'taxonomy' => 'categories',
    'hide_empty' => true,
));

$terms_pic_formats = get_terms(array(
    'taxonomy' => 'formats',
    'hide_empty' => true,
));

$args = array(
    'post_type' => 'photos',
    'orderby' => 'date',
    'order' => 'ASC',
    'posts_per_page' => 4, // je determine la limite d'affichage ici. Pour afficher tout : -1
    'paged' => 1,
);
?>
<div class="W3-container">
    <!-- La partie photo en bg + title de hero header -->
    <div class="hero-header">
        <h1 class="hero-title">PHOTOGRAPH EVENT</h1>
    </div>
    <div class="mainContainer">
        <div class="SelectContainer">
            <div class="w3-row">
                <div class="w3-third w3-section">
                    <form id="filter-cat" class="js-filter-form w3-center">
                        <select class="w3-select w3-border" name="option" name="categories" id="categories-select">
                            <option class="letters-transform">CATEGORIES</option>
                            <option value="">Toutes les photos</option>
                            <?php
                    if (!empty($terms_pic_category) && !is_wp_error($terms_pic_category)) {
                        foreach ($terms_pic_category as $individual_pic_cat) {
                            $option_value = $individual_pic_cat->slug;
                            $option_name = $individual_pic_cat->name;
                            echo '<option value="' . $option_value . '">' . $option_name . '</option>';
                        }
                    }
                    ?>
                        </select>
                        
                    </form>
                </div>
                <div class="w3-third w3-section">
                    <form id="filter-formats" class="w3-center">
                        <select name="format" id="filter-select" class="w3-select w3-border">
                            <option class="letters-transform">FORMATS</option>
                            <option value="">Toutes les photos</option>
                            <?php
                    if (!empty($terms_pic_formats) && !is_wp_error($terms_pic_formats)) {
                        foreach ($terms_pic_formats as $pic_format) {
                            $format_option_value = $pic_format->slug;
                            $format_option_name = $pic_format->name;
                            echo '<option value="' . $format_option_value . '">' . $format_option_name . '</option>';
                        }
                    }
                    ?>
                        </select>
                    </form>
                </div>
                <div class="w3-third w3-section ">
                <form id="filter-date" class="w3-right">
            <div class="filter-3">
                <select name="sort" id="sort-dates" class="w3-select w3-border">
                    <option class="letters-transform">Trier par</option>
                    <option value="DESC">Nouveautés</option>
                    <option value="ASC">Les plus anciens</option>
                </select>
            </div>
        </form>
                  </div>
            </div>
            <div class="w3-row PhotoDisplay">
                <?php 
                     
                     
                     $allphotos = new WP_Query($args);
                      
                     if ($allphotos->have_posts()) :
                     while ($allphotos->have_posts()) : $allphotos->the_post(); ?>

                <div class="w3-col m3 w3-padding photo-grid">
                    <img src="<?php echo get_field('image'); ?>" alt="image de marriage" class="w3-image">
                  
                  </div>

                <?php endwhile; wp_reset_query(); ?> 
                 <button id="load-more">Load More</button>
                <?php endif; ?>
            <?php wp_reset_postdata(); ?>
            </div>

        </div>



    </div>
    <?php get_footer(); ?>