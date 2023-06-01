<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/formulariofilme.css">
    <title>Alterar usuário</title>
</head>
<body>
    <?php
    require_once '../model/dao/UsuarioDAO.php';
    require_once '../model/dto/UsuarioDTO.php';

    $usuarioDAO = new UsuarioDAO();

    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $usuario = $usuarioDAO->recuperarPorID($id);

        if ($usuario != null) {
            echo '<pre>';
            print_r($usuario);
            echo '</pre>';
    ?>
            <h1>Alterar usuário</h1>
            <div class="borda">
                <form action="../control/control_alterar_usuario.php" method="post">
                    <input type="hidden" name="id_usuario" value="<?= $usuario->getId_usuario(); ?>">
                    Nome do usuário:
                    <input type="text" name="nome_usu" placeholder="Nome" value="<?= $usuario->getNome_usu(); ?>"> <br> <br>
                    Nickname:
                    <input type="text" name="nickname_usu" placeholder="Nickname" value="<?= $usuario->getNickname_usu(); ?>"><br><br>

                    <label for="genero_usu">Gênero:</label>
                    <select name="genero_usu" id="genero_usu">
                        <option value="Masculino" <?= ($usuario->getGenero_usu() == "Masculino") ? "selected" : ""; ?>>Masculino</option>
                        <option value="Feminino" <?= ($usuario->getGenero_usu() == "Feminino") ? "selected" : ""; ?>>Feminino</option>
                    </select>

                    Data de nascimento:
                    <input type="text" name="dt_de_nasci_usu" placeholder="00/00/0000" value="<?= $usuario->getDt_de_nasci_usu(); ?>"> <br><br>
                    Email:
                    <input type="email" name="email_usu" placeholder="Email" value="<?= $usuario->getEmail_usu(); ?>"><br><br>
                    Senha:
                    <input type="password" name="senha_usu" value="<?= $usuario->getSenha_usu(); ?>"><br><br>
                    
                    Foto:
                    <input type="text" name="foto_usu" placeholder="URL da foto" value="<?= $usuario->getFoto_usu(); ?>"><br><br>
                    Telefone:
                    <input type="text" name="telefone" placeholder="Telefone" value="<?= $usuario->getTelefone(); ?>"><br><br>
                    CPF/CNPJ:
                    <input type="text" name="cpf_cnpj" placeholder="CPF ou CNPJ" value="<?= $usuario->getCpf_cnpj(); ?>"><br><br>
                    Endereço:
                    <input type="text" name="endereco" placeholder="Endereço" value="<?= $usuario->getEndereco(); ?>"><br><br>
                    Número:
                    <input type="text" name="numero" placeholder="Número" value="<?= $usuario->getNumero(); ?>"><br><br>
                    Complemento:
                    <input type="text" name="complemento" placeholder="Complemento" value="<?= $usuario->getComplemento(); ?>"><br><br>
                    Cidade:
                    <input type="text" name="cidade" placeholder="Cidade" value="<?= $usuario->getCidade(); ?>"><br><br>
                    Estado:
                    <input type="text" name="estado" placeholder="Estado" value="<?= $usuario->getEstado(); ?>"><br><br>
                    CEP:
                    <input type="text" name="cep" placeholder="CEP" value="<?= $usuario->getCep(); ?>"><br><br>

                    <input type="submit" value="Alterar">
                </form>
            </div>
        <?php
        } else {
            echo "Usuário não encontrado.";
        }
    }
    ?>
</body>
</html>