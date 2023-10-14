<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $useremail = $_POST['useremail'];
    $userpassword = $_POST['userpassword'];

    // Conexão com o banco de dados
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "sua_basedados";

    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Consulta SQL para verificar as credenciais do usuário
    $sql = "SELECT * FROM usuarios WHERE email = '$useremail' AND senha = '$userpassword'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Autenticação bem-sucedida, redireciona para a página principal
        header('Location: ../index.html');
        exit();
    } else {
        // Autenticação falhou, redireciona de volta para a página de login
        header('Location: ../auth-login-2.html');
        exit();
    }

    $conn->close();
}
?>
