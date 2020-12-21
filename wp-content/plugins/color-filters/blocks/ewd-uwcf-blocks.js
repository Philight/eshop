var el = wp.element.createElement,
	registerBlockType = wp.blocks.registerBlockType,
	ServerSideRender = wp.components.ServerSideRender,
	TextControl = wp.components.TextControl,
	InspectorControls = wp.editor.InspectorControls;

registerBlockType( 'color-filters/ewd-uwcf-display-filters-block', {
	title: 'WooCommerce Filters',
	icon: 'filter',
	category: 'ewd-uwcf-blocks',
	attributes: {
	},

	edit: function( props ) {
		var returnString = [];
		returnString.push( el( 'div', { class: 'ewd-uwcf-admin-block ewd-uwcf-admin-block-display-filters' }, 'Display WooCommerce Filters' ) );
		return returnString;
	},

	save: function() {
		return null;
	},
} );

