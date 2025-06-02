// editar.js
import Swal from 'sweetalert2';
import { getDoc, doc, updateDoc } from "firebase/firestore";
import { db } from '../../firebase';

document.addEventListener("DOMContentLoaded", async () => {
    const form = document.getElementById("form-editar-cliente");

    // Obtener el ID del cliente desde el atributo data-id
    const clienteId = form?.getAttribute("data-id");

    if (!clienteId) {
        Swal.fire("Error", "ID del cliente no encontrado", "error");
        return;
    }

    const dni = document.getElementById('dni');
    const nombres = document.getElementById('nombres');
    const apellidoPaterno = document.getElementById('apellidoPaterno');
    const apellidoMaterno = document.getElementById('apellidoMaterno');
    const tipoDocumento = document.getElementById('tipoDocumento');
    const email = document.getElementById('email');
    const telefono = document.getElementById('telefono');
    const direccion = document.getElementById('direccion');
    const placa = document.getElementById('placa');

    // Cargar datos del cliente
    try {
        const docRef = doc(db, "usuarios", clienteId);
        const docSnap = await getDoc(docRef);

        if (docSnap.exists()) {
            const data = docSnap.data();
            dni.value = data.dni || "";
            nombres.value = data.nombres || "";
            apellidoPaterno.value = data.apellidoPaterno || "";
            apellidoMaterno.value = data.apellidoMaterno || "";
            tipoDocumento.value = data.tipoDocumento || "DNI";
            email.value = data.email || "";
            telefono.value = data.telefono || "";
            direccion.value = data.direccion || "";
            placa.value = data.placa || "";
        } else {
            Swal.fire("Error", "Cliente no encontrado", "error");
        }
    } catch (error) {
        console.error("Error al cargar cliente:", error);
        Swal.fire("Error", "Hubo un problema al cargar el cliente", "error");
    }

    // Guardar cambios
    form?.addEventListener("submit", async (e) => {
        e.preventDefault();

        try {
            await updateDoc(doc(db, "usuarios", clienteId), {
                dni: dni.value.trim(),
                nombres: nombres.value.trim(),
                apellidoPaterno: apellidoPaterno.value.trim(),
                apellidoMaterno: apellidoMaterno.value.trim(),
                tipoDocumento: tipoDocumento.value.trim(),
                email: email.value.trim(),
                telefono: telefono.value.trim(),
                direccion: direccion.value.trim(),
                placa: placa.value.trim(),
            });

            Swal.fire("Actualizado", "Cliente actualizado correctamente", "success");
        } catch (error) {
            console.error("Error al actualizar:", error);
            Swal.fire("Error", "No se pudo actualizar el cliente", "error");
        }
    });
});
<script type="module" src="{{ asset('js/admin/clientes/editar.js') }}"></script>
