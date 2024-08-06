<?php
/**
 * Adds Category_Background_Widget widget.
 */
class Category_Background_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'category_background_widget', // Base ID
            esc_html__( 'Category Background', 'wavypixel' ), // Name
            array( 'description' => esc_html__( 'A widget to display categories with background images', 'wavypixel' ) ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $number_of_categories = ! empty( $instance['number_of_categories'] ) ? absint( $instance['number_of_categories'] ) : 4;

        echo $args['before_widget'];
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
        }

        $categories = get_categories( array(
            'number' => $number_of_categories,
            'orderby' => 'count',
            'order' => 'DESC'
        ) );

        if ( ! empty( $categories ) ) {
            echo '<div class="category-background-widget">';
            foreach ( $categories as $category ) {
                $category_link = get_category_link( $category->term_id );

                echo '<a href="' . esc_url( $category_link ) . '">';
                echo '<h4>' . esc_html( $category->name ) . '</h4>';
                echo '</a>';
            }
            echo '</div>';
        }

        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'wavypixel' );
        $number_of_categories = ! empty( $instance['number_of_categories'] ) ? absint( $instance['number_of_categories'] ) : 4;
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'wavypixel' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number_of_categories' ) ); ?>"><?php esc_html_e( 'Number of Categories:', 'wavypixel' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number_of_categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_of_categories' ) ); ?>" type="number" min="1" step="1" value="<?php echo esc_attr( $number_of_categories ); ?>">
        </p>
        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['number_of_categories'] = ( ! empty( $new_instance['number_of_categories'] ) ) ? absint( $new_instance['number_of_categories'] ) : 4;

        return $instance;
    }
}

// Register Category_Background_Widget widget
function register_category_background_widget() {
    register_widget( 'Category_Background_Widget' );
}
add_action( 'widgets_init', 'register_category_background_widget' );

// Add category background image field to category add form
function add_category_background_image_field( $taxonomy ) {
    ?>
    <div class="form-field term-group">
        <label for="category-background-image"><?php esc_html_e( 'Category Background Image', 'wavypixel' ); ?></label>
        <input type="text" id="category-background-image" name="category_background_image" value="">
        <p class="description"><?php esc_html_e( 'Enter the URL of the background image.', 'wavypixel' ); ?></p>
    </div>
    <?php
}
add_action( 'category_add_form_fields', 'add_category_background_image_field' );

// Edit category background image field
function edit_category_background_image_field( $term, $taxonomy ) {
    $background_image = get_term_meta( $term->term_id, 'category_background_image', true );
    ?>
    <tr class="form-field term-group-wrap">
        <th scope="row"><label for="category-background-image"><?php esc_html_e( 'Category Background Image', 'wavypixel' ); ?></label></th>
        <td>
            <input type="text" id="category-background-image" name="category_background_image" value="<?php echo esc_attr( $background_image ); ?>">
            <p class="description"><?php esc_html_e( 'Enter the URL of the background image.', 'wavypixel' ); ?></p>
        </td>
    </tr>
    <?php
}
add_action( 'category_edit_form_fields', 'edit_category_background_image_field', 10, 2 );

// Save category background image
function save_category_background_image( $term_id ) {
    if ( isset( $_POST['category_background_image'] ) ) {
        update_term_meta( $term_id, 'category_background_image', sanitize_text_field( $_POST['category_background_image'] ) );
    }
}
add_action( 'created_category', 'save_category_background_image' );
add_action( 'edited_category', 'save_category_background_image' );
?>
