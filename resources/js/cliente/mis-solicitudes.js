import { db, storage } from '../firebase';
import { collection, getDocs, query, updateDoc, doc } from 'firebase/firestore';
import { ref, uploadBytes, getDownloadURL } from 'firebase/storage';
import Swal from 'sweetalert2';

document.addEventListener('DOMContentLoaded', async () => {
    const uid = localStorage.getItem('uid');
    const contenedor = document.getElementById('solicitudes-lista');
    const comprobanteInput = document.getElementById('comprobante-input');

    if (!uid || !contenedor) return;

    const snapshot = await getDocs(query(collection(db, `citas/${uid}/solicitudes`)));

    if (snapshot.empty) {
        contenedor.innerHTML = `<p class="text-center text-gray-500">No tienes solicitudes registradas aún.</p>`;
        return;
    }

    snapshot.forEach(docSnap => {
        const data = docSnap.data();
        const card = document.createElement('div');
        card.className = `bg-white/80 backdrop-blur rounded-lg shadow-md border-l-8 ${getColor(data.estado)} p-4 flex justify-between items-center`;

        const acciones = [];

        if (data.estado === 'aceptado' && !data.comprobante) {
            acciones.push(`<button class="subir-comprobante bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-1 rounded-md text-sm">Subir Comprobante</button>`);
        }

        if (data.estado === 'aceptado') {
            acciones.push(`<button class="btn-pago bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-1 rounded-md text-sm">Medio de Pago</button>`);
        }

        card.innerHTML = `
            <div>
                <p class="text-gray-800 font-semibold">🧾 Servicio: ${data.servicio}</p>
                <p class="text-gray-600">📅 Fecha: ${data.fecha} ${data.hora}</p>
                <p class="text-sm text-gray-500">⏳ Estado: ${data.estado}</p>
            </div>
            <div class="space-x-2">${acciones.join(' ')}</div>
        `;

        const subirBtn = card.querySelector('.subir-comprobante');
        if (subirBtn) {
            subirBtn.addEventListener('click', () => {
                comprobanteInput.click();
                comprobanteInput.onchange = async (e) => {
                    const file = e.target.files[0];
                    if (!file) return;
                    const storageRef = ref(storage, `comprobantes/${uid}/${docSnap.id}`);
                    await uploadBytes(storageRef, file);
                    const url = await getDownloadURL(storageRef);
                    await updateDoc(doc(db, `citas/${uid}/solicitudes/${docSnap.id}`), { comprobante: url });

                    Swal.fire({
                        title: '📤 Comprobante subido',
                        text: 'Gracias, tu comprobante ha sido enviado.',
                        icon: 'success',
                        toast: true,
                        timer: 3000,
                        position: 'top-end',
                        showConfirmButton: false,
                    });

                    location.reload();
                };
            });
        }

        const btnPago = card.querySelector('.btn-pago');
        if (btnPago) {
            btnPago.addEventListener('click', () => {
                Swal.fire({
                    title: 'Selecciona Medio de Pago',
                    html: `
                        <div class="flex justify-center gap-4 items-center mt-4">
                            <div onclick="window.alert('📱 Yape: 934367672 – Gerardo Fabian Gonzalez Moreno')" class="cursor-pointer bg-white rounded-xl p-4 w-32 shadow hover:scale-105 transition">
                                <img src="https://marketing-peru.beglobal.biz/wp-content/uploads/2024/06/1-yape-logo-transparencia-2.png" class="w-10 h-10 mx-auto mb-2" />
                                <p class="text-sm text-center text-gray-700 font-semibold">Yape</p>
                            </div>
                            <div onclick="window.alert('💳 Simular PayPal Sandbox')" class="cursor-pointer bg-white rounded-xl p-4 w-32 shadow hover:scale-105 transition">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" class="w-10 h-10 mx-auto mb-2" />
                                <p class="text-sm text-center text-gray-700 font-semibold">PayPal</p>
                            </div>
                            <div onclick="window.alert('💰 Simular Mercado Pago')" class="cursor-pointer bg-white rounded-xl p-4 w-32 shadow hover:scale-105 transition">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRooqX_tEjlq63fL2GQIpdJ50tuKZ7qT-qJ8A&s" class="w-10 h-10 mx-auto mb-2" />
                                <p class="text-sm text-center text-gray-700 font-semibold">Mercado Pago</p>
                            </div>
                        </div>
                    `,
                    showConfirmButton: false,
                    background: '#f9fafb',
                    width: 600,
                    customClass: {
                        popup: 'rounded-2xl shadow-lg backdrop-blur-md bg-white/90'
                    }
                });
            });
        }

        contenedor.appendChild(card);
    });
});

function getColor(estado) {
    return estado === 'pendiente' ? 'border-yellow-500' :
        estado === 'aceptado' ? 'border-green-600' :
            'border-red-500';
}

