<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/formulariofilme.css">
    <title>Alterar filme</title>
    
</head>
<?php
    require_once '../model/dao/filmeDAO.php';

    $get_id = $_GET["get_id"];
    $FilmeDAO = new FilmeDAO();
    $filme = $FilmeDAO->recuperarPorID($get_id);

    echo'<pre>';
    print_r($filme);
    echo'</pre>';

?>
<body>
    <h1>Alterar filme</h1>
    <div class="borda">
        <form  action="../control/control_alterar_filme.php" method="post">
            <input type="hidden" name="id_filme" value="<?=$filme->getId_filme();?>">
            Poster do filme
            <input type="file" name="capa_filme" value="<?=$filme->getCapa_filme();?>"><br><br>    
            Nome do filme:
            <input type="text"  name="nome_filme" placeholder="Filme" value="<?=$filme->getNome_filme();?>"> <br>  <br>
            Data de lançamento: 
          <input type="date"  name="Dt_de_lancamento_filme" placeholder="Data de lançamento" value="<?=$filme->getDt_de_lancamento_filme();?>"><br><br>
       
            <label for="cars">Categoria:</label>

            <select name="categoria_filme" id="cars">
                <option value="INFANTIL">Infantil</option>
                <option value="ROMANCE">Romance</option>
                <option value="AÇÃO">Ação</option>
                <option value="DORAMA">Dorama</option>
                <option value="FICÇÃO">Ficção</option>
                <option value="TERROR">Terror</option>
                <option value="COMÉDIA">Comédia</option>
                <option value="DRAMA">Drama</option>
                <option value="FAROESTE">Faroeste</option>
                <option value="SUSPENSE">Suspense</option>
            </select>
           
            Duração: 
          <input type="time" name="duracao_filme" placeholder="Duração" value="<?=$filme->getDuracao_filme();?>"> <br><br> 
            Classificação indicativa: 
            <input type="numb" name="classificacao_filme" placeholder="Classificação" value="<?=$filme->getClassificacao_filme();?>"><br><br>     
            Disponível em : 
            <input type="text" name="canal_filme" value="<?=$filme->getCanal_filme();?>"><br><br>     
            Sinopse:
            <textarea name="sinopse_filme" id="" cols="30" rows="10" placeholder="Sinopse" value="<?=$filme->getSinopse_filme();?>"></textarea><br>
            
            <input type="submit" value="Alterar">
        </form>
    </div>
     
 </form><br>
</body>
</html>