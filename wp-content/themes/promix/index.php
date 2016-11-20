<?php

get_header();
$categories = get_categories();

$qry = new WP_Query( 'posts_per_page=4' );

?>


<ul class="pmx-post-list pmx-featured-list">
    <?php include(locate_template('partials/post_list_items.php')); ?>
</ul>


<?php

foreach ( $categories as $category ) {

    $args = array(
        'cat' => $category->term_id,
        'posts_per_page' => '4',
    );

    $qry = new WP_Query( $args );

    if ( $qry->have_posts() ) : ?>
        <section class="pmx-category-list pmx-category-<?php echo $category->slug; ?>" style="width: 33%; display: inline-block;margin-right: 20px;">
            <header>
                <a href="<?php echo get_category_link( $category->term_id ) ?>" >
                    <h2 class="pmx-h2" ><?php echo $category->name; ?>:</h2>
                </a>
            </header>
            <?php if ( $qry->have_posts() ) : ?>
                <ul class="pmx-post-list pmx-small-list">
                    <?php include(locate_template('partials/post_list_items.php')); ?>
                </ul>
            <?php endif; ?>
        </section>
    <?php endif;

    // Use reset to restore original query.
    wp_reset_postdata();
}

get_footer(); ?>