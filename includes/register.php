<?php
require_once("db_config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $useremail = $_POST["useremail"];
    $userpassword = password_hash($_POST["userpassword"], PASSWORD_DEFAULT);

    // Use uma declaração preparada para verificar as credenciais do usuário
    $stmt = $conn->prepare("SELECT nome, senha FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $useremail);

    if ($stmt->execute()) {
        $stmt->store_result();
        
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($nome, $senha_hash);

            if ($stmt->fetch() && password_verify($userpassword, $senha_hash)) {
                // Autenticação bem-sucedida, redirecione para a página principal
                header("Location: index.html");
                exit;
            }
        }
    }

    // Autenticação falhou, redirecione para a página de login
    header("Location: auth-login-2.html");
    exit;
}

$conn->close();
?>
