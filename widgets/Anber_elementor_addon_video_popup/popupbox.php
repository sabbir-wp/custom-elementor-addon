<?php
/**
 * @package   Anber_Elementor_Addon
 * @since 1.0.1
 * 
 *
 * 
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly 
?>
<div class="video-pop-wrap">
    <div class="vpop" 
         data-type="<?php echo esc_attr($settings['video_type']); ?>" 
         data-id="<?php echo esc_attr($settings['video_url']); ?>" 
         data-autoplay='true'>
        <?php if (!empty($settings['poster_image']['id'])) : ?>
            <img class="vpop_img" src="<?php echo esc_url(wp_get_attachment_image_url($settings['poster_image']['id'], 'full')); ?>" />
        <?php endif; ?>
    </div>
</div>


<!-- copy this stuff and down -->
<div id="video-popup-overlay"></div>

<div id="video-popup-container">
    <div id="video-popup-close" class="fade">&#10006;</div>
    <div id="video-popup-iframe-container">
        <iframe id="video-popup-iframe" src="<?php echo esc_url($settings['video_url'], 'anber-elementor-addon'); ?>" width="100%" height="100%" frameborder="0"></iframe>
    </div>
</div>
