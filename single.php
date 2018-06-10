<?php
get_header();

global $shoptheme_options;

$shoptheme_single_sidebar    =   $shoptheme_options['shoptheme_blog_single_sidebar'];

if ( $shoptheme_single_sidebar  == 1 ) :
    $shoptheme_col_not_sidebar = 'col-md-12';
else:
    $shoptheme_col_not_sidebar = 'col-md-9';
endif;

?>

<div class="site-container site-single">
    <div class="container">
        <div class="row">

            <?php

            if( $shoptheme_single_sidebar == 2 ):
                get_sidebar();
            endif;

            ?>

            <div class="<?php echo esc_attr( $shoptheme_col_not_sidebar ); ?>">
                <?php

                if ( have_posts() ) : while (have_posts()) : the_post();

                    $shoptheme_comment_count  = wp_count_comments( get_the_ID() );

                ?>

                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                        <?php

                        if(has_post_format('gallery')):
                            get_template_part( 'template-parts/post/content','gallery' );
                        elseif(has_post_format('audio')):
                            get_template_part( 'template-parts/post/content','audio' );
                        else:
                            get_template_part( 'template-parts/post/content','video' );
                        endif;

                        get_template_part( 'template-parts/post/content','info' );

                        ?>
                    </div>

                <?php if ( get_the_author_meta( 'description' ) != '' ) : ?>

                    <div class="site-author d-flex">
                            <div class="author-avata">
                                <?php echo get_avatar( get_the_author_meta('ID'),80); ?>
                            </div>
                            <div class="author-info">
                                <h3><a href="<?php echo get_author_posts_url(get_the_author_meta('ID'))?>"><?php the_author();?></a></h3>
                                <p>
                                    <?php the_author_meta('description'); ?>
                                </p>
                            </div>
                        </div>

                <?php
                    endif;

                        if ( comments_open() || get_comments_number() ) :

                ?>

                        <div class="site-comments">
                            <?php comments_template( '', true ); ?>
                        </div>

                <?php
                        endif;

                    endwhile;
                endif;

                ?>

            </div>

            <?php

            if( $shoptheme_single_sidebar == 3 ):
                get_sidebar();
            endif;

            ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>

