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
add_filter('loop_shop_per_page', 'shoptheme_show_products_per_page');

function shoptheme_show_products_per_page() {
    global $shoptheme_options, $shoptheme_product_limit;

    $shoptheme_product_limit = $shoptheme_options['shoptheme_product_limit'];

    return $shoptheme_product_limit;

}
/* End limit product */

/* Start Change number or products per row */
add_filter('loop_shop_columns', 'shoptheme_loop_columns_product');

function shoptheme_loop_columns_product() {
    global $shoptheme_options;

    $shoptheme_products_per_row = $shoptheme_options['shoptheme_products_per_row'];

    return $shoptheme_products_per_row;
}
/* End Change number or products per row */

/*
* Lay Out woo
*/

if ( ! function_exists( 'shoptheme_woo_before_main_content' ) ) :
    /**
     * Before Content
     * Wraps all WooCommerce content in wrappers which match the theme markup
     */
    function shoptheme_woo_before_main_content() {

    ?>

        <div class="site-shop">
            <div class="container">
                <div class="row">
                    <?php
                        if ( is_product_category() ) :
                            do_action( 'shoptheme_woo_product_cat_filter' );
                        endif;
                    ?>

                    <div class="col-md-9">
                        <div class="site-shop__box">

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
                        </div>
                    </div><!-- .col-md-9 -->

                    <?php
                    /**
                     * woocommerce_sidebar hook.
                     *
                     * @hooked shoptheme_woo_sidebar - 10
                     */
                    if ( !is_product_category() ) :
                        do_action( 'shoptheme_woo_sidebar' );
                    endif;

                    ?>

                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .site-shop -->

    <?php

    }

endif;

if ( ! function_exists( 'shoptheme_woo_before_shop_loop_open' ) ) :
    /**
     * Before shoptheme Loop
     * woocommerce_before_shop_loop hook.
     *
     * @hooked shoptheme_woo_before_shop_loop_open - 5
     */
    function shoptheme_woo_before_shop_loop_open() {

    ?>

        <div class="site-shop__result-count-ordering d-flex align-items-center justify-content-between">

    <?php
    }

endif;

if ( ! function_exists( 'shoptheme_woo_before_shop_loop_close' ) ) :
    /**
     * Before shop loop
     * woocommerce_before_shop_loop hook.
     *
     * @hooked shoptheme_woo_before_shop_loop_close - 35
     */
    function shoptheme_woo_before_shop_loop_close() {

    ?>

        </div><!-- .site-shop__result-count-ordering -->

    <?php
    }

endif;

if ( ! function_exists( 'shoptheme_woo_before_shop_loop_product' ) ) :
    /**
     * Hook: woocommerce_before_shop_loop.
     *
     * @hooked shoptheme_woo_before_shop_loop_product - 35
     */

    function shoptheme_woo_before_shop_loop_product() {
?>

        <div class="site-shop__product">

<?php
    }
endif;

if ( ! function_exists( 'shoptheme_woo_after_shop_loop_product' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop.
     *
     * @hooked shoptheme_woo_after_shop_loop_product - 15
     */

    function shoptheme_woo_after_shop_loop_product() {
?>

        </div><!-- .site-shop__product -->

<?php
    }
endif;

if ( ! function_exists( 'shoptheme_woo_before_shop_loop_item' ) ) :
    /**
     * Hook: woocommerce_before_shop_loop_item.
     *
     * @hooked shoptheme_woo_before_shop_loop_item - 5
     */
    function shoptheme_woo_before_shop_loop_item() {
?>

    <div class="site-shop__product--item">

<?php
    }
endif;

if ( ! function_exists( 'shoptheme_woo_after_shop_loop_item' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop_item.
     *
     * @hooked shoptheme_woo_after_shop_loop_item - 15
     */
    function shoptheme_woo_after_shop_loop_item() {
?>

    </div><!-- .site-shop__product--item -->

<?php
    }
endif;

if ( ! function_exists( 'shoptheme_woo_pagination_ajax' ) ) :
    /**
     * Hook: woocommerce_after_shop_loop.
     *
     * @hooked shoptheme_woo_pagination_ajax - 10
     */

    function shoptheme_woo_pagination_ajax() {
        global $shoptheme_product_limit;

        $shoptheme_woo_total_pages      =   wc_get_loop_prop( 'total_pages' );

        if ( $shoptheme_woo_total_pages > 1 ) :

            $shoptheme_woo_total_product            =   wc_get_loop_prop( 'total' );
            $shoptheme_woo_total_product_remaining  =   $shoptheme_woo_total_product - $shoptheme_product_limit;
?>

        <div class="site-shop__pagination">
            <button class="btn-global btn-load-product" data-pagination="2" data-limit-product="<?php echo esc_attr( $shoptheme_product_limit ); ?>">
                <?php esc_html_e( 'See more', 'shoptheme' ); echo ' ' . esc_html( $shoptheme_woo_total_product_remaining ) . ' '; esc_html_e( 'products', 'shoptheme' );  ?>
            </button>
        </div>

<?php
        endif;
    }

endif;

/*
* Single woo
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

        <div class="site-shop-single">

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

        </div><!-- .site-shop-single -->

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

        <div class="site-shop-single__warp">

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

        </div><!-- .site-shop-single__warp -->

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

        <div class="site-shop-single__gallery-box">

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

        </div><!-- .site-shop-single__gallery-box -->

    <?php

    }

endif;

/*
* Start pagination ajax
*/
add_action( 'wp_ajax_nopriv_shoptheme_pagination_product', 'shoptheme_pagination_product' );
add_action( 'wp_ajax_shoptheme_pagination_product', 'shoptheme_pagination_product' );

function shoptheme_pagination_product() {

    $shoptheme_page_shop   =   $_POST['shoptheme_page_shop'];
    $shoptheme_limit_product   =   $_POST['shoptheme_limit_product'];

    $shoptheme_product_wc_query        =   new WC_Query();
    $shoptheme_product_ordering        =   $shoptheme_product_wc_query -> get_catalog_ordering_args();
    $shoptheme_product_orderby         =   $shoptheme_product_ordering['orderby'];
    $shoptheme_product_order           =   $shoptheme_product_ordering['order'] ;
    $shoptheme_product_order_meta_key  =   '';

    if ( isset( $shoptheme_product_ordering['meta_key'] ) ) {
        $shoptheme_product_order_meta_key  =   $shoptheme_product_ordering['meta_key'];
    }

    $shoptheme_load_product_args  =   array(
        'post_type'         =>  'product',
        'paged'             =>  $shoptheme_page_shop,
        'posts_per_page'    =>  $shoptheme_limit_product,
        'orderby'           =>  $shoptheme_product_orderby,
        'order'             =>  $shoptheme_product_order,
        'meta_key'          =>  $shoptheme_product_order_meta_key,
    );

    $shoptheme_load_product_query =   new WP_Query( $shoptheme_load_product_args );

    while ( $shoptheme_load_product_query->have_posts() ):
        $shoptheme_load_product_query->the_post();
        do_action( 'woocommerce_shop_loop' );

        wc_get_template_part( 'content', 'product' );
    endwhile;
    exit();

}