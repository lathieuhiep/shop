<?php get_header(); ?>

<div class="site-container site-blog">
    <div class="container">
        <div class="row">
            <div class="col-md-9">

                <?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>

                    <div id='post-<?php the_ID(); ?>' <?php post_class(); ?>>
                        <?php

                        get_template_part( 'template-parts/post/content','info' );

                        if(has_post_format('gallery')):
                            get_template_part( 'template-parts/post/content','gallery' );
                        elseif(has_post_format('audio')):
                            get_template_part( 'template-parts/post/content','audio' );
                        else:
                            get_template_part( 'template-parts/post/content','video' );
                        endif;

                        ?>
                    </div>

                <?php

                    endwhile;

                    shoptheme_pagination();

                    endif;

                ?>

            </div>

            <?php get_sidebar(); ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>

