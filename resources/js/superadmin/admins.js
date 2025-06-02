// 🔁 Firestore y Auth
import { db, auth } from '../firebase';
import {
    collection, doc, setDoc, deleteDoc, getDocs, updateDoc, query, where
} from 'firebase/firestore';
import {
    createUserWithEmailAndPassword,
} from 'firebase/auth';

const tabla = document.getElementById("tablaAdmins");
const modal = document.getElementById("modalAdmin");
const btnNuevo = document.getElementById("btnNuevo");
const btnCancelar = document.getElementById("btnCancelar");
const btnGuardar = document.getElementById("btnGuardar");

let editarId = null;

// ➕ Mostrar modal nuevo admin
btnNuevo.addEventListener('click', () => {
    document.getElementById("modalTitulo").textContent = "Nuevo Administrador";
    document.getElementById("nombreAdmin").value = '';
    document.getElementById("correoAdmin").value = '';
    document.getElementById("claveAdmin").value = '';
    editarId = null;
    modal.classList.remove("hidden");
});

// ❌ Cancelar modal
btnCancelar.addEventListener('click', () => modal.classList.add("hidden"));

// 💾 Guardar o editar admin
btnGuardar.addEventListener('click', async () => {
    const nombre = document.getElementById("nombreAdmin").value.trim();
    const correo = document.getElementById("correoAdmin").value.trim();
    const clave = document.getElementById("claveAdmin").value.trim();

    if (!nombre || !correo || (!clave && !editarId)) {
        Swal.fire("Completa todos los campos", "", "warning");
        return;
    }

    try {
        if (editarId) {
            // 🖊️ Editar datos en ambas colecciones
            const updateData = {
                nombre,
                correo,
                updatedAt: new Date()
            };
            await updateDoc(doc(db, "usuarios", editarId), updateData);
            await updateDoc(doc(db, "admins", editarId), updateData);
            Swal.fire("Administrador actualizado", "", "success");
        } else {
            // 👤 Crear usuario en Auth y registrar
            const cred = await createUserWithEmailAndPassword(auth, correo, clave);
            const uid = cred.user.uid;

            const nuevoAdmin = {
                uid,
                nombre,
                correo,
                rol: "admin",
                createdAt: new Date()
            };

            // Guardar en ambas colecciones con el mismo UID
            await setDoc(doc(db, "usuarios", uid), nuevoAdmin);
            await setDoc(doc(db, "admins", uid), nuevoAdmin);

            Swal.fire("Administrador registrado correctamente", "", "success");
        }

        modal.classList.add("hidden");
        listarAdmins();
    } catch (e) {
        console.error(e);
        Swal.fire("Error", e.message, "error");
    }
});

// 🗑️ Eliminar de ambas colecciones
async function eliminarAdmin(id) {
    if (!confirm("¿Eliminar este administrador?")) return;
    try {
        await deleteDoc(doc(db, "usuarios", id));
        await deleteDoc(doc(db, "admins", id));
        listarAdmins();
    } catch (e) {
        console.error(e);
        Swal.fire("No se pudo eliminar", e.message, "error");
    }
}

// ✏️ Mostrar datos en el modal de edición
function editarAdmin(id, nombre, correo) {
    editarId = id;
    document.getElementById("modalTitulo").textContent = "Editar Administrador";
    document.getElementById("nombreAdmin").value = nombre;
    document.getElementById("correoAdmin").value = correo;
    document.getElementById("claveAdmin").value = '';
    modal.classList.remove("hidden");
}

// 📋 Listar todos los administradores
async function listarAdmins() {
    tabla.innerHTML = "";
    const q = query(collection(db, "usuarios"), where("rol", "==", "admin"));
    const snapshot = await getDocs(q);
    snapshot.forEach(docSnap => {
        const d = docSnap.data();
        const row = `
            <tr>
                <td class="p-2">${d.nombre}</td>
                <td class="p-2">${d.correo}</td>
                <td class="p-2 flex gap-2 justify-center">
                    <button onclick="editarAdmin('${docSnap.id}', '${d.nombre}', '${d.correo}')" class="text-blue-600 hover:underline">Editar</button>
                    <button onclick="eliminarAdmin('${docSnap.id}')" class="text-red-600 hover:underline">Eliminar</button>
                </td>
            </tr>
        `;
        tabla.innerHTML += row;
    });
}

// 🚀 Inicializar
window.editarAdmin = editarAdmin;
window.eliminarAdmin = eliminarAdmin;
document.addEventListener("DOMContentLoaded", listarAdmins);
