import { db } from '../firebase';
import { collection, query, orderBy, getDocs } from 'firebase/firestore';
import { getAuth, onAuthStateChanged } from 'firebase/auth';
import { format } from 'date-fns';
import { es } from 'date-fns/locale';

document.addEventListener("DOMContentLoaded", async () => {
    const auth = getAuth();
    onAuthStateChanged(auth, async (user) => {
        if (!user) return;

        const uid = user.uid;
        const citasRef = collection(db, `citas/${uid}/solicitudes`);
        const q = query(citasRef, orderBy("fecha", "asc"));
        const snapshot = await getDocs(q);

        const detallesCita = document.getElementById('detallesCita');
        const fechaCita = document.getElementById('fechaCita');
        const historialCitas = document.getElementById('historialCitas');
        const citasPendientes = document.getElementById('citasPendientes');

        const hoy = new Date();
        hoy.setHours(0, 0, 0, 0); // Normalizar fecha para comparación

        let proximaCita = null;
        let pendientes = [];
        let historial = [];

        snapshot.forEach(doc => {
            const cita = doc.data();
            let fecha = null;
            if (cita.fecha && typeof cita.fecha.toDate === 'function') {
                fecha = cita.fecha.toDate();
            } else if (typeof cita.fecha === 'string' || cita.fecha instanceof Date) {
                fecha = new Date(cita.fecha);
            } else {
                console.warn("Fecha no válida:", cita.fecha);
            }

            const esHoyOFuturo = fecha >= hoy;
            const esPasado = fecha < hoy;

            if (cita.estado === 'aceptado' && esHoyOFuturo) {
                if (!proximaCita || fecha < proximaCita.fecha) {
                    proximaCita = { ...cita, fecha };
                }
            }

            if (cita.estado === 'pendiente') {
                pendientes.push({ ...cita, fecha });
            }

            if (cita.estado === 'aceptado' && esPasado) {
                historial.push({ ...cita, fecha });
            }
        });

        // Mostrar próxima cita
        if (proximaCita) {
            fechaCita.textContent = format(proximaCita.fecha, "EEEE d 'de' MMMM, h:mm a", { locale: es });
            detallesCita.innerHTML = `
                <li>Servicio: ${proximaCita.servicio}</li>
                <li>Placa: ${proximaCita.placa || '-'}</li>
                <li>Estado: ${proximaCita.estado}</li>
            `;
        } else {
            fechaCita.textContent = 'Sin citas próximas';
            detallesCita.innerHTML = '<li>No tienes una próxima cita registrada.</li>';
        }

        // Mostrar atenciones pendientes
        citasPendientes.innerHTML = pendientes.length > 0
            ? pendientes.map(c => `<li>${format(c.fecha, 'dd MMM yyyy h:mm a', { locale: es })} - ${c.servicio} - ${c.estado}</li>`).join('')
            : '<li>No tienes citas pendientes.</li>';

        // Mostrar historial de atenciones
        historialCitas.innerHTML = historial.length > 0
            ? historial.map(c => `<li>${format(c.fecha, 'dd MMM yyyy', { locale: es })} - ${c.servicio} - S/ ${c.precio ?? '0'}</li>`).join('')
            : '<li>No hay citas pasadas.</li>';
    });
});
