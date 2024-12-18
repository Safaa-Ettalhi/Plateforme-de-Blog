<?php
session_start();
// Vérification de l'accès administrateur
if (!isset($_SESSION['id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] != 2) {
    header('Location: ../../login.php');
    exit();
}

// Connexion à la base de données
require '../../db.php';

// Vérifier si l'ID de l'article est passé dans l'URL
if (isset($_GET['id'])) {
    $article_id = (int) $_GET['id'];

    // Vérifier si l'article existe avant de tenter la suppression
    $check_article = $conn->query("SELECT * FROM articles WHERE id = $article_id");

    if ($check_article->num_rows == 0) {
        echo "L'article n'existe pas dans la base de données.";
        exit();
    }

    // Supprimer les tags associés à l'article
    $conn->query("DELETE FROM article_tags WHERE article_id = $article_id");
    if ($conn->errno) {
        echo "Erreur de suppression des tags : " . $conn->error;
        exit();
    }

    // Supprimer l'article
    $conn->query("DELETE FROM articles WHERE id = $article_id");
    if ($conn->errno) {
        echo "Erreur de suppression de l'article : " . $conn->error;
        exit();
    }

    // Rediriger vers la liste des articles après suppression
    header("Location: ../articles.php");
    exit();
} else {
    echo "ID de l'article manquant.";
    exit();
}
?>
