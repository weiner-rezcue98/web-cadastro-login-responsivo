<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $useremail = $_POST['useremail'];
    $userpassword = $_POST['userpassword'];

    // Verifique o login no banco de dados
    $stmt = $con->prepare("SELECT id, userpassword FROM usuarios WHERE useremail = ?");
    $stmt->bind_param("s", $useremail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $dbUserPassword);
        $stmt->fetch();

        if (password_verify($userpassword, $dbUserPassword)) {
            // Login bem-sucedido, redirecione para a página de perfil ou página inicial
            $_SESSION['user_id'] = $id;
            header('Location: dashboard.php'); // Substitua 'perfil.php' pela página desejada
            exit();
        } else {
            echo "Senha incorreta. <a href='auth-login-2.html'>Tente novamente</a>";
        }
    } else {
        echo "Usuário não encontrado. <a href='auth-login-2.html'>Tente novamente</a>";
    }

    $stmt->close();
} else {
    echo "Método inválido para processar o formulário.";
}
?>
