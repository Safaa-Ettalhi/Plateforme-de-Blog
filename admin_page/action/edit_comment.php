<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role_id'] != 2) {
    header('Location: login.php');
    exit();
}
require '../../db.php';
if (isset($_GET['id'])) {
    $commentId = $_GET['id'];
    $query = "SELECT c.id AS comment_id, c.contenu AS comment_content, c.cree_le AS comment_created, c.modifie_le AS comment_modified, 
                     a.titre AS article_title, u.nom_utilisateur AS username
              FROM commentaires c
              JOIN articles a ON c.article_id = a.id
              LEFT JOIN utilisateurs u ON c.utilisateur_id = u.id
              WHERE c.id = $commentId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $comment = $result->fetch_assoc();
    } else {
        die("Commentaire introuvable.");
    }
} else {
    die("ID du commentaire manquant.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $commentContent = $_POST['comment_content'];
    $updateQuery = "UPDATE commentaires SET contenu = '$commentContent', modifie_le = NOW() WHERE id = $commentId";
    if ($conn->query($updateQuery)) {
        header('Location: ../comments.php');
        exit();
    } else {
        die("Erreur lors de la mise à jour du commentaire.");
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Utilisateur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">

    <div class="w-1/3 bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-[#cb6ce6] mb-6 text-center">Modifier le Commentaire</h2>

        <!-- Formulaire de modification -->
        <form action="edit_comment.php?id=<?php echo $comment['comment_id']; ?>" method="POST" class="space-y-6">
            
            <!-- Créateur -->
            <div>
                <label for="creator" class="block text-lg font-medium text-gray-700">Créateur:</label>
                <input type="text" id="creator" name="creator" value="<?php echo htmlspecialchars($comment['username']); ?>" 
                    disabled class="w-full p-3 mt-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cb6ce6] transition ease-in-out duration-300">
            </div>

            <!-- Titre de l'Article -->
            <div>
                <label for="article_title" class="block text-lg font-medium text-gray-700">Titre de l'Article:</label>
                <input type="text" id="article_title" name="article_title" value="<?php echo htmlspecialchars($comment['article_title']); ?>" 
                    disabled class="w-full p-3 mt-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cb6ce6] transition ease-in-out duration-300">
            </div>

            <!-- Contenu du Commentaire -->
            <div>
                <label for="comment_content" class="block text-lg font-medium text-gray-700">Contenu du Commentaire:</label>
                <textarea id="comment_content" name="comment_content" required
                class="w-full p-3 mt-2 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cb6ce6] transition ease-in-out duration-300"><?php echo htmlspecialchars($comment['comment_content']); ?></textarea>
            </div>

            <!-- Bouton de soumission -->
            <div class="mt-6 flex flex-col space-y-4">
                <button type="submit" class="w-full bg-[#cb6ce6] text-white font-semibold py-3 rounded-lg hover:bg-[#fbd8d5] transition ease-in-out duration-200">
                    Mettre à jour
                </button>
                <a href="../comments.php" class=" font-bold text-[#e0a8a3] underline  ">Retour à la liste des commentaires </a>
            </div>
        </form>
    </div>

</body>
</html>
