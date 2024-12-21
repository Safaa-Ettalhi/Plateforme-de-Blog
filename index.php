

<?php
include("./db.php");

session_start();



// Récupérer les articles de tous les utilisateurs
$query = "SELECT a.id, a.titre, a.contenu, a.Url_image, u.nom_utilisateur, 
                               t.nom AS tags
                        FROM articles a
                        LEFT JOIN utilisateurs u ON a.utilisateur_id = u.id
                        LEFT JOIN article_tags at ON a.id = at.article_id
                        LEFT JOIN tags t ON at.tags_id = t.id";  
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Blog </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="./assets/favicon.svg">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet" />
    <script src="./scripts/main.js" defer ></script>
</head>

<body class="bg-gray-50 mx-4">
   
    <!-- Header And Hero section  -->
    <section class="relative bg-cover bg-center bg-[url('/assets/bg.jpg')] h-[70vh] mt-3 flex  rounded-2xl text-white">
        <div class="container mx-auto px-6 flex flex-col justify-between">
            <header class=" shadow-sm  top-0 z-50">
                <div class="container mx-auto flex items-center justify-between px-6 py-4">

                    <div class="flex items-center space-x-2 text-gray-800 font-semibold">
                        <img src="./assets/LOGO.svg" alt="Safaa Ettalhi" width="130px">
                    </div>

                    

                    <div class="hidden md:flex items-center space-x-4">
                        <button class="px-4 py-1 border border-[#cb6ce6] bg-white  text-[#cb6ce6]  rounded-lg hover:bg-[#cb6ce6] hover:text-white">
                            <a href="./login.php">Log in</a>
                        </button>
                        <button class="px-4 py-1 bg-[#cb6ce6] text-white rounded-lg hover:bg-white  hover:text-[#cb6ce6]">
                            <a href="./inscription.php">Sign up</a>
                        </button>
                    </div>

                    
                </div>
            </header>

            <!-- Hero section -->
            <div class="flex flex-col ml-4 max-w-5xl mb-2">
                <h1 class="text-4xl md:text-5xl text-[#cb6ce6] font-bold leading-snug mb-6">
                Mon parcours, d'une étudiante curieuse <br> à une développeuse passionnée
                </h1>

                <p class="text-lg text-gray-500 mb-8">
                Bienvenue dans mon univers, où je partage mon parcours d'apprentissage, de croissance et les défis que j'ai surmontés pour devenir la développeuse que je suis aujourd'hui. Que tu débutes ou que tu sois déjà développeuse, j'espère que mon histoire t'inspirera et te motivera à aller toujours plus loin !
                </p>

                <div class="flex  space-x-4 mb-8">
                    <span class="bg-[#cb6ce6] text-white px-4 py-1 rounded-full text-sm">
                    Découvre mon parcours
                    </span>
                    <span class="bg-[#cb6ce6] text-white px-4 py-1 rounded-full text-sm">
                    Apprends avec moi
                    </span>
                    
                </div>
            </div>
        </div>
    </section>
    <section class="container max-w-full py-8 mt-10">
            <h2 class="text-4xl font-bold text-[#cb6ce6]  mb-10">Découvrire Nos Articles</h2>
            
            <!-- Articles Cards -->
            <div class="grid w-full grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
                <?php if ($result->num_rows > 0): ?>
                <?php while ($article = $result->fetch_assoc()): ?>
            <div class="w-full bg-white rounded-lg shadow-lg overflow-hidden relative"> <!-- Ajout de relative ici -->
                <!-- Tag positionné en haut à gauche -->
                <p class="absolute top-0 left-0 text-sm text-white mt-3 ml-3 bg-white/30 px-2 py-1 rounded-tr-lg rounded-bl-lg z-10">
                <?php echo $article['tags']; ?>
                </p>

                <!-- Image de l'article -->
                <img src="<?php echo $article['Url_image']; ?>" alt="Image de l'article" class="w-full h-48 object-cover">

                <div class="p-6">
                    <!-- Titre -->
                    <h3 class="text-xl font-semibold text-[#cb6ce6] mb-4 line-clamp-1"><?php echo htmlspecialchars($article['titre']); ?></h3>
                    <!-- Extrait de contenu -->
                    <div class="text-gray-700 text-sm mb-4 line-clamp-2"><?php echo (substr($article['contenu'], 0, 100)) . '...'; ?></div>
                    <!-- Auteur -->
                    <p class="text-gray-500 text-xs">Publié par <?php echo htmlspecialchars($article['nom_utilisateur']); ?></p>
                    
                    <!-- Bouton Voir Plus -->
                    <a href="./articlesinglevis.php?id=<?php echo $article['id']; ?>" 
                    class="mt-4 inline-block px-4 py-2 text-white bg-[#cb6ce6] rounded hover:bg-[#b25ed1]">
                    Voir plus
                    </a>
                </div>
            </div>
        <?php endwhile; ?>

                <?php else: ?>
                    <p class="text-gray-500">Aucun article trouvé.</p>
                <?php endif; ?>
       </div>
    </section>
</body>

</html>