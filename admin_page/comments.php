<?php
session_start();

// Vérification de l'accès administrateur
if (!isset($_SESSION['id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] != 2) {
    header('Location: login.php');
    exit();
}

require '../db.php';

// Récupération des commentaires et des informations associées
$result = $conn->query( "SELECT c.id AS comment_id, c.contenu AS comment_content, c.cree_le AS comment_created, c.modifie_le AS comment_modified, 
               a.titre AS article_title, u.nom_utilisateur AS username
        FROM commentaires c
        JOIN articles a ON c.article_id = a.id
        LEFT JOIN utilisateurs u ON c.utilisateur_id = u.id");


// Si la requête échoue
if (!$result) {
    die("Erreur lors de la récupération des commentaires : " . $db->error_string());
}
$nom_utilisateur = isset($_SESSION['nom_utilisateur']) ? htmlspecialchars($_SESSION['nom_utilisateur']) : 'Admin';
$comments = $result->fetch_all(MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Articles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<body class="bg-gray-100 flex flex-col md:flex-row">
    <!-- Sidebar -->
    <aside class="w-full md:w-64 bg-[#cb6ce6] text-white text-2xl md:text-xl flex flex-col">
        <div class="px-6 py-8">
            <h1 class="text-2xl font-bold flex justify-center">Admin Panel</h1>
        </div>
        <nav class="flex-1 pt-4 px-4 space-y-6">
        <a href="dashboard.php" class="block py-2 px-4 
            rounded hover:bg-[#fbd8d5] hover:text-[#cb6ce6]">
                <i class="fas fa-home mr-2"></i> Dashboard
            </a>
            <a href="users.php" class="block py-2 text-white px-4 rounded hover:bg-[#fbd8d5] hover:text-[#cb6ce6] ">
                <i class="fas fa-users mr-2"></i> Utilisateurs
            </a>
            <a href="articles.php" class="block py-2 text-white px-4 rounded hover:bg-[#fbd8d5] hover:text-[#cb6ce6]">
                <i class="fas fa-newspaper mr-2"></i> Articles
            </a>
            <a href="tags.php" class="block py-2 px-4 text-white rounded hover:bg-[#fbd8d5] hover:text-[#cb6ce6]">
                <i class="fas fa-tags mr-2"></i> Tags
            </a>
            <a href="comments.php" class="block py-2 px-4  rounded bg-[#fbd8d5] text-[#cb6ce6]">
                <i class="fas fa-comments mr-2"></i> Commentaires
            </a>
        </nav>
        <div class="px-4 py-4 border-t border-[#fbd8d5]">
            <a href="../logout.php" class="block py-2 px-4 rounded text-red-600 bg-white hover:bg-red-600 hover:text-white text-center">
                <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
    <div class="mb-6 flex justify-between">
            <h2 class="text-2xl font-bold text-[#cb6ce6]">Bonjour, <?php echo $nom_utilisateur; ?>!</h2>
            <h2 class="text-2xl font-bold text-[#f4bdb8] text-center">Gestion des Commentaires</h2>
    </div>

        

        <div class="bg-white shadow-xl rounded-lg p-6 overflow-x-auto">
               <?php if ($result->num_rows > 0): ?>

                <table class="w-full table-auto rounded-lg overflow-x-auto text-left">
                    <thead class="bg-[#cb6ce6]  text-white">
                        <tr class=" text-white">
                           
                            <th class="border-b border-gray-200 px-6 py-3 text-lg font-medium">Createur</th>
                            <th class="border-b border-gray-200 px-6 py-3 text-lg font-medium">Titre Article</th>
                            <th class="border-b border-gray-200 px-6 py-3 text-lg font-medium">Contenu commantaire</th>
                            <th class="border-b border-gray-200 px-6 py-3 text-lg font-medium">Date creations</th>
                            <th class="border-b border-gray-200 px-6 py-3 text-lg font-medium">Date modification</th>
                            <th class="border-b border-gray-200 px-6 py-3 text-lg font-medium text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php foreach ($comments as $comment): ?>
        <tr class="hover:bg-[#f8deff61] transition duration-300 ease-in-out">
            <td class="border-b border-gray-200 px-6 py-3"><?php echo htmlspecialchars($comment['username']); ?></td>
            <td class="border-b border-gray-200 px-6 py-3"><?php echo htmlspecialchars($comment['article_title']); ?></td>
            <td class="border-b border-gray-200 px-6 py-3"><?php echo htmlspecialchars($comment['comment_content']); ?></td>
            <td class="border-b border-gray-200 px-6 py-3"><?php echo htmlspecialchars($comment['comment_created']); ?></td>
            <td class="border-b border-gray-200 px-6 py-3"><?php echo htmlspecialchars($comment['comment_modified']); ?></td>
            <td class="border-b border-gray-200 px-6 py-8 flex justify-center space-x-8">
                <a href="./action/edit_comment.php?id=<?php echo $comment['comment_id']; ?>" class="text-blue-500 hover:text-blue-700">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="./action/delete_comment.php?id=<?php echo $comment['comment_id']; ?>" class="text-red-500 hover:text-red-700 ml-4">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

                </table>
                <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-gray-700 py-4">Aucun tag trouvé</td>
                        </tr>
                    <?php endif; ?>
              
        </div>
    </main>
</body>
</html>
