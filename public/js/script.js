document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('loginForm');
  const usuario = document.getElementById('usuario');
  const password = document.getElementById('password');
  const mensajeError = document.getElementById('mensajeError');
  const togglePassword = document.getElementById('togglePassword');
  const fondoLetras = document.getElementById('fondoLetras');
  const mayuscula = document.getElementById('mayuscula');
  const especial = document.getElementById('especial');

  // === Validación de formulario ===
  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const user = usuario.value.trim();
    const pass = password.value.trim();

    if (!user || !pass) {
      mostrarMensaje('Por favor, completa todos los campos.', '#f55');
    } else if (user === 'admin' && pass === '123') {
      mostrarMensaje('Acceso permitido. Bienvenido.', '#00faff');
      setTimeout(() => {
        alert("✅ Login exitoso. ¡Bienvenido!");
        // Puedes redirigir aquí si quieres:
        // window.location.href = 'inicio.html';
      }, 1000);
    } else {
      mostrarMensaje('Usuario o contraseña incorrectos.', '#f55');
    }
  });

  // === Mostrar/Ocultar contraseña ===
  togglePassword.addEventListener('click', () => {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    togglePassword.textContent = type === 'password' ? '👁️' : '🙈';
  });

  // === Validación en tiempo real de contraseña ===
  password.addEventListener('input', () => {
    const val = password.value;

    actualizarEstado(mayuscula, /[A-Z]/.test(val), 'Al menos una letra mayúscula');
    actualizarEstado(especial, /[@$]/.test(val), 'Al menos un símbolo @ o $');
  });

  // === Animación de letras de fondo ===
  const frases = [
    "ACCESS GRANTED...\nLOADING SYSTEM 01",
    "👾 HACKING THE MAINFRAME\nCODE: ZX-42X",
    "USER AUTHENTICATION...\n🔐 ENCRYPTING",
    "LOGIN SECUENCED...\n0101010101",
    "WELCOME TO THE FUTURE 🌌\nBOOTING UP..."
  ];

  let index = 0;
  setInterval(() => {
    if (fondoLetras) {
      fondoLetras.textContent = frases[index];
      index = (index + 1) % frases.length;
    }
  }, 4000);

  // === Funciones auxiliares ===
  function mostrarMensaje(texto, color) {
    mensajeError.style.color = color;
    mensajeError.textContent = texto;
  }

  function actualizarEstado(elemento, cumple, texto) {
    if (cumple) {
      elemento.classList.add('verificado');
      elemento.textContent = `🟢 ${texto}`;
    } else {
      elemento.classList.remove('verificado');
      elemento.textContent = `🔴 ${texto}`;
    }
  }
});
