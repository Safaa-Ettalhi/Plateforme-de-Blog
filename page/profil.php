<?php
require '../db.php';
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$message = '';
$user_id = $_SESSION['id'];

// Récupérer les informations actuelles de l'utilisateur
$stmt = $conn->prepare("SELECT nom_utilisateur, email FROM utilisateurs WHERE id = ?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($nom_utilisateur, $email);
$stmt->fetch();
$stmt->close();

// Mettre à jour les informations
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_info'])) {
        $nouveau_nom_utilisateur = trim($_POST['nom_utilisateur']);
        $nouveau_email = trim($_POST['email']);

        $stmt = $conn->prepare("SELECT id FROM utilisateurs WHERE (email = ? OR nom_utilisateur = ?) AND id != ?");
        $stmt->bind_param('ssi', $nouveau_email, $nouveau_nom_utilisateur, $user_id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $message = "<div class='text-red-500 p-3 mb-4 border border-red-300 bg-red-100 rounded'>L'email ou le nom d'utilisateur existe déjà.</div>";
        } else {
            $stmt = $conn->prepare("UPDATE utilisateurs SET nom_utilisateur = ?, email = ? WHERE id = ?");
            $stmt->bind_param('ssi', $nouveau_nom_utilisateur, $nouveau_email, $user_id);
            if ($stmt->execute()) {
                $message = "<div class='text-green-500 p-3 mb-4 border border-green-300 bg-green-100 rounded'>Profil mis à jour avec succès.</div>";
                $_SESSION['nom_utilisateur'] = $nouveau_nom_utilisateur;
                $_SESSION['email'] = $nouveau_email;
                echo "<script>window.location.href = '../page/article.php';</script>";
                exit();
            } else {
                $message = "<div class='text-red-500 p-3 mb-4 border border-red-300 bg-red-100 rounded'>Erreur lors de la mise à jour : " . $stmt->error . "</div>";
            }
        }
        $stmt->close();
    }

    if (isset($_POST['update_password'])) {
        $ancien_mot_de_passe = trim($_POST['ancien_mot_de_passe']);
        $nouveau_mot_de_passe = trim($_POST['nouveau_mot_de_passe']);

        $stmt = $conn->prepare("SELECT mot_de_passe_hash FROM utilisateurs WHERE id = ?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $stmt->bind_result($mot_de_passe_hash);
        $stmt->fetch();
        $stmt->close();

        if (password_verify($ancien_mot_de_passe, $mot_de_passe_hash)) {
            $nouveau_mot_de_passe_hash = password_hash($nouveau_mot_de_passe, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE utilisateurs SET mot_de_passe_hash = ? WHERE id = ?");
            $stmt->bind_param('si', $nouveau_mot_de_passe_hash, $user_id);
            if ($stmt->execute()) {
                $message = "<div class='text-green-500 p-3 mb-4 border border-green-300 bg-green-100 rounded'>Mot de passe mis à jour avec succès.</div>";
                echo "<script>window.location.href = '../page/article.php';</script>";
                exit();
            } else {
                $message = "<div class='text-red-500 p-3 mb-4 border border-red-300 bg-red-100 rounded'>Erreur lors de la mise à jour : " . $stmt->error . "</div>";
            }
        } else {
            $message = "<div class='text-red-500 p-3 mb-4 border border-red-300 bg-red-100 rounded'>L'ancien mot de passe est incorrect.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
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
<section>
    <div id="modal" class="max-w-3xl mx-auto py-12 px-6">
        <div class="w-full max-w-lg bg-white m-auto p-8 rounded-lg shadow-md relative ">
            <button id="closeModal" class="absolute top-4 right-4 text-gray-600 hover:text-gray-900">
                <i class="fas fa-times text-2xl"></i>
            </button>
            <h2 class="text-3xl font-bold text-center text-[#cb6ce6] mb-6">Gérer le Profil</h2>

            <?php if (!empty($message)): ?>
                <div class="mb-4"><?php echo $message; ?></div>
            <?php endif; ?>

            <form action="#" method="POST" class="mb-6">
                <h3 class="text-xl font-bold mt-16 mb-6 text-[#fbd8d5]">Modifier les informations</h3>

                <div class="mb-4">
                    <label class="block text-gray-600 font-medium">Nom d'utilisateur</label>
                    <input type="text" name="nom_utilisateur" value="<?php echo htmlspecialchars($nom_utilisateur); ?>" class="w-full px-4 py-2 border rounded-lg text-gray-500 focus:outline-none focus:ring-2 focus:ring-[#cb6ce6]" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-600 font-medium">Email</label>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none text-gray-500 focus:ring-2 focus:ring-[#cb6ce6]" required>
                </div>

                <button type="submit" name="update_info" class="w-full py-2 mb-10 bg-[#cb6ce6] text-white rounded-lg hover:bg-[#fbd8d5]">Mettre à jour</button>
            </form>

            <form action="#" method="POST">
                <h3 class="text-xl text-[#fbd8d5] font-bold mb-6">Changer le mot de passe</h3>

                <div class="mb-4">
                    <label class="block text-gray-600 font-medium">Ancien mot de passe</label>
                    <input type="password" name="ancien_mot_de_passe" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-600 font-medium">Nouveau mot de passe</label>
                    <input type="password" name="nouveau_mot_de_passe" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                </div>

                <button type="submit" name="update_password" class="w-full py-2 bg-[#cb6ce6] text-white rounded-lg hover:bg-[#fbd8d5]">Changer le mot de passe</button>
            </form>
        </div>
    </div>
    </section>
    <script>
        const closeModal = document.getElementById('closeModal');
        // const modal = document.getElementById('modal');

        closeModal.addEventListener('click', () => {
            window.location.href = '../page/article.php';
        });
    </script>
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
