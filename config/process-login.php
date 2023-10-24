<?php
session_start();
include 'config.php';

// Função para consultar o CEP
function consultarCEP($cep) {
    $cep = preg_replace("/[^0-9]/", "", $cep); // Remova caracteres não numéricos do CEP

    // Verifique se o CEP tem o tamanho correto (8 dígitos)
    if (strlen($cep) != 8) {
        return false;
    }

    // Consulte um serviço de CEP (substitua a URL pelo serviço de sua escolha)
    $url = "https://exemplo.com/sua-api-de-consulta-de-cep/$cep"; // Substitua pela URL correta

    $response = file_get_contents($url);

    if ($response === false) {
        return false;
    }

    $data = json_decode($response, true);

    if (isset($data['cidade']) && isset($data['estado'])) {
        return $data;
    } else {
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $useremail = $_POST['useremail'];
    $userpassword = $_POST['userpassword'];

    // Consulta do CEP (adicione essa parte após a obtenção dos dados do usuário, mas antes do redirecionamento)
    $cep = $_POST['cep']; // Obtenha o CEP do formulário

    $cepData = consultarCEP($cep);
    if ($cepData) {
        // Você pode usar $cepData['cidade'] e $cepData['estado'] para obter a cidade e o estado
        $cidade = $cepData['cidade'];
        $estado = $cepData['estado'];

        // Agora você pode incluir a cidade e o estado nas informações do usuário, por exemplo:
        // UPDATE usuarios SET cidade = '$cidade', estado = '$estado' WHERE id = $id;
    }

    // Verifique o login no banco de dados
    $stmt = $con->prepare("SELECT id, userpassword, usercourse FROM usuarios WHERE useremail = ?");
    $stmt->bind_param("s", $useremail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $dbUserPassword, $usercourse);
        $stmt->fetch();

        if (password_verify($userpassword, $dbUserPassword)) {
            // Login bem-sucedido, redirecione para a página do curso correto
            $_SESSION['user_id'] = $id;
            $_SESSION['usercourse'] = $usercourse;

            // Adicione esta linha para marcar o primeiro login
            $_SESSION['first_login'] = true;

            if ($usercourse == 1) {
                header('Location: ../logica-de-programacao.php');
            } elseif ($usercourse == 2) {
                header('Location: ../matematica.php');
            } else {
                header('Location: ../nao-encontrado.php');
            }
            exit();
        } else {
            echo "Senha incorreta. <a href='../auth-login-2.html'>Tente novamente</a>";
        }
    } else {
        echo "Usuário não encontrado. <a href='../auth-login-2.html'>Tente novamente</a>";
    }

    $stmt->close();
} else {
    echo "Método inválido para processar o formulário.";
}
?>
