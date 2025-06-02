// resources/js/firebase.js

import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
import { getAuth } from "firebase/auth";
import { getFirestore } from "firebase/firestore";
import { getStorage } from "firebase/storage";
import { getMessaging } from "firebase/messaging";

// Configuración de tu Firebase
const firebaseConfig = {
  apiKey: "AIzaSyAykf_rLw3KLeHiGi_UfAF-YUGH_5YH75A",
  authDomain: "autoclean360-3e0f7.firebaseapp.com",
  projectId: "autoclean360-3e0f7",
  storageBucket: "autoclean360-3e0f7.firebasestorage.app",
  messagingSenderId: "194953026142",
  appId: "1:194953026142:web:c0efe3d710ee354c7a72cf",
  measurementId: "G-6L0FXV7MBM"
};

// Inicializar Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);
const auth = getAuth(app);
const db = getFirestore(app);
const storage = getStorage(app);
const messaging = getMessaging(app);

// Exportar para usar en otras partes del sistema
export { app, analytics, auth, db, storage, messaging };

