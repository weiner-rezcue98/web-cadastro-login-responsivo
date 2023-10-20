<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../dashboard.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $newUsername = $_POST['username'];

    // Lidar com o upload da imagem
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $imageTempPath = $_FILES['image']['tmp_name'];
        $imageFileName = $_FILES['image']['name'];

        // Defina o caminho para salvar a imagem no servidor
        $imagePath = '../upload/profile-pic/' . $imageFileName;

        // Movendo a imagem para o caminho de destino
        if (move_uploaded_file($imageTempPath, $imagePath)) {
            // Atualize o nome da imagem no banco de dados
            $stmt = $con->prepare("UPDATE usuarios SET username = ?, userimage = ? WHERE id = ?");
            $stmt->bind_param("ssi", $newUsername, $imageFileName, $user_id);

            if ($stmt->execute()) {
                header('Location: ../dashboard.php');
                exit();
            } else {
                echo "Erro ao atualizar o perfil: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Erro ao fazer o upload da imagem.";
        }
    } else {
        // Caso o usuário não tenha feito upload de uma nova imagem, atualize apenas o nome de usuário
        $stmt = $con->prepare("UPDATE usuarios SET username = ? WHERE id = ?");
        $stmt->bind_param("si", $newUsername, $user_id);

        if ($stmt->execute()) {
            header('Location: ../dashboard.php');
            exit();
        } else {
            echo "Erro ao atualizar o perfil: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>
