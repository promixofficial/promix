<?php

get_header();
$categories = get_categories();
$itemsLimit = 4;
$qry = new WP_Query( 'posts_per_page='.$itemsLimit );


$gamesQuery = new WP_Query('pagename=jogos');
$gamesPageContent = '';
$gamesList = array();
$gamesListLimit = $itemsLimit;

if($gamesQuery->have_posts()){
    while($gamesQuery->have_posts() ) : $gamesQuery->the_post();
        $gamesPageContent = get_the_content();
    endwhile;
}
$gamesList = json_decode($gamesPageContent, true);

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


    <section class="pmx-category-post-list pmx-category-jogos">
        <header class="pmx-category-post-list-header" >
            <a href="./category/jogos" >
                <h2 class="pmx-h2" >Jogos</h2>
            </a>
        </header>
        <ul class="pmx-post-list pmx-small-list">
            <?php foreach($gamesList as $game){
                    if(--$gamesListLimit < 0){
                        break;
                    }
                ?>

                <li class="pmx-post-list-item">
                    <article class="pmx-post-preview" >
                        <a href="./category/jogos" rel="bookmark" title="<?php echo $game['title']; ?>">
                            <img  class="pmx-post-list-thumbnail" alt="<?php echo $game['title'] ?>" src="<?php echo $game['illustration'] ?>">
                            <h2 class="pmx-post-preview-title pmx-h2" ><?php echo $game['title']; ?></h2>
                            <div class="pmx-post-preview-excerpt"></div>
                        </a>
                    </article>
                </li>
            <?php } ?>
        </ul>
        <footer class="pmx-category-post-list-footer">
            <a href="./category/jogos" >
                <span class="pmx-h3" >Ver Mais de Jogos <i class="icon icon-right-open"></i></span>
            </a>
        </footer>
    </section>


</section>

<?php get_footer(); ?>