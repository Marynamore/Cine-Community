<?php
session_start();
unset($_SESSION['id_usuario'], $_SESSION['nickname_usu']);
session_destroy();
header("Location: ../index.php");

?>