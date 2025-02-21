<?php

function theme_scripts() {
    wp_enqueue_script('theme-scripts', get_template_directory_uri() . '/assets/js/main.js', [], false, true);
}
add_action('wp_enqueue_scripts', 'theme_scripts');

function theme_enqueue_styles() {
    wp_enqueue_style('theme-style', get_stylesheet_uri(), [], filemtime(get_template_directory() . '/style.css'), 'all');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/fonts/fontawesome/css/all.min.css', [], null);

}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');