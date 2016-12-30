<?php

function register_my_menus(){
    register_nav_menus(
        array('header-menu' => __('Header Menu'))
    );
}

add_action('init', 'register_my_menus');

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 120, 120 );

add_theme_support( 'html5', array('search-form') );



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


/* Avoid hardcoded height and width on images */
function remove_img_attr ($html) {
    return preg_replace('/(width|height)="\d+"\s/', "", $html);
}
add_filter( 'post_thumbnail_html', 'remove_img_attr' );