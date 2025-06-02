// Archivo plano, sin módulos ES6
async function initMap() {
    const response = await fetch('/ubicacion.json');
    const data = await response.json();

    const lavaderoLatLng = { lat: data.lat, lng: data.lng };

    const map = new google.maps.Map(document.getElementById("map"), {
        center: lavaderoLatLng,
        zoom: 15,
    });

    new google.maps.Marker({
        position: lavaderoLatLng,
        map: map,
        title: "Lavadero de Autos",
    });

    // Obtener ubicación del cliente
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition((position) => {
            const userLatLng = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
            };

            const distancia = calcularDistancia(userLatLng, lavaderoLatLng);
            document.getElementById("distancia").innerText =
                `🚗 Estás a ${distancia.toFixed(2)} km del lavadero.`;
        });
    }
}

function calcularDistancia(coord1, coord2) {
    const R = 6371;
    const dLat = toRad(coord2.lat - coord1.lat);
    const dLon = toRad(coord2.lng - coord1.lng);
    const a =
        Math.sin(dLat / 2) ** 2 +
        Math.cos(toRad(coord1.lat)) *
        Math.cos(toRad(coord2.lat)) *
        Math.sin(dLon / 2) ** 2;

    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return R * c;
}

function toRad(value) {
    return value * Math.PI / 180;
}

window.initMap = initMap;
