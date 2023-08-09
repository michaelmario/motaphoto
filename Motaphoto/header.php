<!DOCTYPE html>
<html <?php language_attributes(); ?>> <!-- permets de définir la langue du document dans les réglages > général > langue du site -->

<head>
    <meta charset="<?php bloginfo('charset'); ?>"> <!-- Permet de définir 'encoage du site -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!--     adding Google Fonts -->
    <!-- Space Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;1,700&display=swap" rel="stylesheet">

    <!-- poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <!-- Fonction essentielle au bon fonctionnement de thème -->
    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div class="header w3-border w3-light-white">
    <div class="w3-bar">
    <div class="logo w3-margin">  
        <a href="<?php echo home_url('/'); ?>" class="w3-bar-item w3-margin-left"> <!-- Permet de revenir à l'accueil une fois logo est cliqué -->
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo"> <!-- Pour avoir adresse absolute (dit "complet") -->
            </a>  
</div>
  <div class="w3-container w3-right">  
  <?php
            if (has_nav_menu('main-menu')) : ?>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'menu_class' => ' my-main-menu', // classe CSS pour customiser mon menu
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
<div class="burger-menu-opened">
            <div class="header-logo-close">
                <a href="<?php echo home_url('/'); ?>"> <!-- Permet de revenir à l'accueil une fois logo est cliqué -->
                    <img id="logo-mobile" src="<?php echo get_template_directory_uri(); ?>/assets/images/images/logo.png" alt="Logo"> <!-- Pour avoir adresse absolute (dit "complet") -->
                </a>

                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/images/menu-cross-close.svg" alt="Burger menu close icon" class="burger-menu-close">
            </div>


            <div class="burger-menu-links">
            <?php
            if (has_nav_menu('main-menu')) : ?>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'mobile-menu',
                    'menu_class' => 'Mobile-menu', // classe CSS pour customiser mon menu
                ));
                ?>
            <?php endif;
            ?>
                
            </div>
        </div>
</div>
