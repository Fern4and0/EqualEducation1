const modalCrear = document.getElementById("modal-crear");
const openCrear = document.getElementById("open-crear");
const closeCrear = document.getElementById("close-crear");


// Abrir la ventana emergente
openCrear.addEventListener("click", () => {
    modalCrear.style.display = "flex";
});

// Cerrar la ventana emergente
closeCrear.addEventListener("click", () => {
    modalCrear.style.display = "none";
});

// Cerrar la ventana emergente si se hace clic fuera de ella
window.addEventListener("click", (event) => {
    if (event.target === modalCrear) {
        modalCrear.style.display = "none";
    }
});