<?php

get_header();

if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb('<p class="pmx-breadcrumbs">','</p>');
}


while ( have_posts() ) : the_post(); ?>

    <?php get_template_part('./partials/social_networks_list_share'); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php the_post_thumbnail( 'full', array('style'=>'display: none;', 'class'=>'pmx-post-featured-img') ); ?>
        <header class="entry-header">
            <?php the_title( '<h1 class="pmx-h1">', '</h1>' ); ?>
        </header>
        <div class="entry-content pmx-post-content">
            <?php the_content(); ?>
        </div>
    </article><!-- #post-## -->

    <?php get_template_part('./partials/social_networks_list_share'); ?>

<?php endwhile; ?>

<ul class="pmx-post-list-nav" >
    <li class="pmx-post-list-item">
        <?php previous_post_link('%link', '<div class="pmx-post-link" ><i class="icon icon-left-open"></i> Anterior<br><span class="pmx-post-list-title" >%title</span></div>', true); ?>
    </li>
    <li class="pmx-post-list-item">
        <?php next_post_link('%link', '<div class="pmx-post-link" >Próximo <i class="icon icon-right-open"></i><br><span class="pmx-post-list-title" >%title</span></div>', true); ?>
    </li>
</ul>

<?php

if ( function_exists('rp4wp_children') ) {
    rp4wp_children();
}


get_footer();

?>