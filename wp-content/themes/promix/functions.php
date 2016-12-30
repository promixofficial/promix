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







function pmx_numeric_posts_nav($qry = null) {

    if( is_singular() )
        return;

    global $wp_query;
    if($qry == null){
        $qry = $wp_query;
    }


    /** Stop execution if there's only 1 page */
    if( $qry->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $qry->max_num_pages );

    /**	Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /**	Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="pmx-navigation"><ul class="pmx-navigation-list" >' . "\n";

    /**	Previous Post Link */
    printf( '<li class="pmx-navigation-list-item pmx-previous-page pmx-page-control" >%s</li>' . "\n", (get_previous_posts_link() ? get_previous_posts_link() : "&nbsp;") );

    /**	Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = ' class="pmx-navigation-list-item';
        $class .= 1 == $paged ? ' is-active"' : '"';

        printf( '<li%s><a class="pmx-navigation-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li class="pmx-navigation-list-item" >…</li>';
    }

    /**	Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = ' class="pmx-navigation-list-item';
        $class .= $paged == $link ? ' is-active"' : '"';
        printf( '<li%s><a class="pmx-navigation-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    /**	Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li class="pmx-navigation-list-item">…</li>' . "\n";
        $class = ' class="pmx-navigation-list-item';
        $class .= $paged == $max ? ' is-active"' : '"';
        printf( '<li%s><a class="pmx-navigation-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    /**	Next Post Link */
    printf( '<li class="pmx-navigation-list-item pmx-next-page pmx-page-control" >%s</li>' . "\n", (get_next_posts_link() ? get_next_posts_link() : "&nbsp;") );

    echo '</ul></div>' . "\n";

}