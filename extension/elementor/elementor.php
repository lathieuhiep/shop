<?php

namespace Elementor;

class shoptheme_plugin_elementor_widgets {

    /**
     * Plugin constructor.
     */
    public function __construct() {
        $this->shoptheme_elementor_add_actions();
    }

    private function shoptheme_elementor_add_actions() {

        add_action( 'elementor/widgets/widgets_registered', [ $this, 'shoptheme_elementor_widgets_registered' ] );
        add_action( 'elementor/init', [ $this, 'shoptheme_elementor_widgets_int' ] );

        add_action( 'elementor/preview/enqueue_styles', [$this, 'shoptheme_elementor_style_preview']);

    }

    public function shoptheme_elementor_widgets_registered() {
        $this->shoptheme_elementor_includes();
    }

    public function shoptheme_elementor_widgets_int() {
        $this->shoptheme_elementor_register_widget();
    }

    public function shoptheme_elementor_style_preview() {
        wp_enqueue_style( 'shoptheme-admin-styles', get_theme_file_uri( '/extension/assets/css/admin-styles.css' ) );
    }

    private function shoptheme_elementor_includes() {
        foreach(glob( get_parent_theme_file_path( '/extension/elementor/widgets/*.php' ) ) as $file){
            require $file;
        }
    }

    private function shoptheme_elementor_register_widget() {

        Plugin::instance()->elements_manager->add_category(
            'shoptheme-widgets',
            [
                'title' => esc_html__( 'shoptheme Widgets', 'shoptheme' ),
                'icon'  => 'icon-goes-here'
            ]
        );

    }

}

new shoptheme_plugin_elementor_widgets();