<?php

$shoptheme_video = get_post_meta(  get_the_ID() , '_format_video_embed', true );

if ( $shoptheme_video != '' ):

?>

    <div class="site-post-video">

        <?php if(wp_oembed_get( $shoptheme_video )) : ?>

            <?php echo wp_oembed_get($shoptheme_video); ?>

        <?php else : ?>

            <?php echo balanceTags($shoptheme_video); ?>

        <?php endif; ?>

    </div>

<?php endif;?>