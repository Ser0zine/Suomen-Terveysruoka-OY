<?php require_once 'config.php';

ShowMessage();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suomen Terveysruoka</title>
    <link rel="stylesheet" href="CSS/Reset.css">
    <link rel="stylesheet" href="CSS/Global.css">
    <link rel="stylesheet" href="CSS/Koti.css">
    <script src="Header_Footer.js"></script>
</head>
    <body>
        <custom-header></custom-header>
        <div class="Info">
            <p> <span>Suomen Terveysruoka OY</span> on suomalainen yritys, joka tarjoaa terveellisiä, luomu- ja gluteenittomia elintarvikkeita eri ruokavalioihin. Perustettu vuonna 2005, yritys keskittyy tarjoamaan asiakkailleen ravitsevia ja maistuvia vaihtoehtoja, kuten vegaanisia, keto- ja paleo-tuotteita. Suomen Terveysruoka OY panostaa kestävään kehitykseen ja ympäristöystävälliseen pakkaamiseen, ja sen tuotteet valmistetaan pääasiassa kotimaisista raaka-aineista ilman keinotekoisia lisäaineita.</p>
        </div>
        <h2>Ajankohtaista</h2>
        <section class="News">
            <?php
            $Query = "SELECT title, image FROM news";
            $Result = $Conn->query($Query);

            if ($Result->num_rows > 0) 
            {
                while($Row = $Result->fetch_assoc())
                {
                    echo '<a href="Link_here">';
                    echo '<h3>' . htmlspecialchars($Row['title']) . '</h3>';
                    echo '<img src="Images/' . htmlspecialchars($Row['image']) . '" alt="Uutiskuva">';
                    echo '</a>';
                }
                
            } else  echo '<p>Ei uutisia vielä.</p>';
            ?>
        </section>
        <h2>Uudet tuotteet</h2>
        <section class="New_Products">
            <?php
            $Query = "SELECT title, image FROM new_products";
            $Result = $Conn->query($Query);

            if ($Result->num_rows > 0) 
            {
                while($Row = $Result->fetch_assoc())
                {
                    echo '<a href="Link_here">';
                    echo '<h3>' . htmlspecialchars($Row['title']) . '</h3>';
                    echo '<img src="Images/' . htmlspecialchars($Row['image']) . '" alt="Tuotekuva">';
                    echo '</a>';
                }
                
            } else  echo '<p>Ei uusia tuotteita tällä hetkellä.</p>';
            ?>
        </section>
        <custom-footer></custom-footer>
    </body>
</html>