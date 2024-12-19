<?php
// Connexion à la base de données
require '../../db.php';

// Vérification si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $nom = trim($_POST['nom']);
    $description = trim($_POST['description']);

    // Vérification des champs
    if (!empty($nom)) {
        // Préparer la requête d'insertion
        $stmt = $conn->prepare("INSERT INTO tags (nom, description) VALUES (?, ?)");
        $stmt->bind_param("ss", $nom, $description); // "ss" car nom et description sont des chaînes

        // Exécuter la requête
        if ($stmt->execute()) {
            header('Location: ../tags.php');
        } else {
            echo "<p class='text-red-500'>Erreur lors de l'ajout du tag.</p>";
        }

        // Fermer la déclaration
        $stmt->close();
    } else {
        echo "<p class='text-red-500'>Veuillez entrer un nom pour le tag.</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Tag</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex justify-center items-center">

    <div class="w-full max-w-lg border-2 border-[#cb6ce6] bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-3xl font-bold text-center text-[#cb6ce6] mb-6">Ajouter un Tag</h2>

        <form action="ajouter_tag.php" method="POST">
            <!-- Nom du Tag -->
            <div class="mb-4">
                <label for="nom" class="block text-[#cb6ce6] font-medium">Nom du Tag</label>
                <input type="text" id="nom" name="nom" placeholder="Nom du Tag" class="w-full px-4 py-2 mt-2 border border-[#cb6ce6] bg-white/10 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cb6ce6]" required>
            </div>

            <!-- Description du Tag -->
            <div class="mb-4">
                <label for="description" class="block text-[#cb6ce6] font-medium">Description du Tag</label>
                <textarea id="description" name="description" placeholder="Description du Tag" class="w-full px-4 py-2 mt-2 border border-[#cb6ce6] bg-white/10 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cb6ce6]" rows="4"></textarea>
            </div>

            <!-- Bouton d'ajout -->
            <button type="submit" name="submit" class="w-full py-3 bg-[#cb6ce6] text-white font-semibold rounded-lg shadow-md hover:bg-[#fbd8d5]">
                Ajouter le Tag
            </button>
        </form>
    </div>

</body>
</html>
