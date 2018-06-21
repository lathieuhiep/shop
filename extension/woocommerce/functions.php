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

    $shoptheme_product_limit = 12;
    return $shoptheme_product_limit;

}
/* End limit product */

/* Start add taxonomy woo */
add_action( 'init', 'shoptheme_register_taxonomy_woo', 10 );
function shoptheme_register_taxonomy_woo () {

    /* Start Type Product */
    $shoptheme_taxonomy_product_type = array(
        'name'              =>  _x( 'Collections', 'taxonomy general name', 'shoptheme' ),
        'singular_name'     =>  _x( 'Collections', 'taxonomy singular name', 'shoptheme' ),
        'search_items'      =>  esc_html__( 'Search Product Type', 'shoptheme' ),
        'all_items'         =>  esc_html__( 'All Product Type', 'shoptheme' ),
        'parent_item'       =>  esc_html__( 'Parent category', 'shoptheme' ),
        'parent_item_colon' =>  esc_html__( 'Parent category:', 'shoptheme' ),
        'edit_item'         =>  esc_html__( 'Edit category', 'shoptheme' ),
        'update_item'       =>  esc_html__( 'Update category', 'shoptheme' ),
        'add_new_item'      =>  esc_html__( 'Add New category', 'shoptheme' ),
        'new_item_name'     =>  esc_html__( 'New category Name', 'shoptheme' ),
        'menu_name'         =>  esc_html__( 'Collections', 'shoptheme' ),
    );
    $shoptheme_taxonomy_product_type_args = array(
        'labels'                =>  $shoptheme_taxonomy_product_type,
        'hierarchical'          =>  true,
        'public'                =>  true,
        'show_ui'               =>  true,
        'show_admin_column'     =>  true,
        'query_var'             =>  true,
        'update_count_callback' =>  '_update_post_term_count',
        'rewrite'               =>  array( 'slug' => 'product-collections' ),
    );
    register_taxonomy( 'product_collections', array( 'product' ), $shoptheme_taxonomy_product_type_args );
    /* End Type Product */

    /* Start Product Origin */
    $shoptheme_taxonomy_product_origin = array(
        'name'              =>  _x( 'Vendor', 'taxonomy general name', 'shoptheme' ),
        'singular_name'     =>  _x( 'Vendor', 'taxonomy singular name', 'shoptheme' ),
        'search_items'      =>  esc_html__( 'Search Product Vendor', 'shoptheme' ),
        'all_items'         =>  esc_html__( 'All Vendor', 'shoptheme' ),
        'parent_item'       =>  esc_html__( 'Parent category', 'shoptheme' ),
        'parent_item_colon' =>  esc_html__( 'Parent category:', 'shoptheme' ),
        'edit_item'         =>  esc_html__( 'Edit category', 'shoptheme' ),
        'update_item'       =>  esc_html__( 'Update category', 'shoptheme' ),
        'add_new_item'      =>  esc_html__( 'Add New category', 'shoptheme' ),
        'new_item_name'     =>  esc_html__( 'New category Name', 'shoptheme' ),
        'menu_name'         =>  esc_html__( 'Vendor', 'shoptheme' ),
    );
    $shoptheme_taxonomy_product_origin_args = array(
        'labels'                =>  $shoptheme_taxonomy_product_origin,
        'hierarchical'          =>  true,
        'public'                =>  true,
        'show_ui'               =>  true,
        'show_admin_column'     =>  true,
        'update_count_callback' =>  '_update_post_term_count',
        'query_var'             =>  true,
        'rewrite'               =>  array( 'slug' => 'product-vendor' ),
    );
    register_taxonomy( 'product_vendor', array( 'product' ), $shoptheme_taxonomy_product_origin_args );
    /* End Product Origin */

}
/* End add taxonomy woo */

/* Start create metabox product cat */

function shoptheme_get_product_collections() {

    return $shoptheme_get_product_collections = get_terms( 'product_collections',
        array(
            'orderby' => 'count',
            'hide_empty' => 0
        )
    );

};

// Add term page
add_action( 'product_cat_add_form_fields', 'shoptheme_product_cat_add_new_meta_field', 10, 2 );

function shoptheme_product_cat_add_new_meta_field() {

    $shoptheme_get_product_collections = shoptheme_get_product_collections();

    if ( !empty( $shoptheme_get_product_collections ) ) :
?>

    <div class="form-field">
        <label for="term-collections">
            <?php esc_html_e( 'Collections', 'shoptheme' ); ?>
        </label>

        <?php foreach ( $shoptheme_get_product_collections as $shoptheme_product_collections_item ): ?>

            <div class="form-field__item">
                <label for="term-collections-<?php echo esc_attr( $shoptheme_product_collections_item->term_id ); ?>">
                    <input type="checkbox" name="term-collections-<?php echo esc_attr( $shoptheme_product_collections_item->term_id ); ?>" value="<?php echo esc_attr( $shoptheme_product_collections_item->term_id ); ?>">

                    <?php echo esc_html( $shoptheme_product_collections_item->name ) . '&nbsp;' . '('. esc_html( $shoptheme_product_collections_item->count ) . ')'; ?>
                </label>
            </div>

        <?php endforeach; ?>
    </div>

<?php
    endif;
}

// Edit term page
add_action( 'product_cat_edit_form_fields', 'shoptheme_product_cat_edit_meta_field', 10, 2 );
function shoptheme_product_cat_edit_meta_field( $shoptheme_product_term ) {

    $t_id = $shoptheme_product_term->term_id;

    $term_meta = get_option( "taxonomy_$t_id" );

    $shoptheme_get_product_collections = shoptheme_get_product_collections();

?>

    <tr>
        <th>
            <label for="term-collections">
                <?php esc_html_e( 'Collections', 'shoptheme' ); ?>
            </label>
        </th>

        <td>
            <div class="form-field">

                <?php
                foreach ( $shoptheme_get_product_collections as $shoptheme_product_collections_item ):

                    $shoptheme_check_product_collections = get_term_meta( $shoptheme_product_term->term_id, 'term-collections-'. $shoptheme_product_collections_item->term_id, true );

                ?>

                    <div class="form-field__item">
                        <label for="term-collections-<?php echo esc_attr( $shoptheme_product_collections_item->term_id ); ?>">
                            <input type="checkbox" name="term-collections-<?php echo esc_attr( $shoptheme_product_collections_item->term_id ); ?>" value="<?php echo esc_attr( $shoptheme_product_collections_item->term_id ); ?>" <?php echo ( $shoptheme_check_product_collections ) ? checked( $shoptheme_check_product_collections, $shoptheme_product_collections_item->term_id ) : ''; ?>>

                            <?php echo esc_html( $shoptheme_product_collections_item->name ) . '&nbsp;' . '('. esc_html( $shoptheme_product_collections_item->count ) . ')'; ?>
                        </label>
                    </div>

                <?php endforeach; ?>

                <div class=""></div>

            </div>
        </td>
    </tr>

<?php

}

// Save extra taxonomy fields callback function.
function shoptheme_taxonomy_custom_meta( $shoptheme_product_term_id ) {

    $shoptheme_get_product_collections = shoptheme_get_product_collections();

    foreach ( $shoptheme_get_product_collections as $shoptheme_product_collections_item ):

        if ( isset( $_POST[ 'term-collections-'. $shoptheme_product_collections_item->term_id ] ) ) {
            update_term_meta( $shoptheme_product_term_id, 'term-collections-'. $shoptheme_product_collections_item->term_id, $shoptheme_product_collections_item->term_id );
        } else {
            update_term_meta( $shoptheme_product_term_id, 'term-collections-'. $shoptheme_product_collections_item->term_id, '' );
        }

    endforeach;

}
add_action( 'edited_product_cat', 'shoptheme_taxonomy_custom_meta', 10, 2 );
add_action( 'create_product_cat', 'shoptheme_taxonomy_custom_meta', 10, 2 );
/* End create metabox product cat */

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
                    if ( is_product_category() ) :
                        do_action( 'shoptheme_woo_product_cat_filter' );
                    else:
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

/*
* Category woo
*/

if ( !function_exists( 'shoptheme_woo_get_product_cat_filter' ) ) :

    function shoptheme_woo_get_product_cat_filter() {

    ?>

        <div class="col-md-3">
            <div class="sidebar-filter-shop"></div>
        </div>

    <?php

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