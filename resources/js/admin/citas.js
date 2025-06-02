import { db } from '../firebase';
import { collectionGroup, doc, updateDoc, getDoc, getDocs } from 'firebase/firestore';
import Swal from 'sweetalert2';

document.addEventListener('DOMContentLoaded', async () => {
    const container = document.getElementById('lista-solicitudes-admin');
    if (!container) {
        console.warn("❌ Contenedor de citas no encontrado.");
        return;
    }

    const snapshot = await getDocs(collectionGroup(db, 'solicitudes'));

    for (const docSnap of snapshot.docs) {
        const data = docSnap.data();
        const id = docSnap.id;
        const path = docSnap.ref.path;

        let nombreCliente = 'Cliente Desconocido';
        try {
            const clienteSnap = await getDoc(doc(db, 'usuarios', data.uidCliente));
            if (clienteSnap.exists()) {
                const clienteData = clienteSnap.data();
                nombreCliente = clienteData.nombres || nombreCliente;
            }
        } catch (err) {
            console.warn("⚠️ No se pudo obtener el nombre del cliente", err);
        }

        const tarjeta = document.createElement('div');
        tarjeta.className = `bg-white/80 border-l-8 ${getColor(data.estado)} p-4 rounded-lg shadow-md`;

        tarjeta.innerHTML = `
            <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                <div class="flex-1">
                    <p class="text-gray-800 font-bold">🚗 ${data.servicio}</p>
                    <p class="text-gray-600">📅 ${data.fecha} - ${data.hora}</p>
                    <p class="text-sm text-gray-500">👤 Cliente: ${nombreCliente}</p>
                    <p class="text-sm text-gray-500">⏳ Estado actual: ${data.estado}</p>

                    ${data.estado === 'pendiente' ? `
                        <div class="mt-3 flex gap-2">
                            <button class="btn-aceptar bg-green-600 text-white px-3 py-1 rounded">Aceptar</button>
                            <button class="btn-rechazar bg-red-600 text-white px-3 py-1 rounded">Rechazar</button>
                        </div>
                    ` : ''}
                </div>

                ${data.fotoURL ? `
                    <div class="w-32 h-32 flex-shrink-0">
                        <img src="${data.fotoURL}" alt="Vehículo"
                            class="w-full h-full object-cover rounded-lg shadow-md border cursor-pointer hover:scale-105 transition"
                            id="img-${id}">
                    </div>
                ` : ''}
            </div>
        `;

        // 👉 Evento para ver imagen en SweetAlert
        if (data.fotoURL) {
            const img = tarjeta.querySelector(`#img-${id}`);
            img.addEventListener('click', () => {
                Swal.fire({
                    title: 'Foto del vehículo',
                    imageUrl: data.fotoURL,
                    imageWidth: 400,
                    imageHeight: 300,
                    background: '#1f2937',
                    color: '#fff',
                    confirmButtonText: 'Cerrar',
                });
            });
        }

        tarjeta.querySelector('.btn-aceptar')?.addEventListener('click', async () => {
            await updateDoc(doc(db, path), { estado: 'aceptado' });

            const result = await Swal.fire({
                title: '✅ Cita aceptada',
                text: 'La cita fue aprobada correctamente.',
                icon: 'success',
                background: '#1f2937',
                color: '#fff',
                toast: true,
                position: 'bottom-end',
                showConfirmButton: true,
                confirmButtonText: 'Entendido',
            });

            if (result.isConfirmed) {
                location.reload();
            }
        });

        tarjeta.querySelector('.btn-rechazar')?.addEventListener('click', async () => {
            await updateDoc(doc(db, path), { estado: 'rechazado' });

            const result = await Swal.fire({
                title: '❌ Cita rechazada',
                text: 'La cita fue rechazada.',
                icon: 'info',
                background: '#1f2937',
                color: '#fff',
                toast: true,
                position: 'bottom-end',
                showConfirmButton: true,
                confirmButtonText: 'Entendido',
            });

            if (result.isConfirmed) {
                location.reload();
            }
        });

        container.appendChild(tarjeta);
    }
});

function getColor(estado) {
    return estado === 'pendiente' ? 'border-yellow-500' :
        estado === 'aceptado' ? 'border-green-600' :
            'border-red-500';
}


