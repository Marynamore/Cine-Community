<?php
session_start();
if (isset($_SESSION["id_usuario"])) {
    $usuarioLogado = $_SESSION["nickname_usu"];
    $id_usuarioLogado = $_SESSION["id_usuario"];
    $id_perfil = $_SESSION["fk_id_perfil"];
} else {
    $usuarioLogado = "";
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon_io/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="stylesheet" href="../css/stylecadastrar.css">
    <title>Cadastrar</title>
    <script>
        function funCad() {
            alert("Seu Cadastro foi concluído com sucesso.");
        }
    </script>
</head>

<body>
    <center>
        <div class="container">
            <form id="contact" action="../control/cadastro_control.php" method="post">
                <h3>Cadastro</h3>
                <input placeholder="Nome" type="text" name="nome_usu" id=""><br>

                <input placeholder="Nickname" type="text" name="nickname_usu" id=""><br>

                <input placeholder="Data de Nascimento" type="date" name="dt_de_nasci_usu" id=""><br>

                <input placeholder="Gênero" type="text" name="genero_usu" id=""><br>

                <input placeholder="Email" type="email" name="email_usu" id=""><br>

                <input placeholder="Senha" type="password" name="senha_usu" id=""><br>

                <input placeholder="Situação" type="text" name="situacao_usu" id=""><br>

                <input placeholder="Foto" type="file" name="foto_usu" id=""><br>

                <input placeholder="Telefone" type="tel" name="telefone" id=""><br>

                <input placeholder="CPF/CNPJ" type="text" name="cpf_cnpj" id=""><br>

                <input placeholder="Endereço" type="text" name="endereco" id=""><br>

                <input placeholder="Número" type="text" name="numero" id=""><br>

                <input placeholder="Complemento" type="text" name="complemento" id=""><br>

                <input placeholder="Bairro" type="text" name="bairro" id=""><br>

                <input placeholder="Cidade" type="text" name="cidade" id=""><br>

                <input placeholder="CEP" type="text" name="cep" id=""><br>

                <input placeholder="UF" type="text" name="uf" id=""><br>

                <?php
                // Testa se é o administrador
                if (isset($_SESSION['fk_id_perfil']) && $_SESSION['fk_id_perfil'] == 1) {
                    // Se a chave existir e o valor for igual a 1
                    echo '
                        <div class="inputBox">
                            <select id="id_perfil" class="inputUser" name="id_perfil">
                                <option value="" selected>Selecione um perfil</option>
                                <option value="1">Administrador</option>
                                <option value="2">Moderador</option>
                                <option value="3">Colecionador</option>
                                <option value="4">Usuário</option>
                            </select>
                            <label for="id_usuario" class="labelInput">Perfil do Usuário:</label>
                        </div><br><br>
                        <div class="inputBox">
                            <select id="situacao_usu" class="inputUser" name="situacao_usu">
                                <option value="Ativo" selected>Ativo</option>
                                <option value="Inativo">Inativo</option>
                                <option value="Bloqueado">Bloqueado</option>
                            </select>
                            <label for="situacao_usu" class="labelInput">Situação do Usuário:</label>
                        </div><br><br>';
                } else {
                    // Caso NÃO seja o administrador ou a chave não exista
                    echo '
                        <input type="hidden" name="fk_id_perfil" id="Usuario" value="4">
                        <input type="hidden" name="situacao_usu" value="Ativo">';
                }
                
                ?>
                <input type="submit" onclick="funCad()" value="Enviar" class="botao">
                <input type="reset" onclick="funCad()" value="Limpar" class="botao">
            </form>
            <button onclick="javascript:history.go(-1)" class="botao">Voltar</button>
        </div>
    </center>

</body>

</html>
