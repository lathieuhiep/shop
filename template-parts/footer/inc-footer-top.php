<?php
//Global variable redux
global $shoptheme_options;

$shoptheme_footer_col     =   $shoptheme_options ["shoptheme_footer_column_col"];
$shoptheme_footer_widthl  =   $shoptheme_options ["shoptheme_footer_column_w1"];
$shoptheme_footer_width2  =   $shoptheme_options ["shoptheme_footer_column_w2"];
$shoptheme_footer_width3  =   $shoptheme_options ["shoptheme_footer_column_w3"];
$shoptheme_footer_width4  =   $shoptheme_options ["shoptheme_footer_column_w4"];

if( is_active_sidebar( 'shoptheme-footer-1' ) || is_active_sidebar( 'shoptheme-footer-2' ) || is_active_sidebar( 'shoptheme-footer-3' ) || is_active_sidebar( 'shoptheme-footer-4' ) ) :

?>

    <div class="site-footer__top">
        <div class="container">
            <div class="row">

                <?php

                for( $shoptheme_i = 0; $shoptheme_i < $shoptheme_footer_col; $shoptheme_i++ ):

                    $shoptheme_j = $shoptheme_i +1;

                    if ( $shoptheme_i == 0 ) :

                        $shoptheme_col = $shoptheme_footer_widthl;

                    elseif ( $shoptheme_i == 1 ) :

                        $shoptheme_col = $shoptheme_footer_width2;

                    elseif ( $shoptheme_i == 2 ) :

                        $shoptheme_col = $shoptheme_footer_width3;

                    else :

                        $shoptheme_col = $shoptheme_footer_width4;

                    endif;

                    if( is_active_sidebar("shoptheme-footer-".$shoptheme_j ) ):

                ?>

                        <div class="col-md-<?php echo esc_attr( $shoptheme_col ); ?>">

                            <?php dynamic_sidebar("shoptheme-footer-".$shoptheme_j); ?>

                        </div><!--end class footermenu-->

                <?php
                    endif;

                endfor;
                ?>

            </div>
        </div>
    </div>

<?php endif; ?>