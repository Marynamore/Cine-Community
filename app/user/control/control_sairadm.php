<?php
session_start();
if($_SESSION['perfil_usu'] == "administrador"){
unset($_SESSION['id_usuario']);
}
header("Location: ../index.php");

?>