<?php
/**
 * Header Layout - Center
 */
$layout = isset($args['layout']) ? $args['layout'] : '';
?>
<div class="branding-wrapper <?php echo esc_attr($layout); ?>">
    <?php get_template_part('inc/modules/branding'); ?>
</div>
<div class="nav-wrapper">
    <div class="<?php echo esc_attr($layout); ?>">
    <?php
        get_template_part('inc/modules/nav-desktop');
        get_template_part('inc/modules/search');
        get_template_part('inc/modules/nav-mobile');
        get_template_part('inc/modules/searchform');
    ?>
    </div>
</div>