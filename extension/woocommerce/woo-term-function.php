<?php
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
            'hide_empty' => 0
        )
    );

};

function shoptheme_get_product_vendor() {

    return $shoptheme_get_product_collections = get_terms( 'product_vendor',
        array(
            'hide_empty' => 0
        )
    );

};
// Add term page
add_action( 'product_cat_add_form_fields', 'shoptheme_product_cat_add_new_meta_field', 10, 2 );

function shoptheme_product_cat_add_new_meta_field() {

    $shoptheme_get_product_collections = shoptheme_get_product_collections();
    $shoptheme_get_product_vendor      = shoptheme_get_product_vendor();

    if ( !empty( $shoptheme_get_product_collections ) ) :
        ?>

        <div class="form-field">
            <label for="term-collections">
                <?php esc_html_e( 'Collections', 'shoptheme' ); ?>
            </label>

            <div class="form-field__box">
                <?php foreach ( $shoptheme_get_product_collections as $shoptheme_product_collections_item ): ?>

                    <div class="form-field__item">
                        <label for="term-collections-<?php echo esc_attr( $shoptheme_product_collections_item->term_id ); ?>">
                            <input type="checkbox" name="term-collections-<?php echo esc_attr( $shoptheme_product_collections_item->term_id ); ?>" value="<?php echo esc_attr( $shoptheme_product_collections_item->term_id ); ?>">

                            <?php echo esc_html( $shoptheme_product_collections_item->name ) . '&nbsp;' . '('. esc_html( $shoptheme_product_collections_item->count ) . ')'; ?>
                        </label>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>

    <?php
    endif;

    if ( !empty( $shoptheme_get_product_vendor ) ) :
        ?>

        <div class="form-field">
            <label for="term-collections">
                <?php esc_html_e( 'Vendor', 'shoptheme' ); ?>
            </label>

            <div class="form-field__box">
                <?php foreach ( $shoptheme_get_product_vendor as $shoptheme_get_product_vendor_item ): ?>

                    <div class="form-field__item">
                        <label for="term-vendor-<?php echo esc_attr( $shoptheme_get_product_vendor_item->term_id ); ?>">
                            <input type="checkbox" name="term-vendor-<?php echo esc_attr( $shoptheme_get_product_vendor_item->term_id ); ?>" value="<?php echo esc_attr( $shoptheme_get_product_vendor_item->term_id ); ?>">

                            <?php echo esc_html( $shoptheme_get_product_vendor_item->name ) . '&nbsp;' . '('. esc_html( $shoptheme_get_product_vendor_item->count ) . ')'; ?>
                        </label>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>

    <?php
    endif;
}

// Edit term page
add_action( 'product_cat_edit_form_fields', 'shoptheme_product_cat_edit_meta_field', 10, 2 );

function shoptheme_product_cat_edit_meta_field( $shoptheme_product_term ) {

    $shoptheme_get_product_collections = shoptheme_get_product_collections();
    $shoptheme_get_product_vendor      = shoptheme_get_product_vendor();
    ?>

    <tr>
        <th>
            <label for="term-collections">
                <?php esc_html_e( 'Collections', 'shoptheme' ); ?>
            </label>
        </th>

        <td>
            <div class="form-field form-field__edit-cat">
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
            </div>
        </td>
    </tr>

    <tr>
        <th>
            <label for="term-vendor">
                <?php esc_html_e( 'Vendor', 'shoptheme' ); ?>
            </label>
        </th>

        <td>
            <div class="form-field form-field__edit-cat">

                <?php
                foreach ( $shoptheme_get_product_vendor as $shoptheme_get_product_vendor_item ):

                    $shoptheme_check_product_vendor = get_term_meta( $shoptheme_product_term->term_id, 'term-vendor-'. $shoptheme_get_product_vendor_item->term_id, true );

                    ?>

                    <div class="form-field__item">
                        <label for="term-vendor-<?php echo esc_attr( $shoptheme_get_product_vendor_item->term_id ); ?>">
                            <input type="checkbox" name="term-vendor-<?php echo esc_attr( $shoptheme_get_product_vendor_item->term_id ); ?>" value="<?php echo esc_attr( $shoptheme_get_product_vendor_item->term_id ); ?>" <?php echo ( $shoptheme_check_product_vendor ) ? checked( $shoptheme_check_product_vendor, $shoptheme_get_product_vendor_item->term_id ) : ''; ?>>

                            <?php echo esc_html( $shoptheme_get_product_vendor_item->name ) . '&nbsp;' . '('. esc_html( $shoptheme_get_product_vendor_item->count ) . ')'; ?>
                        </label>
                    </div>

                <?php endforeach; ?>

            </div>
        </td>
    </tr>

    <?php

}

// Save extra taxonomy fields callback function.
function shoptheme_taxonomy_custom_meta( $shoptheme_product_term_id ) {

    $shoptheme_get_product_collections = shoptheme_get_product_collections();
    $shoptheme_get_product_vendor      = shoptheme_get_product_vendor();

    foreach ( $shoptheme_get_product_collections as $shoptheme_product_collections_item ):

        if ( isset( $_POST[ 'term-collections-'. $shoptheme_product_collections_item->term_id ] ) ) {
            update_term_meta( $shoptheme_product_term_id, 'term-collections-'. $shoptheme_product_collections_item->term_id, $shoptheme_product_collections_item->term_id );
        } else {
            update_term_meta( $shoptheme_product_term_id, 'term-collections-'. $shoptheme_product_collections_item->term_id, '' );
        }

    endforeach;

    foreach ( $shoptheme_get_product_vendor as $shoptheme_get_product_vendor_item ):

        if ( isset( $_POST[ 'term-vendor-'. $shoptheme_get_product_vendor_item->term_id ] ) ) {
            update_term_meta( $shoptheme_product_term_id, 'term-vendor-'. $shoptheme_get_product_vendor_item->term_id, $shoptheme_get_product_vendor_item->term_id );
        } else {
            update_term_meta( $shoptheme_product_term_id, 'term-vendor-'. $shoptheme_get_product_vendor_item->term_id, '' );
        }

    endforeach;

}
add_action( 'edited_product_cat', 'shoptheme_taxonomy_custom_meta', 10, 2 );
add_action( 'create_product_cat', 'shoptheme_taxonomy_custom_meta', 10, 2 );
/* End create metabox product cat */

/*
* Category woo
*/

if ( !function_exists( 'shoptheme_woo_get_product_cat_filter' ) ) :

    function shoptheme_woo_get_product_cat_filter() {

        $shoptheme_get_product_cat_id               =   get_queried_object_id();
        $shoptheme_get_product_collections          =   shoptheme_get_product_collections();
        $shoptheme_get_product_vendor               =   shoptheme_get_product_vendor();
        $shoptheme_get_product_meta_collections_ids =   $shoptheme_get_product_meta_vendor_ids = array();

        /* Collections */
        foreach ( $shoptheme_get_product_collections as $shoptheme_get_product_collections_item ):

            $shoptheme_get_product_meta_collections   =  get_term_meta( $shoptheme_get_product_cat_id, 'term-collections-' . $shoptheme_get_product_collections_item->term_id, true );

            if ( !empty( $shoptheme_get_product_meta_collections ) ) :

                $shoptheme_get_product_meta_collections_ids[] .= $shoptheme_get_product_meta_collections;

            endif;

        endforeach;

        /* Vendor */
        foreach ( $shoptheme_get_product_vendor as $shoptheme_get_product_vendor_item ):

            $shoptheme_get_product_meta_vendor   =  get_term_meta( $shoptheme_get_product_cat_id, 'term-vendor-' . $shoptheme_get_product_vendor_item->term_id, true );

            if ( !empty( $shoptheme_get_product_meta_vendor ) ) :

                $shoptheme_get_product_meta_vendor_ids[] .= $shoptheme_get_product_meta_vendor;

            endif;

        endforeach;

        ?>

        <div class="col-md-3">
            <div class="sidebar-filter-shop" data-product-cat="<?php echo esc_attr( $shoptheme_get_product_cat_id ); ?>">
                <!-- Vendor -->
                <aside class="widget widget-filter-product-term">
                    <h2 class="widget-title">
                        <?php esc_html_e( 'Vendor', 'shoptheme' ); ?>
                    </h2>

                    <?php
                    foreach ( $shoptheme_get_product_meta_vendor_ids as $shoptheme_get_product_meta_vendor_id ) :
                        $shoptheme_term_vendor = get_term( $shoptheme_get_product_meta_vendor_id, 'product_vendor' );
                    ?>

                        <div class="widget-filter-product-term__item">
                            <label>
                                <input class="product_vendor_check" type="checkbox" name="<?php echo esc_attr( $shoptheme_term_vendor->slug ); ?>" value="<?php echo esc_attr( $shoptheme_term_vendor->term_id ); ?>" data-filter="product_vendor" />

                                <span>
                                    <?php echo esc_html( $shoptheme_term_vendor->name ); ?>
                                </span>
                            </label>
                        </div>

                    <?php endforeach; ?>
                </aside>

                <!-- Collections -->
                <aside class="widget widget-filter-product-term">
                    <h2 class="widget-title">
                        <?php esc_html_e( 'Collections', 'shoptheme' ); ?>
                    </h2>

                    <?php
                    foreach ( $shoptheme_get_product_meta_collections_ids as $shoptheme_get_product_meta_collections_id ) :
                        $shoptheme_term_collection = get_term( $shoptheme_get_product_meta_collections_id, 'product_collections' );
                    ?>

                        <div class="widget-filter-product-term__item">
                            <label>
                                <input class="product_collection_check" type="checkbox" name="<?php echo esc_attr( $shoptheme_term_collection->slug ); ?>" value="<?php echo esc_attr( $shoptheme_term_collection->term_id ); ?>" data-filter="product_collections" />

                                <span>
                                    <?php echo esc_html( $shoptheme_term_collection->name ); ?>
                                </span>
                            </label>
                        </div>

                    <?php endforeach; ?>
                </aside>
            </div>
        </div>

        <?php

    }

endif;

/*
* Start ajax filter product cat
*/
add_action( 'wp_ajax_nopriv_shoptheme_filter_product_cat', 'shoptheme_filter_product_cat' );
add_action( 'wp_ajax_shoptheme_filter_product_cat', 'shoptheme_filter_product_cat' );

function shoptheme_filter_product_cat() {

    $shoptheme_product_cat_id   =   $_POST['shoptheme_product_cat_id'];
    $shoptheme_vendor_ids       =   $_POST['shoptheme_vendor_ids'];
    $shoptheme_collection_ids   =   $_POST['shoptheme_collection_ids'];

    $shoptheme_product_wc_query        =   new WC_Query();
    $shoptheme_product_ordering        =   $shoptheme_product_wc_query -> get_catalog_ordering_args();

    $shoptheme_product_orderby         =   $shoptheme_product_ordering['orderby'];
    $shoptheme_product_order           =   $shoptheme_product_ordering['order'] ;
    $shoptheme_product_order_meta_key  =   '';

    if ( isset( $shoptheme_product_ordering['meta_key'] ) ) {
        $shoptheme_product_order_meta_key  =   $shoptheme_product_ordering['meta_key'];
    }

    if ( !empty( $shoptheme_vendor_ids ) && !empty( $shoptheme_collection_ids ) ) :

        $shoptheme_filter_tax_query =   array(
            'relation' => 'AND',

            array(
                'taxonomy'  =>  'product_vendor',
                'field'     =>  'id',
                'terms'     =>  $shoptheme_vendor_ids
            ),

            array(
                'taxonomy'  =>  'product_collections',
                'field'     =>  'id',
                'terms'     =>  $shoptheme_collection_ids
            ),

        );

    elseif ( !empty( $shoptheme_vendor_ids ) && empty( $shoptheme_collection_ids ) ):

        $shoptheme_filter_tax_query =   array(

            array(
                'taxonomy'  =>  'product_vendor',
                'field'     =>  'id',
                'terms'     =>  $shoptheme_vendor_ids
            ),

        );

    elseif( empty( $shoptheme_vendor_ids ) && !empty( $shoptheme_collection_ids ) ):

        $shoptheme_filter_tax_query =   array(

            array(
                'taxonomy'  =>  'product_collections',
                'field'     =>  'id',
                'terms'     =>  $shoptheme_collection_ids
            ),

        );

    else:

        $shoptheme_filter_tax_query =   array(

            array(
                'taxonomy'  =>  'product_cat',
                'field'     =>  'id',
                'terms'     =>  $shoptheme_product_cat_id
            ),

        );

    endif;

    $shoptheme_filter_product_args  =   array(
        'post_type'         =>  'product',
        'posts_per_page'    =>  12,
        'orderby'           =>  $shoptheme_product_orderby,
        'order'             =>  $shoptheme_product_order,
        'meta_key'          =>  $shoptheme_product_order_meta_key,
        'tax_query'         =>  $shoptheme_filter_tax_query
    );

    $shoptheme_filter_product_query =   new WP_Query( $shoptheme_filter_product_args );

    woocommerce_product_loop_start();

    while ( $shoptheme_filter_product_query->have_posts() ):
        $shoptheme_filter_product_query->the_post();
        do_action( 'woocommerce_shop_loop' );

        wc_get_template_part( 'content', 'product' );
    endwhile;

    woocommerce_product_loop_end();
    exit();

}