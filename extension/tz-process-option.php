<?php
    /*
     * Method process option
     * # option 1: config font
     * # option 2: process config theme
    */
    if( !is_admin() ):

        add_action('wp_head','shoptheme_config_theme');

        function shoptheme_config_theme() {

            if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) :

                    global $shoptheme_options;
                    $shoptheme_favicon = $shoptheme_options['shoptheme_favicon_upload']['url'];

                    if( $shoptheme_favicon != '' ) :

                        echo '<link rel="shortcut icon" href="' . esc_url($shoptheme_favicon) . '" type="image/x-icon" />';

                    endif;

            endif;
        }

        // Method add custom css, Css custom add here
        // Inline css add here
        /**
         * Enqueues front-end CSS for the custom css.
         *
         * @see wp_add_inline_style()
         */

        add_action( 'wp_enqueue_scripts', 'shoptheme_custom_css', 99 );

        function shoptheme_custom_css() {

            global $shoptheme_options;

            $shoptheme_typo_selecter_1   =   $shoptheme_options['shoptheme_custom_typography_1_selector'];

            $shoptheme_typo1_font_family   =   $shoptheme_options['shoptheme_custom_typography_1']['font-family'] == '' ? '' : $shoptheme_options['shoptheme_custom_typography_1']['font-family'];

            $shoptheme_css_style = '';

            if ( $shoptheme_typo1_font_family != '' ) :
                $shoptheme_css_style .= ' '.esc_attr( $shoptheme_typo_selecter_1 ).' { font-family: '.balanceTags( $shoptheme_typo1_font_family, true ).' }';
            endif;

            if ( $shoptheme_css_style != '' ) :
                wp_add_inline_style( 'shoptheme-style', $shoptheme_css_style );
            endif;

        }

    endif;
