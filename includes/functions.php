<?php
// Função para verificar a senha
function verifyPassword($password, $encrypted_password) {
    return password_verify($password, $encrypted_password);
}
?>
