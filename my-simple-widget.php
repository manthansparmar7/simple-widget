<?php
/**
 * Plugin Name: My Simple Widget
 * Description: A simple custom widget for WordPress.
 * Version: 1.0
 * Author: Your Name
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Register the widget
function my_simple_widget_init() {
    register_widget('My_Simple_Widget');
}
add_action('widgets_init', 'my_simple_widget_init');

// Define the widget class
class My_Simple_Widget extends WP_Widget {

    // Set up the widget name and description
    public function __construct() {
        $widget_options = array(
            'classname' => 'my_simple_widget',
            'description' => 'A Simple Custom Widget',
        );
        parent::__construct('my_simple_widget', 'My Simple Widget', $widget_options);
    }

    // Output the widget content on the front-end
    public function widget($args, $instance) {
        // Add a custom class and inline CSS to make sure it's visible
        echo '<div class="my-custom-widget" style="display:block; visibility:visible;">';

        // Widget title
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        // Main widget content
        echo '<p>Hello, this is my simple widget content!</p>';

        echo '</div>'; // Close custom div
    }

    // Output the widget options form on the admin
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <?php
    }

    // Process widget options to be saved
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        return $instance;
    }
}
