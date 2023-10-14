<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "sua_basedados";

$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
