<?php
// Database connection details (you'll need to fill these in)
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

// Initialize error message variable
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Get form data
        $wachtwoord = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);
        $gebruikersnaam = $_POST['gebruikersnaam'];
        $telefoonnummer = $_POST['telefoonnummer'];
        
        // Validate input
        if (empty($gebruikersnaam) || empty($wachtwoord) || empty($telefoonnummer)) {
            $error_message = "Alle velden zijn verplicht.";
        } else {
            // Check if username already exists
            $stmt = $conn->prepare("SELECT id FROM users WHERE gebruikersnaam = ?");
            $stmt->execute([$gebruikersnaam]);
            
            if ($stmt->rowCount() > 0) {
                $error_message = "Deze gebruikersnaam bestaat al.";
            } else {
                // Insert new user
                $stmt = $conn->prepare("INSERT INTO users (gebruikersnaam, wachtwoord, telefoonnummer) VALUES (?, ?, ?)");
                $stmt->execute([$gebruikersnaam, $wachtwoord, $telefoonnummer]);
                
                header("Location: succes.php"); // Redirect to success page
                exit();
            }
        }
    } catch(PDOException $e) {
        $error_message = "Er is een fout opgetreden: " . $e->getMessage();
    }
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren</title>
    <link rel="stylesheet" href="style.css">
   
</head>
<body>
    <div class="logo">
        <!-- Plaats hier je logo -->
        <img src="logo.png" alt="Logo">
    </div>

    <?php if (!empty($error_message)): ?>
        <div class="error"><?php echo htmlspecialchars($error_message); ?></div>
    <?php endif; ?>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="gebruikersnaam">Gebruikersnaam</label>
            <input type="text" id="gebruikersnaam" name="gebruikersnaam" required>
        </div>

        <div class="form-group">
            <label for="wachtwoord">Wachtwoord</label>
            <input type="password" id="wachtwoord" name="wachtwoord" required>
        </div>

        <div class="form-group">
            <label for="telefoonnummer">Telefoonnummer</label>
            <input type="tel" id="telefoonnummer" name="telefoonnummer" required>
        </div>

        <button type="submit">Account voltooien</button>
    </form>

    <div class="footer">
        <!-- Voeg hier je footer content toe -->
        FOOTER
    </div>
</body>
</html>
