<?php
session_start();
include 'config/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

$successMessage = "";
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $newUsername = $_POST['username'];

    // Lidar com o upload da imagem
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $imageTempPath = $_FILES['image']['tmp_name'];
        $imageFileName = uniqid() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        // Defina o caminho para salvar a imagem no servidor
        $imagePath = './upload/profile-pic/' . $imageFileName;

        // Movendo a imagem para o caminho de destino
        if (move_uploaded_file($imageTempPath, $imagePath)) {
            // Atualize o nome da imagem no banco de dados
            $stmt = $con->prepare("UPDATE usuarios SET username = ?, userimage = ? WHERE id = ?");
            $stmt->bind_param("ssi", $newUsername, $imagePath, $user_id);

            if ($stmt->execute()) {
                $successMessage = "Perfil atualizado com sucesso.";
            } else {
                $errorMessage = "Erro ao atualizar o perfil: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $errorMessage = "Erro ao fazer o upload da imagem.";
        }
    } else {
        // Caso o usuário não tenha feito upload de uma nova imagem, atualize apenas o nome de usuário
        $stmt = $con->prepare("UPDATE usuarios SET username = ? WHERE id = ?");
        $stmt->bind_param("si", $newUsername, $user_id);

        if ($stmt->execute()) {
            $successMessage = "Perfil atualizado com sucesso.";
        } else {
            $errorMessage = "Erro ao atualizar o perfil: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .message-box {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            max-width: 400px;
        }

        .success-icon {
            color: green;
            font-size: 48px;
        }

        .error-icon {
            color: red;
            font-size: 48px;
        }
    </style>
</head>
<body>
    <div class="message-box">
        <?php if (!empty($successMessage)) { ?>
            <div class="success-icon">✔</div>
            <div class="success-message"><?php echo $successMessage; ?></div>
        <?php } elseif (!empty($errorMessage)) { ?>
            <div class="error-icon">✖</div>
            <div class="error-message"><?php echo $errorMessage; ?></div>
        <?php } ?>

        <!-- Adicionar um botão para voltar à página anterior -->
        <button onclick="history.back()">Voltar</button>
    </div>
</body>
</html>
