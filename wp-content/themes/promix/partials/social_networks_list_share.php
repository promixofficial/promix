<div class="social-list-share">
    <ul class="social-list" >
        <li class="social-list-item" >
            <a title="Share on Facebook."
               href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>"
               onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                <i class="fa fa-facebook-official" ></i>
            </a>
        </li>
        <li class="social-list-item" >
            <a title="Tweet this!"
               target="_blank" href="http://twitter.com/home/?status=<?php the_title(); ?> - <?php the_permalink(); ?>"
               onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                <i class="fa fa-twitter-square" ></i>
            </a>
        </li>
        <li class="social-list-item" >
            <a title=""
               href="https://plus.google.com/share?url=<?php the_permalink(); ?>"
               onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                <i class="fa fa-google-plus-square" ></i>
            </a>
        </li>
        <li class="social-list-item" >
            <a title="Share on LinkedIn"
               href="http://www.linkedin.com/shareArticle?mini=true&amp;title=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>"
               onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                <i class="fa fa-linkedin-square" ></i>
            </a>
        </li>
        <li class="social-list-item" >
            <a title=""
               href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); echo $url; ?>"
               onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;">
                <i class="fa fa-pinterest-square" ></i>
            </a>
        </li>
    </ul>
</div>
