<?php //this is just for the doctype and <head> section
get_template_part( 'theme-partials/header/head' );

$class_name = '';
if ( is_page() && get_page_template_slug( get_the_ID() ) == 'template-journal.php' ) {
    $class_name .= ' blog';
}

$data_ajaxloading     = ( wpgrade::option( 'use_ajax_loading' ) == 1 ) ? 'data-ajaxloading' : '';
$data_smoothscrolling = ( wpgrade::option( 'use_smooth_scroll' ) == 1 ) ? 'data-smoothscrolling' : '';

//we use this so we can generate links with post id
//right now we use it to change the Edit Post link in the admin bar
$data_currentid = '';
if ( ( wpgrade::option( 'use_ajax_loading' ) == 1 ) ) {
    global $wp_the_query;
    $current_object = $wp_the_query->get_queried_object();

    if ( ! empty( $current_object->post_type )
        && ( $post_type_object = get_post_type_object( $current_object->post_type ) )
        && current_user_can( 'edit_post', $current_object->ID )
        && $post_type_object->show_ui && $post_type_object->show_in_admin_bar
    ) {
        $data_currentid = 'data-curpostid="' . $current_object->ID . '"';
    } elseif ( ! empty( $current_object->taxonomy )
        && ( $tax = get_taxonomy( $current_object->taxonomy ) )
        && current_user_can( $tax->cap->edit_terms )
        && $tax->show_ui
    ) {
        $data_currentid = 'data-curpostid="' . $current_object->term_id . '"';
    }
}

if ( wpgrade::option( 'header_inverse' ) == 1 ) {
    $class_name .= " header-inverse";
}

if (wpgrade::option( 'enable_copyright_overlay' ) ){
    $class_name .= '  is--copyright-protected  ';
}

$woo_support = '';
if ( ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
    && wpgrade::option( 'enable_woocommerce_support' ) == 1
) {
    $woo_support = " data-woocommerce_enabled";
}
?>
<body <?php body_class( $class_name );
echo ' ' . $data_ajaxloading . ' ' . $data_smoothscrolling . ' ' . $data_currentid . ' ' . $woo_support; ?>>
<div class="pace">
    <div class="pace-activity"></div>
</div>
<?php if (wpgrade::option( 'enable_copyright_overlay' ) ) : ?>
    <div class="copyright-overlay">
        <div class="copyright-overlay__container">
            <div class="copyright-overlay__content">
                <?php echo wpgrade::option('copyright_overlay_text') ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<div id="page">
    <nav class="navigation  navigation--mobile">
        <h2 class="accessibility"><?php _e( 'Primary Mobile Navigation', wpgrade::textdomain() ) ?></h2>
        <?php
        wpgrade_main_nav_mobile();
        ?>
        <div class="nav-meta">
            <?php
            get_sidebar( 'header' );
            if ( wpgrade::option( 'do_social_footer_menu' ) ) {
                get_template_part('theme-partials/header/social-icons');
            } ?>
            <div class="site-info">
                <?php
                $copyright = wpgrade_callback_theme_general_filters( wpgrade::option( 'copyright_text' ) );
                echo $copyright;
                ?>
            </div>
            <!-- .site-info -->
        </div>
    </nav>
    <div class="wrapper">
        <?php //get the main header section - logo, nav, footer
        get_template_part( 'theme-partials/header/site' );
