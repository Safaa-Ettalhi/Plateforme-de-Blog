<?php
session_start();
include("./db.php");

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $articleId = intval($_GET['id']);  
    // Récupérer l'article
    $stmt = $conn->prepare("SELECT a.*, u.nom_utilisateur, GROUP_CONCAT(t.nom SEPARATOR ', ') AS tags
                            FROM articles a
                            LEFT JOIN utilisateurs u ON a.utilisateur_id = u.id
                            LEFT JOIN article_tags at ON a.id = at.article_id
                            LEFT JOIN tags t ON at.tags_id = t.id
                            WHERE a.id = ? 
                            GROUP BY a.id");
    $stmt->bind_param("i", $articleId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $article = $result->fetch_assoc();
    } else {
        header("Location: ./index.php");
        exit();
    }

    // Récupérer des likes d'article 
    $stmt_likes = $conn->prepare("SELECT COUNT(*) AS likes_count FROM likes WHERE article_id = ?");
    $stmt_likes->bind_param("i", $articleId);
    $stmt_likes->execute();
    $result_likes = $stmt_likes->get_result();
    $likes = $result_likes->fetch_assoc();
    $likes_count = $likes['likes_count'];

    

    // Ajouter ou retirer un like 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['like'])) {
        if (!$has_liked) {
            header("Location: ./login.php"); 
            exit();
        } 
    }

    // Récupérer les commentaires d'article
    $stmt_comments = $conn->prepare("SELECT c.*, u.nom_utilisateur FROM commentaires c LEFT JOIN utilisateurs u ON c.utilisateur_id = u.id WHERE c.article_id = ?");
    $stmt_comments->bind_param("i", $articleId);
    $stmt_comments->execute();
    $comments_result = $stmt_comments->get_result();

} else {
    header("Location: ./index.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['titre']); ?> - Article</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 font-sans">
    <div class="container mx-auto px-6 py-12">
        <!-- Retour à la liste -->
        <a href="./index.php" class="text-[#cb6ce6] hover:underline mb-6 inline-block text-lg font-semibold">← Retour aux articles</a>

        <!-- Contenu de l'article -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <!-- Image de l'article -->
            <img src="<?php echo htmlspecialchars($article['Url_image']); ?>" alt="Image de l'article" class="w-full h-64 object-cover rounded-lg mb-6">

            <!-- Tags -->
            <p class="text-sm text-gray-500 mb-2"><?php echo $article['tags']; ?></p>

            <!-- Titre -->
            <h1 class="text-3xl font-semibold text-[#cb6ce6] mb-4"><?php echo htmlspecialchars($article['titre']); ?></h1>

            <!-- Contenu -->
            <div class="text-gray-700 leading-relaxed mb-6"><?php echo $article['contenu']; ?></div>

            <!-- Auteur et date -->
            <p class="text-gray-500 text-sm mb-6">Publié par <span class="font-semibold"><?php echo htmlspecialchars($article['nom_utilisateur']); ?></span> le <?php echo date('d/m/Y', strtotime($article['cree_le'])); ?></p>

            <!-- Likes -->
            <form method="POST" action="" class="mb-6">
                <button type="submit" name="like" class="flex items-center space-x-2 text-2xl">
                    <i class="fas <?php echo 'fa-heart text-gray-300'; ?> hover:text-red-600 transition-colors"></i>
                    <span class="text-sm text-gray-500"><?php echo $likes_count; ?> J'aime</span>
                </button>
            </form>

         

            <!-- Commentaires -->
            <h2 class="text-xl font-semibold mb-4">Commentaires</h2>
                    <?php while ($comment = $comments_result->fetch_assoc()) : ?>
                        <div class="bg-white p-6 rounded-lg shadow-md mb-6 hover:shadow-lg transition-shadow duration-300">
                            <div class="flex justify-between items-center mb-2">
                                <p class="text-sm text-gray-500">
                                    <span class="font-semibold text-[#cb6ce6]"><?php echo htmlspecialchars($comment['nom_utilisateur']); ?></span> 
                                    le <?php echo date('d/m/Y', strtotime($comment['cree_le'])); ?>
                                </p>

                            </div>

                            <p class="text-gray-700 mb-4"><?php echo nl2br(htmlspecialchars($comment['contenu'])); ?></p>
                        </div>
                    <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
