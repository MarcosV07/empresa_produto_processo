var map;
var marker;

function iniciarlizarMapa(lat, long, z) {
    map = L.map('map').setView([lat, long], z);

    var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
    }).addTo(map);

    if (flAdicionarPin == 1) {
        adicionarPin(lat, long);
    }
}

function atualizarPosicaoMapa(logradouro, cidade, estado) {
    var urlNominatim = "https://nominatim.openstreetmap.org/search?street=" + logradouro + "&city=" + cidade + "&state=" + estado + "&country=Brasil&format=json";
    $.getJSON(urlNominatim, function(dados) {
        if (dados[0]) {
            var latitude = dados[0]['lat'];
            var longitude = dados[0]['lon'];

            // remove a marcação anterior
            if (marker) {
                marker.off("dragend"); // para de escutar as mudanças no pin
                map.removeLayer(marker); // remove o pin
            }

            adicionarPin(latitude, longitude);

            map.setView([latitude, longitude], 17);

            $("#latitude").val(latitude);
            $("#longitude").val(longitude);

            carregarBairros(estado, cidade, latitude, longitude);
        }
    });
}

function escutarMudancaPin(marker) {
    marker.on('dragend', function(e) {
        $("#latitude").val(marker.getLatLng().lat);
        $("#longitude").val(marker.getLatLng().lng);
    });
}

function adicionarPin(latitude, longitude) {
    marker = L.marker([latitude, longitude], { draggable: true }).addTo(map);
    escutarMudancaPin(marker);
}

$(document).ready(function() {
    iniciarlizarMapa(latitude, longitude, zoom);
});