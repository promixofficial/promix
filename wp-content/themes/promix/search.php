<?php get_header() ?>

<h1 class="pmx-h1">Resultados da Busca</h1>

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

<form role="search" method="get" class="pmx-page-search-form" action="<?php echo home_url('/'); ?>">
    <input type="search" class="pmx-search-form-field" placeholder="Pesquisar …" value="<?php echo get_search_query(); ?>" name="s">
</form>

<?php
the_posts_pagination(
    array(
        'screen_reader_text' => ' ',
        'next_text' => '<i class="fa fa-chevron-right" ></i>',
        'prev_text' => '<i class="fa fa-chevron-left" ></i>',
    )
);
?>

<section class="pmx-page-posts">
    <?php if ( have_posts() ){ ?>
        <ul class="pmx-post-list pmx-full-page-list list-view-mode">
            <?php while ( have_posts() ) : the_post(); ?>
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

        <?php
            the_posts_pagination(
                array(
                    'screen_reader_text' => ' ',
                    'mid_size' => 100,
                    'next_text' => '<i class="fa fa-chevron-right" ></i>',
                    'prev_text' => '<i class="fa fa-chevron-left" ></i>',
                )
            );
        ?>
    <?php }else{ ?>
        <div>Nenhum resultado foi retornado</div>
    <?php } ?>
</section>


<?php get_footer() ?>