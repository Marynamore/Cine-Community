<?php
require_once "../model/dto/UsuarioDTO.php";
require_once "../model/dao/UsuarioDAO.php";

// Recebendo os dados do formulário
$id_usuario = filter_input(INPUT_POST, 'id_usuario');
$nome_usu = filter_input(INPUT_POST, 'nome_usu');
$nickname_usu = filter_input(INPUT_POST, 'nickname_usu');
$genero_usu = filter_input(INPUT_POST, 'genero_usu');
$dt_de_nasci_usu = filter_input(INPUT_POST, 'dt_de_nasci_usu');
$foto_usu = filter_input(INPUT_POST , 'foto_usu');
$telefone = filter_input(INPUT_POST , 'telefone');
$cpf_cnpj = filter_input(INPUT_POST , 'cpf_cnpj');
$endereco = filter_input(INPUT_POST , 'endereco');
$numero = filter_input(INPUT_POST , 'numero');
$complemento = filter_input(INPUT_POST, 'complemento');
$bairro = filter_input(INPUT_POST, 'bairro');
$cidade = filter_input(INPUT_POST , 'cidade');
$cep = filter_input(INPUT_POST, 'cep');
$uf = filter_input(INPUT_POST , 'uf');
$email_usu = filter_input(INPUT_POST, 'email_usu', FILTER_VALIDATE_EMAIL);
$senha_usu = md5(filter_input(INPUT_POST, 'senha_usu'));

// Criando um objeto UsuarioDTO e definindo os valores dos atributos
$UsuarioDTO = new UsuarioDTO();
$UsuarioDTO->setId_usuario($id_usuario);
$UsuarioDTO->setNome_usu($nome_usu);
$UsuarioDTO->setNickname_usu($nickname_usu);
$UsuarioDTO->setGenero_usu($genero_usu);
$UsuarioDTO->setDt_de_nasci_usu($dt_de_nasci_usu);
$UsuarioDTO->setTelefone($telefone);
$UsuarioDTO->setCpf_cnpj($cpf_cnpj);
$UsuarioDTO->setEndereco($endereco);
$UsuarioDTO->setNumero($numero);
$UsuarioDTO->setComplemento($complemento);
$UsuarioDTO->setBairro($bairro);
$UsuarioDTO->setCidade($cidade);
$UsuarioDTO->setCep($cep);
$UsuarioDTO->setUf($uf);
$UsuarioDTO->setEmail_usu($email_usu);
$UsuarioDTO->setSenha_usu($senha_usu);

// Criando um objeto UsuarioDAO e chamando o método para alterar o usuário
$UsuarioDAO = new UsuarioDAO();
$sucesso = $UsuarioDAO->alterarUsuario($UsuarioDTO);

// Redirecionando para a página de perfil com uma mensagem de sucesso ou erro
if ($sucesso) {
    $msg = "Usuário alterado com sucesso!";
} else {
    $msg = "Erro ao Alterar o Usuário";
}

header("location:../view/adm/listausuarioadm.php?msg=" . urlencode($msg));
exit;
