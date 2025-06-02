import { db } from '../firebase';
import { collection } from "firebase/firestore";
import { collectionGroup, query, where, getDocs, onSnapshot } from "firebase/firestore";
import Swal from 'sweetalert2';

document.addEventListener("DOMContentLoaded", () => {
    console.log("👂 Escuchando nuevas solicitudes de cita...");

    const citasRef = collectionGroup(db, "solicitudes");

    onSnapshot(citasRef, async (snapshot) => {
        for (const change of snapshot.docChanges()) {
            if (change.type === "added") {
                const data = change.doc.data();
                const uidCliente = data.uidCliente || data.uid || null;
                let nombreCliente = "Cliente desconocido";

                if (uidCliente) {
                    try {
                        // 🔍 Buscar usuario por el campo "uid"
                        const usuariosRef = query(collection(db, "usuarios"), where("uid", "==", uidCliente));
                        const usuarioSnap = await getDocs(usuariosRef);

                        if (!usuarioSnap.empty) {
                            const usuario = usuarioSnap.docs[0].data();
                            nombreCliente = `${usuario.nombres || ''} ${usuario.apellidoPaterno || ''} ${usuario.apellidoMaterno || ''}`.trim();
                        } else {
                            console.warn("⚠️ Usuario no encontrado por UID:", uidCliente);
                        }
                    } catch (err) {
                        console.error("❌ Error al consultar usuario:", err);
                    }
                }

                // ✅ Mostrar alerta
                Swal.fire({
                    html: `
                        <div style="height: 6px; background-color: #1f2937; border-radius: 8px 8px 0 0;"></div>
                        <div class="text-left px-3 py-2">
                            <h2 class="text-md font-bold mb-1">${nombreCliente}</h2>
                            <p><strong>Servicio:</strong> ${data.servicio}</p>
                            <p><strong>Fecha:</strong> ${data.fecha} ${data.hora}</p>
                        </div>
                    `,
                    imageUrl: 'https://static.vecteezy.com/system/resources/previews/019/153/035/non_2x/3d-minimal-appointment-success-icon-schedule-approved-meeting-confirmed-calendar-with-a-checkmark-and-bell-icon-3d-illustration-free-png.png',
                    imageWidth: 80,
                    imageHeight: 80,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 7000,
                    timerProgressBar: true,
                    background: '#fff',
                    customClass: {
                        popup: 'rounded-xl shadow-md'
                    }
                });

                console.log("✅ Notificación mostrada:", data);
            }
        }
    });
});

