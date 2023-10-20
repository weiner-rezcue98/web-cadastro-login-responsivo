<?php
// Substitua 'sua_senha' pela senha que você deseja criptografar
$password = 'minhadb';

// Gere um hash criptografado da senha
$encrypted_password = password_hash($password, PASSWORD_DEFAULT);
echo $encrypted_password;
?>
