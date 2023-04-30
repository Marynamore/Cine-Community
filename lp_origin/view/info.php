<input type="hidden" name="id_filme" value="<?=$filme->getId_filme();?>">


/*
 * filme.php
 * Continuação do Selecionar Filme para Resenha
*/        
        <?php 
            $selecao_resenha = $conn->prepare("SELECT * FROM `resenha` WHERE id_filme = ?");
            $selecao_resenha->execute([$getId_filme]);
        
            if($selecao_resenha->rowCount() > 0){
                while ($resenhaFetch = $selecao_resenha->fetch(PDO::FETCH_ASSOC)){
                    
                $id_filme = $resenhaFetch['id_filme'];
        ?>
           <div class="box" <?php if($resenhaFetch['id_usuario'] == $id_usuario){echo 'style="order: -1;"';}; ?>>
        <?php
            $selecao_usuario = $conn->prepare("SELECT * FROM `usuario` WHERE id_usuario = ?");
            $selecao_usuario->execute([$resenhaFetch['id_usuario']]);
            while($usuarioFetch = $selecao_usuario->fetch(PDO::FETCH_ASSOC)){
        ?>
      <div>
         <?php if($usuarioFetch['foto_usu'] != ''){ ?>
            <img src="uploaded<?= $usuarioFetch['foto_usu']; ?>" alt="">
         <?php }else{ ?>   
            <h3><?= substr($usuarioFetch['nickname_usu'], 0, 1); ?></h3>
         <?php }; ?>   
         <div>
            <p><?= $usuarioFetch['nickname_usu']; ?></p>
            <span><?= $resenhaFetch['dt_hora_res']; ?></span>
         </div>
      </div>
      <?php }; ?>
      <h3 class="title"><?= $resenhaFetch['titulo_res']; ?></h3>
      <?php if($resenhaFetch['descricao_res'] != ''){ ?>
         <p class="descricao"><?= $resenhaFetch['descricao_res']; ?></p>
      <?php }; ?>  
   </div>
    <?php
            }
        }else{
            echo '<p>Nenhuma Resenha criada ainda!</p>';
        }
    ?>