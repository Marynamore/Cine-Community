<?php 

if(isset($sucesso_msg)){
    foreach ($sucesso_msg as $sucesso_msg) {
        echo '<script>swal("'.$sucesso_msg.'" , " ", "sucesso");</script>';

    }
}


if(isset($aviso_msg)){
    foreach ($aviso_msg as $aviso_msg) {
        echo '<script>swal("'.$aviso_msg.'" , " ", "aviso");</script>';
    }
}


if(isset($erro_msg)){
    foreach ($erro_msg as $erro_msg) {
        echo '<script>swal("'.$erro_msg.'" , " ", "erro");</script>';
    }
}


if(isset($informacao_msg)){
    foreach ($informacao_msg as $informacao_msg) {
        echo '<script>swal("'.$informacao_msg.'" , " ", "informacao");</script>';
    }
}
?>
