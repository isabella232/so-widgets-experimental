(function($){

    $.fn.initAdminScript = function() {
        $("<style>.siteorigin-widget-field-custom_map_styles.hide { display: none; }</style>").appendTo("head");
        var $mapStylesRepeater = $(this).find(".siteorigin-widget-field-custom_map_styles");
        var $presetsDropdown = $(this).find('select[id*="preset_map_styles"]');
        var showHideCustomStyles = function() {
            if($presetsDropdown.val() == "none") {
                $mapStylesRepeater.removeClass("hide");
            } else {
                $mapStylesRepeater.addClass("hide");
            }
        };
        $presetsDropdown.change(showHideCustomStyles);
        showHideCustomStyles();
    };

})(jQuery);