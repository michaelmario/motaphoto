<!-- 
    Fichier qui détermine la mise en forme d'une page.
    Template dédiée à l’affichage d’une Page.
-->

<?php get_header(); ?>
<div class="main page">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <div class="post">
                <h1 class="post-title">
                    <?php 
                    // the_title(); 
                    ?>
                </h1>
                <div class="post-content">
                    <?php 
                    the_content();

                    ?>
                    
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>

<!-- the side bar that displays all the 'archives', 'search, etc options presented by default in wp -->
<?php 
// get_sidebar();
 ?>
<?php get_footer(); ?>