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

// Check if "addToCart" has been requested
if (isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $quantity = 1; // Default quantity
    $size = $_POST['size'];
    $badge = $_POST['badge'] ?? 'none';
    $name = $_POST['name'] ?? ''; // Product name customization
    $number = $_POST['number'] ?? ''; // Product number customization

    // Retrieve product name for display
    $productName = $productId == 1 ? 'Heren thuisshirt 24/25 Wit' : 'Heren Uitshirt 24/25 Wit';

    // Initialize cart if not already done
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add to session cart
    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $productId && $item['size'] == $size && $item['badge'] == $badge && $item['name'] == $name && $item['number'] == $number) {
            $item['quantity'] += $quantity;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = [
            'id' => $productId,
            'name' => $productName,
            'size' => $size,
            'badge' => $badge,
            'quantity' => $quantity,
            'custom_name' => $name, // Store custom name for shirt
            'custom_number' => $number, // Store custom number for shirt
        ];
    }

    header('Location: winkelwagen.php');
    exit;
}


?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Madrid Shirt</title>
    <link rel="stylesheet" href="stylee.css">
    <link rel="icon" href="../fotos/favicon-real.svg" type="image/x-icon">
    <style>
        .size-btn {
            margin: 5px;
            background-color: #fff;
            border: 2px solid #ccc;
            padding: 8px 16px;
            border-radius: 50px; 
            cursor: pointer;
            transition: all 0.3s ease;
            outline: none;
            font-weight: bold;
            color: #333;
        }

        .size-btn:hover, .size-btn:focus {
            border-color: #888;
        }

        .size-btn.selected {
            border-color: #0044cc;
            color: #0044cc;
            box-shadow: 0 4px 8px rgba(0, 68, 204, 0.3); /* Subtiele schaduw */
        }
    </style>
    <script>
        function selectSize(element) {
            var buttons = document.querySelectorAll('.size-btn');
            buttons.forEach(function(btn) {
                btn.classList.remove('selected');
            });
            element.classList.add('selected');
        }

        function addToCart() {
            alert('Succesvol toegevoegd aan winkelwagen!');
        }
    </script>
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
            <a href="/ProefExamen/Code-Webshop/Winkelwagen/winkelwagen.php">Winkelwagen</a>
        </div>
    </header>

    <!-- First Product (Home Shirt) -->
    <?php
    $product = [
        'id' => 1,
        'name' => 'Heren thuisshirt 24/25 Wit',
        'price' => 190.00,
        'sizes' => ['XS', 'S', 'M', 'L', 'XL', '2XL', '3XL'],
        'badges' => [
            'none' => 'Geen',
            'cl' => 'Champions League +€25,00',
            'laliga' => 'La Liga +€25,00'
        ]
    ];
    ?>

    <div class="container">
        <div class="product-image">
            <img src="../fotos/RealShirt.png" alt="Real Madrid Thuisshirt">
        </div>
        <div class="product-info">
            <h1><?php echo $product['name']; ?></h1>
            <p class="price">€<?php echo number_format($product['price'], 2); ?></p>
            <form method="POST" action="">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <div class="selectors">
                    <div class="size-selector">
                        <label>Maat:</label>
                        <div class="sizes">
                            <?php foreach ($product['sizes'] as $size): ?>
                                <button type="button" class="size-btn" onclick="selectSize(this)"><?php echo $size; ?></button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="badge-selector">
                        <label>Badge:</label>
                        <select name="badge">
                            <?php foreach ($product['badges'] as $badgeKey => $badgeValue): ?>
                                <option value="<?php echo $badgeKey; ?>"><?php echo $badgeValue; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="name-number">
                        <label>Naam:</label>
                        <input type="text" placeholder="Typ hier je naam...">
                        <label>Nummer:</label>
                        <input type="number" placeholder="Typ hier je nummer...">
                    </div>
                </div>
                <button type="submit" class="add-to-cart" name="add_to_cart">Toevoegen aan Winkelwagen</button>
            </form>
        </div>
    </div>
<br>
<br>
  

    <!-- Second Product (Away Shirt) -->
    <?php
    $product = [
        'id' => 2,
        'name' => 'Heren Uitshirt 24/25 Wit',
        'price' => 190.00,
        'sizes' => ['XS', 'S', 'M', 'L', 'XL', '2XL', '3XL'],
        'badges' => [
            'none' => 'Geen',
            'cl' => 'Champions League +€25,00',
            'laliga' => 'La Liga +€25,00'
        ]
    ];
    ?>

    <div class="container">
        <div class="product-image">
            <img src="../fotos/RealShirt-Uit.png" alt="Real Madrid Uitshirt">
        </div>
        <div class="product-info">
            <h1><?php echo $product['name']; ?></h1>
            <p class="price">€<?php echo number_format($product['price'], 2); ?></p>
            <form method="POST" action="">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <div class="selectors">
                    <div class="size-selector">
                        <label>Maat:</label>
                        <div class="sizes">
                            <?php foreach ($product['sizes'] as $size): ?>
                                <button type="button" class="size-btn" onclick="selectSize(this)"><?php echo $size; ?></button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="badge-selector">
                        <label>Badge:</label>
                        <select name="badge">
                            <?php foreach ($product['badges'] as $badgeKey => $badgeValue): ?>
                                <option value="<?php echo $badgeKey; ?>"><?php echo $badgeValue; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="name-number">
                        <label>Naam:</label>
                        <input type="text" placeholder="Typ hier je naam...">
                        <label>Nummer:</label>
                        <input type="number" placeholder="Typ hier je nummer...">
                    </div>
                </div>
                <button type="submit" class="add-to-cart" name="add_to_cart">Toevoegen aan Winkelwagen</button>
            </form>
        </div>
    </div>

<br>
<br>


    <?php
    $product = [
        'id' => 1,
        'name' => 'Heren Derdeshirt 24/25 ',
        'price' => 190.00,
        'sizes' => ['XS', 'S', 'M', 'L', 'XL', '2XL', '3XL'],
        'badges' => [
            'none' => 'Geen',
            'cl' => 'Champions League +€25,00',
            'laliga' => 'La Liga +€25,00'
        ]
    ];
    ?>

    <div class="container">
        <div class="product-image">
            <img src="../fotos/RealShirt-Drie.png" alt="Real Madrid Derdeshirt">
        </div>
        <div class="product-info">
            <h1><?php echo $product['name']; ?></h1>
            <p class="price">€<?php echo number_format($product['price'], 2); ?></p>
            <form method="POST" action="">
                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                <div class="selectors">
                    <div class="size-selector">
                        <label>Maat:</label>
                        <div class="sizes">
                            <?php foreach ($product['sizes'] as $size): ?>
                                <button type="button" class="size-btn" onclick="selectSize(this)"><?php echo $size; ?></button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="badge-selector">
                        <label>Badge:</label>
                        <select name="badge">
                            <?php foreach ($product['badges'] as $badgeKey => $badgeValue): ?>
                                <option value="<?php echo $badgeKey; ?>"><?php echo $badgeValue; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="name-number">
                        <label>Naam:</label>
                        <input type="text" placeholder="Typ hier je naam...">
                        <label>Nummer:</label>
                        <input type="number" placeholder="Typ hier je nummer...">
                    </div>
                </div>
                <button type="submit" class="add-to-cart" name="add_to_cart">Toevoegen aan Winkelwagen</button>
            </form>
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h4>Winkel</h4>
                <ul>
                    <li><a href="#">Verzending & Retouren</a></li>
                    <li><a href="#">Algemene voorwaarden</a></li>
                    <li><a href="#">Privacybeleid</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Over ons</h4>
                <ul>
                    <li><a href="#">Ons Verhaal</a></li>
                    <li><a href="#">Vacatures</a></li>
                    <li><a href="#">Nieuws</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h4>Contact</h4>
                <ul>
                    <li><a href="#">Klantenservice</a></li>
                    <li><a href="#">Locaties</a></li>
                    <li><a href="#">Sociale media</a></li>
                </ul>
            </div>
        </div>
    </footer>

</body>
</html>

