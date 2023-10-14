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

    // Use declaração preparada para evitar SQL Injection
    $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $useremail, $userpassword);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Autenticação bem-sucedida, defina a variável de sessão
        session_start();
        $_SESSION['autenticado'] = true;

        // Redirecione para a página do painel
        header('Location: ../painel-user.php');
        exit();
    } else {
        // Autenticação falhou, redirecione de volta para a página de login
        header('Location: ../auth-login-2.html');
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
