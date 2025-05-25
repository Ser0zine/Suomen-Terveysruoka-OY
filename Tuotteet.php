<?php require_once 'config.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suomen Terveysruoka</title>
    <link rel="stylesheet" href="CSS/Reset.css">
    <link rel="stylesheet" href="CSS/Global.css">
    <link rel="stylesheet" href="CSS/Tuotteet.css">
    <script src="Header_Footer.js"></script>
</head>
    <body>
        <custom-header></custom-header>
        <form action="">
            <input type="text" , placeholder="">
            <button>Hae</button>
        </form>
            <div class="Products">
                <div class="Section_Title">
                    <h2>Vegaani</h2>
                    <img src="" alt="">
                </div>
                <section class="Vegan">
                    <?php

                    $Query = "SELECT title, image FROM vegan_products";
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
                        
                    } else  echo '<p>Ei tuotteita tällä hetkellä.</p>';
                    
                    ?>
                </section>
                <div class="Section_Title">
                    <h2>Gluteeniton</h2>
                    <img src="" alt="">
                </div>
                <section class="Gluten_Free">
                    <?php

                    $Query = "SELECT title, image FROM glutenless_products";
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
                        
                    } else  echo '<p>Ei tuotteita tällä hetkellä.</p>';

                    $Conn->close();
                    ?>
                </section>
            </div>
        <custom-footer></custom-footer>
    </body>
</html>