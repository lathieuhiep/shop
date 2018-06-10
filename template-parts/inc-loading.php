<?php

global $shoptheme_options;

$shoptheme_show_loading = $shoptheme_options['shoptheme_general_show_loading'] == '' ? '0' : $shoptheme_options['shoptheme_general_show_loading'];

if(  $shoptheme_show_loading == 1 ) :

    $shoptheme_loading_url  = $shoptheme_options['shoptheme_general_image_loading']['url'];
?>

    <div id="site-loadding" class="d-flex align-items-center justify-content-center">

        <?php  if( $shoptheme_loading_url !='' ): ?>

            <img class="loading_img" src="<?php echo esc_url( $shoptheme_loading_url ); ?>" alt="<?php esc_attr_e('loading...','shoptheme') ?>"  >

        <?php else: ?>

            <img class="loading_img" src="<?php echo esc_url(get_theme_file_uri( '/images/loading.gif' )); ?>" alt="<?php esc_attr_e('loading...','shoptheme') ?>">

        <?php endif; ?>

    </div>

<?php endif; ?>