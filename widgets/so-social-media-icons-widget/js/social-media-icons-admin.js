(function($){

    window.sowFetchWidgetVariable = function (key, widget, callback) {
        window.sowVars = window.sowVars || {};
        window.sowVars[widget] = window.sowVars[widget] || {};

        if (typeof window.sowVars[widget][key] == 'undefined') {
            //TODO: make this work with admin action.
            //var data = {
            //    'action': 'so_widgets_variable',
            //    'widget': widget,
            //    'key': key
            //};
            //
            //$.post(
            //    ajaxurl,
            //    data,
            //    function (result) {
            //        window.sowVars[key] = result;
            //        callback(window.sowVars[key]);
            //    },
            //    'html'
            //);
            window.sowVars[widget][key] = window[widget][key];
            callback(window.sowVars[widget][key]);
        }
        else {
            callback(window.sowVars[widget][key]);
        }
    };

    // After the form is setup, add some custom stuff.
    $(document).on( 'sowsetupform', '.siteorigin-widget-form[data-class="SiteOrigin_Widget_SocialMediaIcons_Widget"]', function() {
        var $socialMediaForm = $(this);

        var setNetworkDefaults = function($selectNetworkInput) {
            window.sowFetchWidgetVariable('networks', 'SiteOrigin_Widget_SocialMediaIcons_Widget',
                function(networks) {
                    var selectedNetwork = networks[$selectNetworkInput.find(':selected').val()];
                    var $closestForm = $selectNetworkInput.closest('.siteorigin-widget-field-repeater-item-form');

                    var $urlInput = $closestForm.find('[id*="networks-url"]');
                    $urlInput.val(selectedNetwork.base_url);

                    var $iconColorPicker = $closestForm.find('[id*="networks-icon_color"]');
                    $iconColorPicker.wpColorPicker('color', selectedNetwork.icon_color);

                    var $backgroundColorPicker = $closestForm.find('[id*="networks-background_color"]');
                    $backgroundColorPicker.wpColorPicker('color', selectedNetwork.background_color);
                }
            );
        };

        if ( typeof $socialMediaForm.data('initialised') == 'undefined' ) {
            $socialMediaForm.on('change', '[id*="networks-name"]',
                function(event) {
                    setNetworkDefaults($(event.target));
                }
            );

            $socialMediaForm.data('initialised', true);
        }

    } );

})(jQuery);