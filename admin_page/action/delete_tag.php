<?php
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] != 2) {
    header('Location: login.php');
    exit();
}
require '../../db.php';
if (isset($_GET['id'])) {
    $tag_id = $_GET['id'];
    $delete_query = "DELETE FROM tags WHERE id = ?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("i", $tag_id);

    if ($delete_stmt->execute()) {
        header("Location: ../tags.php"); 
        exit();
    } else {
        echo "Erreur lors de la suppression du tag!";
    }
} else {
    echo "ID de tag manquant!";
}
?>
