// Añade un evento 'submit' al formulario de registro
document.getElementById('formularioRegistro').addEventListener('submit', function(event) {
    // Obtiene el valor del campo 'nombre'
    var nombre = document.getElementById('nombre').value;
    // Obtiene el valor del campo 'email'
    var email = document.getElementById('email').value;
    // Obtiene el valor del campo 'password'
    var password = document.getElementById('password').value;

    // Verifica si alguno de los campos está vacío
    if (nombre === "" || email === "" || password === "") {
        // Muestra una alerta si algún campo está vacío
        alert("Por favor, rellena todos los campos.");
        // Previene el envío del formulario
        event.preventDefault();
    }
});

// Añade un evento 'submit' al formulario de inicio de sesión
document.getElementById('formularioLogin').addEventListener('submit', function(event) {
    // Obtiene el valor del campo 'email'
    var email = document.getElementById('email').value;
    // Obtiene el valor del campo 'password'
    var password = document.getElementById('password').value;

    // Verifica si alguno de los campos está vacío
    if (email === "" || password === "") {
        // Muestra una alerta si algún campo está vacío
        alert("Por favor, rellena todos los campos.");
        // Previene el envío del formulario
        event.preventDefault();
    }
});
