<!doctype html>
<html lang="pt_br">
<head>
    <title>.:Pro-MIX:. &infin;</title>

    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" id="viewport" content="initial-scale=1; maximum-scale=1; user-scalable=0;">

    <meta name="description" itemprop="description" content="Pro-MIX - Jogos Online, Aulas de Japonês e Mangá">
    <meta name="keywords" itemprop="keywords" content="manga, draw, jogos, games, online, japones, japanese, tutorial">

    <meta http-equiv="expires" content="Tue, 31 Dec 2015 12:12:12 GMT">
    <meta http-equiv="cache-control" content="public" />
    <meta http-equiv="Pragma" content="public">

    <meta name="google-site-verification" content="oQr25MficUTW-5r5wFggWHPyKWvraNOMeBGU9RsJN8I">

    <link rel="icon" href="<?php bloginfo('template_directory') ?>/images/favicon.ico">

    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url') ?>">
    <link rel="stylesheet" href="<?php bloginfo('template_directory') ?>/font/fontello/css/fontello.css">
    <link href='https://fonts.googleapis.com/css?family=Cookie|Sarina|Merienda|Roboto' rel='stylesheet' type='text/css'>
</head>
<body>



<div class="page-container" ><!-- page-container -->

    <header class="main-header" >
        <div class="header-banner" >
            <?php get_template_part('partials/social_networks_list') ?>
            <img class="header-banner-image" alt="Pro-MIX Sunset" src="<?php bloginfo('template_directory') ?>/images/promix_cover_sunset.png" />
            <img class="header-logo" alt="Pro-MIX Logo" src="<?php bloginfo('template_directory') ?>/images/promix_logo.svg" />
            <span class="header-slogan" >The best things in life are free.</span>
        </div>

        <nav class="main-menu" >
            <input type="checkbox" id="main-menu-check" name="main-menu-check" class="main-menu-trigger-check" />
            <label class="main-menu-trigger" for="main-menu-check" >
                <div class="menu-trigger-icon" >
                    <div class="menu-trigger-bar" ></div>
                    <div class="menu-trigger-bar" ></div>
                    <div class="menu-trigger-bar" ></div>
                </div>
            </label>
            <?php wp_nav_menu(array('theme_location' => 'header-menu')) ?>
            <!--ul class="main-menu-list active-home" >
                <li class="main-menu-item item-home pmx-material-button" >
                    <a href="index.html" class="list-item-link pmx-material-label" >Home</a>
                </li>
                <li class="main-menu-item item-jogos pmx-material-button" >
                    <a href="jogos.html" class="list-item-link pmx-material-label" >Jogos</a>
                </li>
                <li class="main-menu-item item-manga pmx-material-button" >
                    <a href="manga.html" class="list-item-link pmx-material-label" >Mangá</a>
                </li>
                <!--li class="main-menu-item item-quadrinhos pmx-material-button" >
                    <a href="quadrinhos.html" class="list-item-link pmx-material-label" >Quadrinhos</a>
                </li-->
                <!--li class="main-menu-item item-ilustracoes pmx-material-button" >
                    <a href="ilustracoes.html" class="list-item-link pmx-material-label" >Ilustrações</a>
                </li>
                <li class="main-menu-item item-japones pmx-material-button" >
                    <a href="japones.html" class="list-item-link pmx-material-label" >Japonês</a>
                </li>
                <li class="main-menu-item item-contato pmx-material-button" >
                    <a href="contato.html" class="list-item-link pmx-material-label" >Contato</a>
                </li>
            </ul-->
        </nav>
    </header>


    <section  class="main-container"  >
        <main class="main-content" role="main" >