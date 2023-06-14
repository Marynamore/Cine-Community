<?php
session_start();
if (isset($_SESSION["id_usuario"])) {
    $usuarioLogado = $_SESSION["nickname_usu"];
    $id_usuarioLogado = $_SESSION["id_usuario"];
    $id_perfil = $_SESSION["id_perfil"];
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
                        <label for="foto_usu">Foto de Perfil:</label>
                        <input type="file" name="foto_usu" id="foto_usu">
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
                        <select id="genero_usu" name="genero_usu">
                            <option value="---">Selecione</option>
                            <option value="masculino">Masculino</option>
                            <option value="feminino">Feminino</option>
                            <option value="naoBinario">Não binário</option>
                            <option value="naoDeclarar">Prefiro não declarar</option>
                        </select>
                    </div>

                    <div class="inputBox">
                        <label for="email_usu">Email:</label>
                        <input placeholder="Email" type="email" name="email_usu" id="email_usu" required>
                    </div>

                    <div class="inputBox">
                        <label for="senha_usu">Senha:</label>
                        <input placeholder="Senha" type="password" name="senha_usu" id="senha_usu" required>
                    </div>

                    <div class="inputBox">
                        <label for="telefone">Telefone:</label>
                        <input placeholder="telefone" type="text" name="telefone" id="telefone" required>
                    </div>

                    <div class="inputBox">
                        <label for="cpf_cnpj">Cpf/cnpj:</label>
                        <input placeholder="Cpf/cnpj" type="text" name="cpf_cnpj" id="cpf_cnpj" required>
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
                    <div class="inputBox">
                        <label for="fk_id_perfil">Selecione um perfil:</label>
                        <?php
                        if (isset($_SESSION['id_perfil']) && $_SESSION['id_perfil'] == 1) {
                            echo '
                         <select id="fk_id_perfil" name="fk_id_perfil" required>
                         <option value="1">Administrador</option>
                         <option value="2">Moderador</option>
                         <option value="3">Colecionador</option>
                         <option value="4">Usuário</option>
                         </select>';
                        } else if (isset($_SESSION['id_perfil']) && $_SESSION['id_perfil'] == 2) {
                            echo '
                         <select id="fk_id_perfil" name="fk_id_perfil" required>
                         <option value="3">Colecionador</option>
                         <option value="4">Usuário</option>
                         <option value="2">Moderador</option>
                         </select>';
                        } else {
                            echo '
                         <select id="fk_id_perfil" name="fk_id_perfil" required>
                         <option value="3">Colecionador</option>
                         <option value="4">Usuário</option>
                         </select>';
                        }
                        ?>
                    </div>
                </fieldset>
                <br>

                <input type="submit" onclick="funCad()" value="Enviar" class="botao">
                <input type="reset" value="Limpar" class="botao">
            </form>
        </div>
    </center>
</body>

</html>