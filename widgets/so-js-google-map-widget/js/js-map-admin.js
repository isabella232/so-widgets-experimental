(function($){

    // After the form is setup, add some custom stuff.
    $(document).on( 'sowsetupform', '.siteorigin-widget-form[data-class="SiteOrigin_Widget_JsGoogleMap_Widget"]', function(){

        var $mapStylesRepeater = $(this).find(".siteorigin-widget-field-custom_map_styles");
        var $presetsDropdown = $(this).find('select[id*="preset_map_styles"]');
        var showHideCustomStyles = function() {
            if($presetsDropdown.val() == "none") {
                $mapStylesRepeater.show();
            } else {
                $mapStylesRepeater.hide();
            }
        };
        $presetsDropdown.change(showHideCustomStyles);
        showHideCustomStyles();

    } );

})(jQuery);