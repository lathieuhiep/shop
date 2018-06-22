<?php

if ( ! defined( 'ABSPATH' ) ) exit;

/*
 *constants
 */
if( !function_exists('shoptheme_setup') ):

    function shoptheme_setup() {

        /**
         * Set the content width based on the theme's design and stylesheet.
         */
        global $content_width;
        if ( ! isset( $content_width ) )
            $content_width = 900;

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         */
        load_theme_textdomain( 'shoptheme', get_parent_theme_file_path( '/languages' ) );

        /**
         * theme setup.
         *
         * Set up theme defaults and registers support for various WordPress features.
         *
         * Note that this function is hooked into the after_setup_theme hook, which
         * runs before the init hook. The init hook is too late for some features, such
         * as indicating support post thumbnails.
         *
         */
        //Enable support for Header (tz-demo)
        add_theme_support( 'custom-header' );

        //Enable support for Background (tz-demo)
        add_theme_support( 'custom-background' );

        //Enable support for Post Thumbnails
        add_theme_support('post-thumbnails');

        // Add RSS feed links to <head> for posts and comments.
        add_theme_support( 'automatic-feed-links' );

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menu('primary','Primary Menu');
        register_nav_menu('footer-menu','Footer Menu');

        // add theme support title-tag
        add_theme_support( 'title-tag' );

        /*  Post Type   */
        add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio' ) );

        /*
	    * This theme styles the visual editor to resemble the theme style,
	    * specifically font, colors, icons, and column width.
	    */
        add_editor_style( array( 'css/editor-style.css', shoptheme_fonts_url()) );
    }

    add_action( 'after_setup_theme', 'shoptheme_setup' );

endif;

/*
* Required: include plugin theme scripts
*/
require get_parent_theme_file_path( '/extension/tz-process-option.php' );

if ( class_exists( 'ReduxFramework' ) ) {
    /*
     * Required: Redux Framework
     */
    require get_parent_theme_file_path( '/extension/option-reudx/theme-options.php' );
}

if ( class_exists( 'RW_Meta_Box' ) ) {
    /*
     * Required: Meta Box Framework
     */
    require get_parent_theme_file_path( '/extension/meta-box/meta-box-options.php' );
}

if ( ! function_exists( 'shoptheme_check_rwmb_meta' ) ) {
    function shoptheme_check_rwmb_meta( $shoptheme_rwmb_metakey, $shoptheme_opt_args = '', $shoptheme_rwmb_post_id = null ) {
        return false;
    }
}

if ( ! function_exists( '_is_elementor_installed' ) ) :
    /*
     * Required: Elementor
     */
    require get_parent_theme_file_path( '/extension/elementor/elementor.php' );

endif;

if ( class_exists('Woocommerce') ) :
    /*
     * Required: Woocommerce
     */
    require get_parent_theme_file_path( '/extension/woocommerce/hooks.php' );
    require get_parent_theme_file_path( '/extension/woocommerce/functions.php' );

endif;


/**
 * Register Sidebar
 */
add_action( 'widgets_init', 'shoptheme_widgets_init');

function shoptheme_widgets_init() {

    $shoptheme_widgets_arr  =   array(

        'shoptheme-sidebar'     =>  array(
            'name'              =>  esc_html__( 'Sidebar', 'shoptheme' ),
            'description'       =>  esc_html__( 'Display sidebar right or left on all page.', 'shoptheme' )
        ),

        'shoptheme-footer-1'    =>  array(
            'name'              =>  esc_html__( 'Footer 1', 'shoptheme' ),
            'description'       =>  esc_html__('Display footer column 1 on all page.', 'shoptheme' )
        ),

        'shoptheme-footer-2'    =>  array(
            'name'              =>  esc_html__( 'Footer 2', 'shoptheme' ),
            'description'       =>  esc_html__('Display footer column 2 on all page.', 'shoptheme' )
        ),

        'shoptheme-footer-3'    =>  array(
            'name'              =>  esc_html__( 'Footer 3', 'shoptheme' ),
            'description'       =>  esc_html__('Display footer column 3 on all page.', 'shoptheme' )
        ),

        'shoptheme-footer-4'    =>  array(
            'name'              =>  esc_html__( 'Footer 4', 'shoptheme' ),
            'description'       =>  esc_html__('Display footer column 4 on all page.', 'shoptheme' )
        )

    );

    foreach ( $shoptheme_widgets_arr as $shoptheme_widgets_id => $shoptheme_widgets_value ) :

        register_sidebar( array(
            'name'          =>  esc_attr( $shoptheme_widgets_value['name'] ),
            'id'            =>  esc_attr( $shoptheme_widgets_id ),
            'description'   =>  esc_attr( $shoptheme_widgets_value['description'] ),
            'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  =>  '</aside>',
            'before_title'  =>  '<h2 class="widget-title">',
            'after_title'   =>  '</h2>'
        ));

    endforeach;

}

//Register Back-End script
add_action('admin_enqueue_scripts', 'shoptheme_register_back_end_scripts');

function shoptheme_register_back_end_scripts(){

    /* Start Get CSS Admin */
    wp_enqueue_style( 'shoptheme-admin-styles', get_theme_file_uri( '/extension/assets/css/admin-styles.css' ) );

}

//Register Front-End Styles
add_action( 'wp_enqueue_scripts', 'shoptheme_register_front_end' );

function shoptheme_register_front_end() {

    /*
    * Start Get Css Front End
    * */

    /* Start Bootstrap Css */
    wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/css/bootstrap.min.css' ), array(), '4.0.0' );
    /* End Bootstrap Css */

    /* Start Font Awesome */
    wp_enqueue_style( 'font-awesome', get_theme_file_uri( '/css/font-awesome.min.css' ), array(), '4.7.0' );
    /* End Font Awesome */

    /* Start Font */
    wp_enqueue_style( 'shoptheme-fonts', shoptheme_fonts_url(), array(), null );
    /* End Font */

    /* Start Carousel Css */
    wp_enqueue_style( 'owl-carousel', get_theme_file_uri( '/css/owl.carousel.min.css' ), array(), '2.3.4' );
//    wp_enqueue_style( 'owl-theme-default', get_theme_file_uri( '/css/owl.theme.default.min.css' ), array(), '2.3.4' );
    /* End Carousel Css */

    /*  Start Style Css   */
    wp_enqueue_style( 'shoptheme-style', get_stylesheet_uri() );
    /*  Start Style Css   */

    /*
    * End Get Css Front End
    * */


    /*
    * Start Get Js Front End
    * */

    // Load the html5 shiv.

    wp_enqueue_script( 'html5', get_theme_file_uri( '/js/html5.js' ), array(), '3.7.0' );
    wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

    wp_enqueue_script( 'bootstrap', get_theme_file_uri( '/js/bootstrap.min.js' ), array('jquery'), '4.0.0', true );

    /* Start Carousel Js */
    wp_register_script( 'owl-carousel', get_theme_file_uri( '/js/owl.carousel.min.js' ), array(), '2.3.4', true );

    if( is_single() || is_tag() || is_category() || is_archive() || is_author() || is_search() || is_home() ) :

        wp_enqueue_script( 'owl-carousel' );

    endif;
    /* End Carousel Js */

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    wp_enqueue_script( 'shoptheme-custom', get_theme_file_uri( '/js/custom.js' ), array(), '1.0.0', true );

    if ( class_exists('Woocommerce') ) :

        if ( is_product_category() ) :

            wp_enqueue_script( 'shop-cat', get_theme_file_uri( '/js/shop-cat.js' ), array(), '1.0.0', true );

        endif;

    endif;

    /*
   * End Get Js Front End
   * */

}

/**
 * Show full editor
 */
if ( !function_exists('shoptheme_ilc_mce_buttons') ) :

    function shoptheme_ilc_mce_buttons( $shoptheme_buttons_TinyMCE ) {

        array_push( $shoptheme_buttons_TinyMCE,
                "backcolor",
                "anchor",
                "hr",
                "sub",
                "sup",
                "fontselect",
                "fontsizeselect",
                "styleselect",
                "cleanup"
            );

        return $shoptheme_buttons_TinyMCE;

    }

    add_filter("mce_buttons_2", "shoptheme_ilc_mce_buttons");

endif;

// Start Customize mce editor font sizes
if ( ! function_exists( 'shoptheme_mce_text_sizes' ) ) :

    function shoptheme_mce_text_sizes( $shoptheme_font_size_text ){
        $shoptheme_font_size_text['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 17px 18px 19px 20px 21px 24px 28px 32px 36px";
        return $shoptheme_font_size_text;
    }

    add_filter( 'tiny_mce_before_init', 'shoptheme_mce_text_sizes' );

endif;
// End Customize mce editor font sizes

/* callback comment list */
function shoptheme_comments( $shoptheme_comment, $shoptheme_comment_args, $shoptheme_comment_depth ) {

    if ( 'div' === $shoptheme_comment_args['style'] ) :

        $shoptheme_comment_tag       = 'div';
        $shoptheme_comment_add_below = 'comment';

    else :

        $shoptheme_comment_tag       = 'li';
        $shoptheme_comment_add_below = 'div-comment';

    endif;

?>
    <<?php echo $shoptheme_comment_tag ?> <?php comment_class( empty( $shoptheme_comment_args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">

    <?php if ( 'div' != $shoptheme_comment_args['style'] ) : ?>

        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">

    <?php endif; ?>

    <div class="comment-author vcard">

        <?php if ( $shoptheme_comment_args['avatar_size'] != 0 ) echo get_avatar( $shoptheme_comment, $shoptheme_comment_args['avatar_size'] ); ?>

    </div>

    <?php if ( $shoptheme_comment->comment_approved == '0' ) : ?>

        <em class="comment-awaiting-moderation">
            <?php esc_html_e( 'Your comment is awaiting moderation.', 'shoptheme' ); ?>
        </em>

    <?php endif; ?>

    <div class="comment-meta commentmetadata">
        <div class="comment-meta-box">
             <span class="name">
                <?php comment_author_link(); ?>
            </span>

            <span class="comment-metadata">
                <?php comment_date(); ?>
            </span>

            <?php edit_comment_link( esc_html__( 'Edit ', 'shoptheme' ) ); ?>

            <?php comment_reply_link( array_merge( $shoptheme_comment_args, array( 'add_below' => $shoptheme_comment_add_below, 'depth' => $shoptheme_comment_depth, 'max_depth' => $shoptheme_comment_args['max_depth'] ) ) ); ?>

        </div>

        <div class="comment-text-box">
            <?php comment_text(); ?>
        </div>
    </div>

    <?php if ( 'div' != $shoptheme_comment_args['style'] ) : ?>
        </div>
    <?php endif; ?>

<?php
}
/* callback comment list */

if ( ! function_exists( 'shoptheme_fonts_url' ) ) :

    function shoptheme_fonts_url() {
        $shoptheme_fonts_url = '';

        /* Translators: If there are characters in your language that are not
        * supported by Open Sans, translate this to 'off'. Do not translate
        * into your own language.
        */
        $shoptheme_font_google = _x( 'on', 'Raleway font: on or off', 'shoptheme' );

        if ( 'off' !== $shoptheme_font_google ) {
            $shoptheme_font_families = array();

            if ( 'off' !== $shoptheme_font_google ) {
                $shoptheme_font_families[] = 'Faustina:400,500,700';
            }

            $shoptheme_query_args = array(
                'family' => urlencode( implode( '|', $shoptheme_font_families ) ),
                'subset' => urlencode( 'latin' ),
            );

            $shoptheme_fonts_url = add_query_arg( $shoptheme_query_args, 'https://fonts.googleapis.com/css' );
        }

        return esc_url_raw( $shoptheme_fonts_url );
    }

endif;

/*
 * Content Nav
 */

if ( ! function_exists( 'shoptheme_comment_nav' ) ) :

    function shoptheme_comment_nav() {
        // Are there comments to navigate through?
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :

    ?>
            <nav class="navigation comment-navigation">
                <h2 class="screen-reader-text">
                    <?php _e( 'Comment navigation', 'shoptheme' ); ?>
                </h2>
                <div class="nav-links">
                    <?php
                    if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'shoptheme' ) ) ) :
                        printf( '<div class="nav-previous">%s</div>', $prev_link );
                    endif;

                    if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'shoptheme' ) ) ) :
                        printf( '<div class="nav-next">%s</div>', $next_link );
                    endif;
                    ?>
                </div><!-- .nav-links -->
            </nav><!-- .comment-navigation -->

    <?php
        endif;
    }

endif;

/*
 * TWITTER AMPERSAND ENTITY DECODE
 */
if( ! function_exists( 'shoptheme_social_title' )):

    function shoptheme_social_title( $shoptheme_title ) {

        $shoptheme_title = html_entity_decode( $shoptheme_title );
        $shoptheme_title = urlencode( $shoptheme_title );

        return $shoptheme_title;

    }

endif;

/****************************************************************************************************************
 * Fuction override post_class()
 * */

if ( ! function_exists( 'shoptheme_post_classes' ) ) :

    function shoptheme_post_classes( $shoptheme_body_class ) {

        if ( is_category() || is_tag() || is_search() || is_author() || is_archive() || is_home() ) {
            $shoptheme_body_class[] = 'site-post-item';
        }

        if ( is_single() ) {
            $shoptheme_body_class[] = 'site-post-single-item';
        }
        return $shoptheme_body_class;

    }

    add_filter( 'post_class', 'shoptheme_post_classes' );

endif;

/**
 * Include the TGM_Plugin_Activation class.
 */
require get_parent_theme_file_path( '/plugins/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'shoptheme_register_required_plugins' );
function shoptheme_register_required_plugins() {

    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $shoptheme_plugins = array(

        array(
            'name'     				=>  'Vafpress Post Formats UI', // The plugin name
            'slug'     				=>  'vafpress-post-formats-ui-develop', // The plugin slug (typically the folder name)
            'source'   				=>  get_parent_theme_file_path( '/plugins/vafpress-post-formats-ui-develop.zip' ), // The plugin source
            'required' 				=>  true, // If false, the plugin is only 'recommended' instead of required
            'version' 				=>  '1.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation' 		=>  false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation' 	=>  false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url' 			=>  '', // If set, overrides default API URL and points to an external URL
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      =>  'Redux Framework',
            'slug'      =>  'redux-framework',
            'required'  =>  true,
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      =>  'Meta Box',
            'slug'      =>  'meta-box',
            'required'  =>  true,
        ),

        // This is an example of how to include a plugin from the WordPress Plugin Repository
        array(
            'name'      =>  'Elementor',
            'slug'      =>  'elementor',
            'required'  =>  true,
        ),

    );

    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $shoptheme_config = array(
        'id'           => 'shoptheme',          // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
    );

    tgmpa( $shoptheme_plugins, $shoptheme_config );
}

/* Start Social Network */
function shoptheme_get_social_url() {

    global $shoptheme_options;
    $shoptheme_social_networks = shoptheme_get_social_network();

?>

    <ul class="site-social d-flex">

        <?php
        foreach( $shoptheme_social_networks as $shoptheme_social ) :

            $shoptheme_social_url = $shoptheme_options['shoptheme_social_network_' . $shoptheme_social['id']];

            if( $shoptheme_social_url ) :

        ?>

                <li>
                    <a href="<?php echo esc_url( $shoptheme_social_url ); ?>">
                        <i class="fa fa-<?php echo esc_attr( $shoptheme_social['id'] ); ?>" aria-hidden="true"></i>
                    </a>
                </li>

        <?php
            endif;

        endforeach;
        ?>

    </ul>

<?php

}

function shoptheme_get_social_network() {
    return array(

        array('id' => 'facebook', 'title' => 'Facebook'),
        array('id' => 'twitter', 'title' => 'Twitter'),
        array('id' => 'google-plus', 'title' => 'Google Plus'),
        array('id' => 'linkedin', 'title' => 'linkedin'),
        array('id' => 'pinterest', 'title' => 'Pinterest'),
        array('id' => 'youtube', 'title' => 'Youtube'),
        array('id' => 'instagram', 'title' => 'instagram'),
        array('id' => 'vimeo', 'title' => 'Vimeo'),

    );
}
/* End Social Network */

/* Start pagination */
function shoptheme_pagination() {

    the_posts_pagination( array(
        'type' => 'list',
        'mid_size' => 2,
        'prev_text' => esc_html__( 'Previous', 'shoptheme' ),
        'next_text' => esc_html__( 'Next', 'shoptheme' ),
        'screen_reader_text' => esc_html__( '&nbsp;', 'shoptheme' ),
    ) );

}

function shoptheme_sanitize_pagination( $shoptheme_content ) {
    // Remove role attribute
    $shoptheme_content = str_replace('role="navigation"', '', $shoptheme_content);

    // Remove h2 tag
    $shoptheme_content = preg_replace('#<h2.*?>(.*?)<\/h2>#si', '', $shoptheme_content);

    return $shoptheme_content;
}

add_action('navigation_markup_template', 'shoptheme_sanitize_pagination');
/* End pagination */

/* Start get Category check box */
function shoptheme_check_get_cat( $shoptheme_check_type_taxonomy ) {

    $shoptheme_cat_check    =   array();
    $shoptheme_category     =   get_categories( array( 'taxonomy'   =>  $shoptheme_check_type_taxonomy ) );

    if ( isset( $shoptheme_category ) && !empty( $shoptheme_category ) ):

        foreach( $shoptheme_category as $shoptheme_cate ) {

            $shoptheme_cat_check[$shoptheme_cate->term_id]  =   $shoptheme_cate->name;

        }

    endif;

    return $shoptheme_cat_check;

}
/* End get Category check box */

// function remove editor menu admin
function shoptheme_remove_editor_menu() {
    remove_action('admin_menu', '_add_themes_utility_last', 101);
}
add_action('_admin_menu', 'shoptheme_remove_editor_menu', 1);