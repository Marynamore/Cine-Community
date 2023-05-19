<?php 

class Conexao{

    private static $conexao;
    
    public static function getInstance(){
        if(!isset(self::$conexao)){
            try{
                $options = array(
                    PDO::ATTR_PERSISTENT => true,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8;',
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                );
                self::$conexao = new PDO('mysql:host=localhost;dbname=cine_community','root','', $options);
              
                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $exc){
             
                echo "Houve um erro ao se conectar com o Banco de Dados ".$exc->getMessage();
            }
        }
        return self::$conexao;
    }

}

    function idUnico(){
        $characteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $tamanho_characteres = strlen($characteres); //retorna o tamanho de uma string
        $characteres_aleatorios = '';
        for($i = 0; $i < 20; $i++){
            $characteres_aleatorios .= $characteres[mt_rand(0, $tamanho_characteres - 1)];
            //mt_rand() = 1997 - (Algoritmo) Mersenne Twister ele é 4x mais rápido, moderno é confiavel que o rand()
        }
        return $characteres_aleatorios;
   }
   
   if(isset($_COOKIE['id_usuario'])){
      $id_usuario = $_COOKIE['id_usuario'];
   }else{
      $id_usuario = '';
   }

?>