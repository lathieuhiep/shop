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

    $( '.woocommerce-pagination ul li a' ).on( 'click', function ( event  ) {

        // event.preventDefault();
        let page = set_page( $(this).clone() );
        // alert(page);

    } );

    function set_page( element ) {

        element.find('span').remove();
        return parseInt( element.html() );

    }

} )( jQuery );