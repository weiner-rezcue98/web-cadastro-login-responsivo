<?php
$host = 'localhost'; // Geralmente 'localhost'
$username = 'root'; // Nome de usuário do banco de dados
$password = ''; // Senha do banco de dados
$database = 'nome_do_seu_banco_de_dados'; // Nome do banco de dados

$con = new mysqli($host, $username, $password, $database);

if ($con->connect_error) {
    die("Erro na conexão com o banco de dados: " . $con->connect_error);
}
?>
