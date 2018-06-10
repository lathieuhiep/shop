<?php

/**
 * General functions used to integrate this theme with WooCommerce.
 */

add_action( 'after_setup_theme', 'shoptheme_shoptheme_setup' );

function shoptheme_shoptheme_setup() {

    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );

}

/* Start limit product */
add_filter('loop_shoptheme_per_page', 'shoptheme_show_products_per_page');

function shoptheme_show_products_per_page() {

    $shoptheme_product_limit = 12;
    return $shoptheme_product_limit;

}
/* End limit product */

/*
* Lay Out shoptheme
*/

if ( ! function_exists( 'shoptheme_woo_before_main_content' ) ) :
    /**
     * Before Content
     * Wraps all WooCommerce content in wrappers which match the theme markup
     */
    function shoptheme_woo_before_main_content() {

    ?>

        <div class="site-shoptheme">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">

    <?php

    }

endif;

if ( ! function_exists( 'shoptheme_woo_after_main_content' ) ) :
    /**
     * After Content
     * Closes the wrapping divs
     */
    function shoptheme_woo_after_main_content() {

    ?>

                    </div><!-- .col-md-9 -->

                    <?php
                    /**
                     * woocommerce_sidebar hook.
                     *
                     * @hooked shoptheme_woo_sidebar - 10
                     */
                    do_action( 'shoptheme_woo_sidebar' );
                    ?>

                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .site-shoptheme -->

    <?php

    }

endif;

if ( ! function_exists( 'shoptheme_woo_before_shoptheme_loop_open' ) ) :
    /**
     * Before shoptheme Loop
     * woocommerce_before_shoptheme_loop hook.
     *
     * @hooked shoptheme_woo_before_shoptheme_loop_open - 5
     */
    function shoptheme_woo_before_shoptheme_loop_open() {

    ?>

        <div class="site-shoptheme__result-count-ordering d-flex align-items-center justify-content-between">

    <?php
    }

endif;

if ( ! function_exists( 'shoptheme_woo_before_shoptheme_loop_close' ) ) :
    /**
     * Before shoptheme Loop
     * woocommerce_before_shoptheme_loop hook.
     *
     * @hooked shoptheme_woo_before_shoptheme_loop_close - 35
     */
    function shoptheme_woo_before_shoptheme_loop_close() {

    ?>

        </div><!-- .site-shoptheme__result-count-ordering -->

    <?php
    }

endif;

/*
* Single shoptheme
*/

if ( ! function_exists( 'shoptheme_woo_before_single_product' ) ) :

    /**
     * Before Content Single  product
     *
     * woocommerce_before_single_product hook.
     *
     * @hooked shoptheme_woo_before_single_product - 5
     */

    function shoptheme_woo_before_single_product() {

    ?>

        <div class="site-shoptheme-single">

    <?php

    }

endif;

if ( ! function_exists( 'shoptheme_woo_after_single_product' ) ) :

    /**
     * After Content Single  product
     *
     * woocommerce_after_single_product hook.
     *
     * @hooked shoptheme_woo_after_single_product - 30
     */

    function shoptheme_woo_after_single_product() {

    ?>

        </div><!-- .site-shoptheme-single -->

    <?php

    }

endif;

if ( !function_exists( 'shoptheme_woo_before_single_product_summary_open_warp' ) ) :

    /**
     * Before single product summary
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked shoptheme_woo_before_single_product_summary_open_warp - 1
     */

    function shoptheme_woo_before_single_product_summary_open_warp() {

    ?>

        <div class="site-shoptheme-single__warp">

    <?php

    }

endif;

if ( !function_exists( 'shoptheme_woo_after_single_product_summary_close_warp' ) ) :

    /**
     * After single product summary
     * woocommerce_after_single_product_summary hook.
     *
     * @hooked shoptheme_woo_after_single_product_summary_close_warp - 5
     */

    function shoptheme_woo_after_single_product_summary_close_warp() {

    ?>

        </div><!-- .site-shoptheme-single__warp -->

    <?php

    }

endif;

if ( ! function_exists( 'shoptheme_woo_before_single_product_summary_open' ) ) :

    /**
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked shoptheme_woo_before_single_product_summary_open - 5
     */

    function shoptheme_woo_before_single_product_summary_open() {

    ?>

        <div class="site-shoptheme-single__gallery-box">

    <?php

    }

endif;

if ( ! function_exists( 'shoptheme_woo_before_single_product_summary_close' ) ) :

    /**
     * woocommerce_before_single_product_summary hook.
     *
     * @hooked shoptheme_woo_before_single_product_summary_close - 30
     */

    function shoptheme_woo_before_single_product_summary_close() {

    ?>

        </div><!-- .site-shoptheme-single__gallery-box -->

    <?php

    }

endif;