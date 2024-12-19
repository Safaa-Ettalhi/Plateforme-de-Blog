<?php
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] != 2) {
    header('Location: login.php');
    exit();
}
require '../../db.php';
if (!isset($_GET['id'])) {
    header('Location: users.php');
    exit();
}
$user_id = $_GET['id'];
$result = $conn->query("SELECT utilisateurs.id, nom_utilisateur, email, role_id FROM utilisateurs WHERE id = $user_id");
$user = $result->fetch_assoc();
if (!$user) {
    echo "Utilisateur introuvable.";
    exit();
}
$roles_result = $conn->query("SELECT * FROM roles");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_role_id = $_POST['role_id'];
    $conn->query("UPDATE utilisateurs SET role_id = $new_role_id WHERE id = $user_id");
    header('Location: ../users.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Utilisateur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<body class="bg-gray-100 h-screen flex flex-col md:flex-row">


    <!-- Main Content -->
    <main class="w-full flex items-center justify-center h-screen bg-gray-100">
    <div class=" w-1/3 bg-white p-8 rounded-lg shadow-lg ">
        <h2 class="text-3xl font-bold text-[#cb6ce6] mb-6 text-center">Modifier l'utilisateur</h2>
        
        <form action="edit_user.php?id=<?php echo $user['id']; ?>" method="POST" class="space-y-6">
            <!-- Nom d'utilisateur -->
            <div>
                <label for="nom_utilisateur" class="block text-lg font-medium text-gray-700">Nom d'utilisateur:</label>
                <input type="text" id="nom_utilisateur" name="nom_utilisateur" value="<?php echo htmlspecialchars($user['nom_utilisateur']); ?>" 
                    disabled class="w-full p-3 mt-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cb6ce6] transition ease-in-out duration-300">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-lg font-medium text-gray-700">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" 
                    disabled class="w-full p-3 mt-2 bg-gray-100 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cb6ce6] transition ease-in-out duration-300">
            </div>

            <!-- Rôle -->
            <div>
                <label for="role_id" class="block text-lg font-medium text-gray-700">Rôle:</label>
                <select name="role_id" id="role_id" class="w-full p-3 mt-2 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#cb6ce6] transition ease-in-out duration-300">
                    <?php while ($role = $roles_result->fetch_assoc()): ?>
                        <option value="<?php echo $role['id']; ?>" <?php echo $role['id'] == $user['role_id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($role['nom_role']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Bouton de soumission -->
            <div class="mt-6" >
                <button type="submit" class="w-full bg-[#cb6ce6] text-white font-semibold py-3 rounded-lg hover:bg-[#fbd8d5] transition ease-in-out duration-200 mb-6">
                    Mettre à jour
                </button>
                <a href="../users.php" class=" font-bold text-[#e0a8a3] underline  ">Retour à la liste des utilisateurs </a>
            </div>
        </form>
    </div>
</main>


</body>
</html>
