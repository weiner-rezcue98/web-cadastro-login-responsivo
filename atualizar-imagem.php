<?php
session_start();
include 'config/config.php';

if (!isset($_SESSION['user_id'])) {
    exit('Você não tem permissão para acessar esta página.');
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];

    // Lidar com o upload da nova imagem
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $imageTempPath = $_FILES['image']['tmp_name'];
        $imageFileName = $_FILES['image']['name'];

        // Defina o caminho para salvar a nova imagem no servidor
        $imagePath = 'upload/profile-pic/' . $imageFileName;

        // Movendo a nova imagem para o caminho de destino
        if (move_uploaded_file($imageTempPath, $imagePath)) {
            // Atualize o nome da imagem no banco de dados
            $stmt = $con->prepare("UPDATE usuarios SET userimage = ? WHERE id = ?");
            $stmt->bind_param("si", $imageFileName, $user_id);

            if ($stmt->execute()) {
                exit('success');
            } else {
                exit('Erro ao atualizar a imagem de perfil: ' . $stmt->error);
            }

            $stmt->close();
        } else {
            exit('Erro ao fazer o upload da nova imagem.');
        }
    } else {
        exit('Nenhuma imagem foi fornecida. Por favor, selecione uma imagem para fazer o upload.');
    }
}
