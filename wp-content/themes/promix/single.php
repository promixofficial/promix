<?php get_header() ?>


<?php


if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb('<p id="breadcrumbs">','</p>');
}


while ( have_posts() ) : the_post(); ?>


    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <!--header class="entry-header">
            <?php /*the_title( '<h1 class="entry-title">', '</h1>' );*/ ?>
        </header-->

        <div class="entry-content">
            <?php

            the_content();

            wp_link_pages( array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'promix' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
                'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'promix' ) . ' </span>%',
                'separator'   => '<span class="screen-reader-text">, </span>',
            ) );
            ?>
        </div><!-- .entry-content -->


    </article><!-- #post-## -->


<?php

endwhile;

?>




<?php get_footer() ?>