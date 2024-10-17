const modal = document.getElementById("modal");
const openModalBtn = document.getElementById("openModalBtn");
const closeModalBtn = document.getElementById("closeModalBtn");
const actividad = document.querySelectorAll(".contenido__actividad");

// Abrir la ventana emergente
openModalBtn.addEventListener("click", () => {
    modal.style.display = "flex";
});

// Cerrar la ventana emergente
closeModalBtn.addEventListener("click", () => {
    modal.style.display = "none";
});

// Cerrar la ventana emergente si se hace clic fuera de ella
window.addEventListener("click", (event) => {
    if (event.target === modal) {
        modal.style.display = "none";
    }
});

actividad.forEach(contenido__actividad =>{
    contenido__actividad.addEventListener("click", () => {
        contenido__actividad.classList.toggle("active");
    })
})
