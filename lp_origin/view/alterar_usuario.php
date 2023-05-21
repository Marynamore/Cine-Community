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
            var_dump($usuario);
            echo '</pre>';
    ?>
            <h1>Alterar usuário</h1>
            <div class="borda">
                <form action="../control/control_alterar_usuario.php" method="post">
                    <input type="hidden" name="id_usuario" value="<?= $usuario["id_usuario"]; ?>">
                    Nome do usuário:
                    <input type="text" name="nome_usu" placeholder="Nome" value="<?= $usuario["nome_usu"]; ?>"> <br> <br>
                    Nickname:
                    <input type="text" name="nickname_usu" placeholder="Nickname" value="<?= $usuario["nickname_usu"]; ?>"><br><br>

                    <label for="genero_usu">Gênero:</label>
                    <select name="genero_usu" id="genero_usu">
                        <option value="Masculino" <?= ($usuario["genero_usu"] == "Masculino") ? "selected" : ""; ?>>Masculino</option>
                        <option value="Feminino" <?= ($usuario["genero_usu"] == "Feminino") ? "selected" : ""; ?>>Feminino</option>
                    </select>

                    Data de nascimento:
                    <input type="text" name="dt_de_nasci_usu" placeholder="00/00/0000" value="<?= $usuario["dt_nasci_usu"]; ?>"> <br><br>
                    Email:
                    <input type="email" name="email_usu" placeholder="Email" value="<?= $usuario["email_usu"]; ?>"><br><br>
                    Senha:
                    <input type="password" name="senha_usu" value="<?= $usuario["senha_usu"]; ?>"><br><br>

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
