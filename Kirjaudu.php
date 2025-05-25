<?php

require 'config.php'; // Session Start() ja $Conn

function redirect($msg, $type, $loc = 'Kirjaudu.php') {
    $_SESSION['message'] = $msg;
    $_SESSION['message_type'] = $type;
    header("Location:$loc");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['Email'] ?? '');
    $pass  = trim($_POST['Password'] ?? '');
    if (!$email || !$pass) {
        redirect('Täytä kaikki kentät.', 'error');
    }

    if (isset($_POST['Login_Action'])) {
        $stmt = $Conn->prepare("SELECT id, Password FROM users WHERE Email = ?");
        if ($stmt) {
            $stmt->bind_param("s", $email);
            if ($stmt->execute()) {
                $stmt->bind_result($uid, $hash);
                if ($stmt->fetch() && password_verify($pass, $hash)) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['id'] = $uid;
                    $_SESSION['Email'] = $email;
                    $stmt->close();
                    redirect('Kirjautuminen onnistui!', 'success', 'Koti.php');
                }
            }
            $stmt->close();
        }
        redirect('Kirjautuminen epäonnistui. Tarkista sähköposti ja salasana.', 'error');

    } elseif (isset($_POST['Register_Action'])) {
        $stmt = $Conn->prepare("SELECT id FROM users WHERE Email = ?");
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows) {
                $stmt->close();
                redirect('Käyttäjä tällä sähköpostilla on jo olemassa.', 'error');
            }
            $stmt->close();
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $stmt = $Conn->prepare("INSERT INTO users (Email, Password) VALUES (?, ?)");
            if ($stmt) {
                $stmt->bind_param("ss", $email, $hash);
                if ($stmt->execute()) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['id'] = $Conn->insert_id;
                    $_SESSION['Email'] = $email;
                    $stmt->close();
                    redirect('Rekisteröityminen onnistui! Olet nyt kirjautunut sisään.', 'success', 'Koti.php');
                }
                $stmt->close();
            }
        }
        redirect('Rekisteröinti epäonnistui. Yritä myöhemmin uudelleen.', 'error');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirjaudu</title>
    <link rel="stylesheet" href="CSS/Reset.css">
    <link rel="stylesheet" href="CSS/Global.css">
    <link rel="stylesheet" href="CSS/Kirjaudu.css">
    <script src="Header_Footer.js"></script>
</head>
    <body>
        <custom-header></custom-header>
        <form action="" method="POST">
            <h1>Kirjaudu</h1>
            <input type="Email" placeholder="Sähköposti" name="Email" required>
            <input type="Password" placeholder="Salasana" name="Password" required>
            <div class="Options">
                <button>Muista minut?</button>
                <button>Unohditko salasanasi?</button>
            </div>
            <button type="submit" value="Login" name="Login_Action" class="Login_Button">Kirjaudu</button>
            <div class="Sign_Up">
                <p>Ei tiliä? <button type="submit" value="Register" name="Register_Action" class="Register_Button">Rekisteröidy</button> </p>
            </div>
        </form>
        <custom-footer></custom-footer>
    </body>
</html>