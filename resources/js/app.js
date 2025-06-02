import { auth, db } from './firebase';
import { signInWithEmailAndPassword } from "firebase/auth";
import { doc, getDoc } from "firebase/firestore";
import './admin/clientes/index';
import './shared/topbar';


//import { tsParticles } from "tsparticles-engine";
//import { loadFull } from "tsparticles";

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("login-form");

    if (!form) return;

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const email = document.getElementById("email").value.trim();
        const password = document.getElementById("password").value.trim();

        try {
            const userCredential = await signInWithEmailAndPassword(auth, email, password);
            const uid = userCredential.user.uid;

            const userRef = doc(db, "usuarios", uid);
            const userSnap = await getDoc(userRef);
            console.log("Intentando login con:", email, password);


            if (!userSnap.exists()) {
                Swal.fire("Error", "Usuario no registrado en base de datos", "error");
                return;
            }

            const { rol } = userSnap.data();
            localStorage.setItem("uid", uid);
            localStorage.setItem("rol", rol);

            // Redirigir por rol
            if (rol === "superadmin") {
                window.location.href = "/superadmin/dashboard";
            } else if (rol === "admin") {
                window.location.href = "/dashboard";
            } else if (rol === "cliente") {
                window.location.href = "/cliente/dashboard";
            } else {
                Swal.fire("Error", "Rol no reconocido", "error");
            }


        } catch (error) {
            console.error(error);
            Swal.fire({
                icon: "error",
                title: "Error de inicio de sesión",
                text: "Correo o contraseña incorrectos",
            });
        }
    });
});

