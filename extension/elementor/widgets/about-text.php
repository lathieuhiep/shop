<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class shoptheme_widget_about_text extends Widget_Base {

    public function get_categories() {
        return array( 'shoptheme-widgets' );
    }

    public function get_name() {
        return 'about-text';
    }

    public function get_title() {
        return esc_html__( 'About Text', 'shoptheme' );
    }

    public function get_icon() {
        return 'eicon-text-area';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Text', 'shoptheme' ),
            ]
        );

        $this->add_control(
            'widget_title',
            [
                'label'         =>  esc_html__( 'Title', 'shoptheme' ),
                'type'          =>  Controls_Manager::TEXT,
                'default'       =>  esc_html__( 'Title About Text', 'shoptheme' ),
                'label_block'   =>  true
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_text_editor',
            [
                'label' => esc_html__( 'Text Editor', 'shoptheme' ),
            ]
        );

        $this->add_control(
            'widget_description',
            [
                'label'     =>  esc_html__( 'Description', 'shoptheme' ),
                'type'      =>  Controls_Manager::WYSIWYG,
                'default'   =>  esc_html__( 'Default description', 'shoptheme' ),
            ]
        );

        $this->end_controls_section();

        /*STYLE TAB*/
        $this->start_controls_section('style', array(
            'label' =>  esc_html__( 'Text', '' ),
            'tab'   =>  Controls_Manager::TAB_STYLE,
        ));

        $this->add_control(
            'align',
            [
                'label'     =>  esc_html__( 'Alignment Title', 'shoptheme' ),
                'type'      =>  Controls_Manager::CHOOSE,
                'options'   =>  [
                    'left'  =>  [
                        'title' =>  esc_html__( 'Left', 'shoptheme' ),
                        'icon'  =>  'fa fa-align-left',
                    ],

                    'center'    =>  [
                        'title' =>  esc_html__( 'Center', 'shoptheme' ),
                        'icon'  =>  'fa fa-align-center',
                    ],
                    'right' => [
                        'title' =>  esc_html__( 'Right', 'shoptheme' ),
                        'icon'  =>  'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .element-about-text' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     =>  __( 'Title Color', 'shoptheme' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-about-text__title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'text_editor_color',
            [
                'label'     =>  __( 'Text Editor Color', 'shoptheme' ),
                'type'      =>  Controls_Manager::COLOR,
                'selectors' =>  [
                    '{{WRAPPER}} .element-about-text__description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'hide_line',
            [
                'label'     =>  esc_html__( 'Hide Line', 'shoptheme' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'no',
                'options'   =>  [
                    'no'    =>  esc_html__( 'No', 'shoptheme' ),
                    'yes'   =>  esc_html__( 'Yes', 'shoptheme' ),
                ],
            ]
        );

        $this->add_responsive_control(
            'margin_bottom_line',
            [
                'label'     =>  esc_html__( 'Margin Bottom Line', 'shoptheme' ),
                'type'      =>  Controls_Manager::SLIDER,
                'default'   =>  [
                    'size'  =>  '',
                ],
                'range'     =>  [
                    'px'    =>  [
                        'min'   =>  10,
                        'max'   =>  600,
                    ],
                ],
                'selectors' =>  [
                    '{{WRAPPER}} .element-about-text__line' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition'     =>  [
                    'hide_line' =>  'no',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $shoptheme_widget_elmentor_settings  =   $this->get_settings();

    ?>

        <div class="element-about-text">
            <h2 class="element-about-text__title">
                <?php echo wp_kses_post( $shoptheme_widget_elmentor_settings['widget_title'] ); ?>
            </h2>

            <?php if ( $shoptheme_widget_elmentor_settings['hide_line'] == 'no' ) : ?>

                <span class="element-about-text__line">&nbsp;</span>

            <?php endif; ?>

            <?php if ( !empty( $shoptheme_widget_elmentor_settings['widget_description'] ) ) : ?>

                <div class="element-about-text__description">
                    <?php echo wp_kses_post( $shoptheme_widget_elmentor_settings['widget_description'] ); ?>
                </div>

            <?php endif; ?>
        </div>

    <?php

    }

    protected function _content_template() {

    ?>

        <div class="element-about-text">
            <h2 class="element-about-text__title">
                {{{ settings.widget_title }}}
            </h2>

            <# if ( settings.hide_line == 0 ) {#>

                <span class="element-about-text__line">&nbsp;</span>

            <# } #>

            <# if ( '' !== settings.widget_description ) {#>

                <div class="element-about-text__description">
                    {{{ settings.widget_description }}}
                </div>

            <# } #>
        </div>

    <?php
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new shoptheme_widget_about_text );