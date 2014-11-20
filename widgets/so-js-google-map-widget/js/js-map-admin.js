(function($){

    // After the form is setup, add some custom stuff.
    $(document).on( 'sowsetupform', '.siteorigin-widget-form[data-class="SiteOrigin_Widget_JsGoogleMap_Widget"]', function(){
        var $mapWidgetForm = $(this);

        if( typeof $mapWidgetForm.data('sowsetup-map-widget' == 'undefined' ) ) {

            var $mapTypeField = $mapWidgetForm.find('.siteorigin-widget-field-map_type');
            var updateFieldsForSelectedMapType = function () {
                var $selectedType = $mapTypeField.find('input[type="radio"][name*="map_type"]:checked');
                if ($selectedType.val() == 'static') {
                    $mapWidgetForm.find('.siteorigin-widget-field-width').show();
                    $mapWidgetForm.find('.siteorigin-widget-field-scroll_zoom').hide();
                    //hide marker?
                    $mapWidgetForm.find('.siteorigin-widget-field-marker').hide();
                    $mapWidgetForm.find('.siteorigin-widget-field-marker_draggable').hide();
                    $mapWidgetForm.find('.siteorigin-widget-field-styled_map_name').hide();
                } else {
                    $mapWidgetForm.find('.siteorigin-widget-field-width').hide();
                    $mapWidgetForm.find('.siteorigin-widget-field-scroll_zoom').show();
                    //hide marker?
                    $mapWidgetForm.find('.siteorigin-widget-field-marker').show();
                    $mapWidgetForm.find('.siteorigin-widget-field-marker_draggable').show();
                    $mapWidgetForm.find('.siteorigin-widget-field-styled_map_name').show();
                }
            };
            $mapTypeField.change(updateFieldsForSelectedMapType);
            updateFieldsForSelectedMapType();

            var $styleMethodField = $mapWidgetForm.find('.siteorigin-widget-field-map_styles');
            var updateFieldsForSelectedStyleMethod = function () {
                var $selectedMethod = $styleMethodField.find('input[type="radio"][name*="map_styles"]:checked');
                switch ( $selectedMethod.val() ) {
                    case 'normal' :
                        $mapWidgetForm.find('.siteorigin-widget-field-preset_map_styles').hide();
                        $mapWidgetForm.find('.siteorigin-widget-field-custom_map_styles').hide();
                        $mapWidgetForm.find('.siteorigin-widget-field-raw_json_styles').hide();
                        break;
                    case 'preset' :
                        $mapWidgetForm.find('.siteorigin-widget-field-preset_map_styles').show();
                        $mapWidgetForm.find('.siteorigin-widget-field-custom_map_styles').hide();
                        $mapWidgetForm.find('.siteorigin-widget-field-raw_json_styles').hide();
                        break;
                    case 'custom' :
                        $mapWidgetForm.find('.siteorigin-widget-field-preset_map_styles').hide();
                        $mapWidgetForm.find('.siteorigin-widget-field-custom_map_styles').show();
                        $mapWidgetForm.find('.siteorigin-widget-field-raw_json_styles').hide();
                        break;
                    case 'raw_json' :
                        $mapWidgetForm.find('.siteorigin-widget-field-preset_map_styles').hide();
                        $mapWidgetForm.find('.siteorigin-widget-field-custom_map_styles').hide();
                        $mapWidgetForm.find('.siteorigin-widget-field-raw_json_styles').show();
                        break;
                }
            };
            $styleMethodField.change(updateFieldsForSelectedStyleMethod);
            updateFieldsForSelectedStyleMethod();

            $mapWidgetForm.data('sowsetup-map-widget', true);
        }
    } );

})(jQuery);