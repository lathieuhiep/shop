<?php

global $shoptheme_options;

$shoptheme_post_type      =    get_post_type( get_the_ID() );
$shoptheme_comment_count  =    wp_count_comments( get_the_ID() );

?>
<div class="site-post-content">

    <h2 class="site-post-title">

        <?php

        if( is_single() ) :
            the_title();
        else :

        ?>
            <a href="<?php the_permalink();?>">
                <?php if ( is_sticky() && is_home() ) : ?>

                    <i class="fa fa-thumb-tack" aria-hidden="true"></i>

                <?php

                endif;

                the_title();

                ?>
            </a>

        <?php endif; ?>

    </h2>

    <?php if ( has_post_thumbnail() ) :?>
        <!-- Post Image -->
        <div class="site-post-image">
            <?php the_post_thumbnail('full'); ?>
        </div>
        <!-- /Post Image -->
    <?php endif;?>

    <div class="site-post-meta">

        <span class="site-post-author">
            <?php echo esc_html__('Author:','shoptheme');?>
            <a href="<?php echo get_author_posts_url( get_the_author_meta('ID') );?>">
                <?php the_author();?>
            </a>
        </span>

        <span class="site-post-date">
            <?php esc_html_e( 'Post date: ','shoptheme' ); the_date(); ?>
        </span>

        <span>
            <?php echo esc_html__('Comments:','shoptheme') . esc_html($shoptheme_comment_count ->total_comments);?>
        </span>

    </div>

    <?php if( is_single() ) : ?>

        <div class="site-post-excerpt">
            <?php
            the_content();

            wp_link_pages( array(
                'before'      => '<div class="page-links">' . __( 'Pages:', 'shoptheme' ),
                'after'       => '</div>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            ) );

            ?>
        </div>

        <div class="site-post-cat-tag">

            <?php if( get_the_category() != false ): ?>

                <span class="site-post-category">
                    <?php
                    esc_html_e('Category: ','shoptheme');
                    the_category( ' ' );;
                    ?>
                </span>

            <?php

            endif;

            if( get_the_tags() != false ):

            ?>

                <span class="site-post-tag">
                    <?php
                    esc_html_e('Tag: ','shoptheme');
                    the_tags('',' ');
                    ?>
                </span>

            <?php endif; ?>

        </div>

        <div class="site-post-share">

            <span>
                <?php  esc_html_e('Share this post:', 'shoptheme') ; ?>
            </span>

            <!-- Facebook Button -->
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>">
                <i class="fa fa-facebook"></i>
            </a>

            <a target="_blank" href="https://twitter.com/home?status=Check%20out%20this%20article:%20<?php print shoptheme_social_title( get_the_title() ); ?>%20-%20<?php the_permalink(); ?>">
                <i class="fa fa-twitter"></i>
            </a>

            <?php $shoptheme_pin_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() )); ?>

            <a data-pin-do="skipLink" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo esc_url( $shoptheme_pin_image ); ?>&description=<?php the_title(); ?>">
                <i class="fa fa-pinterest"></i>
            </a>

            <a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>">
                <i class="fa fa-google-plus"></i>
            </a>

        </div>

    <?php

    else :

        if ( $shoptheme_post_type != 'page' ) :
    ?>

            <div class="site-post-excerpt">

                <?php

                if( ! has_excerpt()):

                    the_content();

                else:

                    the_excerpt();
                ?>
                    <a href="<?php the_permalink();?>" class="tzreadmore">
                        <?php echo esc_html__('Read more','shoptheme');?>
                    </a>

                <?php

                endif;

                wp_link_pages( array(
                    'before'      => '<div class="page-links">' . __( 'Pages:', 'shoptheme' ),
                    'after'       => '</div>',
                    'link_before' => '<span class="page-number">',
                    'link_after'  => '</span>',
                ) );

                ?>

            </div>

    <?php

        endif;
    endif;

    ?>

</div>