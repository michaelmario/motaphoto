<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<!-- permets de définir la langue du document dans les réglages > général > langue du site -->

<head>
    <meta charset="<?php bloginfo('charset'); ?>"> <!-- Permet de définir 'encoage du site -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Fonction essentielle au bon fonctionnement de thème -->
    <?php wp_head(); ?>
    <style>
    select option,
    select {
        background-color:white;
    }

    select option[value="1"],
    select.o1
    {
        background-color:green;
    }

    select option[value="2"],
    select.o2
    {
        background-color:red;
    }

    select option[value="3"],
    select.o3
    {
        background-color:orange;
    }
</style>

</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div class="header w3-border w3-light-white">
        <div class="w3-bar">
            <div class="logo">
                <a href="<?php echo home_url('/'); ?>" class="w3-bar-item w3-margin-left">
                     <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" alt="Logo">
                </a>
            </div>
            <div class="w3-container w3-right">
                <?php
            if (has_nav_menu('main-menu')) : ?>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'menu_class' => ' my-main-menu', 
                ));
                ?>
                <?php endif;
            ?>
                <div class="burger-menu-icons">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/images/menu-burger-icon.svg"
                        alt="Burger menu icon" class="burger-menu-open active">
                </div>
            </div>
        </div>
        <!-- ajout de menu burger: une fois la fenetre ouverte -->
        <div class="burger-menu-opened w3-theme-d1">
            <div class="header-logo-close">
                <a href="<?php echo home_url('/'); ?>">                   
                    <img id="logo-mobile"
                        src="<?php echo get_template_directory_uri(); ?>/assets/images/images/logo.png" alt="Logo">
                </a>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/images/menu-cross-close.svg"
                    alt="Burger menu close icon" class="burger-menu-close">
            </div>


            <div class="burger-menu-links">
                <?php
            if (has_nav_menu('main-menu')) : ?>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'mobile-menu',
                    'menu_class' => 'Mobile-menu', ));
                ?>
                <?php endif;
            ?>

            </div>
        </div>
    </div>