function initAutocomplete() {
    const input = document.getElementById('location-autocomplete');
    const lng = document.getElementById('lng-autocomplete');
    const lat = document.getElementById('lat-autocomplete');

    let autocomplete = new google.maps.places.Autocomplete(input);

    autocomplete.addListener('place_changed', () => {
        const place = autocomplete.getPlace();
        lng.value = place.geometry.location.lng();
        lat.value = place.geometry.location.lat();
    });

    // don't submit form when users hit enter on location field
    input.addEventListener('keydown', e => {
        if (e.keyCode == 13) e.preventDefault();
    });
}
