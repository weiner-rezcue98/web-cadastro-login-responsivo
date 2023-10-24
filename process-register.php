<?php
session_start();
include 'config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $useremail = $_SESSION['useremail'];
    $usercpf = $_SESSION['usercpf'];
    $username = $_SESSION['username'];
    $userdob = $_SESSION['userdob'];
    $userpassword = password_hash($_POST['userpassword'], PASSWORD_DEFAULT);
    $usercourse = $_POST['usercourse']; // ID do curso selecionado

    // Processar o upload da imagem de perfil
    if (isset($_FILES['userimage']) && $_FILES['userimage']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'upload/profile-pic/'; // Substitua pelo caminho real no servidor
        $uploadFile = $uploadDir . basename($_FILES['userimage']['name']);

        if (move_uploaded_file($_FILES['userimage']['tmp_name'], $uploadFile)) {
            // O arquivo foi carregado com sucesso, e $uploadFile contém o caminho para a imagem no servidor.

            // Desabilitar o campo de upload de imagem
            echo "<script>document.getElementById('userimage').setAttribute('disabled', 'disabled');</script>";
            // Exibir uma mensagem ou fazer algo com id="imageUploadSuccess"
            echo "<script>document.getElementById('imageUploadSuccess').style.display = 'block';</script>";
        } else {
            echo "Erro ao fazer upload do arquivo de imagem.";
            exit();
        }
    } else {
        echo "Nenhum arquivo de imagem enviado ou erro no upload.";
        exit();
    }

    // Validar o reCAPTCHA aqui (adapte o código conforme necessário)

    // Verificar se o e-mail já existe no banco de dados
    $checkEmailQuery = $con->prepare("SELECT COUNT(*) FROM usuarios WHERE useremail = ?");
    $checkEmailQuery->bind_param("s", $useremail);
    $checkEmailQuery->execute();
    $checkEmailQuery->bind_result($count);
    $checkEmailQuery->fetch();
    $checkEmailQuery->close();

    if ($count > 0) {
        // O email já existe, redirecione o usuário ou mostre uma mensagem de erro
        header('Location: auth-register-2.html');
        exit();
    }

    // Salvar os dados no banco de dados, incluindo o caminho da imagem
    $stmt = $con->prepare("INSERT INTO usuarios (useremail, usercpf, username, userdob, userpassword, usercourse, userimage) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $useremail, $usercpf, $username, $userdob, $userpassword, $usercourse, $uploadFile);

    if ($stmt->execute()) {
        // Registro bem-sucedido, redirecione o usuário para a página de login
        header('Location: auth-login-2.html');
        exit();
    } else {
        if ($stmt->errno === 1062) {
            // O código 1062 indica uma chave duplicada, ou seja, o email já existe
            echo "O email já existe. Por favor, escolha outro email.";
        } else {
            echo "Erro ao cadastrar o usuário: " . $stmt->error;
        }
        $stmt->close();
    }
    $con->close();
}
?>
