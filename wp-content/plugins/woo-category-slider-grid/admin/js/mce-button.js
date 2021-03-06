(function () {
    tinymce.PluginManager.add('sp_wcsp_mce_button', function (editor, url) {
        editor.addButton('sp_wcsp_mce_button', {
            text: false,
            icon: false,
            image: url + '/woo-category-slider-icon.svg',
            tooltip: 'Category Slider for WooCommerce',
            onclick: function () {
                editor.windowManager.open({
                    title: 'Insert Shortcode',
                    width: 400,
                    height: 100,
                    body: [
                        {
                            type: 'listbox',
                            name: 'listboxName',
                            label: 'Select Shortcode',
                            'values': editor.settings.spWCSShortcodeList
                        }
                    ],
                    onsubmit: function (e) {
                        editor.insertContent('[woocatslider id="' + e.data.listboxName + '"]');
                    }
                });
            }
        });
    });
})();
