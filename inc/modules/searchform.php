<?php
/**
 * Search Form functionality
 * 
 * @package wavypixel
 */
?>
<div id="headerSearch" class="search__form-wrapper">
    <form role="search" method="get" id="searchform_header" role="search" class="searchform" action="<?php echo (esc_url(home_url( '/' ))) ?>" >
        <div>
            <label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
            <input type="search" class="search__input" value="<?php echo get_search_query() ?>" name="s" id="s" autocomplete="off" placeholder="Search..." />
        </div>
    </form>
</div>