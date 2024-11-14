const modalCrear = document.getElementById("modalCrear");
const openCrear = document.getElementById("openCrear");
const closeCrear = document.getElementById("closeCrear");


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

function editarAct(id){
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

function eliminarAct(id){
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