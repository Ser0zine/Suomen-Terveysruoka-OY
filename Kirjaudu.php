<?php

require_once 'config.php'; // Session Start() ja $Conn

HandleAuth($Conn);

ShowMessage();

function Redirect($Message, $Type, $Location = 'Kirjaudu.php') 
{
    $_SESSION['message'] = $Message;
    $_SESSION['message_type'] = $Type;

    header("Location:$Location");

    exit;
}

function HandleAuth($Conn)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST' || isset($_SESSION['Logged_In'])) return;
    
    $Email = trim($_POST['Email'] ?? '');
    $Pass = trim($_POST['Password'] ?? '');

    if (!$Email || !$Pass) return Redirect('Täytä kaikki kentät.', 'Error');

    if (isset($_POST['Login_Action']))
    {
        $Statement = $Conn->prepare("SELECT ID, Password FROM users WHERE Email = ?");
        if (!$Statement) return Redirect('Tietokantavirhe.', 'Error');

        $Statement->bind_param("s", $Email);
        if (!$Statement->execute()) 
        {
            $Statement->close();
            return Redirect('Tietokantavirhe.', 'Error');
        }

        $Statement->bind_result($UID, $Hash);
        if ($Statement->fetch() && password_verify($Pass, $Hash)) 
        {
            $_SESSION['Logged_In'] = true;
            $_SESSION['ID'] = $UID;
            $_SESSION['Email'] = $Email;

            setcookie('Logged_In', $UID, time() + (86400 * 30), "/"); // Set user logged in for 30 days

            $Statement->close();
            return Redirect('Kirjautuminen onnistui!', 'Success', 'Koti.php');
        }

        $Statement->close();
        return Redirect('Kirjautuminen epäonnistui. Tarkista sähköposti ja salasana.', 'Error');
    }

    if (isset($_POST['Register_Action'])) 
    {
        $Statement = $Conn->prepare("SELECT ID FROM users WHERE Email = ?");
        if (!$Statement) return Redirect('Tietokantavirhe.', 'Error');

        $Statement->bind_param("s", $Email);
        $Statement->execute();
        $Statement->store_result();

        if ($Statement->num_rows)
        {
            $Statement->close();
            return Redirect('Käyttäjä tällä sähköpostilla on jo olemassa.', 'Error');
        }

        $Statement->close();

        $Hash = password_hash($Pass, PASSWORD_DEFAULT);
        $Statement = $Conn->prepare("INSERT INTO users (Email, Password) VALUES (?, ?)");
        if (!$Statement) return Redirect('Tietokantavirhe.', 'Error');

        $Statement->bind_param("ss", $Email, $Hash);
        if (!$Statement->execute()) 
        {
            $Statement->close();
            return Redirect('Rekisteröinti epäonnistui. Yritä myöhemmin uudelleen.', 'Error');
        }

        $_SESSION['Logged_In'] = true;
        $_SESSION['ID'] = $Conn->insert_id;
        $_SESSION['Email'] = $Email;

        setcookie('Logged_In', $Conn->Insert_id, time() + (86400 * 30), "/"); // Sets users logged in state for 30 days

        $Statement->close();
        return Redirect('Rekisteröityminen onnistui! Olet nyt kirjautunut sisään.', 'Success', 'Koti.php');
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