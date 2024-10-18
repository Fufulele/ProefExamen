<?php
session_start();

// Database Connection Setup
$servername = "localhost";
$username = "root";
$password = ""; // Default XAMPP MySQL root has no password
$database = "webshop";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to display cart items
function displayCart($conn) {
    $html = '';
    if (empty($_SESSION['cart'])) {
        $html .= '<p>Je winkelwagen is leeg.</p>';
    } else {
        $html .= '<table>';
        $html .= '<thead>
                    <tr>
                        <th>Product</th>
                        <th>Aantal</th>
                        <th>Maat</th>
                        <th>Badge</th>
                        <th>Naam</th>
                        <th>Nummer</th>
                        <th>Prijs</th>
                    </tr>
                  </thead>
                  <tbody>';
        
        foreach ($_SESSION['cart'] as $item) {
            // Retrieve product details from database
            $productId = $item['id'];
            $sql = "SELECT * FROM producten WHERE id = $productId";
            $result = $conn->query($sql);
            if ($result && $result->num_rows > 0) {
                $product = $result->fetch_assoc();
                $productName = $product['product_naam'];
                $basePrice = $product['prijs'];
            } else {
                $productName = "Onbekend product";
                $basePrice = 0;
            }

            $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($productName) . '</td>';
            $html .= '<td>' . htmlspecialchars($item['quantity']) . '</td>';
            $html .= '<td>' . htmlspecialchars($item['size']) . '</td>';
            
            // Badge logic
            $badgeText = $item['badge'] !== 'none' ? ($item['badge'] == 'cl' ? 'Champions League +€25,00' : 'La Liga +€25,00') : 'Geen';
            $html .= '<td>' . htmlspecialchars($badgeText) . '</td>';

            $html .= '<td>' . htmlspecialchars($item['custom_name'] ?? '') . '</td>';
            $html .= '<td>' . htmlspecialchars($item['custom_number'] ?? '') . '</td>';
            
            // Calculate price
            $totalPrice = $basePrice * $item['quantity'];
            if ($item['badge'] != 'none') {
                $totalPrice += 25.00 * $item['quantity']; // Add €25 per badge
            }
            $html .= '<td>€' . number_format($totalPrice, 2) . '</td>';
            
            $html .= '</tr>';
        }

        $html .= '</tbody></table>';
    }
    return $html;
}
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
                <li><a href="../Tenues/kleding.php">Tenues</a></li>
                <li><a href="uitverkoop.php">Uitverkoop</a></li>
            </ul>
        </nav>
        <div class="search-bar">
            <input type="text" placeholder="Zoeken...">
        </div>
        <div class="user-actions">
            <a href="#">Inloggen</a>
            <a href="winkelwagen.php">Winkelwagen</a>
        </div>        
    </header>

    <main>
        <h1>Winkelwagen</h1>
        <br>
        <?php echo displayCart($conn); ?>
        <br>
        <a href="checkout.php" class="btn">Afrekenen</a>
        <a href="index.php" class="btn">Verder Winkelen</a>
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
            <div class="footer-social">
                <a href="#"><img src="../fotos/Facebook-Logo.jpg" alt="Facebook"></a>
                <a href="#"><img src="../fotos/Insta-logo.png" alt="Instagram"></a>
                <a href="#"><img src="../fotos/twitter-logo.png" alt="Twitter"></a>
                <a href="#"><img src="../fotos/tiktok-logo.png" alt="TikTok"></a>
                <a href="#"><img src="../fotos/youtube-logo.png" alt="YouTube"></a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Real Madrid CF Shop. Alle rechten voorbehouden.</p>
        </div>
    </footer>
</body>
</html>
