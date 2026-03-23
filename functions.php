<?php
function newstheme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

    register_nav_menus(array(
        'primary' => __('Primary Menu', 'newstheme'),
        'footer' => __('Footer Menu', 'newstheme'),
    ));
}
add_action('after_setup_theme', 'newstheme_setup');

// Add classes to menu items to align with static HTML CSS
add_filter('nav_menu_css_class', function ($classes, $item, $args) {
    if (isset($args->theme_location) && $args->theme_location == 'primary') {
        $classes[] = 'nav-item';
    }
    return $classes;
}, 10, 3);

add_filter('nav_menu_submenu_css_class', function ($classes, $args, $depth) {
    if (isset($args->theme_location) && $args->theme_location == 'primary') {
        $classes[] = 'submenu';
    }
    return $classes;
}, 10, 3);

function newstheme_scripts()
{
    wp_enqueue_style('newstheme-main-style', get_template_directory_uri() . '/assets/css/style.css', array(), wp_get_theme()->get('Version'));
    wp_enqueue_style('newstheme-style', get_stylesheet_uri(), array('newstheme-main-style'), wp_get_theme()->get('Version'));
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    wp_enqueue_script('newstheme-script', get_template_directory_uri() . '/assets/js/script.js', array(), wp_get_theme()->get('Version'), true);
}
add_action('wp_enqueue_scripts', 'newstheme_scripts');

// Add custom image size for header logo
add_action('after_setup_theme', 'newstheme_custom_image_sizes');
function newstheme_custom_image_sizes()
{
    add_image_size('header-logo', 1000, 600, false);

}

// Add ACF Theme Options Page
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Theme Options',
        'menu_title' => 'Theme Options',
        'menu_slug' => 'theme-options',
        'capability' => 'edit_theme_options',
        'redirect' => false
    ));
}
