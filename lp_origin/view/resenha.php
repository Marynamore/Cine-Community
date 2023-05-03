<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form_resenhastyle.css">
    <title>Resenha</title>
</head>

<body>
    <center>
    <p>Resenha</p>
    <form action="../control/resenha_control.php" method="post">
        <div class="form">
            <input type="text" name="titulo_res" id="">
            <textarea name="descricao_res" id="" cols="30" rows="10"></textarea>
        </div>
        <input type="submit" value="enviar" name='submit'>
        <a href="filme_resenha.php?id_filme=<?= $id_filme; ?>">Voltar</a>
    </form>
    </center>
   </body>

</html>
