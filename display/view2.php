<?php
$dsn = "mysql:host=localhost;dbname=produits;charset=utf8mb4";
$username = "root";
$password = "test";

$delete_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_POST['delete'];

        $query = "DELETE FROM sneakers WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $delete_message = "Sneaker supprimée avec succès.";

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['taille']) && isset($_POST['nom']) && isset($_POST['image'])) {
    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_POST['id'];
        $taille = $_POST['taille'];
        $nom = $_POST['nom'];
        $image = $_POST['image'];

        $query = "INSERT INTO sneakers (id, taille, nom, image) VALUES (:id, :taille, :nom, :image)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':taille', $taille, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->execute();

        echo "Nouvelle sneaker ajoutée avec succès.";

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Sneakers</title>
</head>

<body style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f5f5f5;">

    <h1 style="text-align: center; color: #333;">Ajouter une Sneaker</h1>

    <form action="" method="post" style="background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
    
        <label for="id" style="display: block; margin-bottom: 8px; color: #555;">ID :</label>
        <input type="number" id="id" name="id" required style="width: calc(100% - 16px); padding: 8px; margin-bottom: 16px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">

        <label for="taille" style="display: block; margin-bottom: 8px; color: #555;">Taille :</label>
        <input type="number" id="taille" name="taille" required style="width: calc(100% - 16px); padding: 8px; margin-bottom: 16px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">

        <label for="nom" style="display: block; margin-bottom: 8px; color: #555;">Nom :</label>
        <input type="text" id="nom" name="nom" required style="width: calc(100% - 16px); padding: 8px; margin-bottom: 16px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">

        <label for="image" style="display: block; margin-bottom: 8px; color: #555;">Image URL :</label>
        <input type="text" id="image" name="image" required style="width: calc(100% - 16px); padding: 8px; margin-bottom: 16px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px;">

        <input type="submit" value="Ajouter la Sneaker" style="background-color: #
        <input type="submit" value="Ajouter la Sneaker" style="background-color: #4CAF50; color: white; border: none; cursor: pointer; font-size: 16px;">
    </form>

    <h1 style="text-align: center; color: #333;">Supprimer une Sneaker</h1>

    <?php
    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "SELECT * FROM sneakers";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $sneakers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($sneakers as $sneaker) {
            echo '<div style="background-color: #fff; padding: 10px; border: 1px solid #ccc; border-radius: 8px; margin-bottom: 10px;">';
            echo '<p style="font-size: 16px; margin: 0;">ID: ' . $sneaker['id'] . ' - Taille: ' . $sneaker['taille'] . ' - Nom: ' . $sneaker['nom'] . '</p>';
            echo '<p><img src="' . $sneaker['image'] . '" alt="Sneaker Image" style="max-width: 100%;"></p>';
            echo '<form action="" method="post">';
            echo '<input type="hidden" name="delete" value="' . $sneaker['id'] . '">';
            echo '<input type="submit" class="delete-button" value="Supprimer" style="background-color: #ff0000; color: white; border: none; cursor: pointer;">';
            echo '</form>';
            echo '</div>';
        }

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
    ?>

    <div class="delete-message" style="font-weight: bold; color: #ff0000; text-align: center; margin-top: 16px;">
        <?php echo $delete_message; ?>
    </div>

</body>
</html>
