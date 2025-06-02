import fetch from 'node-fetch';

const dni = "73867182"; // Cambia si quieres
const token = "apis-token-15467.h5txmn1w4mz9pTjTsX8UHYxghGoCMfOF";

async function consultarDni() {
  try {
    const response = await fetch(`https://api.apis.net.pe/v2/reniec/dni?numero=${dni}`, {
      method: "GET",
      headers: {
        "Authorization": `Bearer ${token}`,
        "Referer": "https://apis.net.pe/consulta-dni-api",
      },
    });

    if (!response.ok) {
      console.error("❌ Error desde la API:", response.status);
      return;
    }

    const data = await response.json();
    console.log("✅ Datos recibidos:");
    console.log(data);

  } catch (error) {
    console.error("❌ Error al consultar:", error);
  }
}

consultarDni();
