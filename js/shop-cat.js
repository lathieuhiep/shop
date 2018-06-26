/**
 * shop cat js v1.0.0
 * Copyright 2017-2020
 * Licensed under  ()
 */

( function( $ ) {

    "use strict";

    let product_cat_id      =   $( '.sidebar-filter-shop' ).data( 'product-cat' ),
        site_shop_product   =   $( '.site-shop__product' );

    $( '.product_vendor_check, .product_collection_check' ).on( 'click', function () {

        let vendors     =   [],
            collections =   [];

        $.each( $('input[data-filter="product_vendor"]:checked'), function () {

            vendors.push($(this).val());

        });

        $.each( $('input[data-filter="product_collections"]:checked'), function () {

            collections.push($(this).val());

        });

        $.ajax({

            url: load_product_cat.url,
            type: 'POST',
            data: ({

                action: 'shoptheme_filter_product_cat',
                shoptheme_product_cat_id: product_cat_id,
                shoptheme_vendor_ids: vendors,
                shoptheme_collection_ids: collections

            }),

            beforeSend: function () {
                site_shop_product.find( 'ul.products' ).addClass( 'product-opacity' );
            },

            success: function( data ){

                if ( data ){

                    site_shop_product.empty().append(data).find( 'ul.products li.product' ).addClass( 'popIn' );

                }

                setTimeout( function() {

                    site_shop_product.find( 'ul.products li.product' ).removeClass( 'popIn' );

                }, 800 );

            }

        });


    } );

    $( '.btn-load-product' ).on( 'click', function () {

        let pagination_product  =   $(this).data( 'pagination' ),
            limit_product       =   $(this).data( 'limit-product' );

        $.ajax({

            url: load_product_cat.url,
            type: 'POST',
            data: ({

                action: 'shoptheme_pagination_product',
                shoptheme_page_shop: pagination_product,
                shoptheme_limit_product: limit_product

            }),

            beforeSend: function () {

            },

            success: function( data ){

                if ( data ){

                    $( '.site-shop__product ul.products' ).append(data).find( 'li.product' );
                    $( '.btn-load-product' ).data( 'pagination', pagination_product + 1 );

                }

                setTimeout( function() {



                }, 800 );

            }

        });

    } );

} )( jQuery );