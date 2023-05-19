<?php
session_start();
unset($_SESSION['id_usuario'], $_SESSION['nickname_usu']);

header("Location: ../index.php");

?>
