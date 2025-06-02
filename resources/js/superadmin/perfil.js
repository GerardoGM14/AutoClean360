import { auth, db } from '../firebase';
import { doc, getDoc, updateDoc } from 'firebase/firestore';
import { updateEmail, updatePassword } from 'firebase/auth';

document.addEventListener("DOMContentLoaded", async () => {
    const user = auth.currentUser;
    if (!user) return alert("Usuario no autenticado");

    const uid = user.uid;
    const docRef = doc(db, 'usuarios', uid);
    const docSnap = await getDoc(docRef);

    if (docSnap.exists()) {
        const data = docSnap.data();
        document.getElementById('nombre').value = data.nombre || '';
        document.getElementById('correo').value = user.email || '';
    }

    document.getElementById('guardarPerfil').addEventListener('click', async () => {
        const nuevoNombre = document.getElementById('nombre').value.trim();
        const nuevoCorreo = document.getElementById('correo').value.trim();
        const nuevaClave = document.getElementById('password').value.trim();

        try {
            // ✅ Actualizar en Firebase Auth
            if (nuevoCorreo !== user.email) {
                await updateEmail(user, nuevoCorreo);
            }
            if (nuevaClave) {
                await updatePassword(user, nuevaClave);
            }

            // ✅ Actualizar en colección "usuarios"
            const updateData = {
                nombre: nuevoNombre,
                correo: nuevoCorreo,
                updatedAt: new Date()
            };
            await updateDoc(doc(db, 'usuarios', uid), updateData);

            // ✅ Si existe en colección "admins", también actualizar
            const adminRef = doc(db, 'admins', uid);
            const adminSnap = await getDoc(adminRef);
            if (adminSnap.exists()) {
                await updateDoc(adminRef, updateData);
            }

            alert("✅ Perfil actualizado correctamente");
        } catch (error) {
            console.error(error);
            alert("❌ Error al actualizar: " + error.message);
        }
    });
});
