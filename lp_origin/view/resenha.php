<?php
session_start();

if(isset($_GET['get_id'])) {
    $get_id = $_GET['get_id'];
} else {
    $get_id = '';
    header('location:../index.php');
}


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/form_resenhastyle.css">
    <title>Resenha</title>
    <script>
       function funcResenha(){
            alert("Resenha adicionada com Sucesso!");    
        }
    </script>
</head>

<body>
    
    <center>
    <section class="container">
    <h1>RESENHA</h1>
    <form action="../control/resenha_control.php" method="post">
        <br>
        <h2>TITULO</h2>
        <input type="text" name="titulo_res" class="titulo">
        <div class="form">
            <textarea name="descricao_res" id="" cols="30" rows="10" placeholder="DEIXE AQUI SUA OPINIÃO"></textarea>
        </div>
        <input type="hidden" name="dt_hora_res" >
        <input type="hidden" name="fk_filme_id_filme" value="<?= $get_id;?>">
        <input type="hidden" name="fk_usuario_id_usuario" value="<?=$_SESSION['id_usuario'];?>">
        <input type="submit" onclick="funcResenha()" value="ENVIAR" class="button">
        <a href="filme_resenha.php?get_id=<?= $get_id; ?>" class="button">VOLTAR</a>
    </form>
    </section>
    </center>
   </body>

</html>

