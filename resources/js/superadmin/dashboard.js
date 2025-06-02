// 🔁 Firebase
import { db, auth } from '../firebase';
import {
    collection,
    getDocs,
    deleteDoc,
    doc,
    setDoc
} from 'firebase/firestore';
import {
    createUserWithEmailAndPassword
} from 'firebase/auth';

const cardPerfil = document.getElementById('cardPerfil');
const cardAdmins = document.getElementById('cardAdmins');
const modalPerfil = document.getElementById('modalPerfil');
const modalAdmins = document.getElementById('modalAdmins');

const listaAdmins = document.getElementById('listaAdmins');

// 🎯 Mostrar modales
cardPerfil.addEventListener('click', () => modalPerfil.classList.remove('hidden'));
cardAdmins.addEventListener('click', async () => {
    modalAdmins.classList.remove('hidden');
    await cargarAdmins();
});

// ❌ Cerrar modales
document.getElementById('btnCerrarPerfil').addEventListener('click', () => modalPerfil.classList.add('hidden'));
document.getElementById('btnCerrarAdmins').addEventListener('click', () => modalAdmins.classList.add('hidden'));

// ⚙️ Guardar perfil (solo UI, sin lógica real)
document.getElementById('btnGuardarPerfil').addEventListener('click', () => {
    alert("✅ Cambios de perfil guardados (solo interfaz, implementar lógica si se desea)");
    modalPerfil.classList.add('hidden');
});

// ➕ Registrar nuevo admin
document.getElementById('btnGuardarAdmin').addEventListener('click', async () => {
    const nombre = document.getElementById('nombreAdmin').value.trim();
    const correo = document.getElementById('correoAdmin').value.trim();
    const clave = document.getElementById('claveAdmin').value.trim();

    if (!nombre || !correo || !clave) {
        alert("Completa todos los campos");
        return;
    }

    try {
        // 📧 Crear en Auth
        const cred = await createUserWithEmailAndPassword(auth, correo, clave);
        const uid = cred.user.uid;

        const adminData = {
            uid,
            nombre,
            correo,
            rol: "admin",
            createdAt: new Date()
        };

        // 💾 Guardar en ambas colecciones
        await setDoc(doc(db, "admins", uid), adminData);
        await setDoc(doc(db, "usuarios", uid), adminData);

        alert("✅ Administrador creado correctamente");
        await cargarAdmins();
    } catch (e) {
        console.error(e);
        alert("❌ Error al crear admin: " + e.message);
    }
});

// 📋 Cargar admins
async function cargarAdmins() {
    listaAdmins.innerHTML = "";
    const snapshot = await getDocs(collection(db, "admins"));
    snapshot.forEach(docSnap => {
        const admin = docSnap.data();
        const li = document.createElement("li");
        li.className = "bg-gray-100 p-2 rounded flex justify-between items-center";
        li.innerHTML = `
            <div>
                <p class="font-semibold">${admin.nombre}</p>
                <p class="text-sm text-gray-600">${admin.correo}</p>
            </div>
            <button class="text-red-600 hover:text-red-800" data-id="${docSnap.id}">Eliminar</button>
        `;
        li.querySelector("button").addEventListener("click", async () => {
            try {
                await deleteDoc(doc(db, "admins", docSnap.id));
                await deleteDoc(doc(db, "usuarios", docSnap.id));
                await cargarAdmins();
            } catch (err) {
                console.error(err);
                alert("❌ No se pudo eliminar el admin");
            }
        });
        listaAdmins.appendChild(li);
    });
}
