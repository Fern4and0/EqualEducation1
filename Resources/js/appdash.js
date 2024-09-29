        var inactivityTimeout;

        function resetInactivityTimeout() {
            clearTimeout(inactivityTimeout);
            inactivityTimeout = setTimeout(logout, 60000); // 1 minute
        }

        function logout() {
            // Redirigir al usuario a la página de cierre de sesión
            window.location.href = "../Resources/Views/Login.html";
        }

        // Restablecer el temporizador de inactividad en cada interacción del usuario
        document.addEventListener("mousemove", resetInactivityTimeout);
        document.addEventListener("keydown", resetInactivityTimeout);
        document.addEventListener("scroll", resetInactivityTimeout);

        function editarUsuario(id) {
            // Llamar al archivo PHP para obtener los datos del usuario
            fetch(`ObtenerUsuario.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_id').value = data.id;
                    document.getElementById('edit_nombre').value = data.nombre;
                    document.getElementById('edit_email').value = data.email;
                    document.getElementById('edit_rol').value = data.id_rol;

                    document.getElementById('modalEditarUsuario').style.display = 'block';
                });
        }

        function cerrarModal() {
            document.getElementById('modalEditarUsuario').style.display = 'none';
        }

        function eliminarUsuario(id) {
            if (confirm('¿Estás seguro de que quieres eliminar este usuario?')) {
                window.location.href = `EliminarUsuario.php?id=${id}`;
            }
        }


// edit
function editarUsuario(id) {
    // Find the user data in the table
    const row = document.querySelector(`tr[data-id='${id}']`);
    const nombre = row.querySelector('.nombre').textContent;
    const email = row.querySelector('.email').textContent;
    const rol = row.querySelector('.rol').textContent;

    // Populate the modal form with the selected user's data
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_nombre').value = nombre;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_rol').value = rol;

    // Show the modal
    document.getElementById('modalEditarUsuario').style.display = 'block';
}

// Close the modal
function cerrarModal() {
    document.getElementById('modalEditarUsuario').style.display = 'none';
}

function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('collapsed');
}
