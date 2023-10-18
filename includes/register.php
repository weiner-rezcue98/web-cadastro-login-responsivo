<?php
require_once("dbconfig.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $useremail = $_POST["useremail"];
    $userpassword = password_hash($_POST["userpassword"], PASSWORD_DEFAULT);

    // Tratamento do upload da imagem de perfil
    if (isset($_FILES['userImage'])) {
        $uploadDirectory = 'caminho/para/diretorio/de/imagens/';
        $fileName = $_FILES['userImage']['name'];
        $filePath = $uploadDirectory . $fileName;

        // Move o arquivo para o diretório de destino
        if (move_uploaded_file($_FILES['userImage']['tmp_name'], $filePath)) {
            // O arquivo foi enviado com sucesso
            // Agora, você pode armazenar o caminho do arquivo no banco de dados, associado ao usuário.
        } else {
            // O upload falhou, trate esse caso apropriadamente
        }
    }

    // Use uma declaração preparada para inserir um novo registro na tabela "usuarios"
    $stmt = $conn->prepare("INSERT INTO usuarios (email, senha, imagem_perfil) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $useremail, $userpassword, $filePath);

    if ($stmt->execute()) {
        // Registro bem-sucedido, você pode redirecionar o usuário para uma página de confirmação
        header("Location: registro_sucesso.html");
        exit;
    } else {
        // Erro na inserção do registro, você pode redirecionar o usuário para uma página de erro
        header("Location: registro_erro.html");
        exit;
    }
}

$conn->close();
?>
