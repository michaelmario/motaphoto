<?php get_header();

?>
<?php while (have_posts()) : the_post() ?>
<div class="W3-container">
    <!-- La partie photo en bg + title de hero header -->
    <div class="hero-header">
        <h1 class="hero-title">PHOTOGRAPH EVENT</h1>
    </div>
    <div class="w3-container w3-section">
        <div class="w3-container  w3-cell">
            <p>Hello W3.CSS Layout.</p>
        </div>

        <div class="w3-container  w3-cell w3-margin-left">
            <p>Hello W3.CSS Layout.</p>
        </div>
        <div class="w3-container  w3-cell ">
            <p>Hello W3.CSS Layout.</p>
        </div>
    </div>
    <div class="PhotoDisplay">
        
    </div>

    <?php endwhile ?>
</div>
<?php get_footer(); ?>