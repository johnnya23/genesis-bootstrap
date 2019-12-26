<?php
/**
*Plugin Name: Bootstrap with Genesis
*Description: child theme to plugin
*Version: 1.0
*Author: John Antonacci
*Author URI: https://gist.github.com/theandystratton/5924570
*License: GPL2
 */

/**
 * Include all php files in the /includes directory
 *
 * https://gist.github.com/theandystratton/5924570
 */

 /**
  * Absolute file path to Genesis Bootstrap base directory.
  */
define('JMA_GBS_BASE_DIRECTORY', plugin_dir_path(__FILE__));

 /**
  * URI to Genesis Bootstrap base directory.
  */
define('JMA_GBS_BASE_URI', plugin_dir_url(__FILE__));

add_action('genesis_setup', 'JMA_GBS_load_lib_files', 15);

function JMA_GBS_load_lib_files()
{
    foreach (glob(dirname(__FILE__) . '/lib/*.php') as $file) {
        include $file;
    }
}
function jma_gbs_add_customizer()
{
    require_once trailingslashit(dirname(__FILE__)) . 'customizer/functions.php';
}
//add_action('after_setup_theme', 'jma_gbs_add_customizer');

function jma_gbs_customizer($wp_customize)
{
    $wp_customize->add_section('jma_sample_custom_controls_section', array(
        'title'      => __('Visible Section Name', 'mytheme'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting(
            'jma_sample_sortable_repeater_control',
            array(
                'default' => '',
                'transport' => 'refresh',
            'sanitize_callback' => 'skyrocket_text_sanitization'
            )
        );
    $wp_customize->add_control(new JMA_GBS_Sortable_Repeater_Custom_Control(
            $wp_customize,
            'jma_sample_sortable_repeater_control',
            array(
                'label' => __('Sortable Repeatersss'),
                'description' => esc_html__('This is the control description.'),
                'section' => 'jma_sample_custom_controls_section',
            'input_attrs' => array(
                'multiselect' => true,
            ),
            'choices' => array(
                __('Antarctica', 'skyrocket') => array(
                    'Antarctica/Casey' => __('Casey', 'skyrocket'),
                    'Antarctica/Davis' => __('Davis', 'skyrocket'),
                    'Antarctica/DumontDurville' => __('DumontDUrville', 'skyrocket'),
                    'Antarctica/Macquarie' => __('Macquarie', 'skyrocket'),
                    'Antarctica/Mawson' => __('Mawson', 'skyrocket'),
                    'Antarctica/McMurdo' => __('McMurdo', 'skyrocket'),
                    'Antarctica/Palmer' => __('Palmer', 'skyrocket'),
                    'Antarctica/Rothera' => __('Rothera', 'skyrocket'),
                    'Antarctica/Syowa' => __('Syowa', 'skyrocket'),
                    'Antarctica/Troll' => __('Troll', 'skyrocket'),
                    'Antarctica/Vostok' => __('Vostok', 'skyrocket'),
                ),
                __('Atlantic', 'skyrocket') => array(
                    'Atlantic/Azores' => __('Azores', 'skyrocket'),
                    'Atlantic/Bermuda' => __('Bermuda', 'skyrocket'),
                    'Atlantic/Canary' => __('Canary', 'skyrocket'),
                    'Atlantic/Cape_Verde' => __('Cape Verde', 'skyrocket'),
                    'Atlantic/Faroe' => __('Faroe', 'skyrocket'),
                    'Atlantic/Madeira' => __('Madeira', 'skyrocket'),
                    'Atlantic/Reykjavik' => __('Reykjavik', 'skyrocket'),
                    'Atlantic/South_Georgia' => __('South Georgia', 'skyrocket'),
                    'Atlantic/Stanley' => __('Stanley', 'skyrocket'),
                    'Atlantic/St_Helena' => __('St Helena', 'skyrocket'),
                ),
                __('Australia', 'skyrocket') => array(
                    'Australia/Adelaide' => __('Adelaide', 'skyrocket'),
                    'Australia/Brisbane' => __('Brisbane', 'skyrocket'),
                    'Australia/Broken_Hill' => __('Broken Hill', 'skyrocket'),
                    'Australia/Currie' => __('Currie', 'skyrocket'),
                    'Australia/Darwin' => __('Darwin', 'skyrocket'),
                    'Australia/Eucla' => __('Eucla', 'skyrocket'),
                    'Australia/Hobart' => __('Hobart', 'skyrocket'),
                    'Australia/Lindeman' => __('Lindeman', 'skyrocket'),
                    'Australia/Lord_Howe' => __('Lord Howe', 'skyrocket'),
                    'Australia/Melbourne' => __('Melbourne', 'skyrocket'),
                    'Australia/Perth' => __('Perth', 'skyrocket'),
                    'Australia/Sydney' => __('Sydney', 'skyrocket'),
                )
            ),
                'button_labels' => array(
                    'add' => __('Add Rowss'), // Optional. Button label for Add button. Default: Add
                )
            )
        ));



    $wp_customize->add_setting(
        'jma_sample_sortable_input_repeater_control',
    array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_url_sanitization'
    )
);
    $wp_customize->add_control(new Skyrocket_Sortable_Repeater_Custom_Control(
    $wp_customize,
    'jma_sample_sortable_input_repeater_control',
    array(
        'label' => __('Sortable Repeater'),
        'description' => esc_html__('This is the control description.'),
        'section' => 'jma_sample_custom_controls_section',
        'button_labels' => array(
            'add' => __('Add Row'), // Optional. Button label for Add button. Default: Add
        )
    )
));


    $wp_customize->add_setting(
    'jma_sample_dropdown_select2_control_multi',
    array(
        'default' => array( 'Antarctica/McMurdo', 'Australia/Melbourne', 'Australia/Broken_Hill' ),
        'transport' => 'refresh',
        'sanitize_callback' => 'skyrocket_text_sanitization'
    )
);
    $wp_customize->add_control(new Skyrocket_Dropdown_Select2_Custom_Control(
    $wp_customize,
    'jma_sample_dropdown_select2_control_multi',
    array(
        'label' => __('Dropdown Select2 Control', 'skyrocket'),
        'description' => esc_html__('Sample Dropdown Select2 custom control (Multi-Select)', 'skyrocket'),
        'section' => 'jma_sample_custom_controls_section',
        'input_attrs' => array(
            'multiselect' => true,
        ),
        'choices' => array(
            __('Antarctica', 'skyrocket') => array(
                'Antarctica/Casey' => __('Casey', 'skyrocket'),
                'Antarctica/Davis' => __('Davis', 'skyrocket'),
                'Antarctica/DumontDurville' => __('DumontDUrville', 'skyrocket'),
                'Antarctica/Macquarie' => __('Macquarie', 'skyrocket'),
                'Antarctica/Mawson' => __('Mawson', 'skyrocket'),
                'Antarctica/McMurdo' => __('McMurdo', 'skyrocket'),
                'Antarctica/Palmer' => __('Palmer', 'skyrocket'),
                'Antarctica/Rothera' => __('Rothera', 'skyrocket'),
                'Antarctica/Syowa' => __('Syowa', 'skyrocket'),
                'Antarctica/Troll' => __('Troll', 'skyrocket'),
                'Antarctica/Vostok' => __('Vostok', 'skyrocket'),
            ),
            __('Atlantic', 'skyrocket') => array(
                'Atlantic/Azores' => __('Azores', 'skyrocket'),
                'Atlantic/Bermuda' => __('Bermuda', 'skyrocket'),
                'Atlantic/Canary' => __('Canary', 'skyrocket'),
                'Atlantic/Cape_Verde' => __('Cape Verde', 'skyrocket'),
                'Atlantic/Faroe' => __('Faroe', 'skyrocket'),
                'Atlantic/Madeira' => __('Madeira', 'skyrocket'),
                'Atlantic/Reykjavik' => __('Reykjavik', 'skyrocket'),
                'Atlantic/South_Georgia' => __('South Georgia', 'skyrocket'),
                'Atlantic/Stanley' => __('Stanley', 'skyrocket'),
                'Atlantic/St_Helena' => __('St Helena', 'skyrocket'),
            ),
            __('Australia', 'skyrocket') => array(
                'Australia/Adelaide' => __('Adelaide', 'skyrocket'),
                'Australia/Brisbane' => __('Brisbane', 'skyrocket'),
                'Australia/Broken_Hill' => __('Broken Hill', 'skyrocket'),
                'Australia/Currie' => __('Currie', 'skyrocket'),
                'Australia/Darwin' => __('Darwin', 'skyrocket'),
                'Australia/Eucla' => __('Eucla', 'skyrocket'),
                'Australia/Hobart' => __('Hobart', 'skyrocket'),
                'Australia/Lindeman' => __('Lindeman', 'skyrocket'),
                'Australia/Lord_Howe' => __('Lord Howe', 'skyrocket'),
                'Australia/Melbourne' => __('Melbourne', 'skyrocket'),
                'Australia/Perth' => __('Perth', 'skyrocket'),
                'Australia/Sydney' => __('Sydney', 'skyrocket'),
            )
        )
    )
));
}
//add_action('customize_register', 'jma_gbs_customizer', 9999);
