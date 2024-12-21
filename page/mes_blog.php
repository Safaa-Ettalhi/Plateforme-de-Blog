<?php
include("../db.php");

session_start();

if (!isset($_SESSION['nom_utilisateur'])) {
    header("Location: login.php"); 
    exit();
}

$nom_utilisateur = htmlspecialchars($_SESSION['nom_utilisateur']);
$user_id = $_SESSION['id']; 

$query = "SELECT a.id, a.titre, a.contenu, a.Url_image, u.nom_utilisateur, 
                     t.nom AS tag
          FROM articles a
          LEFT JOIN utilisateurs u ON a.utilisateur_id = u.id
          LEFT JOIN article_tags at ON a.id = at.article_id
          LEFT JOIN tags t ON at.tags_id = t.id
          WHERE a.utilisateur_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id); 
$stmt->execute();
$result = $stmt->get_result();


if (isset($_GET['delete_article_id'])) {
        $article_id = $_GET['delete_article_id'];
        $stmt_delete_article = $conn->prepare("DELETE FROM articles WHERE id = ? AND utilisateur_id = ?");
        $stmt_delete_article->bind_param("ii", $article_id, $user_id);
        $stmt_delete_article->execute();
        header("Location: ./mes_blog.php"); 
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mes Articles - Safaa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="../assets/favicon.svg">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>

<body class="bg-gray-50 mx-4">
<section class="relative bg-cover bg-center bg-[#cb6ce6] mt-3 flex rounded-2xl text-white">
    <div class="container mx-auto px-6 flex flex-col justify-between">
        <header class="shadow-sm sticky top-0 z-50">
            <div class="container mx-auto flex items-center justify-between px-6 py-4">
                <div class="flex items-center space-x-2 text-gray-800 font-semibold">
                    <a href="../index.php">
                        <img src="../../assets/userlogo.svg" alt="Safaa" width="130px">
                    </a>
                </div>
                <div class="hidden md:flex items-center justify-between space-x-3">
                    <i class="ri-menu-4-line text-3xl text-[#fbd8d5]" id="menuModalDesktop"></i>
                </div>
                <div class="flex items-center justify-between space-x-3 md:hidden">
                    <i class="ri-menu-4-line text-3xl text-[#fbd8d5]" id="menuModal"></i>
                </div>
            </div>
        </header>
    </div>
</section>
    <section class="container max-w-full py-8 mt-20">
        <h2 class="text-4xl font-bold text-[#cb6ce6]  mb-10">Mes Articles</h2>
        
        <!-- Articles Cards -->
        <div class="grid w-full grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($article = $result->fetch_assoc()): ?>
            <div class="w-full bg-white rounded-lg shadow-lg overflow-hidden relative">
                <!-- Tag positionné en haut à gauche -->
                <p class="absolute top-0 left-0 text-sm text-white mt-3 ml-3 bg-white/30 px-2 py-1 rounded-tr-lg rounded-bl-lg z-10">
                    <?php echo $article['tag']; ?>
                </p>

                <!-- Image de l'article -->
                <img src="<?php echo $article['Url_image']; ?>" alt="Image de l'article" class="w-full h-48 object-cover">

                <div class="p-6">
                    <!-- Titre -->
                    <h3 class="text-xl font-semibold text-[#cb6ce6] mb-4 line-clamp-1"><?php echo htmlspecialchars($article['titre']); ?></h3>
                    <!-- Extrait de contenu -->
                    <div class="text-gray-700 leading-relaxed mb-6"><?php echo $article['contenu']; ?></div>
                    <!-- Auteur -->
                    <p class="text-gray-500 text-xs">Publié par <?php echo htmlspecialchars($article['nom_utilisateur']); ?></p>
                    
                    <!-- Boutons de gestion -->
                    <div class="mt-4 space-x-4">
                        <a href="./action/modifier_article.php?id=<?php echo $article['id']; ?>" class="px-4 py-2 text-white bg-[#cb6ce6] rounded hover:bg-[#b25ed1]">
                            Modifier
                            
                        </a>
                        <a href="mes_blog.php?id=<?php echo $article['id']; ?>&delete_article_id=<?php echo $article['id']; ?>"" class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-500">
                            Supprimer
                        </a>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
            <?php else: ?>
                <p class="text-gray-500">Aucun article trouvé.</p>
            <?php endif; ?>
        </div>
    </section>
    <div id="sidebarModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
        
        <div class="bg-white w-64 h-full shadow-lg flex flex-col justify-between">
            
            <div class="p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-[#cb6ce6]">Menu</h2>
                    <i class="ri-close-line text-2xl cursor-pointer" id="closeSidebar"></i>
                </div>
                <nav class="flex flex-col space-y-4 text-gray-800">
                    <a href="article.php">Home</a>
                    <a href="mes_blog.php">Mes Blog</a>
                    <a href="ressource.php">Resources</a>
                    <a href="tutorial.php">Tutorials</a>
                    <a href="profil.php">Profil</a>
                </nav>
            </div>

            <div class="p-6 space-y-2">
                <button  class="w-full  rounded text-red-600 px-4 py-2 border border-red-600 gap-2 flex justify-center rounded-md bg-white flex items-center hover:bg-red-600 hover:text-white">
                <a href="../logout.php" class=" ">
                            <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                </a>
                </button>
            </div>
    </div>
  </div>
  <footer class="bg-[#cb6ce6] text-gray-200 py-10 rounded-lg mt-20">
    <div class="mx-4 md:mx-20 flex flex-col md:flex-row justify-between gap-8">
        <!-- Section gauche -->
        <div class="order-2 md:order-2 flex flex-col gap-4">
            <div>
                <h2 class="text-2xl font-semibold mb-2">Prêt à passer au niveau supérieur?</h2>
                <p class="text-gray-500 text-sm">Commencez votre essai gratuit de 30 jours. Annulez à tout moment..</p>
            </div>
            <button class="px-6 py-2 bg-white text-gray-900 font-medium rounded-md hover:bg-gray-200 w-fit">
               Commencer
            </button>
        </div>

        <!-- Section droite -->
        <div class="order-1 md:order-1 text-center md:text-left">
            <div class="mb-6">
                <p class="font-semibold flex items-center justify-center md:justify-start">
                    <img src="../../assets/userlogo.svg" alt="Safaa">
                </p>
                <p class="text-gray-500 text-sm">
                Concevez des expériences numériques incroyables qui apportent plus de bonheur dans le monde.
                </p>
            </div>
            <nav class="flex flex-wrap justify-center md:justify-start space-x-4 text-sm">
                <a href="./article.php" class="hover:text-white">Home</a>
                <a href="./contact.php" class="hover:text-white">Contact</a>
                <a href="./tutorial.php" class="hover:text-white">Tutorial</a>
                <a href="./ressource.php" class="hover:text-white">Ressource</a>
                
            </nav>
        </div>
    </div>

    <div class="flex flex-col-reverse md:flex-row justify-between items-center border-t border-gray-700 mt-10 pt-4 mx-4 md:mx-20">
        <div class="text-center text-white text-sm mt-4 md:mt-0">
            © 2025 Safaa Ettalhi. All rights reserved.
        </div>
        <div class="flex justify-center space-x-4 mt-4 md:mt-0 text-2xl">
            <a href="https://www.instagram.com/safaa_ettalhi1/" class="hover:text-white"><i class="ri-instagram-fill"></i></a>
            <a href="https://web.facebook.com/safaa.Ettal?locale=fr_FR" class="hover:text-white"><i class="ri-facebook-fill"></i></a>
            <a href="https://www.linkedin.com/in/safaa-ettalhi/" class="hover:text-white"><i class="ri-linkedin-fill"></i></a>
            <a href="https://github.com/Safaa-Ettalhi" class="hover:text-white"><i class="ri-github-fill"></i></a>
            
        </div>
    </div>
</footer>
</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
    // Get the sidebar modal and buttons
    const sidebarModal = document.getElementById("sidebarModal");
    const menuButton = document.getElementById("menuModalDesktop");
    const closeSidebar = document.getElementById("closeSidebar");

    menuButton.addEventListener("click", function () {
        sidebarModal.classList.remove("hidden"); 
    });

    closeSidebar.addEventListener("click", function () {
        sidebarModal.classList.add("hidden"); 
    });

    sidebarModal.addEventListener("click", function (e) {
        if (e.target === sidebarModal) {
            sidebarModal.classList.add("hidden");
        }
    });
});
</script>
</html>
