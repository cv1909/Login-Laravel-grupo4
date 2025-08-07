<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Futurista Pro</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
</head>
<body>
  <div class="fondo-letras" id="fondoLetras"></div>

  <div class="login-container">
    <!-- ✨ CREDENCIALES ARRIBA ✨ -->
    <div class="credenciales">
      <p>✨ Usuario: <strong>admin</strong> | Contraseña: <strong>123</strong> ✨</p>
    </div>

    <h2 class="titulo">INICIAR SESIÓN</h2>
    <form method="POST" action="/">
  @csrf

  <input type="text" id="usuario" name="usuario" placeholder="Usuario" required />

  <div class="password-container">
    <input type="password" id="password" name="password" placeholder="Contraseña" required />
    <span class="toggle-password" id="togglePassword">👁️</span>
  </div>

  <div id="requisitos">
    <p id="mayuscula">🔴 Al menos una letra mayúscula</p>
    <p id="especial">🔴 Al menos un símbolo @ o $</p>
  </div>

  <button type="submit">Ingresar</button>

  @if (session('error'))
    <p id="mensajeError" style="color: red;">{{ session('error') }}</p>
  @endif
</form>
  </div>

  <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
