<?php

//update_post_meta(1,"this_is_a","service_file");

function wpse_340767_dequeue_theme_assets() {
    $wp_scripts = wp_scripts();
    $wp_styles  = wp_styles();
    $themes_uri = get_theme_root_uri();

    foreach ( $wp_scripts->registered as $wp_script ) {
        if ( strpos( $wp_script->src, $themes_uri ) !== false ) {
            wp_deregister_script( $wp_script->handle );
        }
    }

    foreach ( $wp_styles->registered as $wp_style ) {
        if ( strpos( $wp_style->src, $themes_uri ) !== false ) {
            wp_deregister_style( $wp_style->handle );
        }
    }
}
//add_action( 'wp_enqueue_scripts', 'wpse_340767_dequeue_theme_assets', 999 );

?>