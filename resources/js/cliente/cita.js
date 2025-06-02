// resources/js/cliente/cita.js
import { db, storage } from '../firebase';
import { collection, addDoc, Timestamp } from 'firebase/firestore';
import { ref, uploadBytes, getDownloadURL } from 'firebase/storage';
import Swal from 'sweetalert2';

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("form-cita");
    const btnEnviar = document.getElementById("btnEnviar");
    const spinner = document.getElementById("spinner");

    // ✅ Mostrar el modal con animación
    window.abrirModalServicios = function () {
        const modal = document.getElementById("modal-servicios");
        modal.classList.remove("opacity-0", "pointer-events-none", "scale-95");
        modal.classList.add("opacity-100", "pointer-events-auto", "scale-100");
    };

    // ✅ Cerrar el modal y asignar servicio + precio
    window.seleccionarServicio = function (nombre, precio) {
        document.getElementById("servicio").value = nombre;
        document.getElementById("precio").value = precio;

        const modal = document.getElementById("modal-servicios");
        modal.classList.remove("opacity-100", "pointer-events-auto", "scale-100");
        modal.classList.add("opacity-0", "pointer-events-none", "scale-95");
    };

    if (!form) return;

    // ✅ Envío del formulario
    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const uidCliente = localStorage.getItem("uid");
        const servicio = document.getElementById("servicio").value;
        const precio = document.getElementById("precio").value;
        const fecha = document.getElementById("fecha").value;
        const hora = document.getElementById("hora").value;
        const placa = document.getElementById("placa").value.trim().toUpperCase();
        const fotoFile = document.getElementById("foto-carro").files[0];

        if (!servicio || !precio || !fecha || !hora || !placa || !fotoFile) {
            Swal.fire("Campos incompletos", "Por favor completa todos los campos", "warning");
            return;
        }

        const placaRegex = /^[A-Z0-9]{3}-[A-Z0-9]{3}$/;
        if (!placaRegex.test(placa)) {
            Swal.fire("Placa inválida", "La placa debe tener el formato ABC-123", "error");
            return;
        }

        btnEnviar.disabled = true;
        spinner.classList.remove("hidden");

        try {
            // ✅ Subida de la imagen
            const storageRef = ref(storage, `citas/${uidCliente}/${Date.now()}-${fotoFile.name}`);
            await uploadBytes(storageRef, fotoFile);
            const fotoURL = await getDownloadURL(storageRef);

            // ✅ Guardado en Firestore
            await addDoc(collection(db, `citas/${uidCliente}/solicitudes`), {
                uidCliente,
                servicio,
                precio,
                fecha,
                hora,
                placa,
                fotoURL,
                estado: "pendiente",
                timestamp: Timestamp.now()
            });

            Swal.fire("¡Solicitud enviada!", "Tu cita ha sido registrada con éxito.", "success");
            form.reset();

        } catch (error) {
            console.error("Error al registrar cita:", error);
            Swal.fire("Error", "No se pudo registrar la cita", "error");
        } finally {
            btnEnviar.disabled = false;
            spinner.classList.add("hidden");
        }
    });
});