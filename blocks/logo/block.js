var el = wp.element.createElement,
    Fragment = wp.element.Fragment,
    registerBlockType = wp.blocks.registerBlockType,
    InspectorControls = wp.editor.InspectorControls;

registerBlockType('jma-gbs/logo-block', {
    title: 'Logo Block',

    icon: 'universal-access-alt',

    category: 'layout',

    edit: function(props) {
        var content = props.attributes.content,
            ServerSideRender = wp.components.ServerSideRender;





        return [
            el(
                InspectorControls,
                null,
                el('div', {}, 'Displays the logo as set on the customizer page')
            ),
            el(ServerSideRender, {
                block: 'jma-gbs/logo-block'
            })
        ];
    },

    save: function() {
        return null;
    },
});