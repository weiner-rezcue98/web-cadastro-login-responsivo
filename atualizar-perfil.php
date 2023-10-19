<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $newUsername = $_POST['username'];

    $stmt = $con->prepare("UPDATE usuarios SET username = ? WHERE id = ?");
    $stmt->bind_param("si", $newUsername, $user_id);

    if ($stmt->execute()) {
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Erro ao atualizar o perfil: " . $stmt->error;
    }

    $stmt->close();
}
