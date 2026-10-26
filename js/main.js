import { createCard } from "./card.js";

const results = document.querySelector("#results");

function loadWalkers() {
  const request = new XMLHttpRequest();

  request.addEventListener("load", () => {
    if (request.status < 200 || request.status >= 300) {
      showError("No se pudieron cargar los paseadores. Inténtalo de nuevo más tarde.");
      return;
    }

    try {
      const walkers = JSON.parse(request.responseText);

      if (!Array.isArray(walkers)) {
        throw new TypeError("La respuesta debe ser una lista de paseadores.");
      }

      const cards = walkers.map(createCard);
      results.replaceChildren(...cards);
    } catch (error) {
      console.error("No se pudieron mostrar los paseadores:", error);
      showError("No se pudieron mostrar los paseadores.");
    }
  });

  request.addEventListener("error", () => {
    showError("No se pudo conectar con el servidor. Inténtalo de nuevo más tarde.");
  });

  request.open("GET", "backend_php/api/paseadores.php", true);
  request.send();
}

function showError(message) {
  const errorMessage = document.createElement("p");
  errorMessage.className = "results-message results-message--error";
  errorMessage.setAttribute("role", "alert");
  errorMessage.textContent = message;
  results.replaceChildren(errorMessage);
}

loadWalkers();
