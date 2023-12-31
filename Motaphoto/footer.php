<?php wp_footer(); ?>

<!-- Rajout de menu via panel d'administration -->
<footer class="w3-container w3-border-top w3-light-white w3-padding">
    <?php
    if (has_nav_menu('footer-menu')) : ?>
        <?php
        wp_nav_menu(array(
            'theme_location' => 'footer-menu',
            'menu_class' => 'my-footer-menu', // classe CSS pour customiser mon menu
        )); ?>
    <?php endif;
    ?>
    </footer>


<!-- Appeler le fichier modal contact.php (pop-up contact) -->
<?php
get_template_part( 'template_parts/contact'); 
get_template_part('template_parts/lightbox');
?>

</body>

</html>