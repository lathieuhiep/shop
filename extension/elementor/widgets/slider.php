<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class shoptheme_widget_slides extends Widget_Base {
    public function get_categories() {
        return array( 'shoptheme-widgets' );
    }

    public function get_name() {
        return 'slides-theme';
    }

    public function get_title() {
        return esc_html__( 'Slides Theme', 'shoptheme' );
    }

    public function get_icon() {
        return 'eicon-slideshow';
    }

    public function get_script_depends() {
        return ['owl-carousel', 'shoptheme-elementor-custom'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Slides', 'shoptheme' ),
            ]
        );

        $this->add_control(
            'slides-list',
            [
                'label'     =>  esc_html__( 'Slides', 'shoptheme' ),
                'type'      =>  Controls_Manager::REPEATER,
                'default'   =>  [
                    [
                        'slides_title'    =>  esc_html__( 'Slider', 'shoptheme' ),
                        'slides_content'  =>  esc_html__( 'I am slide content. Click edit button to change this text', 'shoptheme' ),
                        'slides_button'   =>  esc_html__( 'Click Here', 'shoptheme' ),
                        'slides_link'     =>  '#'
                    ],
                ],

                'fields' => [
                    [
                        'name'          =>  'slides_title',
                        'label'         =>  esc_html__( 'Title', 'shoptheme' ),
                        'type'          =>  Controls_Manager::TEXT,
                        'default'       =>  esc_html__( 'Slider' , 'shoptheme' ),
                        'label_block'   =>  true,
                    ],

                    [
                        'name'      =>  'slides_image',
                        'label'     =>  esc_html__( 'Image', 'shoptheme' ),
                        'type'      =>  Controls_Manager::MEDIA,
                        'default'   =>  [
                            'url'   =>  Utils::get_placeholder_image_src(),
                        ],
                    ],

                    [
                        'name'          =>  'slides_link',
                        'label'         =>  esc_html__( 'Link', 'shoptheme' ),
                        'type'          =>  Controls_Manager::URL,
                        'label_block'   =>  true,
                        'default'       =>  [
                            'is_external'   =>  'true',
                        ],
                        'placeholder'   =>  esc_html__( 'https://your-link.com', 'shoptheme' ),
                    ],
                ],

                'title_field'   =>  '{{{ slides_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_setting_slider',
            [
                'label' => esc_html__( 'Setting Slider', 'shoptheme' ),
                'tab' => Controls_Manager::TAB_SETTINGS
            ]
        );

        $this->add_control(
            'loop',
            [
                'type'          =>  Controls_Manager::SWITCHER,
                'label'         =>  esc_html__('Loop Slider ?', 'shoptheme'),
                'label_off'     =>  esc_html__('No', 'shoptheme'),
                'label_on'      =>  esc_html__('Yes', 'shoptheme'),
                'return_value'  =>  'yes',
                'default'       =>  'no',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'         => esc_html__('Autoplay?', 'shoptheme'),
                'type'          => Controls_Manager::SWITCHER,
                'label_off'     => esc_html__('No', 'shoptheme'),
                'label_on'      => esc_html__('Yes', 'shoptheme'),
                'return_value'  => 'yes',
                'default'       => 'no',
            ]
        );

        $this->end_controls_section();
        
    }

    protected function render() {

        $shoptheme_element_settings  =   $this->get_settings_for_display();

        $shoptheme_slider_settings     =   [
            'loop'      =>  ( 'yes' === $shoptheme_element_settings['loop'] ),
            'autoplay'  =>  ( 'yes' === $shoptheme_element_settings['autoplay'] ),
        ];

    ?>

        <div class="element-slides owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $shoptheme_slider_settings ) ); ?>'>

            <?php

            foreach ( $shoptheme_element_settings['slides-list'] as $shoptheme_slides_list_item ) :
                $shoptheme_slides_image_item   =   $shoptheme_slides_list_item['slides_image'];
                $shoptheme_slides_btn_item     =   $shoptheme_slides_list_item['slides_link'];

            ?>

                <div class="element-slides__item">

                    <?php if ( !empty( $shoptheme_slides_btn_item['url'] ) ) : ?>

                        <a title="<?php echo esc_attr( $shoptheme_slides_list_item['slides_title'] ); ?>" class="element-slides__link" href="<?php echo esc_url( $shoptheme_slides_btn_item['url'] ); ?>" <?php echo ( $shoptheme_slides_btn_item['is_external'] ? 'target="_blank"' : '' ); ?>>

                            <?php echo wp_get_attachment_image( $shoptheme_slides_image_item['id'], 'full' ); ?>

                        </a>

                    <?php

                    else:
                        echo wp_get_attachment_image( $shoptheme_slides_image_item['id'], 'full' );
                    endif;

                    ?>

                </div>

            <?php endforeach; ?>

        </div>

        <?php
    }

}
Plugin::instance()->widgets_manager->register_widget_type( new shoptheme_widget_slides );