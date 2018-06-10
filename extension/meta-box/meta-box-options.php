<?php

add_filter( 'rwmb_meta_boxes', 'shoptheme_register_meta_boxes' );

function shoptheme_register_meta_boxes() {

    /* Start 1st meta box */
    $shoptheme_meta_boxes[] = array(
        'id'         => 'personal',
        'title'      => esc_html__( 'Personal Information', 'shoptheme' ),
        'post_types' => array( 'post' ),
        'context'    => 'normal',
        'priority'   => 'high',
        'fields' => array(
            array(
                'name'  => esc_html__( 'Full name', 'shoptheme' ),
                'desc'  => 'Format: First Last',
                'id'    => 'rw_fname',
                'type'  => 'text',
                'std'   => 'Anh Tran',
                'class' => 'custom-class',
                'clone' => true,
            ),
        )
    );
    /* End 1st meta box */

    return $shoptheme_meta_boxes;

}