<?php 
require_once __DIR__.'/../conexao.php';
require_once __DIR__.'/../dto/transacaoDTO.php';

class TransacaoDAO{
    public $pdo;

    public function __construct()
    {
        $this->pdo = Conexao::getInstance();
    }

    public function cadastrarTransacao(TransacaoDTO $transacaoDTO){
        try{
            $sql = "INSERT INTO transacao (tipo_trans, dt_hora_trans, status_trans, valor_total, qtd_trans, fk_id_item, tipo_pagamento_trans, fk_id_usuario, fk_id_perfil) VALUES (?,?,?,?,?,?,?,?,?)";
            $cadTransacao = $this->pdo->prepare($sql); 

            $cadTransacao->bindValue(1, $transacaoDTO->getTipo_trans());
            $cadTransacao->bindValue(2, $transacaoDTO->getDt_hora_trans());
            $cadTransacao->bindValue(3, $transacaoDTO->getStatus_trans());
            $cadTransacao->bindValue(4, $transacaoDTO->getValor_total());
            $cadTransacao->bindValue(5, $transacaoDTO->getQtd_trans());
            $cadTransacao->bindValue(6, $transacaoDTO->getFk_id_item());
            $cadTransacao->bindValue(7, $transacaoDTO->getTipo_pagamento_trans());
            $cadTransacao->bindValue(8, $transacaoDTO->getFk_id_usuario());
            $cadTransacao->bindValue(9, $transacaoDTO->getFk_id_perfil());

            return $cadTransacao->execute();
        }catch(PDOException $exc){
            echo $exc->getMessage();
            die();
        }
    }

    public function alterarTransacao(TransacaoDTO $transacaoDTO){
        try{
            $sql = "UPDATE transacao SET tipo_trans=?, dt_hora_trans=?, status_trans=?, valor_total=?, qtd_trans=?, fk_id_item=?, tipo_pagamento_trans=?, fk_id_usuario=?, fk_id_perfil=? WHERE id_transacao=?";

            $upTransacao = $this->pdo->prepare($sql);
            $upTransacao->bindValue(1, $transacaoDTO->getTipo_trans());
            $upTransacao->bindValue(2, $transacaoDTO->getDt_hora_trans());
            $upTransacao->bindValue(3, $transacaoDTO->getStatus_trans());
            $upTransacao->bindValue(4, $transacaoDTO->getValor_total());
            $upTransacao->bindValue(5, $transacaoDTO->getQtd_trans());
            $upTransacao->bindValue(6, $transacaoDTO->getFk_id_item());
            $upTransacao->bindValue(7, $transacaoDTO->getTipo_pagamento_trans());
            $upTransacao->bindValue(8, $transacaoDTO->getFk_id_usuario());
            $upTransacao->bindValue(9, $transacaoDTO->getFk_id_perfil());
            $upTransacao->bindValue(10, $transacaoDTO->getId_transacao());

            return $upTransacao->execute();

        }catch(PDOException $exc){
            echo $exc->getMessage();
        }
    }

    public function excluirTransacaoPorId($id_transacao){
        try{
            $sql = "DELETE FROM transacao WHERE id_transacao=?";
            $exTransacao = $this->pdo->prepare($sql);

            $exTransacao->bindValue(1, $id_transacao);

            return $exTransacao->execute();

        }catch(PDOException $exc){
            echo $exc->getMessage();
        }
    }

    public function listarTodasTransacoes(){
        try{
            $sql = "SELECT * FROM transacao";

            $allTransacoes = $this->pdo->prepare($sql);
            $allTransacoes->execute();

            $transacoes = array();
            if($allTransacoes->rowCount()>0){
                while($transacaoFetch = $allTransacoes->fetch(PDO::FETCH_ASSOC)){
                    $transacaoDTO = new TransacaoDTO();

                    $transacaoDTO->setId_transacao($transacaoFetch['id_transacao']);
                    $transacaoDTO->setTipo_trans($transacaoFetch['tipo_trans']);
                    $transacaoDTO->setDt_hora_trans($transacaoFetch['dt_hora_trans']);
                    $transacaoDTO->setStatus_trans($transacaoFetch['status_trans']);
                    $transacaoDTO->setValor_total($transacaoFetch['valor_total']);
                    $transacaoDTO->setQtd_trans($transacaoFetch['qtd_trans']);
                    $transacaoDTO->setFk_id_item($transacaoFetch['fk_id_item']);
                    $transacaoDTO->setTipo_pagamento_trans($transacaoFetch['tipo_pagamento_trans']);
                    $transacaoDTO->setFk_id_usuario($transacaoFetch['fk_id_usuario']);
                    $transacaoDTO->setFk_id_perfil($transacaoFetch['fk_id_perfil']);

                    $transacoes[] = $transacaoDTO;
                } 
                return $transacoes;
            }else{
                echo '<p>Nenhuma transação encontrada!</p>';
            }

        }catch(PDOException $exc){
            echo $exc->getMessage();
        }
        
    }

    public function obterTransacaoPorId($id_transacao){
        try{
            $sql = "SELECT * FROM transacao WHERE id_transacao=? LIMIT 1";
            $preTransacao = $this->pdo->prepare($sql);
            $preTransacao->bindValue(1, $id_transacao);
            $preTransacao->execute();
            $transacaoFetch = $preTransacao->fetch(PDO::FETCH_ASSOC);

            return $transacaoFetch;
        }catch(PDOException $exc){
            echo $exc->getMessage();
        }
    }
}

