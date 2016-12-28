<?php

get_header();
$categories = get_categories();
$itemsLimit = 4;
$qry = new WP_Query( 'posts_per_page='.$itemsLimit );

?>


<ul class="pmx-post-list pmx-featured-list">
    <?php include(locate_template('partials/post_list_items.php')); ?>
</ul>


<section class="pmx-category-post-section" >
    <?php foreach ( $categories as $category ) {

        $args = array(
            'cat' => $category->term_id,
            'posts_per_page' => $itemsLimit,
        );

        $qry = new WP_Query( $args );

        if ( $qry->have_posts() ) : ?>
            <section class="pmx-category-post-list pmx-category-<?php echo $category->slug; ?>">
                <header class="pmx-category-post-list-header" >
                    <a href="<?php echo get_category_link( $category->term_id ) ?>" >
                        <h2 class="pmx-h2" ><?php echo $category->name; ?></h2>
                    </a>
                </header>
                <?php if ( $qry->have_posts() ) : ?>
                    <ul class="pmx-post-list pmx-small-list">
                        <?php include(locate_template('partials/post_list_items.php')); ?>
                    </ul>
                <?php endif; ?>
                <footer class="pmx-category-post-list-footer">
                    <a href="<?php echo get_category_link( $category->term_id ) ?>" >
                        <span class="pmx-h3" >Ver Mais de <?php echo $category->name; ?> <i class="icon icon-right-open"></i></span>
                    </a>
                </footer>
            </section>
        <?php endif;

        // Use reset to restore original query.
        wp_reset_postdata();
    } ?>

</section>

<?php get_footer(); ?>