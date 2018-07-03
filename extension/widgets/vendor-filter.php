<?php
/*
 * Widget Filter Products by Vendor
 * */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
class shoptheme_vendor_filter_widget extends WP_Widget {
    /**
     * Sets up the widgets name etc
     */
    public function __construct() {

        $shoptheme_widget_ops = array(
            'classname'     =>  'vendor_filter_widget',
            'description'   =>  'Filter Products by Vendor',
        );

        parent::__construct( 'vendor_filter_widget', 'Filter Products by Vendor', $shoptheme_widget_ops );

    }
    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {

        if ( is_product_category() || is_shop() ) :

        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) :

            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];

        endif;

        $shoptheme_get_product_vendor          =   shoptheme_get_product_vendor();
        $shoptheme_get_product_meta_vendor_ids =   array();

        if ( is_product_category() ) :

            $shoptheme_get_product_cat_id   =   get_queried_object_id();

            foreach ( $shoptheme_get_product_vendor as $shoptheme_get_product_vendor_item ):

                $shoptheme_get_product_meta_vendor   =  get_term_meta( $shoptheme_get_product_cat_id, 'term-vendor-' . $shoptheme_get_product_vendor_item->term_id, true );

                if ( !empty( $shoptheme_get_product_meta_vendor ) ) :

                    $shoptheme_get_product_meta_vendor_ids[] .= $shoptheme_get_product_meta_vendor;

                endif;

            endforeach;

        endif;

        /* Check vendor empty */
        if ( empty( $shoptheme_get_product_meta_vendor_ids ) ) :

            foreach ( $shoptheme_get_product_vendor as $shoptheme_get_product_vendor_item ):

                $shoptheme_get_product_meta_vendor_ids[] .= $shoptheme_get_product_vendor_item->term_id;

            endforeach;

        endif;

        ?>

        <div class="sidebar-filter-shop">

            <?php

            foreach ( $shoptheme_get_product_meta_vendor_ids as $shoptheme_get_product_meta_vendor_id ) :

                $shoptheme_term_vendor = get_term( $shoptheme_get_product_meta_vendor_id, 'product_vendor' );

            ?>

                <div class="widget-filter-product-term__item">
                    <label>
                        <input class="product_vendor_check" type="checkbox" name="<?php echo esc_attr( $shoptheme_term_vendor->slug ); ?>" value="<?php echo esc_attr( $shoptheme_term_vendor->term_id ); ?>" data-filter="product_vendor" />

                        <span>
                            <?php echo esc_html( $shoptheme_term_vendor->name ); ?>
                        </span>
                    </label>
                </div>

            <?php endforeach; ?>

        </div>

        <?php if ( count( $shoptheme_get_product_meta_vendor_ids ) > 7 ) : ?>

            <span class="load-more-filter-product">
                <?php esc_html_e( 'Load More', 'shoptheme' ); ?>
            </span>

        <?php endif; ?>

        <?php

        echo $args['after_widget'];

        endif;
    }
    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {

        ?>

        <!-- Start Title -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                <?php esc_attr_e( 'Title:', 'wp-recent-posts-thumbs' ); ?>
            </label>

            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>
        <!-- End Title -->

        <?php
    }
    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    public function update( $new_instance, $old_instance ) {

        $instance = array();

        $instance['title']      =   ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

        return $instance;

    }
}

// Register recent posts thumbs widget
function shoptheme_vendor_filter_register_widget() {
    register_widget( 'shoptheme_vendor_filter_widget' );
}
add_action( 'widgets_init', 'shoptheme_vendor_filter_register_widget' );