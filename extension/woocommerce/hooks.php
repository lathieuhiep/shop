<?php

/**
 * shoptheme WooCommerce Hooks
 */

add_action( 'shoptheme_woo_get_price_product', 'woocommerce_template_loop_price', 5 );
/**
 * Layout
 *
 * @see shoptheme_woo_before_main_content()
 * @see shoptheme_woo_before_shoptheme_loop_open()
 * @see shoptheme_woo_before_shoptheme_loop_close()
 * @see shoptheme_woo_before_shop_loop_item()
 * @see shoptheme_woo_after_shop_loop_item()
 * @see shoptheme_woo_after_main_content()
 */

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

add_action( 'woocommerce_before_main_content', 'shoptheme_woo_before_main_content', 10 );

add_action( 'woocommerce_before_shop_loop', 'shoptheme_woo_before_shop_loop_open',  5 );
add_action( 'woocommerce_before_shop_loop', 'shoptheme_woo_before_shop_loop_close',  35 );

add_action ( 'woocommerce_before_shop_loop_item', 'shoptheme_woo_before_shop_loop_item', 5 );
add_action ( 'woocommerce_after_shop_loop_item', 'shoptheme_woo_after_shop_loop_item', 15 );

add_action( 'shoptheme_woo_sidebar', 'woocommerce_get_sidebar', 10 );

add_action( 'woocommerce_after_main_content', 'shoptheme_woo_after_main_content', 10 );


/**
 * Single Product
 *
 * @see shoptheme_woo_before_single_product()
 * @see shoptheme_woo_before_single_product_summary_open_warp()
 * @see shoptheme_woo_before_single_product_summary_open()
 * @see shoptheme_woo_before_single_product_summary_close()
 * @see shoptheme_woo_after_single_product_summary_close_warp()
 * @see shoptheme_woo_after_single_product()
 *
 */

add_action( 'woocommerce_before_single_product', 'shoptheme_woo_before_single_product', 5 );

add_action( 'woocommerce_before_single_product_summary', 'shoptheme_woo_before_single_product_summary_open_warp',  1 );

add_action( 'woocommerce_before_single_product_summary', 'shoptheme_woo_before_single_product_summary_open', 5 );
add_action( 'woocommerce_before_single_product_summary', 'shoptheme_woo_before_single_product_summary_close', 30 );

add_action( 'woocommerce_after_single_product_summary', 'shoptheme_woo_after_single_product_summary_close_warp', 5 );

add_action( 'woocommerce_after_single_product', 'shoptheme_woo_after_single_product', 30 );

