<?php
$db_host = "localhost"; // O endereço do servidor do banco de dados (geralmente "localhost" se estiver rodando localmente)
$db_user = "root"; // Nome de usuário do banco de dados
$db_password = ""; // Senha do banco de dados
$db_name = "sua_basedados"; // Nome do banco de dados

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
