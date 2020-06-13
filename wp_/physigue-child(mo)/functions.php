<?php
function my_theme_enqueue_styles() {
 
    $parent_style = 'physique-basic-style';
 
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

function tt_hidetitle_class($classes) {
    if ( is_single() || is_page () ):
    $classes[] = 'hidetitle';
    return $classes;
    endif;
    return $classes;
}

add_filter('post_class', 'tt_hidetitle_class');
?>