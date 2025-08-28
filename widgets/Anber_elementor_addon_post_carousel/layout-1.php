<?php
/**
 * @package   Anber_Elementor_Addon
 * @since 1.0.1
 * 
 *
 * 
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
// The Query
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 10,
    'orderby' => 'date',
    'order' => 'DESC',
);
$the_query = new WP_Query($args);
?>

<div class="anber_ea_carousel_wrap">
    <div id="anber-post-carousel" class="owl-carousel">
        <?php
        if ($the_query->have_posts()) :
            while ($the_query->have_posts()) :
                $the_query->the_post();
                ?>
                <div class="item post-item">
                    <div class="media">
                        <?php if (isset($anber_settings['show_thumbline']) && 'yes' === $anber_settings['show_thumbline']) : ?>
                            <?php
                            $thumbnail_id = get_post_thumbnail_id();
                            $thumbnail_html = '';

                            if (!empty($thumbnail_id)) {
                                $thumbnail_html = wp_get_attachment_image($thumbnail_id, 'full', false, [
                                    'class' => 'media__img',
                                    'alt' => get_the_title(),
                                    'style' => !empty($anber_settings['post_content_img_dimension']['height']) ? 'height:' . esc_attr($anber_settings['post_content_img_dimension']['height']) . 'px; object-fit: cover;' : '',
                                ]);
                            } else {
                                // In case there is no thumbnail, use a default image
                                $default_image_html = '<img src="' . esc_url('path/to/default-image.jpg') . '" class="media__img" alt="' . esc_attr(get_the_title()) . '" ' .
                                        (!empty($anber_settings['post_content_img_dimension']['height']) ? 'style="height:' . esc_attr($anber_settings['post_content_img_dimension']['height']) . 'px; object-fit: cover;"' : '') . ' />';
                                echo wp_kses_post($default_image_html);
                            }

                            echo wp_kses_post($thumbnail_html);
                            ?>
                        <?php endif; ?>



                        <?php if (isset($anber_settings['show_catname']) && 'yes' === $anber_settings['show_catname']) : ?>
                            <h4 class="catname"> <?php the_category(', '); ?></h4>
                        <?php endif; ?>

                        <div class="content_body">
                            <div class="apps-blog-post-box-meta-114 d-flex gap-10">
                                <?php if (isset($anber_settings['show_postdate']) && 'yes' === $anber_settings['show_postdate']) : ?>
                                    <span class="date d-flex gap-10 py-20">
                                        <span class="dateicon icon-wrapper">

                                            <?php
                                            if (!empty($anber_settings['date_icon'])) {
                                                \Elementor\Icons_Manager::render_icon($anber_settings['date_icon'], ['aria-hidden' => 'true']);
                                            }
                                            ?>

                                        </span>
                                        <?php echo esc_html(get_the_date('M/d/ Y')); ?>
                                    </span>
                                <?php endif; ?>

                                <?php if (isset($anber_settings['show_aurthor']) && 'yes' === $anber_settings['show_aurthor']) : ?>
                                    <span class="author d-flex gap-10 py-20">
                                        <span class="aurthoricon icon-wrapper">
                                            <?php
                                            if (!empty($anber_settings['aurthor_icon'])) {
                                                \Elementor\Icons_Manager::render_icon($anber_settings['aurthor_icon'], ['aria-hidden' => 'true']);
                                            }
                                            ?>
                                        </span>
                                        <span><?php echo esc_html(get_the_author_meta('display_name')); ?></span>
                                    </span> 
                                <?php endif; ?>
                            </div>

                            <?php if (isset($anber_settings['show_title']) && 'yes' === $anber_settings['show_title']) : ?>
                                <h3 class="blgtitle"><?php the_title(); ?></h3>
                            <?php endif; ?>

                            <?php if (isset($anber_settings['show_content']) && 'yes' === $anber_settings['show_content']) : ?>
                                <div class="blg-content"><?php echo esc_html(wp_trim_words(get_the_content(), 15, '...')); ?></div>
                            <?php endif; ?>

                            <?php if (isset($anber_settings['show_rdm']) && 'yes' === $anber_settings['show_rdm']) : ?>
                                <div class="postbtn-wrap d-flex">
                                    <a class="post_link d-flex" href="<?php echo esc_url(get_permalink()); ?>">
                                        <span>Read More</span>
                                        <span class="iconsvg icon-wrapper">
                                            <?php
                                            if (!empty($anber_settings['post_button_icon'])) {
                                                \Elementor\Icons_Manager::render_icon($anber_settings['post_button_icon'], ['aria-hidden' => 'true']);
                                            }
                                            ?>
                                        </span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();  // Reset post data after the loop
        endif;
        ?>
    </div>
</div>

<?php
$anber_settings = $this->get_settings_for_display();
$anber_post_car_button = $anber_settings['post_carousel_control'];
$anber_post_previous_icon = $anber_settings['post_previous_icon'];
$anber_post_next_icon = $anber_settings['post_next_icon'];

$anber_post_gap = $anber_settings['item_gap']['size'];

$anber_previous_icon_html2 = '';
if (!empty($anber_post_previous_icon)) {
    // Get the icon HTML
    ob_start(); // Start output buffering
    \Elementor\Icons_Manager::render_icon($anber_post_previous_icon, ['aria-hidden' => 'true']);
    $anber_previous_icon2 = ob_get_clean(); // Store the icon HTML
    $anber_previous_icon_html2 = $anber_previous_icon2; // Sanitize the icon HTML
}

$anber_next_icon_html2 = '';
if (!empty($anber_post_next_icon)) {
    // Get the icon HTML
    ob_start(); // Start output buffering
    \Elementor\Icons_Manager::render_icon($anber_post_next_icon, ['aria-hidden' => 'true']);
    $anber_next_icon2 = ob_get_clean(); // Store the icon HTML
    $anber_next_icon_html2 = $anber_next_icon2; // Sanitize the icon HTML
}


// Get the values for each device (desktop, tablet, mobile)
$anber_carousel_items2 = [
    'desktop' => $anber_settings['post_carousel_item']['size'] ?? 2, // Fallback to 3 if not set
    'tablet' => $anber_settings['post_carousel_item_tablet']['size'] ?? 2, // Fallback to 2 if not set
    'mobile' => $anber_settings['post_carousel_item_mobile']['size'] ?? 1, // Fallback to 1 if not set
];

// Create the script tag


$anber_inline_script2 = "
    jQuery(document).ready(function ($) {
        $('#anber-post-carousel').owlCarousel({
            loop: true,
            margin: " . esc_js($anber_post_gap) . ",
            dots: " . esc_js(($anber_post_car_button == 'dots' || $anber_post_car_button == 'both') ? true : false) . ",
            nav: " . esc_js(($anber_post_car_button == 'nav' || $anber_post_car_button == 'both') ? true : false) . ",
            navText: [" . wp_json_encode($anber_previous_icon_html2) . ", " . wp_json_encode($anber_next_icon_html2) . "],
            autoplay: true,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: " . esc_js($anber_carousel_items2['mobile']) . "
                },
                600: {
                    items: " . esc_js($anber_carousel_items2['tablet']) . "
                },
                1000: {
                    items: " . esc_js($anber_carousel_items2['desktop']) . "
                }
            }
        });
    });
";

// Add the inline script to the registered script.
wp_add_inline_script('anber-carousel-script', $anber_inline_script2);
