<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Anber Elementor Addon
 * Plugin URI:        https://github.com/enamahamed/Anber-elementor-addon
 * Description:       Custom widgets for Elementor
 * Version:           1.0.1
 * Author:  MD Enam Ahamed Chowdhury
 * Author   URI: https://github.com/enamahamed
 * License:           GPLv3
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       anber-elementor-addon
 * 
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Currently plugin version.
 */
define('ANBER_EA_VERSION', '1.0.1');

/**
 * The code that runs during plugin activation.
 *
 */
function anber_elementor_addon_activator() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-anber-ea-activator.php';
    Anber_Ea_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * 
 */
function anber_elementor_addon_deactivator() {
    require_once plugin_dir_path(__FILE__) . 'includes/class-anber-ea-deactivator.php';
    Anber_Ea_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'anber_elementor_addon_activator');
register_deactivation_hook(__FILE__, 'anber_elementor_addon_deactivator');

// Check if Elementor is installed and activated
add_action('admin_init', 'anber_elementor_addon_look_for_elementor');

function anber_elementor_addon_look_for_elementor() {
    // Check if Elementor is not active
    if (!did_action('elementor/loaded')) {
        // Add an admin notice if Elementor is not active
        add_action('admin_notices', 'anber_elementor_addon_elementor_missing_notice');
        return;
    }
}

function anber_elementor_addon_elementor_missing_notice() {
    // Display the admin notice
    ?>
    <div class="notice notice-error">
        <p><?php esc_html_e('Anber Elementor Addon Plugin requires Elementor to be installed and activated.', 'anber-elementor-addon'); ?></p>
    </div>
    <?php
}

// Function to dynamically include and register widgets
function anber_elementor_addon_dynamic_widgets($widgets_manager) {
    $widgets = [];

    // Loop through all files in the widgets directory
    foreach (glob(__DIR__ . '/widgets/*') as $file) {
        $widget_name = basename($file); // Get the folder name of the widget
        if ($widget_name != 'index.php') {
            $widgets[] = $widget_name;
        }
    }

    // Filter out empty or irrelevant entries
    if (is_array($widgets)) {
        $widgets = array_filter($widgets);

        foreach ($widgets as $widget) {
            $widget_dir = __DIR__ . '/widgets/' . $widget . '/index.php';

            // Check if it's a WooCommerce-related widget and if WooCommerce is active
            if (strpos($widget, 'woo') !== false) {
                if (class_exists('WooCommerce')) {
                    // Load the WooCommerce widget
                    require_once $widget_dir;
                }
            } else {
                // Load the regular widget
                require_once $widget_dir;
            }

            // Register the widget with Elementor if it exists
            $widget_class = '\Elementor\\' . str_replace('-', '_', ucwords($widget, '-'));
            if (class_exists($widget_class)) {
                $widgets_manager->register(new $widget_class());
            }
        }
    }
}

// Hook into Elementor’s widget registration action
add_action('elementor/widgets/register', 'anber_elementor_addon_dynamic_widgets');

function anber_elementor_addon_widget_categories($elements_manager) {

    $elements_manager->add_category(
            'anbar-category',
            [
                'title' => esc_html__('Anber Addon', 'anber-elementor-addon'),
                'icon' => 'fa fa-plug',
            ]
    );
}

add_action('elementor/elements/categories_registered', 'anber_elementor_addon_widget_categories');

function anber_elementor_adon_widgets_dependencies() {  
    wp_enqueue_script('jquery');  

    /* Scripts */  
    wp_register_script('anber-comon-script', plugins_url('assets/js/anber-comon-script.js', __FILE__), array('jquery'), '1.0.1', true);  
    wp_enqueue_script('anber-comon-script');  
    // Add defer attribute  
    wp_script_add_data('anber-comon-script', 'defer', true);  

    wp_register_script('anber-carousel-script', plugins_url('assets/js/owl.carousel.min.js', __FILE__), array('jquery'), '1.0.1', true);  
    wp_enqueue_script('anber-carousel-script');  
    wp_script_add_data('anber-carousel-script', 'defer', true);  

    /* Styles */  
    wp_register_style('anber-elementor-addon-comon-style', plugins_url('assets/css/anber-elementor-addon-comon-style.css', __FILE__), array(), '1.0.1');  
    wp_enqueue_style('anber-elementor-addon-comon-style');  

    wp_register_style('anber-carousel-style', plugins_url('assets/css/carousel-style.css', __FILE__), array(), '1.0.1');  
    wp_enqueue_style('anber-carousel-style');  

    wp_register_style('anber-carousel', plugins_url('assets/css/owl.carousel.min.css', __FILE__), array(), '1.0.1');  
    wp_enqueue_style('anber-carousel');  

   }

add_action('wp_enqueue_scripts', 'anber_elementor_adon_widgets_dependencies');

