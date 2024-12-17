
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<body class="h-screen flex flex-col md:flex-row">
    <!-- Sidebar -->
    <aside class="w-full md:w-64 bg-[#cb6ce6] text-white text-2xl md:text-xl flex flex-col">
        <div class="px-6 py-8">
            <h1 class="text-2xl font-bold flex justify-center">Admin Panel</h1>
        </div>
        <nav class="flex-1 pt-4 px-4 space-y-6">
            <a href="dashboard.php" class="block py-2 px-4 
            rounded bg-[#fbd8d5] text-[#cb6ce6]">
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
            <h2 class="text-2xl font-bold text-[#f4bdb8] text-center">Tableau de Bord</h2>
    </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-xl">
            <!-- Statistique Utilisateurs -->
            <div class="bg-white shadow-md rounded-lg p-6 border border-[#f0b3b3]">
                <h3 class="text-xl font-semibold text-[#f0b3b3] mb-4 ">Utilisateurs</h3>
                <p class="text-gray-700">Nombre total : <span class="font-bold"><?php echo $total_utilisateurs; ?></span></p>
                <a href="users.php" class="text-[#f0b3b3] hover:underline mt-4 block">Voir les détails →</a>
            </div>

            <!-- Statistique Articles -->
            <div class="bg-white shadow-md rounded-lg p-6 border border-[#ecaad8]">
                <h3 class="text-xl font-semibold text-[#ecaad8] mb-4">Articles</h3>
                <p class="text-gray-700">Nombre total : <span class="font-bold"><?php echo $total_articles; ?></span></p>
                <a href="articles.php" class="text-[#ecaad8] hover:underline mt-4 block">Voir les détails →</a>
            </div>

            <!-- Statistique Tags -->
            <div class="bg-white shadow-md rounded-lg p-6 border border-purple-300">
                <h3 class="text-xl font-semibold text-purple-300 mb-4">Tags</h3>
                <p class="text-gray-700">Nombre total : <span class="font-bold"><?php echo $total_tags; ?></span></p>
                <a href="tags.php" class="text-purple-300 hover:underline mt-4 block">Voir les détails →</a>
            </div>
        </div>

        <!-- Section supplémentaire -->
        <div class="mt-12 bg-white shadow-md rounded-lg p-6 border border-[#cb6ce6]">
            <h3 class="text-xl font-bold text-[#cb6ce6] mb-4">Activités récentes</h3>
            <p class="text-gray-600">Aucune activité récente pour le moment.</p>
        </div>
    </main>
</body>
</html>
