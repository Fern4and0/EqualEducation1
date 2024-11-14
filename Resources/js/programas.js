const modal = document.getElementById("modal");
const openModalBtn = document.getElementById("openModalBtn");
const closeModalBtn = document.getElementById("closeModalBtn");
const actividad = document.querySelectorAll(".contenido__actividad");
const crear = document.getElementById("crear");

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


function editarPrgm(id){
    const modalEditar = document.getElementById("modal-editar-" + id);
    const openEditar = document.getElementById("open-editar-" + id);
    const closeEditar = document.getElementById("close-editar-" + id);

    // Abrir la ventana emergente
    openEditar.addEventListener("click", () => {
        modalEditar.style.display = "flex";
    });

    // Cerrar la ventana emergente
    closeEditar.addEventListener("click", () => {
        modalEditar.style.display = "none";
    });

    // Cerrar la ventana emergente si se hace clic fuera de ella
    window.addEventListener("click", (event) => {
        if (event.target === modalEditar) {
            modalEditar.style.display = "none";
        }
    });
}


function eliminarPrgm(id){
    const modalEliminar = document.getElementById("modal-eliminar-" + id);
    const openModalEliminar = document.getElementById("open-eliminar-" + id);
    const closeModalEliminar = document.getElementById("close-eliminar-" + id);

    // Abrir la ventana emergente
    openModalEliminar.addEventListener("click", () => {
        modalEliminar.style.display = "flex";
    });

    // Cerrar la ventana emergente
    closeModalEliminar.addEventListener("click", () => {
        modalEliminar.style.display = "none";
    });

    // Cerrar la ventana emergente si se hace clic fuera de ella
    window.addEventListener("click", (event) => {
        if (event.target === modalEliminar) {
            modalEliminar.style.display = "none";
        }
    });
}


actividad.forEach(contenido__actividad =>{
    contenido__actividad.addEventListener("click", () => {
        contenido__actividad.classList.toggle("active");
    })
})

crear.addEventListener("click", () => {
    location.reload();
});