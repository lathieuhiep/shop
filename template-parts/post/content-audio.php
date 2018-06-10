<?php

    $shoptheme_audio = get_post_meta(  get_the_ID() , '_format_audio_embed', true );
    if( $shoptheme_audio != '' ):

?>
        <div class="site-post-audio">

            <?php if( wp_oembed_get( $shoptheme_audio ) ) : ?>

                <?php echo wp_oembed_get( $shoptheme_audio ); ?>

            <?php else : ?>

                <?php echo balanceTags( $shoptheme_audio ); ?>

            <?php endif; ?>

        </div>

<?php endif;?>