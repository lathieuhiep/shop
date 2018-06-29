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
    global $shoptheme_options;

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

/* Start Sidebar Shop */
if ( ! function_exists( 'shoptheme_woo_get_sidebar' ) ) :

    function shoptheme_woo_get_sidebar() {

         if( is_active_sidebar( 'shoptheme-sidebar-wc' ) ):
 ?>

            <aside class="col-md-3">
                <?php dynamic_sidebar( 'shoptheme-sidebar-wc' ); ?>
            </aside>

<?php
         endif;
    }

endif;
/* End Sidebar Shop */

/*
* Lay Out woo
*/

if ( ! function_exists( 'shoptheme_woo_before_main_content' ) ) :
    /**
     * Before Content
     * Wraps all WooCommerce content in wrappers which match the theme markup
     */
    function shoptheme_woo_before_main_content() {
        global $shoptheme_options;
        $shoptheme_sidebar_woo_position = $shoptheme_options['shoptheme_sidebar_woo'];
    ?>

        <div class="site-shop">
            <div class="container">
                <div class="row">
                    <?php
                    /**
                     * woocommerce_sidebar hook.
                     *
                     * @hooked shoptheme_woo_sidebar - 10
                     */

                    if ( $shoptheme_sidebar_woo_position == 'left' ) :
                        do_action( 'shoptheme_woo_sidebar' );
                    endif;
                    ?>

                    <div class="<?php echo is_active_sidebar( 'shoptheme-sidebar-wc' ) && $shoptheme_sidebar_woo_position != 'hide' ? 'col-md-9' : 'col-md-12'; ?>">
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
        global $shoptheme_options;
        $shoptheme_sidebar_woo_position = $shoptheme_options['shoptheme_sidebar_woo'];
    ?>
                        </div>
                    </div><!-- .col-md-9 or col-md-12 -->

                    <?php
                    /**
                     * woocommerce_sidebar hook.
                     *
                     * @hooked shoptheme_woo_sidebar - 10
                     */

                    if ( $shoptheme_sidebar_woo_position == 'right' ) :
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

    function shoptheme_woo_pagination_ajax( $shoptheme_ajax_query ) {

        $shoptheme_product_limit        =   shoptheme_show_products_per_page();
        $shoptheme_data_cat_product     =   '';
        $shoptheme_woo_total_pages      =   wc_get_loop_prop( 'total_pages' );
        $shoptheme_woo_total_product    =   wc_get_loop_prop( 'total' );
        $shoptheme_woo_orderby          =   $_GET['orderby'];

        if ( !empty( $shoptheme_ajax_query ) ) :

            $shoptheme_woo_total_pages      =   $shoptheme_ajax_query->max_num_pages;
            $shoptheme_woo_total_product    =   $shoptheme_ajax_query->found_posts;

        endif;

        if ( is_product_category() ) :
            $shoptheme_data_cat_product =   ' data-cat-id='. get_queried_object_id() .'';
        endif;

        if ( $shoptheme_woo_total_pages > 1 ) :

            $shoptheme_woo_total_product_remaining  =   $shoptheme_woo_total_product - $shoptheme_product_limit;
?>

        <div class="site-shop__pagination text-center">
            <div class="loader-ajax loader-hide"></div>

            <button class="btn-global btn-load-product" data-pagination="2" data-orderby="<?php echo esc_attr( $shoptheme_woo_orderby ); ?>" data-limit-product="<?php echo esc_attr( $shoptheme_product_limit ); ?>" data-remaining-product="<?php echo esc_attr( $shoptheme_woo_total_product_remaining ); ?>" <?php echo esc_attr( $shoptheme_data_cat_product ); ?>>
                <?php esc_html_e( 'See more products', 'shoptheme' ); ?>

                <span class="total-product-remaining">
                    ( <?php echo esc_html( $shoptheme_woo_total_product_remaining ); ?> )
                </span>
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

    $shoptheme_page_shop        =   $_POST['shoptheme_page_shop'];
    $shoptheme_orderby_product  =   $_POST['shoptheme_orderby_product'];
    $shoptheme_limit_product    =   $_POST['shoptheme_limit_product'];
    $shoptheme_product_cat_id   =   $_POST['shoptheme_product_cat_id'];

    if ( !empty( $shoptheme_orderby_product ) ) :

        $shoptheme_orderby_value = explode( '-', $shoptheme_orderby_product );
        $shoptheme_orderby       = esc_attr( $shoptheme_orderby_value[0] );
        $shoptheme_order         = ! empty( $shoptheme_orderby_value[1] ) ? $shoptheme_orderby_value[1] : '';

        $shoptheme_product_ordering =   wc()->query->get_catalog_ordering_args( $shoptheme_orderby, $shoptheme_order );

    else:
        $shoptheme_product_ordering =   wc()->query->get_catalog_ordering_args();
    endif;

    $shoptheme_product_orderby         =   $shoptheme_product_ordering['orderby'];
    $shoptheme_product_order           =   $shoptheme_product_ordering['order'] ;
    $shoptheme_product_order_meta_key  =   '';

    if ( isset( $shoptheme_product_ordering['meta_key'] ) ) {
        $shoptheme_product_order_meta_key  =   $shoptheme_product_ordering['meta_key'];
    }

    if ( !empty( $shoptheme_product_cat_id ) ) :

        $shoptheme_load_product_args  =   array(
            'post_type'         =>  'product',
            'paged'             =>  $shoptheme_page_shop,
            'posts_per_page'    =>  $shoptheme_limit_product,
            'orderby'           =>  $shoptheme_product_orderby,
            'order'             =>  $shoptheme_product_order,
            'meta_key'          =>  $shoptheme_product_order_meta_key,
            'tax_query'         =>  array(
                array(
                    'taxonomy'  =>  'product_cat',
                    'field'     =>  'id',
                    'terms'     =>  $shoptheme_product_cat_id
                ),
            )
        );

    else:

        $shoptheme_load_product_args  =   array(
            'post_type'         =>  'product',
            'paged'             =>  $shoptheme_page_shop,
            'posts_per_page'    =>  $shoptheme_limit_product,
            'orderby'           =>  $shoptheme_product_orderby,
            'order'             =>  $shoptheme_product_order,
            'meta_key'          =>  $shoptheme_product_order_meta_key,
        );

    endif;

    $shoptheme_load_product_query =   new WP_Query( $shoptheme_load_product_args );

    while ( $shoptheme_load_product_query->have_posts() ):
        $shoptheme_load_product_query->the_post();
        do_action( 'woocommerce_shop_loop' );

?>

        <li <?php wc_product_class( 'popIn' ); ?>>
            <?php
            /**
             * Hook: woocommerce_before_shop_loop_item.
             *
             * @hooked woocommerce_template_loop_product_link_open - 10
             */
            do_action( 'woocommerce_before_shop_loop_item' );

            /**
             * Hook: woocommerce_before_shop_loop_item_title.
             *
             * @hooked woocommerce_show_product_loop_sale_flash - 10
             * @hooked woocommerce_template_loop_product_thumbnail - 10
             */
            do_action( 'woocommerce_before_shop_loop_item_title' );

            /**
             * Hook: woocommerce_shop_loop_item_title.
             *
             * @hooked woocommerce_template_loop_product_title - 10
             */
            do_action( 'woocommerce_shop_loop_item_title' );

            /**
             * Hook: woocommerce_after_shop_loop_item_title.
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action( 'woocommerce_after_shop_loop_item_title' );

            /**
             * Hook: woocommerce_after_shop_loop_item.
             *
             * @hooked woocommerce_template_loop_product_link_close - 5
             * @hooked woocommerce_template_loop_add_to_cart - 10
             */
            do_action( 'woocommerce_after_shop_loop_item' );
            ?>
        </li>

<?php
    endwhile;
    exit();

}