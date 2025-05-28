<?php

$Conn = new mysqli("localhost", "root", "", "suomen_terveysruoka_oy");
if ($Conn->connect_error) die("Yhteys epäonnistui: " . $Conn->connect_error);

session_start();

LogIn($Conn);

function ShowMessage()
{
    if (!isset($_SESSION['message'])) return;
    
    echo "<div class='{$_SESSION['message_type']}'>{$_SESSION['message']}</div>";
    unset($_SESSION['message'], $_SESSION['message_type']);
}

function LogIn($Conn)
{
    if (isset($_SESSION['Logged_In']) || !isset($_COOKIE['Logged_In'])) return;

    $UID = intval($_COOKIE['Logged_In']);
        
    $Statement = $Conn->prepare("SELECT Email FROM users WHERE ID = ?");
    if (!$Statement)
    {
        $Statement->close();
        return;
    }

    $Statement->bind_param("i", $UID);
    $Statement->execute();
    $Statement->bind_result($Email);
    
    if (!$Statement->fetch()) 
    {
        setcookie('Logged_In', '', time() - 3600, "/"); // Delete invalid cookie
        return;
    }

    $_SESSION['Logged_In'] = true;
    $_SESSION['ID'] = $UID;
    $_SESSION['Email'] = $Email;

    echo "User is logged in as: " . htmlspecialchars($_SESSION['Email']);

    $Statement->close();
}

?>