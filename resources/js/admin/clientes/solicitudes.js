import { getFirestore, collection, getDocs, doc, updateDoc, deleteDoc } from "firebase/firestore";
import { app } from '../../../firebase';
import Swal from 'sweetalert2';

const db = getFirestore(app);

document.addEventListener("DOMContentLoaded", async () => {
    const contenedor = document.getElementById("contenedor-solicitudes");

    try {
        const snapshot = await getDocs(collection(db, "solicitudes_citas"));
        contenedor.innerHTML = "";

        if (snapshot.empty) {
            contenedor.innerHTML = '<div class="text-center text-gray-400">No hay solicitudes pendientes</div>';
            return;
        }

        snapshot.forEach(docSnap => {
            const data = docSnap.data();
            const id = docSnap.id;

            const tarjeta = document.createElement("div");
            tarjeta.className = `bg-white/80 backdrop-blur rounded-xl shadow-md p-6 border-l-4 border-cyan-600`;

            tarjeta.innerHTML = `
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Cliente: ${data.nombres} ${data.apellidoPaterno}</h3>
                        <p class="text-sm text-gray-600 mt-1">Fecha solicitada: <strong>${data.fecha}</strong></p>
                        <p class="text-sm text-gray-600">Motivo: ${data.motivo || 'No especificado'}</p>
                        
                    </div>
                    <div class="space-x-2 mt-2 md:mt-0">
                        <button class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700 transition" data-aceptar="${id}">Aceptar</button>
                        <button class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700 transition" data-rechazar="${id}">Rechazar</button>
                    </div>
                </div>
            `;
            contenedor.appendChild(tarjeta);
        });

        // Delegación de eventos
        contenedor.addEventListener("click", async (e) => {
            const aceptarId = e.target.getAttribute("data-aceptar");
            const rechazarId = e.target.getAttribute("data-rechazar");

            if (aceptarId) {
                await updateDoc(doc(db, "solicitudes_citas", aceptarId), {
                    estado: "aceptado"
                });
                Swal.fire("Solicitud Aceptada", "", "success");
                e.target.closest("div.rounded-xl").remove();
            }

            if (rechazarId) {
                await deleteDoc(doc(db, "solicitudes_citas", rechazarId));
                Swal.fire("Solicitud Rechazada", "", "info");
                e.target.closest("div.rounded-xl").remove();
            }
        });

    } catch (error) {
        console.error("Error al cargar solicitudes:", error);
        contenedor.innerHTML = '<div class="text-center text-red-400">Error al cargar solicitudes</div>';
    }
});
