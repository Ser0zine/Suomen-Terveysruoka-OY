<?php

require_once 'config.php';

if (!isset($_SESSION['Logged_In'])) 
{
    header('Location: Kirjaudu.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bonukset</title>
    <link rel="stylesheet" href="CSS/Reset.css">
    <link rel="stylesheet" href="CSS/Global.css">
    <link rel="stylesheet" href="CSS/Bonukset.css">
    <script src="Header_Footer.js"></script>
</head>
    <body>
        <custom-header></custom-header>
        <custom-footer></custom-footer>
    </body>
</html>