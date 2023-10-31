const countryNames = [
    { value: 1, name: 'Oman' },
    { value: 2, name: 'Bahrain' },
    { value: 3, name: 'Kuwait' },
    { value: 4, name: 'Qatar' },
    { value: 5, name: 'Saudi Arabia' },
    { value: 6, name: 'United Arab Emirates' }
];
var map;
var editMap;
var marker;
var editMarker;
var autocomplete;
var editAutocomplete;
var geocoder = new google.maps.Geocoder();

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: parseFloat(document.getElementById('lat').value), lng: parseFloat(document.getElementById('lng').value) },
        zoom: 15,
        mapTypeControl: false,
    });

    // Add custom control for "Get My Location"
    var controlDiv = document.getElementById('current-location-control');
    controlDiv.innerHTML = ''
    var controlUI = document.createElement('div');
    controlUI.title = 'Locate me';
    controlUI.className = "d-flex align-items-center"
    controlUI.style.cssText = "padding-top: 1px";
    controlDiv.appendChild(controlUI);

    var icon = document.createElement('i');
    icon.className = 'fas fa-crosshairs';
    icon.style.cssText = "color: #555";
    controlUI.appendChild(icon);

    var text = document.createElement('span');
    text.className = `${default_language === 1 ? 'me-1' : 'ms-1'} pt-1 text-uppercase fw-bolder`;
    text.style.cssText = "color: #555";
    text.textContent = 'Locate me';
    controlUI.appendChild(text);

    controlDiv.addEventListener('click', getCurrentLocation);

    marker = new google.maps.Marker({
        position: { lat: parseFloat(document.getElementById('lat').value), lng: parseFloat(document.getElementById('lng').value) },
        map: map,
        draggable: true,
    });

    marker.addListener('dragend', handleMarkerDrag);

    autocomplete = new google.maps.places.Autocomplete(document.getElementById('search_address'), {
        types: ['establishment'],
    });

    autocomplete.addListener('place_changed', handlePlaceChanged);
}

function initEditMap(lat, lng) {
    editMap = new google.maps.Map(document.getElementById('edit-map'), {
        center: { lat: parseFloat(lat), lng: parseFloat(lng) },
        zoom: 15,
        mapTypeControl: false,
    });

    // Add custom control for "Get My Location"
    var editControlDiv = document.getElementById('edit-current-location-control');
    var editControlUI = document.createElement('div');
    editControlUI.title = 'Locate me';
    editControlUI.className = "d-flex align-items-center";
    editControlUI.style.cssText = "padding-top: 1px";
    editControlDiv.appendChild(editControlUI);

    var editIcon = document.createElement('i');
    editIcon.className = 'fas fa-crosshairs';
    editIcon.style.cssText = "color: #555";
    editControlUI.appendChild(editIcon);

    var editText = document.createElement('span');
    editText.className = `${default_language === 1 ? 'me-1' : 'ms-1'} pt-1 text-uppercase fw-bolder`;
    editText.style.cssText = "color: #555";
    editText.textContent = 'Locate me';
    editControlUI.appendChild(editText);

    editControlDiv.addEventListener('click', getEditCurrentLocation);

    editMarker = new google.maps.Marker({
        position: { lat: parseFloat(lat), lng: parseFloat(lng) },
        map: editMap,
        draggable: true,
    });

    editMarker.addListener('dragend', handleEditMarkerDrag);

    editAutocomplete = new google.maps.places.Autocomplete(document.getElementById('search_address1'), {
        types: ['establishment'],
    });

    editAutocomplete.addListener('place_changed', handleEditPlaceChanged);
}

function getCurrentLocation() {
    if ('geolocation' in navigator) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var newPosition = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
            };
            map.setCenter(newPosition);
            marker.setPosition(newPosition);
            updateLatLngInputs(newPosition.lat, newPosition.lng);
            geocodePosition(newPosition);
            reverseGeocode(newPosition);
        }, function (error) {
            console.log('Error getting current location:', error);
            alert('Error getting current location. Please try again.');
        });
    } else {
        alert('Geolocation is not supported by your browser.');
    }
}

function getEditCurrentLocation() {
    if ('geolocation' in navigator) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var newPosition = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
            };
            editMap.setCenter(newPosition);
            editMarker.setPosition(newPosition);
            updateEditLatLngInputs(newPosition.lat, newPosition.lng);
            editGeocodePosition(newPosition);
            editReverseGeocode(newPosition);
        }, function (error) {
            console.log('Error getting current location:', error);
            alert('Error getting current location. Please try again.');
        });
    } else {
        alert('Geolocation is not supported by your browser.');
    }
}

function handleMarkerDrag() {
    var newPosition = marker.getPosition();
    updateLatLngInputs(newPosition.lat(), newPosition.lng());
    geocodePosition(newPosition);
    reverseGeocode(newPosition);
}

function handleEditMarkerDrag() {
    var newPosition = editMarker.getPosition();
    updateEditLatLngInputs(newPosition.lat(), newPosition.lng());
    editGeocodePosition(newPosition);
    editReverseGeocode(newPosition);
}

function handlePlaceChanged() {
    var place = autocomplete.getPlace();
    if (place.geometry) {
        var newPosition = place.geometry.location;
        map.setCenter(newPosition);
        marker.setPosition(newPosition);
        updateLatLngInputs(newPosition.lat(), newPosition.lng());
        geocodePosition(newPosition);
        reverseGeocode(newPosition);
    } else {
        alert('No location found for the entered address.');
    }
}

function handleEditPlaceChanged() {
    var place = editAutocomplete.getPlace();
    if (place.geometry) {
        var newPosition = place.geometry.location;
        editMap.setCenter(newPosition);
        editMarker.setPosition(newPosition);
        updateEditLatLngInputs(newPosition.lat(), newPosition.lng());
        editGeocodePosition(newPosition);
        editReverseGeocode(newPosition);
    } else {
        alert('No location found for the entered address.');
    }
}

function reverseGeocode(position) {
    geocoder.geocode({ location: position }, function (results, status) {
        if (status === 'OK' && results[0]) {
            var country = getCountryFromGeocode(results[0]);
            setSelectedCountry(country);
        }
    });
}

function editReverseGeocode(position) {
    geocoder.geocode({ location: position }, function (results, status) {
        if (status === 'OK' && results[0]) {
            var country = getCountryFromGeocode(results[0]);
            setEditSelectedCountry(country);
        }
    });
}

function getCountryFromGeocode(geocode) {
    for (var i = 0; i < geocode.address_components.length; i++) {
        var component = geocode.address_components[i];
        if (component.types.includes('country')) {
            return component.long_name;
        }
    }
    return '';
}

function clearAddressForm() {
    document.querySelector('#lat').value = '';
    document.querySelector('#lng').value = '';
    document.querySelector('#fulladdress').value = '';
    document.querySelector('#country').value = '';
}

function updateLatLngInputs(lat, lng) {
    document.getElementById('lat').value = lat;
    document.getElementById('lng').value = lng;
}

function updateEditLatLngInputs(lat, lng) {
    document.getElementById('edit-lat').value = lat;
    document.getElementById('edit-lng').value = lng;
}

function geocodePosition(pos) {
    geocoder.geocode({ latLng: pos }, function (results, status) {
        if (status === 'OK' && results[0]) {
            console.log(results)
            document.getElementById('search_address').value = results[0].formatted_address;
            document.getElementById('fulladdress').value = results[0].formatted_address;
        } else {
            console.log('Geocoder failed due to: ' + status);
        }
    });
}

function editGeocodePosition(pos) {
    geocoder.geocode({ latLng: pos }, function (results, status) {
        if (status === 'OK' && results[0]) {
            console.log(results)
            document.getElementById('search_address1').value = results[0].formatted_address;
            document.getElementById('edit-address').value = results[0].formatted_address;
        } else {
            console.log('Geocoder failed due to: ' + status);
        }
    });
}

window.addEventListener('load', initMap);


/* International Telephone Input */
const input = document.querySelector("#mobile");
var iti = window.intlTelInputGlobals.getInstance(input);
function initializeIntlTelInput(initialCountry) {
    if (iti) {
        // If iti instance exists, destroy it before reinitializing
        iti.destroy();
    }

    iti = window.intlTelInput(input, {
        initialCountry: initialCountry,
        onlyCountries: ["om", "bh", "kw", "qa", "sa", "ae"],
        separateDialCode: true,
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.8/build/js/utils.js"
    });
}
initializeIntlTelInput("om");
