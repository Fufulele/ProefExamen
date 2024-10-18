<?php
session_start();  


$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "webshop"; 

// Probeer verbinding te maken met de database
$conn = new mysqli($servername, $username, $password, $database);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Sluit de databaseverbinding aan het einde van het script
$conn->close();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkelwagen</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="../fotos/favicon-real.svg" type="image/x-icon">
</head>
<body>
    <header>
        <div class="logo">
            <a href="http://localhost/ProefExamen/Code-Webshop/">
                <img src="../fotos/LogoRM.png" alt="Logo">
            </a>
        </div>
        <nav>
            <ul>
                <li><a href="/ProefExamen/Code-Webshop/Tenues/kleding.php">Tenues</a></li>
                <li><a href="#">Uitverkoop</a></li>
            </ul>
        </nav>
        <div class="search-bar">
            <input type="text" placeholder="Zoeken...">
        </div>
        <div class="user-actions">
            <a href="#">Inloggen</a>
            <a href="./Winkelwagen/winkelwagen.php">Winkelwagen</a>
        </div>        
    </header>

    <main>
        <h1>Welkom bij onze Webshop</h1>
        <p>Verken ons uitgebreide assortiment producten.</p>
    </main>

    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h4>Winkel</h4>
                <ul>
                    
                    <li><a href="#">Verzending & Retouren</a></li>
                    <li><a href="#">Mijn bestelling volgen</a></li>
                    <li><a href="#">Mijn account</a></li>

                </ul>
            </div>
            <div class="footer-column">
                <h4>Over ons</h4>
                <ul>
                    <li><a href="#">Privacybeleid</a></li>
                    <li><a href="#">Cookiebeleid</a></li>
                    <li><a href="#">Algemene voorwaarden</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Hulp nodig?</h4>
                <ul>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Veelgestelde vragen</a></li>
                </ul>
            </div>
          
        </div>
        
        </div>
      
       
        <div class="footer-social">
            <a href="#"><img src="../fotos/Facebook-Logo.jpg" alt="Facebook"></a>
            <a href="#"><img src="../fotos/Insta-logo.png" alt="Instagram"></a>
            <a href="#"><img src="../fotos/twitter-logo.png" alt="Twitter"></a>
            <a href="#"><img src="../fotos/tiktok-logo.png" alt="TikTok"></a>
            <a href="#"><img src="../fotos/youtube-logo.png" alt="YouTube"></a>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Real Madrid CF Shop. Alle rechten voorbehouden.</p>
        </div>
    </footer>
</body>
</html>
