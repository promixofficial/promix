<?php
/* Template Name: Jogos */

$pageTitle = 'Jogos';

get_header();

$args = array('pagename' => strtolower($pageTitle));
$qry = new WP_Query($args);
$pageContent = array();

if($qry->have_posts()){
    while($qry->have_posts() ) : $qry->the_post();
        $pageContent = get_the_content();
    endwhile;
}

$gamesList = json_decode($pageContent, true);

?>

<h1 class="pmx-h1"><?php echo $pageTitle; ?></h1>

<section class="pmx-page-posts">
	<ul class="pmx-post-list pmx-full-page-list grid-view-mode">
		<?php foreach($gamesList as $game){ ?>
			<li class="pmx-post-list-item">
				<article class="pmx-post-preview" data-url="//<?php echo $game['url'] ?>" <?php if($game['size']){ echo 'data-size="'.$game['size'].'"'; } ?>>
					<div title="<?php echo $game['title'] ?>">
						<img  class="pmx-post-list-thumbnail wp-post-image" alt="<?php echo $game['title'] ?>" src="<?php echo $game['illustration'] ?>">
						<h2 class="pmx-post-preview-title pmx-h2"><?php echo $game['title'] ?></h2>
						<div class="pmx-post-preview-excerpt">
							<p><?php echo $game['description'] ?></p>
                            <?php if($game['googlePlay']){ ?>
                                <br>
                                <a class="pmx-mobile-store-link" href="<?php echo $game['googlePlay'] ?>" target="_blank" title="<?php echo $game['title'] ?> - Get it on Google Play">
                                    <img width="130px" alt="Get it on Google Play" src="<?php bloginfo('template_directory') ?>/images/google_play_button.png">
                                </a>
                            <?php } ?>
						</div>
					</div>
				</article>
			</li>
		<?php } ?>
	</ul>
</section>

<?php get_footer(); ?>