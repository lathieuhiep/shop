<?php

get_header();
global $shoptheme_options;

$shoptheme_title      = $shoptheme_options['shoptheme_404_title'];
$shoptheme_content    = $shoptheme_options['shoptheme_404_editor'];
$shoptheme_background = $shoptheme_options['shoptheme_404_background'];

?>

<div class="site-error">
    <div class="container">

        <?php if ( $shoptheme_title != '' ): ?>

            <h1 class="site-title-404">
                <?php echo esc_html( $shoptheme_title ); ?>
            </h1>

        <?php endif; ?>

        <?php if ( $shoptheme_content != '' ) : ?>

            <div id="site-error-box-header">
                <?php echo balanceTags( $shoptheme_content, true ); ?>
            </div>

        <?php endif; ?>

        <div id="site-error-box-body">
            <a href="<?php echo esc_url( get_home_url('/') ); ?>" title="<?php echo esc_html__('Go to the Home Page', 'shoptheme'); ?>">
                <?php esc_html_e('Go to the Home Page', 'shoptheme'); ?>
            </a>
        </div>
    </div>
</div>

<?php get_footer(); ?>