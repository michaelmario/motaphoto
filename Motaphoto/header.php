<!DOCTYPE html>
<html <?php language_attributes(); ?>>
 <!-- permets de définir la langue du document dans les réglages > général > langue du site -->

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
     <!-- Permet de définir 'encoage du site -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Fonction essentielle au bon fonctionnement de thème -->
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div class="header w3-border w3-light-white">
    <div class="w3-bar" id="mainMenu">
    <div class="logo w3-margin">  
        <a href="<?php echo home_url('/'); ?>" class="w3-bar-item w3-margin-left">
         <!-- Permet de revenir à l'accueil une fois logo est cliqué -->
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo"> <!-- Pour avoir adresse absolute (dit "complet") -->
            </a>  
</div>
  <div class="w3-container w3-right">  
  <?php
            if (has_nav_menu('main-menu')) : ?>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'menu_class' => ' my-main-menu',
                    // classe CSS pour customiser mon menu
                ));
                ?>
            <?php endif;
            ?>
        <div class="burger-menu-icons">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/images/menu-burger-icon.svg" alt="Burger menu icon" class="burger-menu-open active">
        </div>
</div>
</div>
<!-- ajout de menu burger: une fois la fenetre ouverte -->
