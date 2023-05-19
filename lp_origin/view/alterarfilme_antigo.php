<?php
require_once '../model/conexao.php';
require_once './filmeDAO.php';
require_once './filmeDTO.php';

$id = $_GET["id"];
$FilmeDAO = new FilmeDAO();
$sucesso = $FilmeDAO->recuperarPorID($id);

echo'<pre>';
print_r($FilmeDAO);
echo'</pre>';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Cadastro</title>
  
</head>
<body>
        
    <h1 >Editar filme</h1>
    
    <form action="../control/controlalterarfilme.php" method="post" >

    <fieldset>

         <legend>
            Dados do Filme:
        </legend>
      <div>
        Nome Do Filme:<br/><input type="text" name="nome_filme" >
     
      <div>
        Lançamento:<br/> <input type="date" name="dt_de_lancamento_filme">
      </div>
      <div>
        classificação:<br/><input type="text" name="classificacao_filme">
     
      <div>
      <div>
        Genêro:<br/><select name="genero_filme">
            <option value="a">Ação</option>
            <option value="c">Comédia</option>
            <option value="d">Drama</option>
            <option value="r">Romance</option>
            <option value="do">Documentário</option>
            <option value="s">Suspense</option>
            <option value="t">Terror</option>
            <option value="fc">Ficção científica</option>
            </select>
      
      <div>
        Duração:<br/><input type="time" name="duracao_filme">
      </div>
      <div>
        Sinopse:<br/><input type="text" name="sinopse_filme">
      </div>
      <div>
        Imagem:<br/><input type="file" name="capa_filme">
      </div>
      
      <div>
      </div>
      <div>
        Canais:<br/><input type="text" name="canal_filme">
      </div>

       
      
    </fieldset>
    <div id="submit_cadastro">
               <a link href="./lista.php"> Voltar</a>
                 <input type="submit" value="Alterar">
     </div>
     </div>
      </div>
   </form> 
</div>

</body>
</html>