(function() {


    function conditional_display(conditional, condition_toggled) {
        wp.customize.control(conditional, function(control) {
            var conditions, toggleControl; // here.
            //conditions are the value(s) for controller that will trigger toggling
            conditions = condition_toggled.split('^');
            toggleControl = function toggleControl(value) {
                conditions.forEach(function(condition) {
                    var cond_display_control, controllers; // here.
                    //this will get the condition that will result in display
                    //and controllers of displayed items
                    cond_display_control = condition.split('|');
                    //separates out the controllers to be displayed
                    controllers = cond_display_control[1].split(',');
                    if (value == cond_display_control[0]) {

                        controllers.forEach(function(controller) {
                            console.log(controller);
                            wp.customize.control(controller).toggle(true);
                        });
                    } else {
                        controllers.forEach(function(controller) {
                            wp.customize.control(controller).toggle(false);
                        });
                    }
                });
            };

            toggleControl(control.setting.get());
            control.setting.bind(toggleControl);
        });
    }
    /**
     * Run functions when customizer is ready.
     */
    wp.customize.bind('ready', function() {
        conditional_display('jma_gbs_frame_content_control', '1|jma_gbs_frame_border_color_control,jma_gbs_frame_border_width_control,jma_gbs_frame_border_radius_control');

        conditional_display('jma_gbs_modular_header_control', '1|jma_gbs_header_border_color_control,jma_gbs_header_border_width_control,jma_gbs_header_border_radius_control');

        conditional_display('jma_gbs_modular_footer_control', '1|jma_gbs_footer_border_color_control,jma_gbs_footer_border_width_control,jma_gbs_footer_border_radius_control');

        conditional_display('jma_gbs_use_menu_root_bg_control', '0|jma_gbs_menu_root_font_color_control,jma_gbs_menu_root_current_font_color_control,jma_gbs_menu_root_hover_font_color_control,jma_gbs_menu_highlight_control');

        conditional_display('jma_gbs_site_font_family_control', 'custom|jma_gbs_site_custom_font_family_control');

        conditional_display('jma_gbs_site_title_font_family_control', 'custom|jma_gbs_site_custom_title_font_family_control');
    });
})();