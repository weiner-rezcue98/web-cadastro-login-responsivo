<?php
$host = 'localhost'; // Geralmente 'localhost'
$username = 'minhadb'; // Nome de usuário do banco de dados
$database = 'minhadb'; // Nome do banco de dados
$encrypted_password = ')is@yooFj[Rb!9-P';

$con = new mysqli($host, $username, $encrypted_password, $database); // Não armazene a senha aqui

if ($con->connect_error) {
    die("Erro na conexão com o banco de dados: " . $con->connect_error);
}

// Função para verificar a senha
function verifyPassword($password, $encrypted_password) {
    return password_verify($password, $encrypted_password);
}
?>
