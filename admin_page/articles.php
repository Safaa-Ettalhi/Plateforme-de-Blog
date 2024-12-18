<?php
session_start();

// Vérification de l'accès administrateur
if (!isset($_SESSION['id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] != 2) {
    header('Location: login.php');
    exit();
}

// Connexion à la base de données
require '../db.php';

// Récupération des articles avec leurs tags et l'utilisateur
$result = $conn->query("SELECT a.id, a.titre, a.contenu, a.Url_image, u.nom_utilisateur, 
                               GROUP_CONCAT(t.nom ORDER BY t.nom ASC) AS tags
                        FROM articles a
                        LEFT JOIN utilisateurs u ON a.utilisateur_id = u.id
                        LEFT JOIN article_tags at ON a.id = at.article_id
                        LEFT JOIN tags t ON at.tags_id = t.id
                        GROUP BY a.id");


// Récupération du nom de l'utilisateur connecté
$nom_utilisateur = isset($_SESSION['nom_utilisateur']) ? htmlspecialchars($_SESSION['nom_utilisateur']) : 'Admin';
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
<body class="bg-gray-100 h-screen flex flex-col md:flex-row">
    <!-- Sidebar -->
    <aside class=" w-full  md:w-64 bg-[#cb6ce6] text-white text-2xl md:text-xl flex flex-col">
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
            <a href="articles.php" class="block py-2  px-4 rounded bg-[#fbd8d5] text-[#cb6ce6]">
                <i class="fas fa-newspaper mr-2"></i> Articles
            </a>
            <a href="tags.php" class="block py-2 px-4 text-white rounded hover:bg-[#fbd8d5] hover:text-[#cb6ce6]">
                <i class="fas fa-tags mr-2"></i> Tags
            </a>
            <a href="comments.php" class="block py-2 px-4 text-white rounded hover:bg-[#fbd8d5] hover:text-[#cb6ce6]">
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
            <h2 class="text-2xl font-bold text-[#f4bdb8] text-center">Gestion des Articles</h2>
    </div>

    <div class="bg-white shadow-xl rounded-lg p-6 overflow-hidden">
        <div class="flex justify-end mb-4">
            <a href="./action/ajouter_article.php" class="bg-[#fbd8d5] text-[#cb6ce6] py-2 px-4 rounded-lg hover:bg-[#cb6ce6] hover:text-[#fbd8d5]">
               
            <i class="fa-solid fa-plus"></i> Ajouter un article
            </a>
        </div>

        <?php if ($result->num_rows > 0): ?>
            <!-- Si des articles sont trouvés -->
            <table class="w-full table-auto rounded-lg overflow-hidden text-left">
                <thead class="bg-[#cb6ce6]  text-white">
                    <tr>
                        <th class="border-b border-gray-200 px-6 py-3 text-lg font-medium">Titre</th>
                        <th class="border-b border-gray-200 px-6 py-3 text-lg font-medium">Contenu</th>
                        <th class="border-b border-gray-200 px-6 py-3 text-lg font-medium">Tags</th>
                        <th class="border-b border-gray-200 px-6 py-3 text-lg font-medium">Utilisateur</th>
                        <th class="border-b border-gray-200 px-6 py-3 text-lg font-medium">Image</th>
                        <th class="border-b border-gray-200 px-6 py-3 text-lg font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($article = $result->fetch_assoc()): ?>
                        <tr class="hover:bg-[#f8deff61] transition duration-300 ease-in-out">
                            <td class="border-b border-gray-200 px-6 py-4"><?php echo htmlspecialchars($article['titre']); ?></td>
                            <td class="border-b border-gray-200 px-6 py-4"><?php echo htmlspecialchars(substr($article['contenu'], 0, 18)) . '...'; ?></td>
                            <td class="border-b border-gray-200 px-6 py-4">
                                  <?php echo htmlspecialchars($article['tags'] ?: 'Aucun tag'); ?>
                            </td>

                            <td class="border-b border-gray-200 px-6 py-4"><?php echo htmlspecialchars($article['nom_utilisateur']); ?></td>
                            <td class="border-b border-gray-200 px-6 py-4">
                                <img src="<?php echo htmlspecialchars($article['Url_image']); ?>" alt="Image de l'article" class="w-16 h-16 object-cover">
                            </td>
                            <td class="border-b border-gray-200 px-6 py-4 flex justify-center space-x-4 ">
                                <a href="./action/edit_article.php?id=<?php echo $article['id']; ?>" class="text-blue-500 hover:text-blue-700 hover:bg-blue-100 px-4 py-2 rounded-lg transition duration-200 ease-in-out">
                                    <i class="fas fa-edit"></i> 
                                </a>
                                <a href="./action/supprimer_article.php?id=<?php echo $article['id']; ?>" class="text-red-500 hover:text-red-700 hover:bg-red-100 px-4 py-2 rounded-lg transition duration-200 ease-in-out" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">
                                    <i class="fas fa-trash-alt"></i> 
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <!-- Si aucun article n'est trouvé -->
            <p class="text-center text-gray-700">Aucun article trouvé</p>
        <?php endif; ?>
    </div>
</main>

</body>

</html>
