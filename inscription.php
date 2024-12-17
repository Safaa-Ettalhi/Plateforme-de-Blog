

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>

<body class="bg-cover bg-center bg-[url('/assets/bg.jpg')] py-16 py-12 flex justify-center items-center">

    <div class="w-full max-w-lg border-2 border-[#cb6ce6] bg-white/10 p-8 rounded-lg shadow-md">
        <h2 class="text-3xl font-bold text-center text-[#cb6ce6] mb-6">Créer un Compte</h2>

        <?php if (!empty($message)): ?>
            <div class="mb-4">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form action="#" method="POST">
            <!-- Nom -->
            <div class="mb-4">
                <label for="nom" class="block text-[#cb6ce6]  font-medium">Nom d'utilisateur</label>
                <input type="text" id="nom" name="nom_utilisateur" placeholder="Votre nom" class="w-full px-4 py-2 mt-2 border border-[#cb6ce6] bg-white/10 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cb6ce6]  " required>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-[#cb6ce6] font-medium">Email</label>
                <input type="email" id="email" name="email" placeholder="Votre email" class="w-full px-4 py-2 mt-2 border border-[#cb6ce6] bg-white/10 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cb6ce6]" required>
            </div>

            <!-- Mot de passe -->
            <div class="mb-4">
                <label for="password" class="block text-[#cb6ce6]  font-medium">Mot de passe</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Votre mot de passe" class="w-full px-4 py-2 mt-2 border border-[#cb6ce6] bg-white/10 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cb6ce6]" required>
            </div>
            
            <!-- Bouton de soumission -->
            <button type="submit" name='submit' class="w-full py-3 bg-[#cb6ce6] text-white font-semibold rounded-lg shadow-md hover:bg-[#fbd8d5] hover:text-[#cb6ce6] ">
                Créer un compte
            </button>

            <a href="login.php" class="block border-2 border-[#cb6ce6] text-center mt-4 py-3 text-[#cb6ce6] font-semibold rounded-lg hover:bg-[#fbd8d5] ">
                Login
            </a>
        </form>
    </div>

</body>
</html>
