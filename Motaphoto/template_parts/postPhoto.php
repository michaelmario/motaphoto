<div class="W3-container">
    <!-- La partie photo en bg + title de hero header >-->
    <div class="hero-header">
        <?php get_template_part( 'template_parts/carousel'); ?>
    </div>
    <div class="mainContainer">
        <section>
            <div class="w3-container w3-margin-bottom w3-center" id="sectionSelect">
                <div class="w3-row">
                    <div class="w3-third w3-section">
                        <form id="filter-cat" class="js-filter-form" method="GET">
                            <select name="categorie" id="categories-select" class="w3-select w3-border ">
                                <option value="catégories">Catégories</option>
                                <option value="Réception">Réception</option>
                                <option value="Télévision">Télévision</option>
                                <option value="Concert">Concert</option>
                                <option value="Mariage">Mariage</option>


                            </select>

                        </form>
                    </div>

                    <div class="w3-third w3-section">
                        <form id="filter-formats">
                            <select name="format" id="filter-select" class="w3-select letters-transform w3-border">
                                <option>Formats</option>
                                <option value="paysage">paysage</option>
                                <option value="portrait">portrait</option>
                            </select>
                        </form>
                    </div>
                    <div class="w3-third w3-section">
                        <form id="filter-date">
                            <div class="filter-3">
                                <select name="sort" id="sort-dates" class="w3-select letters-transform w3-border">
                                    <option value="">Trier par</option>
                                    <option value="DESC">Nouveautés</option>
                                    <option value="ASC">Les plus anciens</option>
                                    <option value="date">Tirage</option>

                                </select>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section class="display-photo">
            <div class="photo-grid">
            </div>
            <div class="w3-container buttonContainer">
                <button class="w3-btn w3-gray" id="load-more">Charger plus</button>
            </div>
        </section>