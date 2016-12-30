<?php

get_header();

// get category slug
if ( is_single() ) {
    $cats =  get_the_category();
    $cat = $cats[0];
} else {
    $cat = get_category( get_query_var( 'cat' ) );
}
$cat_slug = $cat->slug;
$pageTitle = $cat->name;
$currentPage = get_query_var('paged') ? get_query_var('paged') : 1;

$args = array(
    'category_name' => $cat_slug,
    'posts_per_page' => get_option( 'posts_per_page' ),
    'paged' => $currentPage,
    'pagination' => true
);
$qry = new WP_Query($args);

if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb('<p class="pmx-breadcrumbs">','</p>');
}

?>


<h1 class="pmx-h1"><?php echo $pageTitle; ?></h1>


<div class="pmx-list-view-toggle-container">
    <div class="pmx-list-view-toggle list-view-mode" >
        <div class="pmx-list-view-toggle-component" ></div>
        <div class="pmx-list-view-toggle-component" ></div>
        <div class="pmx-list-view-toggle-component" ></div>
        <div class="pmx-list-view-toggle-component" ></div>
        <div class="pmx-list-view-toggle-component" ></div>
        <div class="pmx-list-view-toggle-component" ></div>
    </div>
</div>

<section class="pmx-page-posts">
    <?php if ( $qry->have_posts() ) : ?>
        <ul class="pmx-post-list pmx-full-page-list list-view-mode">
            <?php include(locate_template('partials/post_list_items.php')); ?>
        </ul>
    <?php endif; ?>
</section>


<?php

the_posts_pagination(
    array(
        'screen_reader_text' => ' ',
        'mid_size' => 100,
        'next_text' => '<i class="fa fa-chevron-right" ></i>',
        'prev_text' => '<i class="fa fa-chevron-left" ></i>',
    )
);


get_footer();

?>