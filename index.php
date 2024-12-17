<?php
include("db.php");
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
    <section class="relative bg-cover bg-center bg-[url('/assets/bg.jpg')] h-[96vh] mt-3 flex  rounded-2xl text-white">
        <div class="container mx-auto px-6 flex flex-col justify-between">
            <header class=" shadow-sm sticky top-0 z-50">
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

    <!-- Sidebar Modal -->

    <div id="sidebarModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 hidden">
        
        <div class="bg-white w-64 h-full shadow-lg flex flex-col justify-between">
            
            <div class="p-6 space-y-4">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800">Menu</h2>
                    <i class="ri-close-line text-2xl cursor-pointer" id="closeSidebar"></i>
                </div>
                <nav class="flex flex-col space-y-4 text-gray-800">
                    <a href="#">Home</a>
                    <a href="#">Blog</a>
                    <a href="#">Resources</a>
                    <a href="#">Tutorials</a>
                    <a href="#">Community</a>
                </nav>
            </div>

            <div class="p-6 space-y-2">
                <button class="w-full px-4 py-2 border border-black bg-white text-black rounded-lg hover:bg-black hover:text-white">
                    Log in
                </button>
                <button class="w-full px-4 py-2 bg-black text-white rounded-lg hover:bg-white hover:text-black hover:border hover:border-black">
                    Sign up
                </button>
            </div>
        </div>
    </div>




</body>

</html>