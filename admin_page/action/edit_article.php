<?php
session_start();

// Vérification de l'accès administrateur
if (!isset($_SESSION['id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] != 2) {
    header('Location: login.php');
    exit();
}

// Connexion à la base de données
require '../../db.php';

// Récupération de l'ID de l'article
if (!isset($_GET['id'])) {
    header('Location: ../articles.php');
    exit();
}

$article_id = $_GET['id'];

// Récupérer l'article avec ses informations et son tag associé
$article_query = $conn->prepare("SELECT a.id, a.titre, a.contenu, a.Url_image, a.tags_id
                                FROM articles a
                                WHERE a.id = ?");
$article_query->bind_param('i', $article_id);
$article_query->execute();
$article_result = $article_query->get_result();

// Si l'article n'existe pas
if ($article_result->num_rows == 0) {
    header('Location: ../articles.php');
    exit();
}

$article = $article_result->fetch_assoc();
$current_tag_id = $article['tags_id'];

// Récupérer tous les tags disponibles
$tags_query = $conn->query("SELECT id, nom FROM tags");

// Traitement du formulaire de mise à jour
// Traitement du formulaire de mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];
    $image = $_POST['image']; // L'URL de l'image
    $tag_id = $_POST['tag']; // Le tag sélectionné

    // Mise à jour de l'article
    $update_query = $conn->prepare("UPDATE articles SET titre = ?, contenu = ?, Url_image = ?, tags_id = ? WHERE id = ?");
    $update_query->bind_param('sssii', $titre, $contenu, $image, $tag_id, $article_id);
    $update_query->execute();

    // Rediriger vers la page des articles après la mise à jour
    header('Location: ../articles.php');
    exit();
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
<body class="bg-gray-100  flex flex-col md:flex-row">
   

    <!-- Main Content -->
    <main class="w-full flex items-center justify-center h-screen bg-gray-100">
    <div class=" w-1/3 bg-white p-8 rounded-lg shadow-lg ">
        <h2 class="text-3xl font-bold text-[#cb6ce6] mb-6 text-center">Modifier l'Article</h2>
        
        <form action="edit_article.php?id=<?php echo $article_id; ?>" method="POST" class="space-y-6">
            <!-- Titre -->
            <div>
                <label for="titre" class="block text-lg font-medium text-gray-700">Titre</label>
                <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($article['titre']); ?>"
                    class="w-full p-3 mt-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cb6ce6] transition ease-in-out duration-300" required>
            </div>

            <!-- Contenu -->
            <div>
                <label for="contenu" class="block text-lg font-medium text-gray-700">Contenu</label>
                <textarea id="contenu" name="contenu" 
                    class="w-full p-3 mt-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cb6ce6] transition ease-in-out duration-300" required><?php echo htmlspecialchars($article['contenu']); ?></textarea>
            </div>

            <!-- URL de l'image -->
            <div>
                <label for="image" class="block text-lg font-medium text-gray-700">URL de l'image</label>
                <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($article['Url_image']); ?>"
                    class="w-full p-3 mt-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cb6ce6] transition ease-in-out duration-300">
            </div>

            <!-- Tag -->
            <div>
                <label for="tag" class="block text-lg font-medium text-gray-700">Tag</label>
                <select name="tag" id="tag" 
                    class="w-full p-3 mt-2 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cb6ce6] transition ease-in-out duration-300" required>
                    <?php while ($tag = $tags_query->fetch_assoc()): ?>
                        <option value="<?php echo $tag['id']; ?>" <?php echo $current_tag_id == $tag['id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($tag['nom']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Bouton de soumission -->
            <div class="mt-6" >
                <button type="submit" class="w-full bg-[#cb6ce6] text-white font-semibold py-3 rounded-lg hover:bg-[#fbd8d5] transition ease-in-out duration-200 mb-6 ">
                    Mettre à jour l'article
                </button>
                <a href="../articles.php" class="font-bold text-[#e0a8a3] underline  ">Retour à la liste des articles </a>
            </div>
        </form>
    </div>
</main>

</body>
</html>
