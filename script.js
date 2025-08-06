const form = document.getElementById('loginForm');
const usuario = document.getElementById('usuario');
const password = document.getElementById('password');
const mensajeError = document.getElementById('mensajeError');
const togglePassword = document.getElementById('togglePassword');

const mayuscula = document.getElementById('mayuscula');
const especial = document.getElementById('especial');

form.addEventListener('submit', function (e) {
  e.preventDefault();

  const pass = password.value.trim();
  const user = usuario.value.trim();

  const tieneMayuscula = /[A-Z]/.test(pass);
  const tieneEspecial = /[@$]/.test(pass);

  if (user === '' || pass === '') {
    mensajeError.style.color = '#f55';
    mensajeError.textContent = 'Por favor, completa todos los campos.';
  } else if (!tieneMayuscula || !tieneEspecial) {
    mensajeError.style.color = '#f55';
    mensajeError.textContent = 'La contraseña no cumple con los requisitos.';
  } else {
    mensajeError.style.color = '#00faff';
    mensajeError.textContent = 'Acceso permitido. Bienvenido.';
    setTimeout(() => {
      alert("Login exitoso. ¡Bienvenido al futuro!");
      // window.location.href = 'dashboard.html';
    }, 1500);
  }
});

// Mostrar/Ocultar contraseña
togglePassword.addEventListener('click', () => {
  const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
  password.setAttribute('type', type);
  togglePassword.textContent = type === 'password' ? '👁️' : '🙈';
});

// Validación en tiempo real
password.addEventListener('input', () => {
  const val = password.value;

  if (/[A-Z]/.test(val)) {
    mayuscula.classList.add('verificado');
    mayuscula.textContent = '🟢 Al menos una letra mayúscula';
  } else {
    mayuscula.classList.remove('verificado');
    mayuscula.textContent = '🔴 Al menos una letra mayúscula';
  }

  if (/[@$]/.test(val)) {
    especial.classList.add('verificado');
    especial.textContent = '🟢 Al menos un símbolo @ o $';
  } else {
    especial.classList.remove('verificado');
    especial.textContent = '🔴 Al menos un símbolo @ o $';
  }
});
