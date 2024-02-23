<?php
require_once '../model/dao/UsuarioDAO.php';
require_once '../model/dto/UsuarioDTO.php';

$email_usu = trim( filter_input( INPUT_POST, 'email_usu', FILTER_VALIDATE_EMAIL ) );

$usuarioDTO = new UsuarioDTO();
$usuarioDTO->setEmail_usu( $email_usu );

$usuarioDAO    = new UsuarioDAO();
$chave = $usuarioDAO->geraChaveAcesso( $usuarioDTO );

if ($chave) {
    echo "<a href ='http://localhost/Cine-Community/lp_origin/view/nova_senha.php?chave=".$chave."'>http://localhost/Cine-Community/lp_origin/view/nova_senha.php?chave=".$chave."</a>";
}else {
    echo "Usuário não encontrado.";
}