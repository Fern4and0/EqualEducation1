const body = document.querySelector("body"),
      modeToggle = body.querySelector(".mode-toggle");
      sidebar = body.querySelector("nav");
      sidebarToggle = body.querySelector(".sidebar-toggle");

let getMode = localStorage.getItem("mode");
if(getMode && getMode ==="dark"){
    body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status");
if(getStatus && getStatus ==="close"){
    sidebar.classList.toggle("close");
}

modeToggle.addEventListener("click", () =>{
    body.classList.toggle("dark");
    if(body.classList.contains("dark")){
        localStorage.setItem("mode", "dark");
    }else{
        localStorage.setItem("mode", "light");
    }
});

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
    }else{
        localStorage.setItem("status", "open");
    }
})



 // Obtener elementos del DOM
 const solicitudesBtn = document.getElementById('solicitudes-btn');
 const solicitudesModal = document.getElementById('solicitudes-modal');
 const closeBtn = document.querySelector('.close-btn');

 // Mostrar el modal cuando se hace clic en el botón de solicitudes
 solicitudesBtn.addEventListener('click', () => {
     solicitudesModal.style.display = 'block';
 });

 // Cerrar el modal cuando se hace clic en el botón de cerrar
 closeBtn.addEventListener('click', () => {
     solicitudesModal.style.display = 'none';
 });

 // Cerrar el modal cuando se hace clic fuera del contenido del modal
 window.addEventListener('click', (event) => {
     if (event.target == solicitudesModal) {
         solicitudesModal.style.display = 'none';
     }
 });

 // Función para abrir el modal de edición y llenar los campos con los datos del beneficiario
 function openEditModal(id, nombre, fechaNacimiento, direccion, nivelEdu, situacionEco) {
     // Asigna los valores a los campos del modal
     document.getElementById('edit_id').value = id;
     document.getElementById('edit_nombre').value = nombre;
     document.getElementById('edit_fecha_nacimiento').value = fechaNacimiento;
     document.getElementById('edit_direccion').value = direccion;
     document.getElementById('edit_nivel_edu').value = nivelEdu;
     document.getElementById('edit_situacion_eco').value = situacionEco;

     // Muestra el modal
     document.getElementById('editModal').style.display = 'block';
 }

 // Función para cerrar el modal de edición
 function closeEditModal() {
     // Oculta el modal
     document.getElementById('editModal').style.display = 'none';
 }

 // Función para cerrar el modal de solicitudes
 function closeSolicitudesModal() {
     document.getElementById('solicitudes-modal').style.display = 'none';
 }

 // Abre el modal de solicitudes
function openSolicitudesModal() {
    document.getElementById("solicitudes-modal").style.display = "block";
}

// Cierra el modal de solicitudes
function closeSolicitudesModal() {
    document.getElementById("solicitudes-modal").style.display = "none";
}

// Cierra el modal cuando se hace clic fuera de él
window.onclick = function(event) {
    const modal = document.getElementById("solicitudes-modal");
    if (event.target == modal) {
        closeSolicitudesModal();
    }
}
