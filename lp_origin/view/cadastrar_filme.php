<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/formulariofilme.css">
    <title>Cadastrar filme</title>
    
</head>
<body>
    <h1>Cadastrar filme</h1>
    <div class="borda">
        <form  action="../control/control_filme.php" method="post" enctype="multipart/form-data">
            Poster do filme
            <input type="file" name="capa_filme" ><br><br>    
            Nome do filme:
            <input type="text"  name="nome_filme" placeholder="Filme"> <br>  <br>
            Data de lançamento: 
            <input type="date"  name="dt_de_lancamento_filme" placeholder="Data de lançamento" value="<?= date('Y-m-d');?>"><br><br>

            <label for="cars">Categoria:</label>
            <select name="fk_categoria_filme_id_categoria_filme" id="cars">
            <option value="1">Infantil</option>
            <option value="2">Romance</option>
            <option value="3">Ação</option>
            <option value="4">Ficção</option>
            <option value="5">Terror</option>
            <option value="6">Comédia</option>
            <option value="7">Drama</option>
            <option value="8">Faroeste</option>
            <option value="9">Suspense</option>
            </select>

            Duração: <input type="time" name="duracao_filme" placeholder="Duração" value="<?= date('H:i:s');?>"> <br><br>
            Classificação indicativa: <input type="numb" name="classificacao_filme" placeholder="Classificação"><br><br>     Disponível em : <input type="text" name="fk_canal_filme_id_canal_filme"><br><br>     Sinopse:<textarea name="sinopse_filme" id="" cols="30" rows="10" placeholder="Sinopse" ></textarea><br>
            <input type="hidden" name="fk_usuario_id_usuario" value="<?= $id_usuario;?>">
            <input type="submit" value="Cadastrar">
        </form>
    </div>
</body>
</html>