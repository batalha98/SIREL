<?php
include 'includes/connection.php';

class Veiculo{
    
    function inserir_veiculo(){
        global $connection;
        $mensagem = "";
        $array = [];
        
        $prop_nuit = $_POST['nuit_prop'];
        $matricula = $_POST['cod_matricula'];
        $lotacao = $_POST['lotacao'];
        $marca = $_POST['marca'];
        $modelo = $_POST['modelo'];
        $peso_bruto = $_POST['peso_bruto'];
        $tara = $_POST['tara'];
        $combustivel = $_POST['combustivel_tipo'];
        $caixa = $_POST['caixa_tipo'];
        $dimensao_pneus = $_POST['dimensao_pneus'];
        
        $array = $this->busca_por_matricula($matricula);
        
        if($array!=null){
            $mensagem = "A matricula ja se encontra registada!";
        }else{
            try{
                $connection->beginTransaction();
                $stmnt = $connection->prepare(''
                    . 'INSERT INTO veiculo (cod_matricula, nuitProp, lotacao, marca, modelo, '
                    . 'peso_bruto, tara, combustivel_tipo, caixa_tipo, dimensao_pneus) '
                    . 'VALUES (:cod_matricula, :lotacao, :marca, :modelo, :peso_bruto, '
                    . ':tara, :combustivel_tipo, :caixa_tipo, :dimensao_pneus)');

                $result = $stmnt->execute(array(':cod_matricula' => $matricula,
                                            ':nuitProp' => $prop_nuit, 
                                            ':lotacao' => $lotacao,
                                            ':marca' => $marca,
                                            ':modelo' => $modelo,
                                            ':peso_bruto' => $peso_bruto,
                                            ':tara' => $tara,
                                            ':combustivel_tipo' => $combustivel,
                                            ':caixa_tipo' => $caixa,
                                            ':dimensao_pneus' => $dimensao_pneus)
                        );

                if(!empty($result)){
                   self::registar_log('Registo de veiculo');
                   $mensagem = "Registado com sucesso!";
                }
                $connection->commit();

            } catch (Exception $ex) {
                $connection->rollback();

                throw new Exception($ex->getCode(),$ex->getMessage()) ;
            }
        }
        return $mensagem;
    }
    
    function eliminar_veiculo($cod_matricula){
        global $connection;
        $mensagem = "";
        
        try{
            $connection -> beginTransaction();
            
            $stmnt = $connection->prepare("DELETE FROM veiculo WHERE cod_matricula = :cod_matricula");
            $stmnt->bindParam(':cod_matricula',$cod_matricula, PDO::PARAM_STR);

            $result = $stmnt->execute();
            
            if(!empty($result)){
                self::registar_log("Eliminacao de veiculo");
                $mensagem = "Veiculo eliminado com sucesso!";
            }
        } catch (PDOException $e){
            throw new Exception($e->getCode(),$ex->getMessage());
        }
        
        return $mensagem;
    }
    
    function editar_veiculo(){
        
    }
    
    function buscar_todos(){
        global $connection;
        $veiculos=[];
        
        try{
            $stmnt = $connection->prepare("SELECT * FROM veiculo");

            $stmnt->execute();
            
            $veiculos = $stmnt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            $connection->rollback();
            
            throw new Exception($ex->getCode(),$ex->getMessage()) ;
        }
        return $veiculos;
    }
    
    function busca_por_matricula($matricula){
        global $connection;
        $veiculos=[];
        
        try{
            $stmnt = $connection->prepare("SELECT * FROM veiculo WHERE cod_matricula = :matricula");

            $stmnt->bindParam(':matricula', $matricula);
            
            $stmnt->execute();
            
            $veiculos = $stmnt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $ex) {
            $connection->rollback();
            
            throw new Exception($ex->getCode(),$ex->getMessage()) ;
        }
        
        return $veiculos;
    }
    
    function registar_log($mensagem){                 
        global $connection;
        $usuario_id=1;
        $data=Date('Y-m-d');

        $sql="INSERT INTO log_file(idUsuario, dataLog, actividade) ";
             $sql.="VALUES ";
             $sql.="(:usuario_id, :dataLog, :mensagem)";
             try{

        $statement=$connection->prepare($sql); 

        $result= $statement->execute(array(':usuario_id' => $usuario_id,
                                        ':dataLog' => $data,
                                       ':mensagem' => $mensagem
                                     )
                               );

        }catch(PDOException $ex){
               throw new Exception($ex->getCode(),$ex->getMessage()) ;
        }
    }
 
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

