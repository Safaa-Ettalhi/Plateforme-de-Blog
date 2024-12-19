<?php
session_start();
require '../../db.php';
$query_tags = "SELECT id, nom FROM tags";
$result_tags = $conn->query($query_tags);

if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
$titre = $_POST['titre'];
$contenu = $_POST['contenu'];
$tags_id = $_POST['tags'] ?? null;
$Url_image = $_POST['Url_image'];
    
    if (empty($titre) || empty($contenu)) {
        $error_message = "Le titre et le contenu sont obligatoires.";
    } else {
        $stmt = $conn->prepare("INSERT INTO articles (utilisateur_id, titre, contenu, Url_image) VALUES (?, ?, ?, ?)");
        $utilisateur_id = $_SESSION['id'];
        $stmt->bind_param("isss", $utilisateur_id, $titre, $contenu, $Url_image);
        $stmt->execute();
        
        $article_id = $stmt->insert_id;
        if ($tags_id) {
            $stmt_tags = $conn->prepare("INSERT INTO article_tags (article_id, tags_id) VALUES (?, ?)");
            $stmt_tags->bind_param("ii", $article_id, $tags_id);
            $stmt_tags->execute();
            $stmt_tags->close();
        }

        $stmt->close();

        header("Location: ../articles.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Article</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 justify-center items-center flex flex-col md:flex-row">


    <!-- Main Content -->
    <body class="bg-gray-100 h-screen flex justify-center items-center">

    <div class="w-full max-w-lg border-2 border-[#cb6ce6] bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-3xl font-bold text-center text-[#cb6ce6] mb-6">Ajouter un Article</h2>

        <!-- Affichage des erreurs -->
        <?php if (isset($error_message)): ?>
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <!-- Formulaire d'ajout d'article -->
        <form action="ajouter_article.php" method="POST">
            
            <!-- Titre -->
            <div class="mb-6">
                <label for="titre" class="block text-gray-700 text-lg font-medium">Titre</label>
                <input type="text" id="titre" name="titre" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" required>
            </div>

            <!-- Contenu -->
            <div class="mb-6">
                <label for="contenu" class="block text-gray-700 text-lg font-medium">Contenu</label>
                <textarea id="contenu" name="contenu" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" rows="6" required></textarea>
            </div>

            <!-- Tags -->
            <div class="mb-6">
                <label for="tags_id" class="block text-gray-700 text-lg font-medium">Tags</label>
                <select name="tags" id="tags_id" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <option value="">Sélectionner un tag</option>
                    <?php while ($tag = $result_tags->fetch_assoc()): ?>
                        <option value="<?php echo $tag['id']; ?>"><?php echo $tag['nom']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- URL de l'image -->
            <div class="mb-6">
                <label for="Url_image" class="block text-gray-700 text-lg font-medium">Image URL</label>
                <input type="text" id="Url_image" name="Url_image" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            
            <div class="mt-6" >
                <button type="submit" class="w-full bg-[#cb6ce6] text-white font-semibold py-3 rounded-lg hover:bg-[#fbd8d5] transition ease-in-out duration-200 mb-6 ">
                    valider
                </button>
                <a href="../articles.php" class="font-bold text-[#e0a8a3] underline  ">Retour à la liste des articles </a>
            </div>
        </form>

    </div>
    </main>
</body>

</html>
