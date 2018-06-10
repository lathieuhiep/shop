<?php get_header(); ?>

<div class="site-container site-blog">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <?php

                if ( have_posts() ) : while (have_posts()) : the_post();

                    $shoptheme_post_type        =   get_post_type( get_the_ID() );
                    $shoptheme_comment_count    =   wp_count_comments( get_the_ID() );

                ?>

                    <div id='post-<?php the_ID(); ?>' <?php post_class(); ?>>

                        <?php

                        if ( $shoptheme_post_type != 'page' ) :

                            get_template_part( 'template-parts/post/content','info' );

                            if(has_post_format('gallery')):
                                get_template_part( 'template-parts/post/content','gallery' );
                            elseif(has_post_format('audio')):
                                get_template_part( 'template-parts/post/content','audio' );
                            else:
                                get_template_part( 'template-parts/post/content','video' );
                            endif;

                        else:

                        ?>

                            <h2 class="site-post-title">
                                <a href="<?php the_permalink() ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>

                        <?php endif; ?>

                    </div>

                <?php

                    endwhile; // end while ( have_posts )
                else:

                ?>

                    <div class="site-serach-no-data">
                        <h3>
                            <?php  esc_html_e('No Data', 'shoptheme');?>
                        </h3>

                        <div class="page-content">

                            <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

                                <p>
                                    <?php printf(  esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'shoptheme' ), esc_url( admin_url( 'post-new.php' ) ) ); ?>
                                </p>

                            <?php elseif ( is_search() ) : ?>

                                <p>
                                    <?php  esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'shoptheme' ); ?>
                                </p>

                                <?php get_search_form(); ?>

                            <?php else : ?>

                                <p>
                                    <?php  esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'shoptheme' ); ?>
                                </p>
                                <?php get_search_form(); ?>

                            <?php endif; ?>

                        </div><!-- .page-content -->
                    </div>

                <?php

                    shoptheme_pagination();
                endif; // end if ( have_posts )

                ?>

            </div>

            <?php get_sidebar(); ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>

