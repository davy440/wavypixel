<?php
/**
 * Add a Theme Page providing essential links and information for the user
 */

function itre_admin_theme_page() {
    add_theme_page('wavypixel Options & info', 'wavypixel Options', 'edit_theme_options', 'wavypixel_options', 'wavypixel_theme_info');
}
add_action('admin_menu', 'itre_admin_theme_page');

function wavypixel_theme_info() {
    var_dump('Theme Page!');
}