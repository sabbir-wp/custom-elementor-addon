<?php
/**
 * @package   anber-elementor-addon
 *
 * 
 *
 * @since 1.0.1
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$anber_settings = $this->get_settings_for_display();
$anber_car_button = $anber_settings['carousel_control'];
$anber_car_item_gap = $anber_settings['item_gap']["size"];

/**
 * Add color styling from theme
 */
$anber_previous_icon_html = '';
if (!empty($anber_settings['previous_icon'])) {
    ob_start();
    \Elementor\Icons_Manager::render_icon($anber_settings['previous_icon'], ['aria-hidden' => 'true']);
    $anber_previous_icon_html = ob_get_clean();
}

$anber_next_icon_html = '';
if (!empty($anber_settings['next_icon'])) {
    ob_start();
    \Elementor\Icons_Manager::render_icon($anber_settings['next_icon'], ['aria-hidden' => 'true']);
    $anber_next_icon_html = ob_get_clean();
}

$anber_carousel_items = [
    'desktop' => $anber_settings['carousel_item']['size'] ?? 3,
    'tablet' => $anber_settings['carousel_item_tablet']['size'] ?? 2,
    'mobile' => $anber_settings['carousel_item_mobile']['size'] ?? 1,
];

$anber_inline_script = "
    jQuery(document).ready(function ($) {
        $('#anber_ea_carousel').owlCarousel({
            loop: true,
            margin: " . esc_js($anber_car_item_gap) . ",
            dots: " . esc_js(($anber_car_button == 'dots' || $anber_car_button == 'both') ? true : false) . ",
            nav: " . esc_js(($anber_car_button == 'nav' || $anber_car_button == 'both') ? true : false) . ",
            navText: [" . wp_json_encode($anber_next_icon_html) . ", " . wp_json_encode($anber_previous_icon_html) . "],
            autoplay: true,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: " . esc_js($anber_carousel_items['mobile']) . "
                },
                600: {
                    items: " . esc_js($anber_carousel_items['tablet']) . "
                },
                1000: {
                    items: " . esc_js($anber_carousel_items['desktop']) . "
                }
            }
        });
    });
";

// Add the inline script to the registered script.
wp_add_inline_script('anber-carousel-script', $anber_inline_script);

?>
<div class="anber_ea_carousel_wrap">
    <div id="anber_ea_carousel" class="owl-carousel">
        <?php
        $same_height_item_column = $anber_settings['same_height_column'];
        $same_height_parent_class = ('yes' === $same_height_item_column) ? ' d-flex' : ''; // Add class if switch is 'yes'
        $same_height__clield_class = ('yes' === $same_height_item_column) ? ' flex-1' : ''; // Add class if switch is 'yes'

        if (!empty($anber_settings['item_list'])) {
            foreach ($anber_settings['item_list'] as $item) {
                ?>
                <div class="item elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">     
                    <div class="carosul_item ">
                        <?php
                        if ('yes' === $anber_settings['overlayer_switcher']) {
                            ?>
                            <div class="overlayer"></div>
                            <?php
                        }
                        ?>

                        <div class="item_content_wrap p-relative m-auto">
                            <?php if (!empty($item['carousel_title'])) : ?> 
                                <h2 class="carousel_title"><?php echo esc_html($item['carousel_title']); ?></h2>
                            <?php endif; ?>

                            <?php if (!empty($item['item_content'])) : ?> 
                                <div class="item_content"><?php echo esc_html($item['item_content']); ?></div>
                            <?php endif; ?>

                            <?php
                            if ('yes' === $item['show_button']) {
                                echo '<div class="button_wrapper d-flex flex-wrap">';
                                // Initialize icon HTML
                                $anber_icon_html = '';
                                if (!empty($item['icon'])) {
                                    // Get the icon HTML
                                    ob_start(); // Start output buffering
                                    \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']);
                                    $anber_icon_html = ob_get_clean(); // Store the icon HTML
                                }

                                // Output the button with the icon inside the wrapper
                                echo '<a class="banner_cta_button d-flex align-items-center elementor-repeater-item-' . esc_attr($item['_id']) . '" href="' . esc_attr($item['button_link']['url']) . '">';
                                echo esc_html($item['button_title']);
                                if ($anber_icon_html) {
                                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    echo '<span class="my-icon-wrapper">' . $anber_icon_html . '</span>';
                                }
                                echo '</a></div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>


