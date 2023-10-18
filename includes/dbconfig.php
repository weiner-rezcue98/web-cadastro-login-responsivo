<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "sua_basedados";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $database);

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
?>
