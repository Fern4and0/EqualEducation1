// Función para editar un usuario basado en el id proporcionado
function editarUsuario(id) {
    // Llamar al servidor para obtener los datos del usuario
    fetch(`ObtenerUsuario.php?id=${id}`)
        .then(response => response.json()) // Convertir la respuesta del servidor a JSON
        .then(data => {
            // Rellenar el formulario de edición con los datos del usuario obtenidos
            document.getElementById('edit_id').value = data.id;
            document.getElementById('edit_nombre').value = data.nombre;
            document.getElementById('edit_email').value = data.email;
            document.getElementById('edit_rol').value = data.id_rol;

            // Mostrar el modal de edición de usuario
            document.getElementById('modalEditarUsuario').style.display = 'block';
        });
}

// Función para abrir el modal y cargar los datos del beneficiario
function openModal(id) {
    // Realiza una petición AJAX para obtener los datos del beneficiario
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "getBeneficiario.php?id=" + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var beneficiario = JSON.parse(xhr.responseText);
            document.getElementById('beneficiario_id').value = beneficiario.id;
            document.getElementById('nombre').value = beneficiario.nombre;
            document.getElementById('fecha_nacimiento').value = beneficiario.fecha_nacimiento;
            document.getElementById('direccion').value = beneficiario.direccion;
            document.getElementById('nivel_edu').value = beneficiario.nivel_edu;
            document.getElementById('situacion_eco').value = beneficiario.situacion_eco;
            document.getElementById('programa_asig').value = beneficiario.programa_asig;
            
            // Muestra el modal
            document.getElementById('editModal').style.display = "flex";  // Cambiado a "flex" para centrarlo
        }
    };
    xhr.send();
}
