<?php
/**
 * Header Layout - Full
 */
$layout = isset($args['layout']) ? $args['layout'] : '';
?>
<div class="<?php echo esc_attr($layout); ?>">
    <div class="top-wrapper">
    <?php
        get_template_part('inc/modules/branding');
        get_template_part('inc/modules/search');
        get_template_part('inc/modules/nav-mobile');
    ?>
    </div>
    <?php get_template_part('inc/modules/searchform'); ?>
</div>