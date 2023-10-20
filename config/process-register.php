<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Processar os dados da segunda etapa do formulário
    $useremail = $_SESSION['useremail'];
    $usercpf = $_SESSION['usercpf'];
    $username = $_SESSION['username'];
    $userdob = $_SESSION['userdob'];
    $userpassword = password_hash($_POST['userpassword'], PASSWORD_DEFAULT);

    // Processar o upload da imagem de perfil
    if (isset($_FILES['userimage']) && $_FILES['userimage']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../upload/profile-pic/'; // Substitua pelo caminho real no servidor
        $uploadFile = $uploadDir . basename($_FILES['userimage']['name']);

        if (move_uploaded_file($_FILES['userimage']['tmp_name'], $uploadFile)) {
            // O arquivo foi carregado com sucesso, e $uploadFile contém o caminho para a imagem no servidor.
        } else {
            echo "Erro ao fazer upload do arquivo de imagem.";
            exit();
        }
    } else {
        echo "Nenhum arquivo de imagem enviado ou erro no upload.";
        exit();
    }

    // Validar o reCAPTCHA aqui (adapte o código conforme necessário)

    // Salvar os dados no banco de dados, incluindo o caminho da imagem
    $stmt = $con->prepare("INSERT INTO usuarios (useremail, usercpf, username, userdob, userimage, userpassword) VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssss", $useremail, $usercpf, $username, $userdob, $uploadFile, $userpassword);

    if ($stmt->execute()) {
        // Redirecionar para a página de sucesso ou login
        header('Location: ../auth-login-2.html');
        exit();
    } else {
        echo "Erro ao cadastrar o usuário: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Método inválido para processar o formulário.";
}
?>
