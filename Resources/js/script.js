document.getElementById('formularioRegistro').addEventListener('submit', function(event) {
    var nombre = document.getElementById('nombre').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    if (nombre === "" || email === "" || password === "") {
        alert("Por favor, rellena todos los campos.");
        event.preventDefault(); // Previene el envío del formulario
    }
});

document.getElementById('formularioLogin').addEventListener('submit', function(event) {
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;

    if (email === "" || password === "") {
        alert("Por favor, rellena todos los campos.");
        event.preventDefault(); // Previene el envío del formulario
    }
});