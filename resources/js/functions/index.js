// functions/index.js

const functions = require("firebase-functions");
const admin = require("firebase-admin");
const cors = require("cors")({ origin: true });
const fetch = require("node-fetch");

admin.initializeApp();

exports.reniecLookup = functions.https.onRequest((req, res) => {
  cors(req, res, async () => {
    if (req.method !== "GET") {
      return res.status(405).send({ error: "Método no permitido" });
    }

    const dni = req.query.dni;
    const token = "apis-token-15467.h5txmn1w4mz9pTjTsX8UHYxghGoCMfOF"; // 🔐 Aquí va tu token personal

    if (!dni || dni.length !== 8) {
      return res.status(400).json({ error: "DNI inválido o faltante" });
    }

    try {
      const response = await fetch(`https://api.apis.net.pe/v2/reniec/dni?numero=${dni}`, {
        method: "GET",
        headers: {
          "Authorization": `Bearer ${token}`,
          "Referer": "https://apis.net.pe/consulta-dni-api",
        },
      });

      if (!response.ok) {
        return res.status(response.status).json({ error: "Error desde API de RENIEC" });
      }

      const data = await response.json();
      return res.status(200).json(data);

    } catch (error) {
      console.error("Error en lookup RENIEC:", error);
      return res.status(500).json({ error: "Error interno del servidor" });
    }
  });
});
