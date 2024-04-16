// Archivo: validarForm.js

function validarFormulario() {
  var username = document.getElementById('username').value;
  var password = document.getElementById('password').value;
  var email = document.getElementById('email').value;
  var phone = document.getElementById('phone').value;
  var age = document.getElementById('age').value;

  // Validar que todos los campos estén llenos
  if (
    username === '' ||
    password === '' ||
    email === '' ||
    phone === '' ||
    age === ''
  ) {
    alert('Todos los campos son obligatorios');
    return false;
  }

  // Validar formato de correo electrónico
  var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailPattern.test(email)) {
    alert('Correo electrónico no válido');
    return false;
  }

  // Validar formato de número de teléfono
  var phonePattern = /^\d{10}$/;
  if (!phonePattern.test(phone)) {
    alert('Número de teléfono no válido (debe tener 10 dígitos)');
    return false;
  }

  // Validar edad
  if (isNaN(age) || age < 18) {
    alert('Debes ser mayor de 18 años para registrarte');
    return false;
  }

  // Si todas las validaciones pasan, enviar el formulario
  return true;
}
