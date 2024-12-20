<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tutoriels </title>
  <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<body class="bg-gray-100 ">
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
  <div class="max-w-7xl mt-20 mx-auto px-4">
    <h1 class="text-3xl font-bold text-[#cb6ce6] mb-8 text-center">Tutoriels Full Stack</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Card 1 -->
      <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="relative group">
          <img 
            src="data:image/png;base64,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" 
            alt="Node.js Basics" 
            class="w-full h-48 object-cover cursor-pointer video-trigger" 
            data-video="https://www.youtube.com/embed/Oe421EPjeBE">
          <div class="absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 opacity-0 group-hover:opacity-100 transition">
            <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
              <path d="M8 5v14l11-7L8 5z"></path>
            </svg>
          </div>
        </div>
        <div class="p-4">
          <span class="text-sm font-semibold text-white bg-green-500 px-2 py-1 rounded">Node.js</span>
          <h3 class="text-lg font-bold text-gray-800 mt-2">Introduction à Node.js</h3>
          <p class="text-sm text-gray-600 mt-1">Durée: 12:30 min · Date: Jan 15, 2023</p>
          <button class="watch mt-4 text-green-500 font-medium hover:underline flex items-center">
            Watch <span class="ml-1">→</span>
          </button>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="relative group">
          <img 
            src="data:image/png;base64,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" 
            alt="React Hooks Explained" 
            class="w-full h-48 object-cover cursor-pointer video-trigger" 
            data-video="https://www.youtube.com/embed/dpw9EHDh2bM">
          <div class="absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 opacity-0 group-hover:opacity-100 transition">
            <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
              <path d="M8 5v14l11-7L8 5z"></path>
            </svg>
          </div>
        </div>
        <div class="p-4">
          <span class="text-sm font-semibold text-white bg-blue-500 px-2 py-1 rounded">React</span>
          <h3 class="text-lg font-bold text-gray-800 mt-2">Comprendre les Hooks React</h3>
          <p class="text-sm text-gray-600 mt-1">Durée: 15:00 min · Date: Feb 10, 2023</p>
          <button class="watch mt-4 text-blue-500 font-medium hover:underline flex items-center">
            Watch <span class="ml-1">→</span>
          </button>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="relative group">
          <img 
            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDlrm9TkTYvBiPDQ0zTkjB8ggVG6wo9ePULA&s" 
            alt="Building a Full Stack App" 
            class="w-full h-48 object-cover cursor-pointer video-trigger" 
            data-video="https://www.youtube.com/embed/Ke90Tje7VS0">
          <div class="absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 opacity-0 group-hover:opacity-100 transition">
            <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
              <path d="M8 5v14l11-7L8 5z"></path>
            </svg>
          </div>
        </div>
        <div class="p-4">
          <span class="text-sm font-semibold text-white bg-red-500 px-2 py-1 rounded">Full Stack</span>
          <h3 class="text-lg font-bold text-gray-800 mt-2">Créer une Application Full Stack</h3>
          <p class="text-sm text-gray-600 mt-1">Durée: 18:20 min · Date: Mar 5, 2023</p>
          <button class="watch mt-4 text-red-500 font-medium hover:underline flex items-center">
            Watch <span class="ml-1">→</span>
          </button>
        </div>
      </div>

      
      <!-- 4-->
      <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="relative group">
          <img 
            src="data:image/png;base64,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" 
            alt="Node.js Basics" 
            class="w-full h-48 object-cover cursor-pointer video-trigger" 
            data-video="https://www.youtube.com/embed/cDEVWbz2PpQ?si=jv5exlmKqbB5ueKP">
          <div class="absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 opacity-0 group-hover:opacity-100 transition">
          <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
              <path d="M8 5v14l11-7L8 5z"></path>
            </svg>
          </div>
        </div>
        <div class="p-4">
          <span class="text-sm font-semibold text-white bg-red-500 px-2 py-1 rounded">LARAVEL</span>
          <h3 class="text-lg font-bold text-gray-800 mt-2">Introduction à laravel</h3>
          <p class="text-sm text-gray-600 mt-1">Durée: 4:18:51 min · Date: Avr 26, 2022</p>
          <button class="watch mt-4 text-red-500 font-medium hover:underline flex items-center">
            Watch <span class="ml-1">→</span>
          </button>
        </div>
      </div>
      <!-- 5 -->
      <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="relative group">
          <img 
            src="data:image/png;base64,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" 
            alt="Node.js Basics" 
            class="w-full h-48 object-cover cursor-pointer video-trigger" 
            data-video="https://www.youtube.com/embed/DenUCuq4G04?si=7xRHrNTVFB7LGsKi">
          <div class="absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 opacity-0 group-hover:opacity-100 transition">
          <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
              <path d="M8 5v14l11-7L8 5z"></path>
            </svg>
          </div>
        </div>
        <div class="p-4">
          <span class="text-sm font-semibold text-white bg-red-500 px-2 py-1 rounded">Tailwind</span>
          <h3 class="text-lg font-bold text-gray-800 mt-2">Apprendre Tailwind Css</h3>
          <p class="text-sm text-gray-600 mt-1">Durée: 4:18:51 min · Date: Avr 26, 2022</p>
          <button class="watch mt-4 text-red-500 font-medium hover:underline flex items-center">
            Watch <span class="ml-1">→</span>
          </button>
        </div>
      </div>
      <!-- 6 -->
      <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="relative group">
          <img 
            src="data:image/png;base64,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" 
            alt="Node.js Basics" 
            class="w-full h-48 object-cover cursor-pointer video-trigger" 
            data-video="https://www.youtube.com/embed/Ew7KG2j8eII?si=VEs0KMXaxMuA_0i1">
          <div class="absolute inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 opacity-0 group-hover:opacity-100 transition">
          <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
              <path d="M8 5v14l11-7L8 5z"></path>
            </svg>
          </div>
        </div>
        <div class="p-4">
          <span class="text-sm font-semibold text-white bg-red-500 px-2 py-1 rounded">Javascript</span>
          <h3 class="text-lg font-bold text-gray-800 mt-2">Javascript de A à Z</h3>
          <p class="text-sm text-gray-600 mt-1">Durée: 1:16:48 min · Date: Jan 30, 2023</p>
          <button class="watch mt-4 text-red-500 font-medium hover:underline flex items-center">
            Watch <span class="ml-1">→</span>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Video -->
  <div id="video-modal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden">
    <div class="relative w-full max-w-4xl">
      <button id="close-modal" class="absolute top-0 right-0 mt-4 mr-4 text-white text-3xl">&times;</button>
      <iframe id="video-frame" class="w-full h-96" src="" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
    </div>
  </div>

  <script>
   
  console.log('safaa')
  document.querySelectorAll('.watch').forEach(button => {
  button.addEventListener('click', () => {
    
    const card = button.closest('.bg-white'); 
    const videoTrigger = card.querySelector('.video-trigger'); 
    const videoUrl = videoTrigger.getAttribute('data-video'); 


    if (videoUrl) {
      console.log('URL de la vidéo :', videoUrl);
      
      const modal = document.getElementById('video-modal');
      const frame = document.getElementById('video-frame');
      frame.src = videoUrl;
      modal.classList.remove('hidden');
    } else {
      console.error('Aucune URL vidéo trouvée.');
    }
  });
});
document.getElementById('close-modal').addEventListener('click', () => {
      const modal = document.getElementById('video-modal');
      const frame = document.getElementById('video-frame');
      frame.src = ''; 
      modal.classList.add('hidden'); 
    })
  </script>
  <footer class="bg-[#cb6ce6] mb-6 text-gray-200 py-10 rounded-lg mt-20">
    <div class="mx-20 flex flex justify-between">
        <div class="flex flex-col justify-between order-2 gap-1">
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
        <div class="text-center text-white text-sm">
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
