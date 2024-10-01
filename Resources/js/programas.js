const modal = document.getElementById("modal");
const openModalBtn = document.getElementById("openModalBtn");
const cancelBtn = document.getElementById("cancelBtn");

// Mostrar el modal al hacer clic en el botón
openModalBtn.addEventListener("click", () => {
    modal.style.display = "block";
});

// Ocultar el modal al hacer clic en "Cancelar"
cancelBtn.addEventListener("click", () => {
    modal.style.display = "none";
});

// Cerrar el modal si el usuario hace clic fuera del contenido
window.addEventListener("click", (event) => {
    if (event.target == modal) {
        modal.style.display = "none";
    }
});
