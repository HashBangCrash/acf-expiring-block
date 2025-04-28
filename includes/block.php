<?php

namespace hbc_expiring_block\block;

function expiring_block_render_callback($block, $content = '', $is_preview = false, $post_id = 0) {
    // Custom class handling
    $class_name = isset($block['className']) ? esc_attr($block['className']) : '';

    // Load field values.
    $start_date = get_field('start_date');
    $end_date = get_field('end_date');
    $now = current_time('Y-m-d H:i:s'); // WP's localized time.

    if( $start_date && $end_date ) {
        if( $now < $start_date || $now > $end_date ) {
            // Outside the range — don't output anything
            return;
        }
    }

    // Inside range or no dates set — output content
    echo "
    <div class='expiring-block ${class_name}'>
        ${content}
    </div>
    ";
}