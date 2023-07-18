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
?>