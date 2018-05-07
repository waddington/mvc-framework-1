// This is the javascript that I wrote
// I use jQuery heavily


// Variables accessed by multiple functions
var map;

// Code for the map
function initMap() {
    map = new google.maps.Map(document.getElementById('contact-map'), {
        center: new google.maps.LatLng(51.474278, -0.035526),
        zoom: 15
    }); // Creating a new map object
    var infoWindow = new google.maps.InfoWindow;
}

// Function to download a page
function downloadUrl(url, callback) {
    var request = window.ActiveXObject ? new ActiveXObject('Microsoft.XMLHTTP') : new XMLHttpRequest; // Ternary if/else statement

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            request.onreadystatechange;
            callback(request, request.status);
        }
    };
    request.open('GET', url, true);
    request.send(null);
}

// More code for the map
function getMapMarkers() {
    // Check that we are on the page with the map
    if ($('#contact-map').length == 1) {
        var customLabel = { // Labels for the markers on the map
            rhb: {
                label: 'RHB'
            },
            psh: {
                label: 'PSH'
            },
            igl: {
                label: 'IGL'
            }
        };

        // Getting the map data from the webpage by downloading the file below which calls a function to download the data
        downloadUrl('/~kwadd001/dnw/coursework-2/term-2/Templates/getMapData.php', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            // Looping through the returned data
            Array.prototype.forEach.call(markers, function (markerElem) {
                var id = markerElem.getAttribute('id'); // Retrieving the values of the attributes
                var name = markerElem.getAttribute('name');
                var address = markerElem.getAttribute('address');
                var type = markerElem.getAttribute('type');
                var point = new google.maps.LatLng(
                    parseFloat(markerElem.getAttribute('lat')),
                    parseFloat(markerElem.getAttribute('lng')));

                var infowincontent = document.createElement('div');
                var strong = document.createElement('strong');
                strong.textContent = name
                infowincontent.appendChild(strong);
                infowincontent.appendChild(document.createElement('br'));

                var text = document.createElement('text');
                text.textContent = address
                infowincontent.appendChild(text);
                var icon = customLabel[type] || {};
                var marker = new google.maps.Marker({
                    map: map,
                    position: point,
                    label: icon.label
                });
            });
        });
    }
}

// Code that can only run when the DOM is ready
$(document).ready(function () {
    // Contact form validation and sending
    $('#cm-form').validate();
    $('#cm-send').click(function (e) {
        e.preventDefault();

        // Getting the values from the form
        var formData = {
            'cm-name': $('#cm-name').val(),
            'cm-email': $('#cm-email').val(),
            'cm-message': $('#cm-message').val()
        };

        // Using ajax to submit the form data so that the page doesn't have to refresh
        $.ajax({
            type: 'POST',
            url: '/~kwadd001/dnw/coursework-2/term-2/Templates/submitContactForm.php', // The file that handles the data
            data: formData,
            dataType: 'json'
        }).done(function (data) {
            console.log(data);
            if (data.success) { // If the form submits correctly
                $('.cm.alert-success').removeClass('hidden'); // Showing a success message
                $('#cm-name').val(""); // Resetting form values
                $('#cm-email').val("");
                $('#cm-message').val("");
            } else { // If the form does not submit correctly
                $('.cm.alert-danger').removeClass('hidden'); // Show an error message
            }
        });
    });
});