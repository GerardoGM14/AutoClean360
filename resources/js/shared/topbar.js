// resources/js/topbar.js
import { db } from '../firebase';
import { doc, getDoc } from "firebase/firestore";

document.addEventListener("DOMContentLoaded", async () => {
    const spanNombre = document.getElementById("nombre-usuario");
    const uid = localStorage.getItem("uid");

    if (!uid || !spanNombre) return;

    try {
        const docRef = doc(db, "usuarios", uid);
        const docSnap = await getDoc(docRef);

        if (docSnap.exists()) {
            const data = docSnap.data();
            const nombreCompleto = data.nombres || data.nombre || "Usuario";
            spanNombre.textContent = nombreCompleto;
        } else {
            spanNombre.textContent = "Usuario";
        }
    } catch (error) {
        console.error("Error al obtener nombre de usuario:", error);
        spanNombre.textContent = "Usuario";
    }
});

