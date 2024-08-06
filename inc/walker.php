<?php
/**
 * Walker Class for Mobile Menu
 * 
 * @package wavypixel
 */
class wavypixel_Mobile_Menu extends Walker_Nav_Menu {


	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $class_names = join( ' ', apply_filters( 'itre_nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		if ( $args->walker->has_children ) {
			$dropDown = '<span class="dropdown-arrow" tabindex="0"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#ffffff"><path d="M24 24H0V0h24v24z" fill="none" opacity=".87"/><path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6-1.41-1.41z"/></svg></span>';
		} else {
			$dropDown = '';
		}

        $fontIcon = ! empty( $item->attr_title ) ? ' <i class="fa ' . esc_attr( $item->attr_title ) .'">' : '';
        $attributes = ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_url( $item->url ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>'.$fontIcon.'</i>';
        $item_output .= $args->link_before . apply_filters( 'itre_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $dropDown;
        $item_output .= $args->after;

        $output .= apply_filters( 'itre_walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
	}
}
