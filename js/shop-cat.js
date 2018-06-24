/**
 * shop cat js v1.0.0
 * Copyright 2017-2020
 * Licensed under  ()
 */

( function( $ ) {

    "use strict";

    $( '.product_vendor_check, .product_collection_check' ).on( 'click', function () {

        let vendors             =   [],
            collections         =   [],
            site_shop_product   =   $( '.site-shop__product' );

        $.each( $('input[data-filter="product_vendor"]:checked'), function () {

            vendors.push($(this).val());

        });

        $.each( $('input[data-filter="product_collections"]:checked'), function () {

            collections.push($(this).val());

        });

        $('#txtValue').val(vendors + collections);

        $.ajax({

            url: load_product_cat.url,
            type: 'POST',
            data: ({

                action: 'shoptheme_filter_product_cat',
                shoptheme_vendor_ids: vendors,
                shoptheme_collection_ids: collections

            }),

            beforeSend: function () {

            },

            success: function( data ){

                if ( data ){

                    site_shop_product.empty().append(data);

                }

                setTimeout( function() {



                }, 800 );

            }

        });


    } )

} )( jQuery );