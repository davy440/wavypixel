<?php
/**
 * Top Menu
 * 
 * @package wavypixel
 */
if(has_nav_menu('menu-top')){
wp_nav_menu([
    'container_class'	=>	'menu-top',
    'theme_location'	=>	'menu-top',
    'depth'				=>	1
]);}
