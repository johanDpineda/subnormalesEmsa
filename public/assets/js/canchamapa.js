function initMap() {
    var latitud = parseFloat(document.getElementById('latitud').value);
    var longitud = parseFloat(document.getElementById('longitud').value);

    var mapOptions = {
        center: { lat: latitud, lng: longitud }, // Coordenadas del centro del mapa desde los elementos ocultos
        zoom: 12 // Nivel de zoom
    };

    var map = new google.maps.Map(document.getElementById('map'), mapOptions);
}
