jQuery(function ($) {
    const zipcode = jQuery('#zipcode')

    zipcode.mask('00000-000')

    jQuery(document).on('submit', '#form-store-search', function (event) {
        event.preventDefault()
        let coordinates = []
        let listStores = jQuery('#store-search-filter-results')
        let buttonSearch = jQuery('#button-store-search')

        if (jQuery('#zipcode').val() === "") {
            Swal.fire('Ops!', 'O campo do CEP está vazio!', 'warning')
            zipcode.addClass('empty').focus()
            return false
        } else {
            zipcode.removeClass('empty').focusout()
        }

        jQuery.ajax({
            url: obj.ajaxurl,
            data: {
                nonce: obj.ajax_nonce,
                zipcode: zipcode.val(),
                action: 'places'
            },
            beforeSend: function () {
                listStores.html('').empty()
                buttonSearch.text('Aguarde...')
            }
        }).done((response) => {
            buttonSearch.text('Encontrar')

            if (response.status === 404) {
                Swal.fire('CEP não encontrado!', 'Por favor, verique o CEP digitado', 'warning')
                return false
            }

            if (response.data.length < 1) {
                Swal.fire('Nenhuma Loja Encontrada!', 'Não foram encontradas lojas cadastradas em sua região. Tente novamente com outro CEP.', 'warning')
                return false
            }

            jQuery.get(`https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyD10o8PT8CEbyzDTkCLj9xnCSL02Y-NP3E&address=${response.city}`, (data) => {

                let center_updated = new google.maps.LatLng(
                    data.results[0].geometry.location.lat,
                    data.results[0].geometry.location.lng
                )

                response.data.map((store, index) => {
                    listStores.append(`<li>
                <p>${store.store_name}</p>
                <span>${store.store_address}</span>
                </li>`)

                    coordinates.push({
                        lat: Number(store.store_lat),
                        lng: Number(store.store_long)
                    })
                })

                updateMap(center_updated, coordinates)
            })

        })
    })

    /**
     * API Places Google Maps
     */
    var map;
    var service;
    var center = new google.maps.LatLng(-5.5255, -47.477);

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: center,
            zoom: 7
        });
    }

    function updateMap(center_updated, positions) {
        map = new google.maps.Map(document.getElementById('map'), {
            center: center_updated,
            zoom: 12
        });

        positions.forEach(function (coord) {
            new google.maps.Marker({
                position: coord,
                map: map
            });
        });
    }

    function callback(results, status) {
        if (status == google.maps.places.PlacesServiceStatus.OK) {
            for (var i = 0; i < results.length; i++) {
                var place = results[i];
                createMarker(place);
            }
        }
    }

    function createMarker(place) {
        var marker = new google.maps.Marker({
            map: map,
            position: place.geometry.location
        });

        var infowindow = new google.maps.InfoWindow({
            content: place.name
        });

        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });
    }

    google.maps.event.addDomListener(window, 'load', initMap);
});