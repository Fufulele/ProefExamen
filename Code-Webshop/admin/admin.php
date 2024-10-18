<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webshop"; // Change this to your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle price update
if (isset($_POST['update_price'])) {
    $product_id = $_POST['product_id'];
    $new_price = $_POST['new_price'];

    $sql = "UPDATE bestelling SET prijs='$new_price' WHERE product_naam='$product_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Price updated successfully!";
    } else {
        echo "Error updating price: " . $conn->error;
    }
}

// Handle product addition
if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category'];
    $product_description = $_POST['product_description'];

    $sql = "INSERT INTO bestelling (product_naam, prijs, categorie, omschrijving) 
            VALUES ('$product_name', '$product_price', '$product_category', '$product_description')";
    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully!";
    } else {
        echo "Error adding product: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Orders, Products, and More</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .form-section {
            margin: 20px 0;
        }

        .form-section h3 {
            margin-bottom: 10px;
        }

        .form-section input[type="text"] {
            width: 200px;
            margin-right: 10px;
            padding: 5px;
        }

        .form-section input[type="submit"] {
            padding: 5px 10px;
        }

    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Admin Dashboard</h1>
            <nav>
                <ul>
                    <li><a href="?page=orders">Orders</a></li>
                    <li><a href="?page=customers">Customers</a></li>
                    <li><a href="?page=suppliers">Suppliers</a></li>
                    <li><a href="?page=products">Products</a></li>
                </ul>
            </nav>
        </header>

        <section>
            <?php
            if (isset($_GET['page'])) {
                $page = $_GET['page'];

                // Fetch and display products
                if ($page == 'products') {
                    $sql = "SELECT * FROM bestelling";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<h2>Products</h2>";
                        echo "<table>";
                        echo "<tr><th>Product ID</th><th>Name</th><th>Price</th><th>Category</th><th>Description</th><th>Update Price</th></tr>";
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["product_naam"] . "</td>";
                            echo "<td>" . $row["prijs"] . "</td>";
                            echo "<td>" . $row["categorie"] . "</td>";
                            echo "<td>" . $row["omschrijving"] . "</td>";
                            echo "<td>
                                    <form method='POST' action=''>
                                        <input type='hidden' name='product_id' value='" . $row["product_naam"] . "'>
                                        <input type='text' name='new_price' placeholder='New price'>
                                        <input type='submit' name='update_price' value='Update'>
                                    </form>
                                  </td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "No products found.";
                    }

                    // Form to add new product
                    echo "<div class='form-section'>";
                    echo "<h3>Add New Product</h3>";
                    echo "<form method='POST' action=''>
                            <input type='text' name='product_name' placeholder='Product name' required>
                            <input type='text' name='product_price' placeholder='Product price' required>
                            <input type='text' name='product_category' placeholder='Product category' required>
                            <input type='text' name='product_description' placeholder='Product description' required>
                            <input type='submit' name='add_product' value='Add Product'>
                          </form>";
                    echo "</div>";
                }

                // Fetch and display orders
                if ($page == 'bestelling') {
                    $sql = "SELECT * FROM bestelling"; // Assuming your orders table is called 'orders'
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<h2>Orders</h2>";
                        echo "<table>";
                        echo "<tr><th>Order ID</th><th>Customer ID</th><th>Product ID</th><th>Quantity</th><th>Total Price</th></tr>";
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["order_id"] . "</td>";
                            echo "<td>" . $row["customer_id"] . "</td>";
                            echo "<td>" . $row["product_id"] . "</td>";
                            echo "<td>" . $row["quantity"] . "</td>";
                            echo "<td>" . $row["total_price"] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "No orders found.";
                    }
                }

                // Fetch and display customers
                if ($page == 'klant') {
                    $sql = "SELECT * FROM klant"; // Assuming your customers table is called 'customers'
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<h2>Customers</h2>";
                        echo "<table>";
                        echo "<tr><th>Customer ID</th><th>Name</th><th>Email</th></tr>";
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["customer_id"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "No customers found.";
                    }
                }

                // Fetch and display suppliers
                if ($page == 'leverancier') {
                    $sql = "SELECT * FROM leverancier"; // Assuming your suppliers table is called 'suppliers'
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo "<h2>Suppliers</h2>";
                        echo "<table>";
                        echo "<tr><th>Supplier ID</th><th>Name</th><th>Contact</th></tr>";
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["supplier_id"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["contact"] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "No suppliers found.";
                    }
                }
            }
            ?>
        </section>
    </div>  
</body>
</html>

<?php
$conn->close();
?>
