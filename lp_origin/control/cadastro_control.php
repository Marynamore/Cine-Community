<?php

require_once __DIR__ . "/../model/dao/UsuarioDAO.php";
require_once __DIR__ . "/../model/dto/UsuarioDTO.php";

$nome_usu = filter_input(INPUT_POST, 'nome_usu');
$nickname_usu = filter_input(INPUT_POST, 'nickname_usu');
$dt_de_nasci_usu = filter_input(INPUT_POST, 'dt_de_nasci_usu');
$genero_usu = filter_input(INPUT_POST, 'genero_usu');
$email_usu = filter_input(INPUT_POST, 'email_usu');
$senha_usu = filter_input(INPUT_POST, 'senha_usu');
$telefone = filter_input(INPUT_POST, 'telefone');
$cpf_cnpj = filter_input(INPUT_POST, 'cpf_cnpj');
$endereco = filter_input(INPUT_POST, 'endereco');
$numero = filter_input(INPUT_POST, 'numero');
$complemento = filter_input(INPUT_POST, 'complemento');
$bairro = filter_input(INPUT_POST, 'bairro');
$cidade = filter_input(INPUT_POST, 'cidade');
$cep = filter_input(INPUT_POST, 'cep');
$uf = filter_input(INPUT_POST, 'uf');
$id_perfil = isset($_POST['fk_id_perfil']) ? $_POST['fk_id_perfil'] : null;
$foto_usu = $_FILES['foto_usu'];
// Verifica se o campo de upload de arquivo foi enviado e se não há erros
if ($foto_usu['error'] === UPLOAD_ERR_OK){
    $nome_arquivo = $foto_usu['name'];
    $caminho_temporario = $foto_usu['tmp_name'];
    $caminho_destino = '../assets/pessoas/' . $nome_arquivo;
    move_uploaded_file($caminho_temporario, $caminho_destino);


    $usuarioDTO = new UsuarioDTO();
    $usuarioDTO->setNome_usu($nome_usu);
    $usuarioDTO->setNickname_usu($nickname_usu);
    $usuarioDTO->setDt_de_nasci_usu($dt_de_nasci_usu);
    $usuarioDTO->setGenero_usu($genero_usu);
    $usuarioDTO->setEmail_usu($email_usu);
    $usuarioDTO->setTelefone($telefone);
    $usuarioDTO->setSenha_usu($senha_usu);
    $usuarioDTO->setCpf_cnpj($cpf_cnpj);
    $usuarioDTO->setEndereco($endereco);
    $usuarioDTO->setNumero($numero);
    $usuarioDTO->setComplemento($complemento);
    $usuarioDTO->setBairro($bairro);
    $usuarioDTO->setFoto_usu($nome_arquivo);
    $usuarioDTO->setCidade($cidade);
    $usuarioDTO->setCep($cep);
    $usuarioDTO->setUf($uf);
    $usuarioDTO->setFk_id_perfil($id_perfil);


    $usuarioDAO = new UsuarioDAO();
    $usuarioDAO->cadastrarUsuario($usuarioDTO);

    if ($usuarioDAO) {
        header("Location: ../view/login.php");
        exit;
    } else {
        header("Location: ../view/cadastro.php");
        exit;
    }
}
?>