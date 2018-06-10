<?php

$shoptheme_gallery = get_post_meta(  get_the_ID() , '_format_gallery_images', true );

if( $shoptheme_gallery != '' ) :

?>

    <div class="site-post-slides owl-carousel owl-theme">

            <?php

            foreach($shoptheme_gallery as $shoptheme_image) :

                $shoptheme_image_src = wp_get_attachment_image_src( $shoptheme_image, 'full-thumb' );

                $shoptheme_caption = get_post_field('post_excerpt', $shoptheme_image);
            ?>

                <div class="site-post-slides__item">

                    <img src="<?php echo esc_url($shoptheme_image_src[0]); ?>" <?php echo ( $shoptheme_caption != '' ? 'title="' . esc_attr( $shoptheme_caption ) . '"' : '' ); ?> alt="<?php echo sanitize_title(get_the_title())?>"/>
                </div>

            <?php endforeach; ?>

    </div>

<?php endif; ?>