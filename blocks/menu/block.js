var el = wp.element.createElement,
    Fragment = wp.element.Fragment,
    registerBlockType = wp.blocks.registerBlockType,
    InspectorControls = wp.editor.InspectorControls,
    RadioControl = wp.components.RadioControl,
    ColorPicker = wp.components.ColorPicker;

registerBlockType('jma-gbs/menu-block', {
    title: 'Menu Block',

    icon: 'universal-access-alt',

    category: 'layout',

    attributes: {
        nav_val: {
            type: 'string',
            default: 'genesis_do_nav',
        },
        use_bg: {
            type: 'string',
            default: '1',
        },
        menu_bg: {
            type: 'string'
        },
        menu_font: {
            type: 'string'
        },
        menu_bg_hover: {
            type: 'string'
        },
        menu_font_hover: {
            type: 'string'
        },
        menu_bg_active: {
            type: 'string'
        },
        menu_font_active: {
            type: 'string'
        }
    },

    edit: function(props) {
        var content = props.attributes.content,
            nav_val = props.attributes.nav_val,
            use_bg = props.attributes.use_bg,
            menu_bg = props.attributes.menu_bg,
            menu_font = props.attributes.menu_font,
            menu_bg_hover = props.attributes.menu_bg_hover,
            menu_font_hover = props.attributes.menu_font_hover,
            menu_bg_active = props.attributes.menu_bg_active,
            menu_font_active = props.attributes.menu_font_active;
        var ServerSideRender = wp.components.ServerSideRender;





        return [
            el(
                InspectorControls,
                null,
                el(
                    RadioControl, {
                        label: 'Nav Location',
                        selected: nav_val,
                        options: [{
                                label: 'Primary',
                                value: '1'
                            },
                            {
                                label: 'Secondary',
                                value: '0'
                            }
                        ],
                        onChange: function(newValue) {
                            props.setAttributes({
                                nav_val: newValue
                            });
                        }
                    }
                ),
                el(
                    RadioControl, {
                        label: 'Use Background on Root',
                        selected: use_bg,
                        options: [{
                                label: 'Yes',
                                value: '1'
                            },
                            {
                                label: 'No',
                                value: '0'
                            }
                        ],
                        onChange: function(newValue) {
                            props.setAttributes({
                                use_bg: newValue
                            });
                        }
                    }
                ),
                el('div', {}, 'Menu Background'),
                el(ColorPicker, {
                    type: 'color',
                    color: menu_bg,
                    onChangeComplete: function(newValue) {
                        props.setAttributes({
                            menu_bg: newValue.hex
                        });
                    },
                    disableAlpha: true
                }),
                el('div', {}, 'Menu Font'),
                el(ColorPicker, {
                    type: 'color',
                    color: menu_font,
                    onChangeComplete: function(newValue) {
                        props.setAttributes({
                            menu_font: newValue.hex
                        });
                    },
                    disableAlpha: true
                }),
                el('div', {}, 'Menu Background Hover'),
                el(ColorPicker, {
                    type: 'color',
                    color: menu_bg_hover,
                    onChangeComplete: function(newValue) {
                        props.setAttributes({
                            menu_bg_hover: newValue.hex
                        });
                    },
                    disableAlpha: true
                }),
                el('div', {}, 'Menu Font Hover'),
                el(ColorPicker, {
                    type: 'color',
                    color: menu_font_hover,
                    onChangeComplete: function(newValue) {
                        props.setAttributes({
                            menu_font_hover: newValue.hex
                        });
                    },
                    disableAlpha: true
                }),
                el('div', {}, 'Menu Background Active'),
                el(ColorPicker, {
                    type: 'color',
                    color: menu_bg_active,
                    onChangeComplete: function(newValue) {
                        props.setAttributes({
                            menu_bg_active: newValue.hex
                        });
                    },
                    disableAlpha: true
                }),
                el('div', {}, 'Menu Font Active'),
                el(ColorPicker, {
                    type: 'color',
                    color: menu_font_active,
                    onChangeComplete: function(newValue) {
                        props.setAttributes({
                            menu_font_active: newValue.hex
                        });
                    },
                    disableAlpha: true
                })
            ),
            el(ServerSideRender, {
                block: 'jma-gbs/menu-block',
                attributes: props.attributes,
            })
        ];
    },

    save: function() {
        return null;
    },
});