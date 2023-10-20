<?php
session_start();
// Processar os dados da primeira etapa do formulário e armazenar em uma sessão
$_SESSION['useremail'] = $_POST['useremail'];
$_SESSION['usercpf'] = $_POST['usercpf'];
$_SESSION['username'] = $_POST['username'];
$_SESSION['userdob'] = $_POST['userdob'];

// Redirecionar para a segunda etapa do formulário
header('Location: ../auth-register-3.html');
?>
