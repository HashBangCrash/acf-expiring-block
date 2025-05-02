<?php
/**
 * Plugin Name: ACF Expiring Block
 * Description: A simple WordPress block to allow inner blocks that only get rendered within a specified date range.
 * Version: 1.1.1
 * Author: Stephen Schrauger
 * Plugin URI: https://github.com/HashBangCrash/acf-expiring-block
 * Github Plugin URI: HashBangCrash/acf-expiring-block
 */

namespace hbc_expiring_block;

include_once plugin_dir_path( __FILE__ ) . 'includes/acf-pro-fields.php';
include_once plugin_dir_path( __FILE__ ) . 'includes/block.php';

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Used by acf enqueue assets, to load the js and css conditionally (only when block is on page)
 */
function enqueue_js_css() {
    add_css();
}

function add_css() {
    if ( file_exists( plugin_dir_path( __FILE__ ) . '/includes/plugin.css' ) ) {
        wp_enqueue_style(
            'hbc-expiring-block-style',
            plugin_dir_url( __FILE__ ) . '/includes/plugin.css',
            false,
            filemtime( plugin_dir_path( __FILE__ ) . '/includes/plugin.css' ),
            false
        );
    }
}
