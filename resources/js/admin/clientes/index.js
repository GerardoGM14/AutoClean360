import Swal from 'sweetalert2';
import { getFirestore, collection, addDoc, deleteDoc, getDocs, getDoc, doc, updateDoc } from "firebase/firestore";
import { getAuth, createUserWithEmailAndPassword } from "firebase/auth";
import { app } from '../../firebase';
import { db } from "../../firebase";

const dbInstance = getFirestore(app);
const auth = getAuth(app);

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("form-crear-cliente");
    const btnValidar = document.getElementById("btn-validar-dni");
    const tbody = document.querySelector("#tabla-clientes");

    // ✅ CARGAR CLIENTES EN TABLA (SI EXISTE LA TABLA)
    if (tbody) {
        (async () => {
            try {
                const querySnapshot = await getDocs(collection(dbInstance, "usuarios"));
                tbody.innerHTML = "";

                querySnapshot.forEach((doc) => {
                    const cliente = doc.data();
                    if (cliente.rol !== "cliente") return;

                    const tr = document.createElement("tr");
                    tr.setAttribute("data-id", doc.id);
                    tr.innerHTML = `
                    <td class="px-6 py-4">${cliente.nombres} ${cliente.apellidoPaterno}</td>
                    <td class="px-6 py-4">${cliente.email}</td>
                    <td class="px-6 py-4">${cliente.telefono}</td>
                    <td class="px-6 py-4">${cliente.placa}</td>
                    <td class="px-6 py-4 space-x-2">
                        <button class="btn-editar bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition" data-id="${doc.id}">✏️</button>
                        <button class="btn-eliminar bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition" data-id="${doc.id}">🗑️</button>
                    </td>
                `;
                    tbody.appendChild(tr);
                });

            } catch (error) {
                console.error("Error al cargar clientes:", error);
            }
        })();
    }

    // ✅ VALIDAR DNI (ya funcional)
    if (btnValidar) {
        btnValidar.addEventListener("click", async () => {
            const dni = document.getElementById("dni").value;
            if (dni.length !== 8) {
                Swal.fire("Error", "El DNI debe tener 8 dígitos", "error");
                return;
            }

            try {
                const response = await fetch(`https://us-central1-autoclean360-3e0f7.cloudfunctions.net/reniecLookup?dni=${dni}`);
                const data = await response.json();

                document.getElementById("nombres").value = data.nombres || "";
                document.getElementById("apellidoPaterno").value = data.apellidoPaterno || "";
                document.getElementById("apellidoMaterno").value = data.apellidoMaterno || "";
                document.getElementById("tipoDocumento").value = data.tipoDocumento || "DNI";
            } catch (error) {
                console.error(error);
                Swal.fire("Error", "No se pudo validar el DNI", "error");
            }
        });
    }

    document.addEventListener("click", async (e) => {
        if (e.target.classList.contains("btn-eliminar")) {
            const id = e.target.getAttribute("data-id");
            const fila = e.target.closest("tr");

            const confirmacion = await Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta acción no se puede deshacer",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            });

            if (confirmacion.isConfirmed) {
                try {
                    await deleteDoc(doc(dbInstance, "usuarios", id));
                    fila.remove();
                    Swal.fire("Eliminado", "Cliente eliminado correctamente", "success");
                } catch (error) {
                    console.error("Error al eliminar:", error);
                    Swal.fire("Error", "No se pudo eliminar el cliente", "error");
                }
            }
        }
    });

    document.addEventListener("click", async (e) => {
        if (e.target.classList.contains("btn-editar")) {
            const id = e.target.getAttribute("data-id");

            try {
                const docSnap = await getDoc(doc(dbInstance, "usuarios", id));
                if (!docSnap.exists()) {
                    Swal.fire("Error", "Cliente no encontrado", "error");
                    return;
                }

                const cliente = docSnap.data();

                const { value: formValues } = await Swal.fire({
                    title: "Editar Cliente",
                    html: `
                    <input id="swal-nombres" class="swal2-input" placeholder="Nombres" value="${cliente.nombres}">
                    <input id="swal-apellidoPaterno" class="swal2-input" placeholder="Apellido Paterno" value="${cliente.apellidoPaterno}">
                    <input id="swal-apellidoMaterno" class="swal2-input" placeholder="Apellido Materno" value="${cliente.apellidoMaterno}">
                    <input id="swal-telefono" class="swal2-input" placeholder="Teléfono" value="${cliente.telefono}">
                    <input id="swal-direccion" class="swal2-input" placeholder="Dirección" value="${cliente.direccion}">
                    <input id="swal-placa" class="swal2-input" placeholder="Placa" value="${cliente.placa}">
                `,
                    focusConfirm: false,
                    preConfirm: () => {
                        return {
                            nombres: document.getElementById("swal-nombres").value,
                            apellidoPaterno: document.getElementById("swal-apellidoPaterno").value,
                            apellidoMaterno: document.getElementById("swal-apellidoMaterno").value,
                            telefono: document.getElementById("swal-telefono").value,
                            direccion: document.getElementById("swal-direccion").value,
                            placa: document.getElementById("swal-placa").value,
                        };
                    }
                });

                if (formValues) {
                    await updateDoc(doc(dbInstance, "usuarios", id), formValues);
                    Swal.fire("Actualizado", "Cliente editado correctamente", "success");
                    location.reload(); // refresca tabla
                }

            } catch (error) {
                console.error("Error al editar:", error);
                Swal.fire("Error", "No se pudo cargar el cliente", "error");
            }
        }
    });

    // ✅ GUARDAR CLIENTE (solo si el formulario existe)
    if (form) {
        form.addEventListener("submit", async (e) => {
            e.preventDefault();

            const cliente = {
                dni: document.getElementById("dni").value,
                nombres: document.getElementById("nombres").value,
                apellidoPaterno: document.getElementById("apellidoPaterno").value,
                apellidoMaterno: document.getElementById("apellidoMaterno").value,
                tipoDocumento: document.getElementById("tipoDocumento").value,
                email: document.getElementById("email").value,
                telefono: document.getElementById("telefono").value,
                direccion: document.getElementById("direccion").value,
                placa: document.getElementById("placa").value,
                rol: "cliente",
                timestamp: new Date()
            };

            try {
                const defaultPassword = "cliente123"; // o genera una dinámica como ya se hizo
                const userCredential = await createUserWithEmailAndPassword(auth, cliente.email, defaultPassword);
                const uid = userCredential.user.uid;

                await addDoc(collection(dbInstance, "usuarios"), {
                    uid,
                    ...cliente
                });

                Swal.fire("Éxito", "Cliente registrado correctamente", "success");
                form.reset();

            } catch (error) {
                console.error("Error al registrar cliente:", error);
                Swal.fire("Error", "No se pudo registrar el cliente", "error");
            }
        });
    }
});

