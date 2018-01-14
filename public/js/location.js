'use strict';

function initAutocomplete()
{
    let address = document.getElementById('address');
    new google.maps.places.Autocomplete(address, {types: ['geocode']});
}

function getLocation(e)
{
    e.preventDefault();

    if(navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition(geocode, notDetected, {
            timeout: 5000,
            enableHighAccuracy: true
        });
    }
}

function geocode(position)
{
    let latLng = {lat: position.coords.latitude, lng: position.coords.longitude};
    let geocoder = new google.maps.Geocoder();
    geocoder.geocode({location: latLng}, updateAddressField);
}

function notDetected(error)
{
    console.log(error);
}

function updateAddressField(results)
{
    let address = document.getElementById("address");
    address.value = results[0].formatted_address;
}

function geocodeAddress(e)
{
    e.preventDefault();

    let geocoder = new google.maps.Geocoder();
    let data = $(this).serializeArray();
    let address = data[0].value;

    geocoder.geocode({
        address: address
    }, getCoords);
}

function getCoords(results, status)
{
    let geohash = Geohash.encode(results[0].geometry.location.lat(), results[0].geometry.location.lng());
    location.assign('/restaurants/location/' + geohash);

}

$(function(){
    $('#geolocation').on('click', getLocation);
    $('#search_location').on('submit', geocodeAddress);
});