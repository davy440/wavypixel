<?php
/**
 * Header Layout - Top
 * 
 * @package wavypixel
 */
$layout = isset($args['layout']) ? $args['layout'] : '';
?>
    <div class="top-wrapper">
        <div class="<?php echo esc_attr($layout); ?>">
            <?php
                get_template_part('inc/modules/nav-desktop');
                get_template_part('inc/modules/search');
                get_template_part('inc/modules/nav-mobile');
            ?>
        </div>
    </div>
    <div class="branding-wrapper <?php echo esc_attr($layout); ?>">
        <?php
            get_template_part('inc/modules/searchform');
            get_template_part('inc/modules/branding');
        ?>
    </div>
