<?php
session_start();
include("../../db.php");

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $articleId = intval($_GET['id']);
    $utilisateur_id = $_SESSION['id'];

    // Récupérer l'article à modifier
    $stmt = $conn->prepare("SELECT a.*, u.nom_utilisateur, t.nom AS tags, at.tags_id
                        FROM articles a
                        LEFT JOIN utilisateurs u ON a.utilisateur_id = u.id
                        LEFT JOIN article_tags at ON a.id = at.article_id
                        LEFT JOIN tags t ON at.tags_id = t.id
                        WHERE a.id = ? AND a.utilisateur_id = ?");

    $stmt->bind_param("ii", $articleId, $utilisateur_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $article = $result->fetch_assoc();
    } else {
        // Si l'article n'existe pas ou l'utilisateur n'est pas le propriétaire
        header("Location: ../article.php");
        exit();
    }

    // Récupérer tous les tags disponibles
    $stmt_tags = $conn->prepare("SELECT * FROM tags");
    $stmt_tags->execute();
    $result_tags = $stmt_tags->get_result();

    // Modifier l'article
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $tag_id = $_POST['tags'];
        $thumbnail_url = $_POST['thumbnail_url'];

        // Mettre à jour l'article dans la base de données
        $stmt_update_article = $conn->prepare("UPDATE articles SET titre = ?, contenu = ?, Url_image = ? WHERE id = ?");
        $stmt_update_article->bind_param("sssi", $title, $content, $thumbnail_url, $articleId);
        $stmt_update_article->execute();

        // Mettre à jour les tags associés
        $stmt_delete_tags = $conn->prepare("DELETE FROM article_tags WHERE article_id = ?");
        $stmt_delete_tags->bind_param("i", $articleId);
        $stmt_delete_tags->execute();

        if ($tag_id) {
            $stmt_add_tag = $conn->prepare("INSERT INTO article_tags (article_id, tags_id) VALUES (?, ?)");
            $stmt_add_tag->bind_param("ii", $articleId, $tag_id);
            $stmt_add_tag->execute();
        }

        header("Location: ../mes_blog.php"); // Rediriger après la modification
        exit();
    }

} else {
    // Si l'ID de l'article n'est pas passé ou incorrect
    header("Location: ../article.php");
    exit();
}
?>

<!-- HTML Formulaire de modification -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nouveau article</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="../assets/favicon.svg">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet" />
    <script src="../scripts/articles.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
</head>
<body class="mx-4 mx-8">

        <!-- Header And Hero section -->
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
                </div>
            </header>
        </div>
    </section>

    <section class="bg-white border-2 border-[#cb6ce6] rounded-lg shadow-lg p-8 mt-10">
        <form method="POST" class="space-y-6">

            <div>
                <label for="title" class="block text-lg font-semibold mb-2 text-[#cb6ce6]">Title</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($article['titre']); ?>" required
                    class="w-full px-4 py-3 border-2 border-[#cb6ce6] bg-white rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cb6ce6] placeholder-gray-400"
                    placeholder="Enter article title here">
            </div>

            

            <label for="content" class="block text-lg font-semibold mb-2 text-[#cb6ce6]">Content</label>
            <div id="editor-container" style="border: 1px solid ; border-radius: 4px; min-height: 700px;"><?php echo $article['contenu']; ?></div>
            <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
            <style>
                #ql-toolbar ql-snow {
                    border-radius: 20px !important;
                }
            </style>
            <textarea name="content" id="content" style=" display:none;"> <?php echo htmlspecialchars($article['contenu']); ?></textarea>
            <script>
                document.querySelector('form').onsubmit = function () {
                    document.querySelector('#content').value = quill.root.innerHTML;
                };
                var quill = new Quill('#editor-container', {
    theme: 'snow',
    placeholder: 'Write the full content of the article here...',
  });
            </script>

            <div>
                <label for="tag_id" class="block text-lg font-semibold mb-2 text-[#cb6ce6]">Select Tag</label>
                <select id="tag_id" name="tags" required
        class="w-full px-4 py-3 border-2 border-[#cb6ce6] bg-white rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cb6ce6] placeholder-gray-400">
    <option value="" disabled selected>Select a tag</option>
    <?php while ($tag = $result_tags->fetch_assoc()): ?>
        <option value="<?php echo $tag['id']; ?>"
            <?php echo ($tag['id'] == $article['tags_id']) ? 'selected' : ''; ?>>
            <?php echo $tag['nom']; ?>
        </option>
    <?php endwhile; ?>
</select>

            </div>

            <div>
                <label for="thumbnail" class="block text-lg font-semibold mb-2 text-[#cb6ce6]">Thumbnail URL</label>
                <input type="text" id="thumbnail" name="thumbnail_url" value="<?php echo htmlspecialchars($article['Url_image']); ?>"
                    class="w-full px-4 py-3 border-2 border-[#cb6ce6] bg-white rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cb6ce6] placeholder-gray-400"
                    placeholder="Enter image URL )" required>
            </div>
       
            <button type="submit" name="submit"
                class="w-full  py-3 bg-[#cb6ce6] text-white font-semibold rounded-lg hover:bg-[#fbd8d5] hover:text-[#cb6ce6] border-2 border-[#cb6ce6] transition duration-200">
                Modifier 
            </button>
            
       
        </form>
        <a href="../article.php">
                <button class="mt-4 w-full pb-2 py-3 bg-[#fbd8d5] text-[#cb6ce6]  font-semibold rounded-lg hover:bg-[#cb6ce6] hover:text-[#fbd8d5] border-2 border-[#fbd8d5] transition duration-200">
                    Annuler
                </button>
            </a>
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
                    <a href="contact.php">Contact</a>
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

    <!-- footer  -->
    <footer class="bg-[#cb6ce6] mb-6 text-gray-200 py-10 rounded-lg mt-20">
  <div class="  mx-20 flex  flex justify-between">

    <div class=" flex flex-col justify-between order-2 gap-1">
      <div>
        <h2 class="text-2xl font-semibold mb-2">Ready to level up your business?</h2>
        <p class="text-gray-400 text-sm">Start your 30-day free trial. Cancel anytime.</p>
      </div>
      <button class="mt-2 px-6 py-2 bg-white text-gray-900 font-medium rounded-md hover:bg-gray-200 w-fit">
        Get started
      </button>
    </div>

    <div class="order-1">
      <div class="mb-6">
        <p class="font-semibold flex items-center">
          <img src="../../assets/userlogo.svg" alt="Safaa">
        </p>
        <p class="text-gray-400 text-sm">
          Design amazing digital experiences that create more happy in the world.
        </p>
      </div>
      <nav class="flex space-x-4 text-sm">
        <a href="#" class="hover:text-white">Home</a>
        <a href="#" class="hover:text-white">Articles</a>
        <a href="#" class="hover:text-white">contact</a>
        <a href="#" class="hover:text-white">Careers</a>
        <a href="#" class="hover:text-white">Help</a>
        <a href="#" class="hover:text-white">Privacy</a>
      </nav>
    </div>
  </div>

  <div class="flex justify-between flex-row-reverse mx-20 items-center border-t border-gray-700 mt-10 pt-4">
  <div class=" text-center text-white text-sm">
    © 2025 Safaa Ettalhi. All rights reserved.
  </div>
  <div class="flex space-x-4 mt-6 text-2xl">
        <a href="#" class="hover:text-white"><i class="ri-twitter-fill"></i></a>
        <a href="#" class="hover:text-white"><i class="ri-facebook-fill"></i></a>
        <a href="#" class="hover:text-white"><i class="ri-linkedin-fill"></i></a>
        <a href="#" class="hover:text-white"><i class="ri-github-fill"></i></a>
        <a href="#" class="hover:text-white"><i class="ri-dribbble-fill"></i></a>
  </div>
  </div>

  

</footer>

    <style>
        #editor-container .ql-editor::before {
            font-size: 16px;
            color: #9ca3af !important;
        }
    </style>
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

</body>
</html>
