<?php

/* Template Name: Manga */


get_header();


$args = array('category_name' => 'manga');
$qry = new WP_Query($args);


?>













<?php

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









































    <section id="primary" class="site-content">
        <div id="content" role="main">
            <?php
            // Check if there are any posts to display
            if ( $qry->have_posts() ) : ?>

                <header class="archive-header">
                    <?php
                    // Since this template will only be used for Design category
                    // we can add category title and description manually.
                    // or even add images or change the layout
                    ?>

                    <h1 class="archive-title">Design Articles</h1>
                    <div class="archive-meta">
                        Articles and tutorials about design and the web.
                    </div>
                </header>

                <?php

// The Loop
                while ( $qry->have_posts() ) : $qry->the_post(); ?>
                    <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                    <small><?php the_time('F jS, Y') ?> by <?php the_author_posts_link() ?></small>

                    <div class="entry">
                        <?php the_excerpt(); ?>

                        <p class="postmetadata"><?php
                            comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments closed');
                            ?></p>
                    </div>

                <?php endwhile; // End Loop

            else: ?>
                <p>Sorry, no posts matched your criteria.</p>
            <?php endif; ?>
        </div>
    </section>


<?php get_footer(); ?>