importScripts('https://www.gstatic.com/firebasejs/10.12.1/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/10.12.1/firebase-messaging-compat.js');

firebase.initializeApp({
  apiKey: "AIzaSyAykf_rLw3KLeHiGi_UfAF-YUGH_5YH75A",
  authDomain: "autoclean360-3e0f7.firebaseapp.com",
  projectId: "autoclean360-3e0f7",
  messagingSenderId: "194953026142",
  appId: "1:194953026142:web:c0efe3d710ee354c7a72cf",
});

const messaging = firebase.messaging();
