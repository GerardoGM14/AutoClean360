// 🔁 Importar Firestore
import { db } from '../firebase';
import { doc, setDoc, getDoc } from 'firebase/firestore';
import Swal from 'sweetalert2'; // <-- Asegúrate de tener esta línea

// 🌐 Variables globales del mapa
let map;
let marker;

// 🗺️ Función global requerida por Google Maps para cargar el mapa
window.initMap = function () {
    const defaultLocation = { lat: -9.1196, lng: -78.5267 };

    map = new google.maps.Map(document.getElementById("map"), {
        center: defaultLocation,
        zoom: 15,
    });

    marker = new google.maps.Marker({
        position: defaultLocation,
        map: map,
        draggable: true,
    });

    document.getElementById("lat").value = defaultLocation.lat;
    document.getElementById("lng").value = defaultLocation.lng;

    marker.addListener("dragend", (e) => {
        document.getElementById("lat").value = e.latLng.lat();
        document.getElementById("lng").value = e.latLng.lng();
    });
};

document.addEventListener('DOMContentLoaded', async () => {
    const btnGuardar = document.getElementById('guardarUbicacion');

    const docSnap = await getDoc(doc(db, 'configuracion', 'ubicacion'));
    if (docSnap.exists()) {
        const data = docSnap.data();
        document.getElementById("lat").value = data.lat;
        document.getElementById("lng").value = data.lng;

        if (typeof map !== 'undefined' && typeof marker !== 'undefined') {
            const nuevaUbicacion = { lat: data.lat, lng: data.lng };
            map.setCenter(nuevaUbicacion);
            marker.setPosition(nuevaUbicacion);
        }
    }

    btnGuardar.addEventListener('click', async () => {
        const lat = parseFloat(document.getElementById('lat').value);
        const lng = parseFloat(document.getElementById('lng').value);

        if (isNaN(lat) || isNaN(lng)) {
            return Swal.fire({
                icon: 'error',
                title: 'Coordenadas inválidas',
                text: 'Por favor ingresa una latitud y longitud válidas.',
            });
        }

        await setDoc(doc(db, 'configuracion', 'ubicacion'), {
            lat,
            lng,
            updatedAt: new Date()
        });

        Swal.fire({
            icon: 'success',
            title: 'Ubicación guardada',
            text: 'Los datos fueron registrados correctamente.',
            toast: true,
            position: 'bottom-end',
            timer: 3000,
            showConfirmButton: false,
        });
    });
});

if (typeof google !== 'undefined' && typeof google.maps !== 'undefined') {
    window.initMap();
}

