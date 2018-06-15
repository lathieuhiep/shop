<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class shoptheme_widget_product_slider extends Widget_Base {

    public function get_categories() {
        return array( 'shoptheme-widgets' );
    }

    public function get_name() {
        return 'product-slider';
    }

    public function get_title() {
        return esc_html__( 'Product Slider', 'shoptheme' );
    }

    public function get_icon() {
        return 'fa fa-shopping-cart';
    }

    public function get_script_depends() {
        return ['owl-carousel', 'shoptheme-elementor-custom'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_product',
            [
                'label' => esc_html__( 'Product Slider', 'shoptheme' ),
            ]
        );

        $this->add_control(
            'select_product_cat',
            [
                'label'     =>  esc_html__( 'Choose Product Category', 'shoptheme' ),
                'type'      =>  Controls_Manager::SELECT,
                'options'   =>  shoptheme_check_get_cat( 'product_cat' ),
                'multiple'  =>  true,
            ]
        );

        $this->add_control(
            'product_limit',
            [
                'label'     =>  esc_html__( 'Limit Product', 'shoptheme' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  15,
                'min'       =>  1,
                'max'       =>  200,
                'step'      =>  1,
            ]
        );

        $this->add_control(
            'product_order_by',
            [
                'label'     =>  esc_html__( 'Order By', 'shoptheme' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'id',
                'options'   =>  [
                    'id'    =>  esc_html__( 'ID', 'shoptheme' ),
                    'name'  =>  esc_html__( 'Name', 'shoptheme' ),
                    'date'  =>  esc_html__( 'Date', 'shoptheme' ),
                ],
            ]
        );

        $this->add_control(
            'product_order',
            [
                'label'     =>  esc_html__( 'Order', 'shoptheme' ),
                'type'      =>  Controls_Manager::SELECT,
                'default'   =>  'ASC',
                'options'   =>  [
                    'ASC'   =>  esc_html__( 'ASC', 'shoptheme' ),
                    'DESC'  =>  esc_html__( 'DESC', 'shoptheme' ),
                ],
            ]
        );

        $this->add_control(
            'number_item',
            [
                'label'     =>  esc_html__( 'Number Item Product', 'shoptheme' ),
                'type'      =>  Controls_Manager::NUMBER,
                'default'   =>  6,
                'min'       =>  1,
                'max'       =>  200,
                'step'      =>  1,
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
                'default'       =>  'yes',
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

        $this->add_control(
            'nav',
            [
                'label'         => esc_html__('nav Slider', 'shoptheme'),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => esc_html__('Yes', 'shoptheme'),
                'label_off'     => esc_html__('No', 'shoptheme'),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $shoptheme_elmentor_settings    =   $this->get_settings();
        $shoptheme_prodcut_cat_id       =   $shoptheme_elmentor_settings['select_product_cat'];
        $shoptheme_prodcut_limit        =   $shoptheme_elmentor_settings['product_limit'];
        $shoptheme_prodcut_order_by     =   $shoptheme_elmentor_settings['product_order_by'];
        $shoptheme_prodcut_order        =   $shoptheme_elmentor_settings['product_order'];

        $shoptheme_slider_settings     =   [
            'number_item'   =>  $shoptheme_elmentor_settings['number_item'],
            'loop'          =>  ( 'yes' === $shoptheme_elmentor_settings['loop'] ),
            'autoplay'      =>  ( 'yes' === $shoptheme_elmentor_settings['autoplay'] ),
            'nav'           =>  ( 'yes' === $shoptheme_elmentor_settings['nav'] ),
            'dots'          =>  ( 'yes' === $shoptheme_elmentor_settings['dots'] ),
        ];

        if ( !empty( $shoptheme_prodcut_cat_id ) ) :

            $shoptheme_product_args = array(

                'post_type'         =>  'product',
                'posts_per_page'    =>  $shoptheme_prodcut_limit,
                'orderby'           =>  $shoptheme_prodcut_order_by,
                'order'             =>  $shoptheme_prodcut_order,
                'tax_query'         =>  array(
                    array(
                        'taxonomy'  =>  'product_cat',
                        'field'     =>  'id',
                        'terms'     =>   $shoptheme_prodcut_cat_id
                    )
                )

            );

            $shoptheme_prodcut_term = get_term( $shoptheme_prodcut_cat_id[0], 'product_cat' );

        else:

            $shoptheme_product_args = array(

                'post_type'         =>  'product',
                'posts_per_page'    =>  $shoptheme_prodcut_limit,
                'orderby'           =>  $shoptheme_prodcut_order_by,
                'order'             =>  $shoptheme_prodcut_order,

            );

        endif;

        $shoptheme_product_query    =   new \ WP_Query( $shoptheme_product_args ) ;

        if ( $shoptheme_product_query->have_posts() ) :

    ?>

        <div class="element-product-slider">

            <?php if ( !empty( $shoptheme_prodcut_term ) ) : ?>

                <h2 class="element-product-term">
                    <a href="<?php echo esc_url( get_term_link( $shoptheme_prodcut_term->term_id, 'product_cat' ) ); ?>" title="<?php echo esc_attr( $shoptheme_prodcut_term->name ) ?>">
                        <?php echo esc_html( $shoptheme_prodcut_term->name ); ?>
                    </a>
                </h2>

            <?php endif; ?>

            <div class="element-product-slider__warp element-slides-nav text-center owl-carousel owl-theme" data-settings='<?php echo esc_attr( wp_json_encode( $shoptheme_slider_settings ) ); ?>'>

                <?php
                while ( $shoptheme_product_query->have_posts() ) :
                    $shoptheme_product_query->the_post();
                ?>

                    <div class="element-product-slider__item">
                        <div class="product-thumbnail">
                            <?php the_post_thumbnail( 'medium' ); ?>
                        </div>

                        <h3 class="product-title">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h3>
                    </div>

                <?php
                endwhile;
                wp_reset_postdata();
                ?>

            </div>
        </div>

    <?php

        endif;
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new shoptheme_widget_product_slider );