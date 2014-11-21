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
                    $mapWidgetForm.find('.siteorigin-widget-field-marker_draggable').hide();
                    $mapWidgetForm.find('.siteorigin-widget-field-stylesstyled_map_name').hide();
                } else {
                    $mapWidgetForm.find('.siteorigin-widget-field-width').hide();
                    $mapWidgetForm.find('.siteorigin-widget-field-scroll_zoom').show();
                    $mapWidgetForm.find('.siteorigin-widget-field-marker_draggable').show();
                    $mapWidgetForm.find('.siteorigin-widget-field-stylesstyled_map_name').show();
                }
            };
            $mapTypeField.change(updateFieldsForSelectedMapType);
            updateFieldsForSelectedMapType();

            var $styleMethodField = $mapWidgetForm.find('.siteorigin-widget-field-stylesmap_styles');
            var $fieldPresets = $mapWidgetForm.find('.siteorigin-widget-field-stylespreset_map_styles');
            var $fieldCustom = $mapWidgetForm.find('.siteorigin-widget-field-stylescustom_map_styles');
            var $fieldRawJson = $mapWidgetForm.find('.siteorigin-widget-field-stylesraw_json_styles');
            var $fieldMapName = $mapWidgetForm.find('.siteorigin-widget-field-stylesstyled_map_name');
            var updateFieldsForSelectedStyleMethod = function () {
                var $selectedMethod = $styleMethodField.find('input[type="radio"][name*="map_styles"]:checked');
                switch ( $selectedMethod.val() ) {
                    case 'normal' :
                        $fieldPresets.hide();
                        $fieldCustom.hide();
                        $fieldRawJson.hide();
                        $fieldMapName.hide();
                        break;
                    case 'preset' :
                        $fieldPresets.show();
                        $fieldCustom.hide();
                        $fieldRawJson.hide();
                        $fieldMapName.show();
                        break;
                    case 'custom' :
                        $fieldPresets.hide();
                        $fieldCustom.show();
                        $fieldRawJson.hide();
                        $fieldMapName.show();
                        break;
                    case 'raw_json' :
                        $fieldPresets.hide();
                        $fieldCustom.hide();
                        $fieldRawJson.show();
                        $fieldMapName.show();
                        break;
                }
            };
            $styleMethodField.change(updateFieldsForSelectedStyleMethod);
            updateFieldsForSelectedStyleMethod();

            $mapWidgetForm.data('sowsetup-map-widget', true);
        }
    } );

})(jQuery);