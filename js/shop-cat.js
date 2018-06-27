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

        let site_shop_pagination    =   $( '.site-shop__pagination' ),
            pagination_product      =   parseInt( $(this).data( 'pagination' ) ),
            limit_product           =   parseInt( $(this).data( 'limit-product' ) ),
            remaining_product       =   parseInt( $(this).data( 'remaining-product' ) );

        $.ajax({

            url: load_product_cat.url,
            type: 'POST',
            data: ({

                action: 'shoptheme_pagination_product',
                shoptheme_page_shop: pagination_product,
                shoptheme_limit_product: limit_product

            }),

            beforeSend: function () {
                site_shop_pagination.find( '.loader-ajax').removeClass( 'loader-hide' );
            },

            success: function( data ) {

                if ( data ) {

                    let btn_load_product        =   $( '.btn-load-product' ),
                        pagination_product_plus =   pagination_product + 1,
                        total_remaining_product =   remaining_product - limit_product;

                    site_shop_pagination.find( '.loader-ajax').addClass( 'loader-hide' );

                    $( '.site-shop__product ul.products' ).append(data);

                    btn_load_product.data( 'pagination', pagination_product_plus );

                    if ( total_remaining_product > 0 ) {
                        btn_load_product.data( 'remaining-product', total_remaining_product ).find( '.total-product-remaining' ).empty().append( '(' + total_remaining_product + ')' );
                    }else {
                        site_shop_pagination.remove();
                    }

                }

                setTimeout( function() {

                    site_shop_product.find( 'ul.products li.product' ).removeClass( 'popIn' );

                }, 800 );

            }

        });

    } );

} )( jQuery );