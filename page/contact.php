<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '../../vendor/autoload.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $destinataireEmail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $destinataireNom = htmlspecialchars($_POST['name']);
    $message = htmlspecialchars($_POST['message']);
    $subject= htmlspecialchars($_POST['subject']);
    if (!$destinataireEmail) {
        $error = 'Adresse e-mail invalide.';
    } else {
    
        $mail = new PHPMailer(true);

        try {

            // Configuration de l'email
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';            
            $mail->SMTPAuth = true;                   
            $mail->Username = 'safaeettalhi@gmail.com';    
            $mail->Password = 'rljrrkguhommedyh';          
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
            $mail->Port = 587;                         

            $mail->setFrom($destinataireEmail, $destinataireNom);
            $mail->addAddress('safaeettalhi@gmail.com', 'safaa');

            $mail->isHTML(true);
            $mail->Subject = 'Message de ' . $destinataireNom;
            $mail->Body = '
                <html>
                    <head>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                margin: 0;
                                padding: 0;
                                background-color: #f9f9f9;
                            }
                            .email-container {
                                width: 100%;
                                max-width: 600px;
                                margin: 0 auto;
                                background-color: #ffffff;
                                border-radius: 10px;
                                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                padding: 20px;
                            }
                            .email-header {
                               
                                padding: 10px;
                                border-radius: 5px;
                                color: #ffffff;
                                text-align: center;
                            }
                            .email-body {
                                padding: 20px;
                                font-size: 16px;
                                color: #333333;
                            }
                            h2 {
                                
                                color:#cb6ce6;
                            }
                        </style>
                    </head>
                    <body>
                        <div class="email-container">
                            <div class="email-header">
                                <h2>Message de ' . $destinataireNom . '</h2>
                            </div>
                            <div class="email-body">
                                <h2>Subject:</h2>
                                <p>' . $subject .'</p>
                                <h2>Message Contenu :</h2>
                                <p>' . $message. '</p>
                            </div>
                            
                        </div>
                    </body>
                </html>
            ';
            $mail->AltBody = '' . $message;

            $mail->send();
            $success = 'Message envoyé avec succès !';
        } catch (Exception $e) {
            $error = "Erreur lors de l'envoi : {$mail->ErrorInfo}";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contactez-nous</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/x-icon" href="../assets/favicon.svg">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 text-gray-800">
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
    <div class="max-w-3xl mx-auto py-12 px-6">
        <h1 class="text-4xl font-extrabold text-center text-[#cb6ce6] mb-8">Contactez-nous</h1>

        <div class="bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-center text-[#cb6ce6] mb-6">Formulaire de Contact</h2>

            <?php if ($success): ?>
                <div class="bg-green-200 text-green-800 p-4 rounded-lg mb-4"><?php echo $success; ?></div>
            <?php elseif ($error): ?>
                <div class="bg-red-200 text-red-800 p-4 rounded-lg mb-4"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="contact.php">
                <div class="mb-4">
                    <label for="name" class="block text-lg font-semibold text-[#cb6ce6] mb-2">Votre nom</label>
                    <input type="text" id="name" name="name" required class="w-full px-4 py-2 border-2 border-[#cb6ce6] rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-600 placeholder-gray-400" placeholder="Entrez votre nom">
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-lg font-semibold text-[#cb6ce6] mb-2">Votre email</label>
                    <input type="email" id="email" name="email" required class="w-full px-4 py-2 border-2 border-[#cb6ce6] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cb6ce6] placeholder-gray-400" placeholder="Entrez votre email">
                </div>

                <div class="mb-4">
                    <label for="subject" class="block text-lg font-semibold text-[#cb6ce6] mb-2">Sujet</label>
                    <input type="text" id="subject" name="subject" required class="w-full px-4 py-2 border-2 border-[#cb6ce6] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cb6ce6] placeholder-gray-400" placeholder="Entrez le sujet du message">
                </div>

                <div class="mb-6">
                    <label for="message" class="block text-lg font-semibold text-[#cb6ce6] mb-2">Message</label>
                    <textarea id="message" name="message" rows="6" required class="w-full px-4 py-2 border-2 border-[#cb6ce6] rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cb6ce6] placeholder-gray-400" placeholder="Écrivez votre message"></textarea>
                </div>

                <button type="submit" name="submit" class="w-full py-3 bg-[#cb6ce6] text-white font-semibold rounded-lg hover:bg-purple-700 transition duration-300">
                    Envoyer le message
                </button>
            </form>
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
