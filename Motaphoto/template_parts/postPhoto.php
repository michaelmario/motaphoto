<?php
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
        <section class="SelectContainer">
            <div class="w3-row">
                <div class="w3-third w3-section">
                    <form id="filter-cat" class="js-filter-form w3-center">
                        <select class="w3-select w3-border" name="option" name="categories" id="categories-select">
                            <option class="letters-transform">CATEGORIES</option>
                            <option value="">Toutes les photos</option>                            
                            </select>

                    </form>
                </div>
                <div class="w3-third w3-section">
                    <form id="filter-formats" class="w3-center">
                        <select name="format" id="filter-select" class="w3-select w3-border">
                            <option class="letters-transform">FORMATS</option>
                            <option value="">Toutes les photos</option> 
                            <option value="payage">paysage</option> 
                            <option value="portrait">portrait</option>                          
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
        </section>
        <div class="display-photo">
           <div class="photo-grid">                  
            </div>
            <div class="w3-container buttonContainer">
              <button class="w3-btn w3-gray" id="load-more">Charger plus</button>
            </div>    
     </div>
      