<?php
/**
 * Header Layout - Default
 * 
 * @package wavypixel
 */
$layout = isset($args['layout']) ? $args['layout'] : '';
?>
<div class="top-wrapper <?php echo esc_attr($layout); ?>">
    <?php
        get_template_part('inc/modules/branding');
        get_template_part('inc/modules/nav-desktop');
        get_template_part('inc/modules/search');
        get_template_part('inc/modules/nav-mobile');
        get_template_part('inc/modules/searchform');
    ?>
</div>