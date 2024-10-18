<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Madrid Shirt </title>
    <link rel="stylesheet" href="stylee.css">
    <link rel="icon" href="../fotos/favicon-real.svg" type="image/x-icon">
    <style>
        .size-btn {
            margin: 5px;
            background-color: #fff;
            border: 2px solid #ccc;
            padding: 8px 16px;
            border-radius: 50px; /* Geeft de knoppen een afgeronde vorm */
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
            box-shadow: 0 4px 8px rgba(0, 68, 204, 0.3); /* Voegt een subtiele schaduw toe rond de geselecteerde knop */
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

    <?php
    $product = [
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
                    <select>
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
            <button class="add-to-cart" onclick="addToCart()">Toevoegen aan Winkelwagen</button>
        </div>
    </div>

<br>
<br>
<br>
<br>
    <?php
    $product = [
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
                    <select>
                        <?php foreach ($product['badges'] as $badgeKey => $badgeValue): ?>
                            <option value="<?php echo $badgeKey; ?>"><?php echo $badgeValue; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="name-number">
                    <label>Naam:</label>
                    <input type="text" placeholder="Typ hier je naam.">
                    <label>Nummer:</label>
                    <input type="number" placeholder="Typ hier je nummer.">
                </div>
            </div>
            
            <button class="add-to-cart" onclick="addToCart()">Toevoegen aan Winkelwagen</button>
        </div>
    </div>


<br>
<br>
<br>

    <?php
    $product = [
        'name' => 'Heren Derdeshirt 24/25 Wit',
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
            <img src="../fotos/RealShirt-Drie.png" alt="Real Madrid Thuisshirt">
        </div>
        <div class="product-info">
            <h1><?php echo $product['name']; ?></h1>
            <p class="price">€<?php echo number_format($product['price'], 2); ?></p>
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
                    <select>
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
            <button class="add-to-cart" onclick="addToCart()">Toevoegen aan Winkelwagen</button>
        </div>
    </div>





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
