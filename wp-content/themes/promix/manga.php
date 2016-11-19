<?php
/* Template Name: Manga */

get_header();

$args = array('category_name' => 'manga');
$qry = new WP_Query($args);

if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb('<p class="pmx-breadcrumbs">','</p>');
}

?>


<h1 class="pmx-h1">Mangá</h1>

<section class="pmx-page-posts">
    <?php if ( $qry->have_posts() ) : ?>
        <ul class="pmx-post-list pmx-full-page-list">
            <?php while ( $qry->have_posts() ) : $qry->the_post(); ?>
                <li class="pmx-post-list-item">
                    <article class="pmx-post-preview" >
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                            <?php the_post_thumbnail( 'full', array('class'=>'pmx-post-list-thumbnail') ); ?>
                            <h2 class="pmx-post-preview-title pmx-h2" ><?php the_title(); ?></h2>
                            <div class="pmx-post-preview-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        </a>
                    </article>
                </li>
            <?php endwhile; ?>
        </ul>
    <?php endif; ?>
</section>


<?php get_footer(); ?>