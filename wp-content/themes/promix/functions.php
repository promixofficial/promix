<?php

function register_my_menus(){
    register_nav_menus(
        array('header-menu' => __('Header Menu'))
    );
}

add_action('init', 'register_my_menus');

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 120, 120 );


/*
function create_post_type() {
    register_post_type( 'manga',
        array(
            'labels' => array(
                'name' => __( 'Mangá' ),
                'singular_name' => __( 'Mangá' )
            ),
            'public' => true,
            'has_archive' => true,
        )
    );
}

add_action( 'init', 'create_post_type' );
*/