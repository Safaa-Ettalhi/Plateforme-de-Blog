<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ressources - Safaa</title>
    <script src="https://cdn.tailwindcss.com"></script>
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

<!-- Contenu principal -->
<main class="max-w-7xl mt-20 mx-auto px-4">
    <section id="guides" class="mt-20">
        <h2 class="text-4xl font-bold text-purple-700 mb-6 text-center">Guides d'apprentissage</h2>
        <div class="grid grid-cols-1 mt-16  md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
                <img src="https://www.freecatphotoapp.com/your-image.jpg" alt="freeCodeCamp" class="mb-4 rounded-md w-full">
                <h3 class="text-xl font-semibold text-purple-600 mb-2">freeCodeCamp</h3>
                <p class="text-gray-600 mb-4">Plateforme gratuite pour apprendre le développement web</p>
                <a href="https://www.freecodecamp.org/" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium underline">Accéder au site</a>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS3uYZfONnL1OMnVjwDj6owcaF2L_HDFfWL3g&s" alt="The Modern JavaScript Tutorial" class="mb-4 rounded-md w-full">
                <h3 class="text-xl font-semibold text-purple-600 mb-2">The Modern JavaScript Tutorial</h3>
                <p class="text-gray-600 mb-4">Tutoriel détaillé pour JavaScript moderne</p>
                <a href="https://javascript.info/" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium underline">Accéder au site</a>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
                <img src="data:image/jpeg;base64,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" alt="CSS-Tricks" class="mb-4 rounded-md w-full">
                <h3 class="text-xl font-semibold text-purple-600 mb-2">CSS-Tricks</h3>
                <p class="text-gray-600 mb-4">Références et tutoriels CSS</p>
                <a href="https://css-tricks.com/" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium underline">Accéder au site</a>
            </div>
        </div>
    </section>

    <section id="tools" class="mt-20">
        <h2 class="text-4xl font-bold text-purple-700 mb-6 text-center">Outils recommandés</h2>
        <div class="grid sm:grid-cols-1 mt-16  md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
                <img src="https://code.visualstudio.com/favicon.ico"  alt="Visual Studio Code"  class="mb-4 rounded-md w-full">
               
                <h3 class="text-xl font-semibold text-purple-600 mb-2">Visual Studio Code</h3>
                <p class="text-gray-600 mb-4">Un éditeur de code puissant et extensible</p>
                <a href="https://code.visualstudio.com/" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium underline">Accéder au site</a>
                
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
                <img src="data:image/png;base64,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" alt="Git" class="mb-4 rounded-md w-full">
              
                <h3 class="text-xl font-semibold text-purple-600 mb-2">Git</h3>
                <p class="text-gray-600 mb-4">Système de contrôle de version essentiel</p>
                    <a href="https://git-scm.com/" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium underline"">Accéder au site</a>
                
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
                <img src="https://seeklogo.com/images/D/dbeaver-logo-E07205C498-seeklogo.com.png" alt="DBeaver" class="mb-4 rounded-md w-full">
              
                <h3 class="text-xl font-semibold text-purple-600 mb-2">DBeaver</h3>
                <p class="text-gray-600 mb-4">Outil de gestion de bases de données</p>
                    <a href="https://www.dbeaver.io/" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium underline"">Accéder au site</a>
              
            </div>
        </div>
    </section>

    <section id="community" class="mt-20">
        <h2 class="text-4xl font-bold text-purple-700 mb-6 text-center ">Communautés et Forums</h2>
        <div class="grid sm:grid-cols-1 mt-16 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
                <img src="data:image/png;base64,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" alt="Stack Overflow" class="mb-4 rounded-md w-full">
                <h3 class="text-xl font-semibold text-purple-600 mb-2">Stack Overflow</h3>
                <p class="text-gray-600 mb-4">Poser et répondre à des questions techniques</p>
                <a href="https://stackoverflow.com/" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium underline">Accéder au site</a>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
                <img src="data:image/png;base64,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" alt="Discord" class="mb-4 rounded-md w-full">
                <h3 class="text-xl font-semibold text-purple-600 mb-2">Dev.to</h3>
                <p class="text-gray-600 mb-4">Plateforme pour les développeurs</p>
                <a href="https://dev.to/" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium underline">Accéder au site</a>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
                <img src="data:image/png;base64,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" alt="Discord" class="mb-4 rounded-md w-full">
                <h3 class="text-xl font-semibold text-purple-600 mb-2">Discord</h3>
                <p class="text-gray-600 mb-4">Rejoindre des communautés de développeurs</p>
                <a href="https://discord.com/" target="_blank" class="text-blue-600 hover:text-blue-800 font-medium underline">Accéder au site</a>
            </div>
        </div>
    </section>
</main>

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
<script>
    document.addEventListener("DOMContentLoaded", function () {
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
