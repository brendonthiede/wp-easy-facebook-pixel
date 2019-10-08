<?php
/*
Plugin Name: WP Easy Facebook Pixel
Plugin URI: https://www.digestibledevops.com/wp-easy-facebook-pixel
Description: This plugin adds the Facebook Pixel to all pages on your site, with configuration for specific events.
Version: 1.0
Author: Brendon Thiede
Author URI: https://www.digestibledevops.com/
License: MIT
License URI: https://www.digestibledevops.com/wp-easy-facebook-pixel/LICENSE

MIT License

Copyright (c) 2019 Brendon Thiede

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/

function pixel_page_meta()
{
    $event_list = array('ViewContent', 'Lead', 'AddPaymentInfo', 'AddToCart', 'AddToWishlist', 'CompleteRegistration', 'Contact', 'CustomizeProduct', 'Donate', 'FindLocation', 'InitiateCheckout', 'Lead', 'Purchase', 'Schedule', 'Search', 'StartTrial', 'SubmitApplication', 'Subscribe', 'ViewContent');
    $event_type = '';

    echo '<select name="fb-pixel-event-type" id="fb-pixel-event-type">';
    foreach ($event_list as $event_type) {
        echo '<option value="' . $event_type . '">' . $event_type . '</option>';
    }
    echo '</select>';
}

function pixel_event_selector()
{
    add_meta_box('pixel_event_type_meta_selector', 'Facebook Event Type', 'pixel_page_meta', 'page', 'side', 'high');
}

function save_pixel_meta_box($post_id, $post)
{
    if (empty($post_id) || empty($post)) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (is_int(wp_is_post_revision($post))) return;
    if (is_int(wp_is_post_autosave($post))) return;
    if (empty($_POST['fb_pixel_event_meta_nonce']) || !wp_verify_nonce($_POST['fb_pixel_event_meta_nonce'], 'fb_pixel_event_save_data')) return;
    if (!current_user_can('edit_post', $post_id)) return;

    // if (array_key_exists('fb-pixel-event-type', $_POST)) {
    //     update_post_meta(
    //         $post_id,
    //         '_wp_easy_facebook_pixel_meta_key',
    //         $_POST['fb-pixel-event-type']
    //     );
    // }
}

if (is_admin()) {
    add_action('admin_menu', 'pixel_event_selector');
    add_action('save_post', 'save_pixel_meta_box');
}
