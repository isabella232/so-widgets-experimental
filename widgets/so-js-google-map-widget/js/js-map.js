/**
 * (c) Greg Priday, freely distributable under the terms of the GPL 2.0 license.
 */

function loadMap($) {
    $('.google-map-canvas').each(function () {
        var $$ = $(this);
        // We use the geocoder
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({'address': $$.data('address')}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var zoom = Number($$.data('zoom'));
                if ( !zoom ) zoom = 14;

                var userMapTypeId = 'user_map_style';

                var mapOptions = {
                    zoom: zoom,
                    scrollwheel: Boolean($$.data('scroll-zoom')),
                    center: results[0].geometry.location,
                    mapTypeControlOptions: {
                        mapTypeIds: [google.maps.MapTypeId.ROADMAP, userMapTypeId]
                    }
                };

                var map = new google.maps.Map($$.get(0), mapOptions);

                var userMapOptions = {
                    name: $$.data('map-name')
                };

                var userMapStyles = $$.data('map-styles');

                if ( userMapStyles ) {
                    var userMapType = new google.maps.StyledMapType(userMapStyles, userMapOptions);

                    map.mapTypes.set(userMapTypeId, userMapType);
                    map.setMapTypeId(userMapTypeId);
                }

                var marker = new google.maps.Marker({
                    position: results[0].geometry.location,
                    map: map,
                    draggable: Boolean($$.data('marker-draggable')),
                    icon: $$.data('marker-icon'),
                    title: ''
                });
            }
            else if (status == google.maps.GeocoderStatus.ZERO_RESULTS) {
                $$.append('<div><p><strong>There were no results for the place you entered. Please try another.</strong></p></div>');
            }
        });
    });
}

function loadApi($) {
    var apiKey = $('.google-map-canvas').data('api-key');

    var apiUrl = 'https://maps.googleapis.com/maps/api/js?v=3.exp&callback=initialize';
    if(apiKey) {
        apiUrl += '&key=' + apiKey;
    }
    var script = $('<script type="text/javascript" src="' + apiUrl + '">');
    $('body').append(script);
}

function initialize() {
    loadMap(window.jQuery);
}

jQuery(function ($) {
    if (window.google) {
        loadMap($);
    } else {
        loadApi($);
    }
});