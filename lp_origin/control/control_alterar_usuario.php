<?php
session_start();
require_once "../model/dto/UsuarioDTO.php";
require_once "../model/dao/UsuarioDAO.php";

if (isset($_SESSION['id_perfil']) && ($_SESSION['id_perfil'] == 1 || $_SESSION['id_perfil'] == 2 || $_SESSION['id_perfil'] == 3 || $_SESSION['id_perfil'] == 4)) {

    // Recebendo os dados do formulário
    $id_usuario = filter_input(INPUT_POST, 'id_usuario');
    $nome_usu = filter_input(INPUT_POST, 'nome_usu');
    $nickname_usu = filter_input(INPUT_POST, 'nickname_usu');
    $genero_usu = filter_input(INPUT_POST, 'genero_usu');
    $dt_de_nasci_usu = filter_input(INPUT_POST, 'dt_de_nasci_usu');
    $foto_usu = filter_input(INPUT_POST, 'foto_usu');
    $telefone = filter_input(INPUT_POST, 'telefone');
    $cpf_cnpj = filter_input(INPUT_POST, 'cpf_cnpj');
    $endereco = filter_input(INPUT_POST, 'endereco');
    $numero = filter_input(INPUT_POST, 'numero');
    $complemento = filter_input(INPUT_POST, 'complemento');
    $bairro = filter_input(INPUT_POST, 'bairro');
    $cidade = filter_input(INPUT_POST, 'cidade');
    $cep = filter_input(INPUT_POST, 'cep');
    $uf = filter_input(INPUT_POST, 'uf');
    $email_usu = filter_input(INPUT_POST, 'email_usu', FILTER_VALIDATE_EMAIL);
    $senha_usu = filter_input(INPUT_POST, 'senha_usu');

    $id_perfil = isset($_POST['fk_id_perfil']) ? $_POST['fk_id_perfil'] : null;

    // Alterar o valor do perfil se for "Colecionador 3" ou "Usuário 4"
    if ($id_perfil == 3) {
        $id_perfil = 4;
    } elseif ($id_perfil == 4) {
        $id_perfil = 3;
    }
    
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
    $UsuarioDTO->setFk_id_perfil($id_perfil);
    
    // Criando um objeto UsuarioDAO e chamando o método para alterar o usuário
    $UsuarioDAO = new UsuarioDAO();
    $success = $UsuarioDAO->alterarUsuario($UsuarioDTO);

    // Verificar se o usuário é administrador, moderador, colecionador ou usuário comum
    if ($success) {
        $msg = "Usuário alterado com sucesso!";
    } else {
        $msg = "Erro ao alterar o usuário";
    }


    // Exibir saída específica para cada perfil
    if ($_SESSION['id_perfil'] == 1) {
        header("Location: ../view/dashboard/painel_adm.php?msg=" . urlencode($msg));
    } elseif ($_SESSION['id_perfil'] == 2) {
        header("Location: ../view/dashboard/painel_moderador.php?msg=" . urlencode($msg));
    } elseif ($_SESSION['id_perfil'] == 3) {
        header("Location: ../view/dashboard/painel_colecionador.php?msg=" . urlencode($msg));
    } elseif ($_SESSION['id_perfil'] == 4) {
        header("Location: ../index.php?msg=" . urlencode($msg));
    }
} else {
    // Redirecionar para a página do administrador com mensagem de erro
    header("location:../view/dashboard/listausuarioadm.php?msg=" . urlencode("Erro ao alterar o usuário"));
}
?>
