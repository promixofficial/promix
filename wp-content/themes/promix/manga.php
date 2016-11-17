<?php

/* Template Name: Manga */

get_header();


$args = array('category_name' => 'manga');
$qry = new WP_Query($args);


if ( function_exists('yoast_breadcrumb') ) {
    yoast_breadcrumb('<p class="pmx-breadcrumbs">','</p>');
}

?>

    <header class="archive-header">
        <h1 class="archive-title pmx-h1">Mangá</h1>
    </header>

    <section id="primary" class="site-content">
        <div id="content" role="main">
            <?php
            // Check if there are any posts to display
            if ( $qry->have_posts() ) : ?>


                <?php

                while ( $qry->have_posts() ) : $qry->the_post(); ?>
                    <article>
                        <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                        <div class="entry">
                            <?php the_excerpt(); ?>
                        </div>
                    </article>
                <?php endwhile; // End Loop

            else: ?>
                <p>Sorry, no posts matched your criteria.</p>
            <?php endif; ?>
        </div>
    </section>


<?php get_footer(); ?>