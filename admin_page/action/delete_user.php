<?php
session_start();
// Vérification de l'accès
if (!isset($_SESSION['id']) || !isset($_SESSION['role_id']) || $_SESSION['role_id'] != 2) {
    header('Location: login.php');
    exit();
}
require '../../db.php';
if (!isset($_GET['id'])) {
    header('Location: ../users.php');
    exit();
}

$user_id = $_GET['id'];

$conn->query("DELETE FROM utilisateurs WHERE id = $user_id");
header('Location: ../users.php');
exit();
?>
