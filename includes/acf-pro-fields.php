<?php

namespace hbc_expiring_block\acf_pro_fields;

// Register the block
add_action('acf/init', __NAMESPACE__ . '\register_expiring_block');

function register_expiring_block() {
    if (function_exists('acf_register_block_type')) {
        acf_register_block_type(array(
            'name'              => 'acf-expiring-block',
            'title'             => __('Expiring Block'),
            'description'       => __('A simple WordPress block to allow inner blocks that only get rendered within a specified date range.'),
            'render_callback'   => 'hbc_expiring_block\\block\\expiring_block_render_callback',
            'enqueue_assets'    => 'hbc_expiring_block\\enqueue_js_css',
            'category'          => 'layout',
            'icon'              => 'calendar-alt',
            'keywords'          => array('expire', 'expiring', 'date', 'time', 'visibility', 'schedule'),
            'supports'          => array(
                'align'            => false,
                'mode'             => true,
                'jsx'              => true,
                'multiple'         => true,
                'innerBlocks'      => true, // Allow nested blocks inside
                'customClassName'  => true,
            ),
        ));
    }

    if( function_exists('acf_add_local_field_group') ) {

        acf_add_local_field_group(array(
            'key' => 'group_acf_expiring_block',
            'title' => 'Expiring Block Date Settings',
            'fields' => array(
                array(
                    'key' => 'field_start_date',
                    'label' => 'Start Date',
                    'name' => 'start_date',
                    'type' => 'date_time_picker',
                    'required' => 0,
                    'display_format' => 'Y-m-d H:i:s',
                    'return_format' => 'Y-m-d H:i:s',
                ),
                array(
                    'key' => 'field_end_date',
                    'label' => 'End Date',
                    'name' => 'end_date',
                    'type' => 'date_time_picker',
                    'required' => 0,
                    'display_format' => 'Y-m-d H:i:s',
                    'return_format' => 'Y-m-d H:i:s',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'block',
                        'operator' => '==',
                        'value' => 'acf/acf-expiring-block',
                    ),
                ),
            ),
        ));
    }
}

