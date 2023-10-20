<?php
session_start();
session_destroy(); // Encerra a sessão do usuário
header('Location: ../auth-login-2.html'); // Redireciona o usuário para a página de login
exit();
?>
