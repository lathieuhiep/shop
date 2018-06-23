/**
 * shop cat js v1.0.0
 * Copyright 2017-2020
 * Licensed under  ()
 */

( function( $ ) {

    "use strict";

    $( '.product_vendor_check, .product_collection_check' ).on( 'click', function () {

        let vendors     = [],
            collections = [];

        $.each( $('input[data-filter="product_vendor"]:checked'), function () {

            vendors.push($(this).val());

        });

        $.each( $('input[data-filter="product_collections"]:checked'), function () {

            collections.push($(this).val());

        });

        $('#txtValue').val(vendors + collections)

    } )

} )( jQuery );