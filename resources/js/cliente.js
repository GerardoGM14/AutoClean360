// cliente.js
import Swal from 'sweetalert2';
import { createUserWithEmailAndPassword } from "firebase/auth";
import { auth } from './firebase';
import { addDoc, collection, serverTimestamp } from "firebase/firestore";
import { setDoc, doc } from "firebase/firestore";
import { db } from './firebase';

document.addEventListener("DOMContentLoaded", () => {
    const inputDNI = document.getElementById("dni");
    const btnValidar = document.getElementById("btn-validar-dni");
    const placaInput = document.getElementById("placa");
    const form = document.getElementById('form-crear-cliente');
    const telefonoInput = document.getElementById("telefono");
    const emailInput = document.getElementById("email");

    // --- Formateo en vivo de PLACA ---
    if (placaInput) {
        placaInput.addEventListener("input", (e) => {
            let value = e.target.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
            if (value.length > 6) value = value.slice(0, 6);
            if (value.length > 3) {
                value = value.slice(0, 3) + '-' + value.slice(3);
            }
            e.target.value = value;
        });
    }

    if (telefonoInput) {
        telefonoInput.addEventListener("input", (e) => {
            // Solo números
            let value = e.target.value.replace(/\D/g, "");

            // Limitar a 9 dígitos
            if (value.length > 9) value = value.slice(0, 9);

            e.target.value = value;
        });

        telefonoInput.addEventListener("blur", () => {
            const value = telefonoInput.value;
            if (value.length !== 9 || !value.startsWith("9")) {
                telefonoInput.classList.add("border-red-500", "ring-red-500");
                Swal.fire("Error", "El teléfono debe tener 9 dígitos y comenzar con 9", "warning");
            } else {
                telefonoInput.classList.remove("border-red-500", "ring-red-500");
            }
        });
    }

    if (emailInput) {
        emailInput.addEventListener("blur", () => {
            const value = emailInput.value.trim();

            const esValido = value.includes("@") && value.endsWith(".com");

            if (!esValido) {
                emailInput.classList.add("border-red-500", "ring-red-500");
                Swal.fire("Error", "El correo debe contener '@' y terminar en '.com'", "warning");
            } else {
                emailInput.classList.remove("border-red-500", "ring-red-500");
            }
        });
    }

    // --- Validación de DNI usando RENIEC ---
    if (btnValidar) {
        btnValidar.addEventListener("click", async () => {
            const dni = inputDNI.value.trim();
            inputDNI.classList.remove("border-red-500", "ring-red-500");

            if (dni.length !== 8) {
                inputDNI.classList.add("border-red-500", "ring-red-500");
                Swal.fire("Error", "El DNI debe tener 8 dígitos", "warning");
                return;
            }

            try {
                const response = await fetch(`https://us-central1-autoclean360-3e0f7.cloudfunctions.net/reniecLookup?dni=${dni}`);
                if (!response.ok) throw new Error("DNI no válido o no encontrado");

                const data = await response.json();
                // Remover borde rojo si lo había
                inputDNI.classList.remove("border-red-500", "ring-red-500");
                inputDNI.classList.add("border-green-500", "ring-green-500");

                // Mostrar confirmación
                Swal.fire("Validado", "Datos encontrados correctamente", "success");

                document.getElementById("nombres").value = data.nombres || "";
                document.getElementById("apellidoPaterno").value = data.apellidoPaterno || "";
                document.getElementById("apellidoMaterno").value = data.apellidoMaterno || "";
                document.getElementById("tipoDocumento").value = data.tipoDocumento || "DNI";

                ["nombres", "apellidoPaterno", "apellidoMaterno", "tipoDocumento"].forEach(id => {
                    const field = document.getElementById(id);
                    field.readOnly = true;
                    field.classList.add("bg-gray-100");
                });

                Swal.fire("Validado", "Datos encontrados correctamente", "success");

            } catch (error) {
                console.error(error);
                inputDNI.classList.add("border-red-500", "ring-red-500");
                Swal.fire("Error", error.message || "No se pudo obtener los datos del DNI", "error");
            }
        });
    }

    // --- Envío del Formulario ---
    if (form) {
        form.addEventListener("submit", async (e) => {
            e.preventDefault();

            const dni = document.getElementById('dni').value.trim();
            const nombres = document.getElementById('nombres').value.trim();
            const apellidoPaterno = document.getElementById('apellidoPaterno').value.trim();
            const apellidoMaterno = document.getElementById('apellidoMaterno').value.trim();
            const email = document.getElementById('email').value.trim();
            const telefono = document.getElementById('telefono').value.trim();
            const direccion = document.getElementById('direccion').value.trim();
            const placa = document.getElementById('placa').value.trim();

            const generarContrasena = (nombre, dni) => {
                const simbolos = ['*', '-', '_', '.', '#', '$'];
                const simbolo = simbolos[Math.floor(Math.random() * simbolos.length)];
                const numeroAleatorio = Math.floor(10 + Math.random() * 90);
                return nombre.substring(0, 4).charAt(0).toUpperCase() + nombre.substring(1, 4).toLowerCase() + simbolo + dni.slice(-3) + numeroAleatorio;
            };

            const password = generarContrasena(nombres, dni);

            try {
                const userCredential = await createUserWithEmailAndPassword(auth, email, password);
                const user = userCredential.user;

                await setDoc(doc(db, "usuarios", user.uid), {
                    uid: user.uid,
                    dni,
                    nombres,
                    apellidoPaterno,
                    apellidoMaterno,
                    email,
                    telefono,
                    direccion,
                    placa,
                    rol: 'cliente',
                    createdAt: serverTimestamp()
                });

                Swal.fire({
                    icon: 'success',
                    title: 'Cliente registrado',
                    html: `<p><strong>Contraseña generada:</strong> <code>${password}</code></p>`,
                    confirmButtonText: 'OK',
                    customClass: {
                        popup: 'rounded-xl'
                    }
                });

                form.reset();

            } catch (error) {
                console.error("Error al registrar cliente:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'No se pudo registrar el cliente'
                });
            }
        });
    }
});
