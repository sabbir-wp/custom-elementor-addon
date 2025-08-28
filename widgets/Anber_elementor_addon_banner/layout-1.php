<?php
/**
 * @package   anber-elementor-addon
 * @since 1.0.1
 * 
 *
 * 
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
?>
<section class="anber_ea_banner p-relative">
    <?php
    if ('yes' === $settings['overlayer_switcher']) {
        ?>
        <div class="overlayer"></div>
        <?php
    }
    ?>

    <div class="banner_title_wrap z-9 p-relative flex-direction-column d-flex" style="margin: auto">
        <?php if (!empty($settings['banner_title'])) : ?> 
            <h2 class="anbar_banner_title"><?php echo esc_html($settings['banner_title']); ?></h2>
        <?php endif; ?>
        <?php
        $allowed_tags = array(
            'a' => array(
                'href' => array(),
                'title' => array(),
            ),
            'br' => array(),
            'em' => array(),
            'strong' => array(),
            'p' => array(),
            'span' => array(),
                // Add more allowed tags and attributes as needed
        );

        $banner_content = isset($settings['banner_content']) ? wp_kses($settings['banner_content'], $allowed_tags) : '';

        if (!empty($settings['banner_content'])) :
            ?>
            <h4 class="banner_content">
                <?php
                // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                echo $banner_content;
                ?>
            </h4>
            <?php
        endif;

        echo '<div class="button_wrapper d-flex flex-wrap">';
        if (!empty($settings['button_list'])) {
            foreach ($settings['button_list'] as $item) {
                // Initialize icon HTML
                $icon_html = '';
                if (!empty($item['icon'])) {
                    // Get the icon HTML
                    ob_start(); // Start output buffering
                    \Elementor\Icons_Manager::render_icon($item['icon'], ['aria-hidden' => 'true']);
                    $icon_html = ob_get_clean(); // Store the icon HTML
                }

                // Output the button with the icon inside the wrapper
                echo '<a class="banner_cta_button d-flex align-items-center elementor-repeater-item-' . esc_attr($item['_id']) . '" href="' . esc_attr($item['button_link']['url']) . '">';
                echo esc_html($item['button_title']);
                if ($icon_html) {
                    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    echo '<span class="anbar_ea_banner_icon_wrapper">' . $icon_html . '</span>';
                }
                echo '</a>';
            }
        }

        echo '</div>';
        ?>
    </div>
</section>

