<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/formulariofilme.css">
    <title>Cadastrar filme</title>
    <style>
       
    </style>
</head>
<body>
    <h1>Cadastrar filme</h1>
    <div class="borda">
        <form action="./controladicionar_filme.php" method="post" enctype="multipart/form-data">
            <label for="capa_filme">Poster do filme:</label>
            <input type="file" name="capa_filme" id="capa_filme"><br><br>    
            <label for="nome_filme">Nome do filme:</label>
            <input type="text" name="nome_filme" id="nome_filme" placeholder="Filme"><br><br>
            <label for="dt_de_lancamento_filme">Data de lançamento:</label>
            <input type="date" name="dt_de_lancamento_filme" id="dt_de_lancamento_filme" placeholder="Data de lançamento" value="<?= date('Y-m-d'); ?>"><br><br>
            <label for="categoria_filme">Categoria:</label>
            <select name="fk_categoria_filme_id_categoria_filme" id="categoria_filme">
                <option value="1">Infantil</option>
                <option value="2">Romance</option>
                <option value="3">Ação</option>
                <option value="4">Ficção</option>
                <option value="5">Terror</option>
                <option value="6">Comédia</option>
                <option value="7">Drama</option>
                <option value="8">Faroeste</option>
                <option value="9">Suspense</option>
            </select><br><br>
            <label for="duracao_filme">Duração:</label>
            <input type="time" name="duracao_filme" id="duracao_filme" placeholder="Duração" value="<?= date('H:i:s'); ?>"><br><br>
            <label for="classificacao_filme">Classificação indicativa:</label>
            <input type="number" name="classificacao_filme" id="classificacao_filme" placeholder="Classificação"><br><br>
            <label for="fk_canal_filme_id_canal_filme">Disponível em:</label>
            <input type="text" name="fk_canal_filme_id_canal_filme" id="fk_canal_filme_id_canal_filme"><br><br>
            <label for="sinopse_filme">Sinopse:</label>
            <textarea name="sinopse_filme" id="sinopse_filme" cols="30" rows="10" placeholder="Sinopse"></textarea><br><br>
            <input type="hidden" name="fk_usuario_id_usuario" value="<?= $id_usuario; ?>">
            <input type="submit" value="Cadastrar">
        </form>
    </div>
</body>
</html>
