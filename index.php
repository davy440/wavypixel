<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wavypixel
 */

$title_setting = get_theme_mod('wavypixel_blog_title_enable', '1');
$sidebar_choice = get_theme_mod('wavypixel_sidebar_choice', 'right');
$has_left_sidebar = is_active_sidebar('sidebar-2') && in_array( $sidebar_choice, ['left', 'dual'] );
$has_right_sidebar = is_active_sidebar('sidebar-1') && in_array( $sidebar_choice, ['right', 'dual'] );
$layout_setting = get_theme_mod( 'wavypixel_blog_layout_choice', 'boxed' );
get_header(null, ['page-layout' => $layout_setting]);

if ( !empty( $title_setting ) ) {
    printf(
        '<div class="blog-title">
            <div class="%s">
                <h1>%s</h1>
            </div>
        </div>',
        esc_attr( $layout_setting ),
        __('Blog', 'wavypixel')
    );
}

$slider_width_class = get_theme_mod( 'wavypixel_featured_posts_slider_width', 'boxed' );
$featured_area_width = get_theme_mod( 'wavypixel_fa-style_width', 'boxed' );
$widget_before_main_width = get_theme_mod( 'wavypixel_featured_posts_widgets_before_content_width', 'boxed' );

?>
<div class="widget-before-main-wrapper <?php echo esc_attr( $widget_before_main_width ); ?>">
<?php
   get_template_part('template-parts/widget-content-before/widget-after-header');
   ?>
</div>

<div class="slider-wrapper <?php echo esc_attr( $slider_width_class ); ?>">
    <?php get_template_part('template-parts/featured-posts-slider'); ?>
</div>

<div class="widget-before-main-wrapper <?php echo esc_attr( $widget_before_main_width ); ?>">
<?php
   get_template_part('template-parts/widget-content-before/widget-before-contet');
   ?>
</div>

<div class="featured-area-main <?php echo esc_attr( $featured_area_width ); ?>">
<?php
   get_template_part('template-parts/featured-area/featured-area');
   ?>
</div>

<div class="ad-before-main-wrapper <?php echo esc_attr( $widget_before_main_width ); ?>">
<?php
   get_template_part('template-parts/widget-content-before/ad-before-main');
   ?>
</div>



<div class="content <?php echo esc_attr( get_theme_mod( 'wavypixel_blog_layout_choice', 'boxed' ) ); ?>">
    <div class="blog-wrapper">
        <?php if ( $has_left_sidebar ) : ?>
            <aside class="md-3 theme-sidebar <?php if ( $sidebar_choice === 'left') echo esc_attr( $sidebar_choice ); ?>" id="secondary-sidebar">
                <?php dynamic_sidebar('sidebar-2'); ?>
            </aside>
        <?php endif; ?>
        <main id="primary" class="md-<?php echo !$has_left_sidebar && !$has_right_sidebar ? '12' : ( $sidebar_choice === 'dual' ? '6' : '9' ); ?> main-content site-main">
    <?php
    // Get the layout setting from the customizer
    $blog_layout = get_theme_mod( 'wavypixel_blog_layout', 'list' );

    if (have_posts()) :

        /* Start the Loop */
        while (have_posts()) :
            the_post();

            /*
             * Include the Post-Type-specific template for the content.
             * If you want to override this in a child theme, then include a file
             * called content-___.php (where ___ is the Post Type name) and that will be used instead.
             */
            if ( $blog_layout === 'card' ) {
                get_template_part('template-parts/blog-style/content-style2', get_post_type());
            } else {
                get_template_part('template-parts/blog-style/content', get_post_type());
            }

        endwhile;

        the_posts_pagination( apply_filters( 'wavypixel_posts_pagination_args', array(
            'class' => 'wavypixel-pagination',
            'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12l4.58-4.59z"/></svg>',
            'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M10.02 6L8.61 7.41 13.19 12l-4.58 4.59L10.02 18l6-6-6-6z"/></svg>'
        ) ) );

    else :

        get_template_part('template-parts/content', 'none');

    endif;
    ?>
</main><!-- #main -->

		<?php if ($has_right_sidebar) : ?>
			<aside class="main-sidebar theme-sidebar md-3 secondary-content" id="right-sidebar">
			    <?php dynamic_sidebar('sidebar-1'); ?>
			</aside>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();