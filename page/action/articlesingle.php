<?php
session_start();
include("../../db.php");

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $articleId = intval($_GET['id']);
    $utilisateur_id = $_SESSION['id'];
    
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
        header("Location: ../articles.php");
        exit();
    }

    // Récupérer des likes d'article 
    $stmt_likes = $conn->prepare("SELECT COUNT(*) AS likes_count FROM likes WHERE article_id = ?");
    $stmt_likes->bind_param("i", $articleId);
    $stmt_likes->execute();
    $result_likes = $stmt_likes->get_result();
    $likes = $result_likes->fetch_assoc();
    $likes_count = $likes['likes_count'];

    // Vérifier si l'utilisateur a aimé cet article
    $stmt_user_like = $conn->prepare("SELECT * FROM likes WHERE article_id = ? AND utilisateur_id = ?");
    $stmt_user_like->bind_param("ii", $articleId, $utilisateur_id);
    $stmt_user_like->execute();
    $like_result = $stmt_user_like->get_result();
    $has_liked = $like_result->num_rows > 0;

    // Ajouter ou retirer un like 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['like'])) {
        if (!$has_liked) {
            $stmt_add_like = $conn->prepare("INSERT INTO likes (article_id, utilisateur_id) VALUES (?, ?)");
            $stmt_add_like->bind_param("ii", $articleId, $utilisateur_id);
            $stmt_add_like->execute();
            header("Location: ./articlesingle.php?id=" . $articleId); 
            exit();
        } else {
            $stmt_remove_like = $conn->prepare("DELETE FROM likes WHERE article_id = ? AND utilisateur_id = ?");
            $stmt_remove_like->bind_param("ii", $articleId, $utilisateur_id);
            $stmt_remove_like->execute();
            header("Location: ./articlesingle.php?id=" . $articleId); 
            exit();
        }
    }

    // Récupérer les commentaires d'article
    $stmt_comments = $conn->prepare("SELECT c.*, u.nom_utilisateur FROM commentaires c LEFT JOIN utilisateurs u ON c.utilisateur_id = u.id WHERE c.article_id = ?");
    $stmt_comments->bind_param("i", $articleId);
    $stmt_comments->execute();
    $comments_result = $stmt_comments->get_result();

    // Ajouter un commentaire
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['commentaire'])) {
        $commentaire = $_POST['commentaire'];
        $stmt_insert_comment = $conn->prepare("INSERT INTO commentaires (article_id, utilisateur_id, contenu) VALUES (?, ?, ?)");
        $stmt_insert_comment->bind_param("iis", $articleId, $utilisateur_id, $commentaire);
        $stmt_insert_comment->execute();
        header("Location: ./articlesingle.php?id=" . $articleId);
        exit();
    }

    // Supprimer un commentaire
    if (isset($_GET['delete_comment_id'])) {
        $commentaire_id = $_GET['delete_comment_id'];
        $stmt_delete_comment = $conn->prepare("DELETE FROM commentaires WHERE id = ? AND utilisateur_id = ?");
        $stmt_delete_comment->bind_param("ii", $commentaire_id, $utilisateur_id);
        $stmt_delete_comment->execute();
        header("Location: ./articlesingle.php?id=" . $articleId); 
        exit();
    }

    // Modifier un commentaire
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['commentContent']) && isset($_POST['commentId'])) {
        $commentContent = $_POST['commentContent'];
        $commentId = $_POST['commentId'];

        if (!empty($commentContent) && $commentId > 0) {
            $stmt_update_comment = $conn->prepare("UPDATE commentaires SET contenu = ? WHERE id = ?");
            $stmt_update_comment->bind_param("si", $commentContent, $commentId);
            if ($stmt_update_comment->execute()) {
                header("Location: articlesingle.php?id=$articleId"); // Redirection vers l'article
                exit();
            } else {
                echo "Erreur lors de la mise à jour du commentaire.";
            }
        }
    }
} else {
    header("Location: ../article.php");
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
        <a href="../article.php" class="text-[#cb6ce6] hover:underline mb-6 inline-block text-lg font-semibold">← Retour aux articles</a>

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
                    <i class="fas <?php echo $has_liked ? 'fa-heart text-red-500' : 'fa-heart text-gray-300'; ?> hover:text-red-600 transition-colors"></i>
                    <span class="text-sm text-gray-500"><?php echo $likes_count; ?> J'aime</span>
                </button>
            </form>

            <!-- Formulaire de commentaire -->
            <div class="mb-6">
              <h2 class="text-xl font-semibold mb-4">Laisser un commentaire</h2>
                <form action="" method="POST">
                    <textarea name="commentaire" rows="4" class="w-full p-4 border border-gray-300 rounded-lg mb-4 focus:outline-none focus:ring-2 focus:ring-[#cb6ce6]" placeholder="Votre commentaire..."></textarea>
                    <button type="submit" class="bg-[#cb6ce6] text-white py-2 px-4 rounded-lg hover:bg-[#a75bcf] transition-colors">Envoyer</button>
                </form>
            </div>

            <!-- Commentaires -->
            <h2 class="text-xl font-semibold mb-4">Commentaires</h2>
                    <?php while ($comment = $comments_result->fetch_assoc()) : ?>
                        <div class="bg-white p-6 rounded-lg shadow-md mb-6 hover:shadow-lg transition-shadow duration-300">
                            <div class="flex justify-between items-center mb-2">
                                <p class="text-sm text-gray-500">
                                    <span class="font-semibold text-[#cb6ce6]"><?php echo htmlspecialchars($comment['nom_utilisateur']); ?></span> 
                                    le <?php echo date('d/m/Y', strtotime($comment['cree_le'])); ?>
                                </p>

                                <!-- Menu déroulant pour supprimer ou modifier -->
                                <?php if ($comment['utilisateur_id'] == $utilisateur_id) : ?>
                                    <div class="relative">
                                        <button class="text-gray-500 hover:text-gray-700" onclick="toggleMenu(<?php echo $comment['id']; ?>)">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div id="menu-<?php echo $comment['id']; ?>" class="absolute right-0 hidden bg-white border border-gray-300 rounded-lg shadow-md mt-2 w-48">
                                            <ul>
                                                <li>
                                                <button class="commentEditBtn block text-blue-500 hover:text-blue-700 px-4 py-2" data-content="<?php echo htmlspecialchars($comment['contenu']); ?>" data-id="<?php echo $comment['id']; ?>">Modifier</button>
                                                </li>
                                                <li>
                                                    <a href="articlesingle.php?id=<?php echo $articleId; ?>&delete_comment_id=<?php echo $comment['id']; ?>" class="block text-red-500 hover:text-red-700 px-4 py-2">Supprimer</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <p class="text-gray-700 mb-4"><?php echo nl2br(htmlspecialchars($comment['contenu'])); ?></p>
                        </div>
                    <?php endwhile; ?>
        </div>
    </div>

<!-- Modal de modification de commentaire -->
<div id="commentModal" class="fixed inset-0 bg-black hidden bg-opacity-50 flex justify-center items-center">
    <div class="bg-white p-6 rounded-lg w-96">
        <div class="flex justify-between">
            <h2 class="text-xl font-semibold mb-4 text-[#cb6ce6]">
                Modifier le commentaire
            </h2>
            <i class="ri-close-circle-line text-2xl text-red-600" id="closeModalBtn"></i>
        </div>
        <!-- Formulaire de modification du commentaire -->
        <form method="POST">
            <textarea name="commentContent" id="commentContent" rows="4" class="w-full p-2 border border-gray-300 rounded mb-4" placeholder="Modifiez votre commentaire ici..."></textarea>
            <input type="hidden" name="commentId" value="" />
            <div class="flex justify-end gap-4">
                <button type="submit" id="submitCommentBtn" class="bg-[#cb6ce6] text-white w-full px-4 py-2 rounded hover:bg-[#fbd8d5] hover:text-[#cb6ce6] transition">Modifier</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleMenu(commentId) {
        const menu = document.getElementById(`menu-${commentId}`);
        menu.classList.toggle('hidden');
    }

    const commentEditBtns = document.querySelectorAll('.commentEditBtn');
    const commentModal = document.getElementById('commentModal');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const commentContentTextarea = document.getElementById('commentContent');

    commentEditBtns.forEach(function(commentEditBtn) {
        commentEditBtn.addEventListener('click', function() {
            const commentContent = commentEditBtn.getAttribute('data-content');
            const commentId = commentEditBtn.getAttribute('data-id'); // On récupère l'ID du commentaire

            // Remplir le textarea avec le contenu actuel du commentaire
            commentContentTextarea.value = commentContent;

            // Placer l'ID du commentaire dans un champ caché
            document.querySelector('[name="commentId"]').value = commentId;

            // Afficher le modal
            commentModal.classList.remove('hidden');
        });
    });

    closeModalBtn.addEventListener('click', function() {
        commentModal.classList.add('hidden');
    });
</script>
</body>
</html>
