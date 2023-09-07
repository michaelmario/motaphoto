<?php wp_footer(); ?>

<!-- Rajout de menu via panel d'administration -->
<footer class="Footerbordertop w3-light-white ">
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


<?php wp_footer(); ?>
<!-- Appeler le fichier modal contact.php (pop-up contact) -->
<?php
get_template_part( 'template_parts/contact'); 
get_template_part('template_parts/lightbox');
?>
</body>

</html>