<?php
/**
 * Adds a meta box to the post editing screen
 */
function wavypixel_custom_meta() {
    add_meta_box( 'wavypixel_meta', esc_html__( 'Display Options', 'wavypixel' ), 'wavypixel_meta_callback', 'page','side','high' );
}
add_action( 'add_meta_boxes', 'wavypixel_custom_meta' );

/**
 * Outputs the content of the meta box
 */
function wavypixel_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'wavypixel_nonce' );

    $defaults = array(
        'layout'            =>  ['boxed'],
        'show-title'        =>  ['1'],
        'enable-sidebar'    =>  ['right']
    );

    $wavypixel_stored_meta = wp_parse_args( get_post_meta( $post->ID ), $defaults );
    ?>

    <p>
	    <div class="itre-row-content">

            <p>
                <label for="layout"><h4><?php _e( 'Page Layout', 'wavypixel' ) ?></h4></label>
                <select id="layout" name="layout">
                    <option value="boxed" <?php if ( isset( $_POST['layout'] ) ) selected( $wavypixel_stored_meta['layout'][0], 'boxed'); ?>><?php esc_html_e('Boxed Layout', 'wavypixel'); ?></option>
                    <option value="wide-width" <?php if ( isset( $_POST['layout'] ) ) selected( $wavypixel_stored_meta['layout'][0], 'wide-width'); ?>><?php esc_html_e('Wide Width', 'wavypixel'); ?></option>
                    <option value="full-width" <?php if ( isset( $_POST['layout'] ) ) selected( $wavypixel_stored_meta['layout'][0], 'full-width'); ?>><?php esc_html_e('Full Width', 'wavypixel'); ?></option>
                </select>
            </p>

            <p>
                <input type="checkbox" name="show-title" id="show-title" value="1" <?php if ( isset( $wavypixel_stored_meta['show-title'] ) ) checked( $wavypixel_stored_meta['show-title'][0], '1' ); ?> />
                <label for="show-title"><?php _e( 'Show Title', 'wavypixel' ) ?></label>
            </p>

            <p>
                <input type="checkbox" name="enable-sidebar" id="enable-sidebar" value="right" <?php if ( isset( $wavypixel_stored_meta['enable-sidebar'] ) ) checked( $wavypixel_stored_meta['enable-sidebar'][0], 'right' ); ?> />
                <label for="enable-sidebar"><?php _e( 'Enable the Sidebar', 'wavypixel' ) ?></label>
            </p>
	        

	    </div>
	</p>
    <?php
}


/**
 * Saves the custom meta input
 */
function wavypixel_meta_save( $post_id ) {

    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'wavypixel_nonce' ] ) && wp_verify_nonce( $_POST[ 'wavypixel_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    // Checks for input and saves
    $enable_sidebar =  isset($_POST['enable-sidebar']) ? 'right' : 'none';
    update_post_meta( $post_id, 'enable-sidebar', $enable_sidebar );

    $layout =  isset($_POST['layout']) ? $_POST['layout'] : 'boxed';
    update_post_meta( $post_id, 'layout', $layout );

    $show_title =  isset($_POST['show-title']) ? '1' : '';
    update_post_meta( $post_id, 'show-title', $show_title );
    
}
add_action( 'save_post', 'wavypixel_meta_save', 10, 2 );
