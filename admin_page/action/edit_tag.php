<?php
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] != 2) {
    header('Location: ../../login.php');
    exit();
}
require '../../db.php';
if (isset($_GET['id'])) {
    $tag_id = $_GET['id'];
    $query = "SELECT * FROM tags WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $tag_id);
    $stmt->execute();
    $result = $stmt->get_result();
    // Vérifier si le tag existe
    if ($result->num_rows == 0) {
        echo "Tag non trouvé!";
        exit();
    }
    $tag = $result->fetch_assoc();
} else {
    echo "ID de tag manquant!";
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $description = htmlspecialchars($_POST['description']);
    $update_query = "UPDATE tags SET nom = ?, description = ?, modifie_le = NOW() WHERE id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssi", $nom, $description, $tag_id);

    if ($update_stmt->execute()) {
        header("Location: ../tags.php"); 
        exit();
    } else {
        echo "Erreur lors de la mise à jour du tag!";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'Article</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<body class="bg-gray-100 h-screen flex flex-col md:flex-row">


    <!-- Main Content -->
    <main class="w-full flex items-center justify-center h-screen bg-gray-100">
        <div class="w-1/3 bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-[#cb6ce6] mb-6 text-center">Modifier le Tag</h2>
            
            <form action="edit_tag.php?id=<?php echo $tag['id']; ?>" method="POST" class="space-y-6">
                <!-- Nom du tag -->
                <div>
                    <label for="nom" class="block text-lg font-medium text-gray-700">Nom du tag</label>
                    <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($tag['nom']); ?>" required 
                        class="w-full p-3 mt-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cb6ce6] transition ease-in-out duration-300">
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-lg font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="4" required 
                        class="w-full p-3 mt-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cb6ce6] transition ease-in-out duration-300"><?php echo htmlspecialchars($tag['description']); ?></textarea>
                </div>

                <!-- Bouton de soumission -->
                <div class="mt-6">
                    <button type="submit" class="w-full bg-[#cb6ce6] text-white font-semibold py-3 rounded-lg hover:bg-[#fbd8d5] hover:text-[#cb6ce6] transition ease-in-out duration-200 mb-6">
                        <i class="fas fa-save mr-2"></i>Sauvegarder
                    </button>
                    <a href="../tags.php" class="font-bold text-[#e0a8a3] underline  ">Retour à la liste des tags </a>
                </div>
            </form>
        </div>
    </main>


</body>
</html>

