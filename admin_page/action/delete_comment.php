<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['role_id'] != 2) {
    header('Location: ../login.php');
    exit();
}

require '../../db.php';

if (isset($_GET['id'])) {
    $commentId = $_GET['id'];

    // Supprimer le commentaire
    $deleteQuery = "DELETE FROM commentaires WHERE id = $commentId";
    if ($conn->query($deleteQuery)) {
        header('Location: ../comments.php');
        exit();
    } else {
        die("Erreur lors de la suppression du commentaire.");
    }
} else {
    die("ID du commentaire manquant.");
}
?>
