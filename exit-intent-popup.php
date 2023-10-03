<?php
/*
Plugin Name: Exit Intent Popup
Description: Display a popup when the user leaves the page.
Version: 1.01
Author: Lawrence Makoona - Lide Digital Studio
*/

// Enqueue the JavaScript and CSS files
function exit_intent_popup_enqueue_bioep() {
    wp_enqueue_script('bioep', plugin_dir_url(__FILE__) . 'js/bioep.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'exit_intent_popup_enqueue_bioep');

function exit_intent_popup_enqueue_scripts() {
    wp_enqueue_script('exit-intent-popup', plugin_dir_url(__FILE__) . 'js/exit-intent-popup.js', array('jquery'), '1.0', true);
    wp_enqueue_style('exit-intent-popup-style', plugin_dir_url(__FILE__) . 'css/exit-intent-popup.css');
}
add_action('wp_enqueue_scripts', 'exit_intent_popup_enqueue_scripts');

// Add the popup content
function exit_intent_popup_content() {
    ob_start(); // Start output buffering

    // Customize the popup content here
    ?>
    <div id="bio_ep">
        <div id="bio_ep_content">
            <h2>Don’t go without saying goodbye!</h2>
            <p>Seriously though, we’d love to know how we can help you with your social media needs. Send us a message, and our Head of Strategy Jess will reach out for a chat.</p>
            <?php echo do_shortcode('[contact-form-7 id="2947" title="Get in touch - Contact Page"]'); ?>
            <br />
        </div>
    </div>
    <?php

    $popup_content = ob_get_clean(); // Get the buffered content

    return $popup_content;
}
// Add a plugin option for the popup content
function exit_intent_popup_settings_init() {
    register_setting('exit_intent_popup_settings', 'exit_intent_popup_content');
}
add_action('admin_init', 'exit_intent_popup_settings_init');

// Create a plugin settings page to edit the popup content
function exit_intent_popup_settings_page() {
    add_options_page('Exit Intent Popup Settings', 'Exit Intent Popup', 'manage_options', 'exit_intent_popup_settings', 'exit_intent_popup_settings_page_callback');
}
add_action('admin_menu', 'exit_intent_popup_settings_page');

// Callback function for the plugin settings page
function exit_intent_popup_settings_page_callback() {
    ?>
    <div class="wrap">
        <h2>Exit Intent Popup Settings</h2>
        <form method="post" action="options.php">
            <?php settings_fields('exit_intent_popup_settings'); ?>
            <?php do_settings_sections('exit_intent_popup_settings'); ?>
            <textarea name="exit_intent_popup_content" rows="10" cols="50"><?php echo esc_textarea(get_option('exit_intent_popup_content')); ?></textarea>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
