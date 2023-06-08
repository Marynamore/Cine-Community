<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/stylecadastrar.css">
    <title>Alterar usuário</title>
</head>
<body>
    <?php
    require_once '../model/dao/UsuarioDAO.php';
    require_once '../model/dto/UsuarioDTO.php';

    $usuarioDAO = new UsuarioDAO();

    if (isset($_GET["id_usuario"])) {
        $id = $_GET["id_usuario"];
        $usuario = $usuarioDAO->recuperarPorID($id);

        if ($usuario != null) {
    ?>       
    <button onclick="javascript:history.go(-1)" class="botao">Voltar</button>
    <center>            
        <h1>Alterar usuário</h1>
        <form action="../control/control_alterar_usuario.php" method="post">
            <fieldset>
                <legend>Dados Pessoais</legend>

                <div class="inputBox">
                    <label for="imagem_perfil">Foto de Perfil:</label>
                    <input type="file" name="imagem_perfil" id="imagem_perfil">
                </div>
                <div class="inputBox">
                    <label for="nome_usu">Nome:</label>
                    <input placeholder="Nome" type="text" name="nome_usu" id="nome_usu" value="<?=$usuario->getNome_usu();?>" required>
                </div>

                <div class="inputBox">
                    <label for="nickname_usu">Nickname:</label>
                    <input placeholder="Nickname" type="text" name="nickname_usu" id="nickname_usu" value="<?=$usuario->getNickname_usu();?>" required>
                </div>

                <div class="inputBox">
                    <label for="dt_de_nasci_usu">Data de Nascimento:</label>
                    <input placeholder="Data de Nascimento" type="date" name="dt_de_nasci_usu" id="dt_de_nasci_usu" value="<?=$usuario->getDt_de_nasci_usu();?>" required>
                </div>

                <div class="inputBox">
                    <label for="genero_usu">Gênero:</label>
                    <select id="genero_usu" name="genero_usu">
                    <option value="---">Selecione</option>
                    <option value="masculino" <?= ($usuario->getGenero_usu() == 'masculino') ? 'selected' : ''; ?>>Masculino</option>
                    <option value="feminino" <?= ($usuario->getGenero_usu() == 'feminino') ? 'selected' : ''; ?>>Feminino</option>
                    <option value="naoBinario" <?= ($usuario->getGenero_usu() == 'naoBinario') ? 'selected' : ''; ?>>Não binário</option>
                    <option value="naoDeclarar" <?= ($usuario->getGenero_usu() == 'naoDeclarar') ? 'selected' : ''; ?>>Prefiro não declarar</option>
                    </select>
                </div>

                <div class="inputBox">
                    <label for="email_usu">Email:</label>
                    <input placeholder="Email" type="email" name="email_usu" id="email_usu" value="<?=$usuario->getEmail_usu();?>" value="<?=$usuario->getEmail_usu();?>" required>
                </div>

                <div class="inputBox">
                    <label for="senha_usu">Senha:</label>
                    <input placeholder="Senha" type="password" name="senha_usu" id="senha_usu" value="<?=$usuario->getSenha_usu();?>" required>
                </div>
            </fieldset>

            <!-- Address -->
            <fieldset>
                <legend>Endereço</legend>
                <div class="inputBox">
                    <label for="endereco">Endereço:</label>
                    <input placeholder="Endereço" type="text" name="endereco" id="endereco" value="<?=$usuario->getEndereco();?>" required>
                </div>

                <div class="inputBox">
                    <label for="numero">Número:</label>
                    <input placeholder="Número" type="text" name="numero" id="numero" value="<?=$usuario->getNumero();?>" required>
                </div>

                <div class="inputBox">
                    <label for="complemento">Complemento:</label>
                    <input placeholder="Complemento" type="text" name="complemento" id="complemento" value="<?=$usuario->getComplemento();?>" required>
                </div>

                <div class="inputBox">
                    <label for="bairro">Bairro:</label>
                    <input placeholder="Bairro" type="text" name="bairro" id="bairro" value="<?=$usuario->getBairro();?>" required>
                </div>

                <div class="inputBox">
                    <label for="cidade">Cidade:</label>
                    <input placeholder="Cidade" type="text" name="cidade" id="cidade" value="<?=$usuario->getCidade();?>" required>
                </div>

                <div class="inputBox">
                    <label for="cep">CEP:</label>
                    <input placeholder="CEP" type="text" name="cep" id="cep" value="<?=$usuario->getCep();?>" required>
                </div>

                <div class="inputBox">
                    <label for="uf">UF:</label>
                    <select id="uf" name="uf">
                        <option value="0">Selecione</option>
                        <option value="1">AC</option>
                        <option value="2">AL</option>
                        <option value="3">AP</option>
                        <option value="4">AM</option>
                        <option value="5">BA</option>
                        <option value="6">CE</option>
                        <option value="7">DF</option>
                        <option value="8">ES</option>
                        <option value="9">GO</option>
                        <option value="10">MA</option>
                        <option value="11">MT</option>
                        <option value="12">MS</option>
                        <option value="13">MG</option>
                        <option value="14">PA</option>
                        <option value="15">PB</option>
                        <option value="16">PR</option>
                        <option value="17">PE</option>
                        <option value="18">PI</option>
                        <option value="19">RJ</option>
                        <option value="20">RN</option>
                        <option value="21">RS</option>
                        <option value="22">RO</option>
                        <option value="23">RR</option>
                        <option value="24">SC</option>
                        <option value="25">SP</option>
                        <option value="26">SE</option>
                        <option value="27">TO</option>
                    </select>
                </div>
                <div>
                    <label for="fk_id_perfil">Selecione um perfil:</label>
                    <input type="radio" id="usuario" name="fk_id_perfil" value="4" value="<?=$usuario->getEmail_usu();?>" required>Usuário
                    <input type="radio" id="colecionador" name="fk_id_perfil" value="3" value="<?=$usuario->getEmail_usu();?>" required>Colecionador
                </div>
            </fieldset> 
            <br>
            <?php
                // Testa se é o administrador
                if ( isset( $_SESSION['fk_id_perfil'] ) && $_SESSION['fk_id_perfil'] == 1 ) {
                    // Se a chave existir e o valor for igual a 1
                    echo '';
                } else {
                    // Caso NÃO seja o administrador ou a chave não exista
                    echo '
                    <input type="hidden" name="fk_id_perfil" id="Usuario" value="4">
                    <input type="hidden" name="situacao_usu" value="Ativo">';
                }
            ?>
            <input type="submit" onclick="funCad()" value="Enviar" class="botao">
            <input type="reset"  value="Limpar" class="botao">
        </form>
    </center>
    
    <?php
    } else {
        echo "Usuário não encontrado.";
    }
    }
    ?>
</body>
</html>