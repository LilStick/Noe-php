<?php
$dsn = "mysql:host=localhost;dbname=produits;charset=utf8mb4";
$username = "root";
$password = "test";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM sneakers";

    $stmt = $pdo->query($sql);

    ob_start();
    ?>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .sneaker {
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px;
            max-width: 400px;
            background-color: #f9f9f9;
        }

        .sneaker h2 {
            margin-top: 0;
        }

        .sneaker p {
            margin: 5px 0;
        }

        .sneaker img {
            max-width: 100%;
        }
    </style>

    <?php
    $css = ob_get_clean();

    echo $css;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='sneaker'>";
        echo "<h2>ID: " . $row['id'] . "</h2>";
        echo "<p>Taille: " . $row['taille'] . "</p>";
        echo "<p>Nom: " . $row['nom'] . "</p>";
        echo "<p>Image: <img src='" . $row['image'] . "' alt='Sneaker Image'></p>";
        echo "</div>";
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
