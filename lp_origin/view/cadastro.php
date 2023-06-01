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
    <button onclick="javascript:history.go(-1)" class="botao">Voltar</button>
    <center>
        <div class="container">
            <form id="contact" action="../control/cadastro_control.php" method="post">
                <h3>Cadastro</h3>

                <!-- Personal Data -->
                <fieldset>
                    <legend>Dados Pessoais</legend>

                    <div class="inputBox">
                        <label for="imagem_perfil">Foto de Perfil:</label>
                        <input type="file" name="imagem_perfil" id="imagem_perfil">
                    </div>
                    <div class="inputBox">
                        <label for="nome_usu">Nome:</label>
                        <input placeholder="Nome" type="text" name="nome_usu" id="nome_usu" required>
                    </div>

                    <div class="inputBox">
                        <label for="nickname_usu">Nickname:</label>
                        <input placeholder="Nickname" type="text" name="nickname_usu" id="nickname_usu" required>
                    </div>

                    <div class="inputBox">
                        <label for="dt_de_nasci_usu">Data de Nascimento:</label>
                        <input placeholder="Data de Nascimento" type="date" name="dt_de_nasci_usu" id="dt_de_nasci_usu" required>
                    </div>

                    <div class="inputBox">
                        <label for="genero_usu">Gênero:</label>
                        <input placeholder="Gênero" type="text" name="genero_usu" id="genero_usu" required>
                    </div>

                    <div class="inputBox">
                        <label for="email_usu">Email:</label>
                        <input placeholder="Email" type="email" name="email_usu" id="email_usu" required>
                    </div>

                    <div class="inputBox">
                        <label for="senha_usu">Senha:</label>
                        <input placeholder="Senha" type="password" name="senha_usu" id="senha_usu" required>
                    </div>
                </fieldset>

                <!-- Address -->
                <fieldset>
                    <legend>Endereço</legend>
                    <div class="inputBox">
                        <label for="endereco">Endereço:</label>
                        <input placeholder="Endereço" type="text" name="endereco" id="endereco" required>
                    </div>

                    <div class="inputBox">
                        <label for="numero">Número:</label>
                        <input placeholder="Número" type="text" name="numero" id="numero" required>
                    </div>

                    <div class="inputBox">
                        <label for="complemento">Complemento:</label>
                        <input placeholder="Complemento" type="text" name="complemento" id="complemento" required>
                    </div>

                    <div class="inputBox">
                        <label for="bairro">Bairro:</label>
                        <input placeholder="Bairro" type="text" name="bairro" id="bairro" required>
                    </div>

                    <div class="inputBox">
                        <label for="cidade">Cidade:</label>
                        <input placeholder="Cidade" type="text" name="cidade" id="cidade" required>
                    </div>

                    <div class="inputBox">
                        <label for="cep">CEP:</label>
                        <input placeholder="CEP" type="text" name="cep" id="cep" required>
                    </div>

                    <div class="inputBox">
                        <label for="uf">UF:</label>
                        <input placeholder="UF" type="text" name="uf" id="uf" required>
                    </div>



                    <div class="inputBox">
    <label for="perfil">Selecione um perfil:</label>
    <input type="radio" id="usuario" name="perfil" value="usuario" required>Usuário
                     <input type="radio" id="colecionador" name="perfil" value="colecionador" required>Colecionador
</div>

                </fieldset>

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
                <br>

                <input type="submit" onclick="funCad()" value="Enviar" class="botao">
                <input type="reset"  value="Limpar" class="botao">
            </form>
        </div>
    </center>
</body>

</html>