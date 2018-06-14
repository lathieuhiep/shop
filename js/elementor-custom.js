(function ($) {

    /* Start element slider */
    let ElementCarouselSlider   =   function( $scope, $ ) {

        let element_slides = $scope.find('.element-slides');

        $( document ).general_owlCarousel_item( element_slides );

    };
    /* End element slider */

    /* Start element slides product  */
    let ElementProductCarouselSlider   =   function( $scope, $ ) {

        let element_product_slides = $scope.find('.element-product-slider__warp');

        $( document ).general_multi_owlCarouse( element_product_slides );

    };
    /* End element slides product  */

    $( window ).on( 'elementor/frontend/init', function() {

        /* Element slider */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/slides-theme.default', ElementCarouselSlider  );

        /* Element slides product  */
        elementorFrontend.hooks.addAction( 'frontend/element_ready/product-slider.default', ElementProductCarouselSlider  );

    } );

})( jQuery );