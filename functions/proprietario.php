
<?php
         //include '../includes/connection.php'; 
 include 'includes/connection.php';

 class Proprietario{
   
    function registar_proprietario(){
      
     global $connection;
   
     $mensagem='';
     
            $nome=$_POST['nome'];
            
            $apelido=$_POST['apelido'];
            $nuit=$_POST['nuit'];
            $email=$_POST['email'];
            $documento_tipo=$_POST['documento_tipo'];
            $documento_numero=$_POST['documento_numero'];
            $documento_validade=$_POST['documento_validade'];
            $local_residencia=$_POST['local_residencia'];
            $data_registo=Date('Y-m-d');
            
              $array= $this->ver_proprietarioPorNuit($nuit);
              if($array!=null){
                  $mensagem="O proprietario ja existe no sistema com esse NUIT";
              }else{
            
             $sql="INSERT INTO proprietario(nome, apelido, nuit, email, documento_tipo, documento_numero, documento_validade, local_residencia, data_registo) ";
                  $sql.="VALUES ";
                  $sql.="(:nome, :apelido, :nuit, :email, :documento_tipo, :documento_numero, :documento_validade,:local_residencia, :data_registo)";
                 
                try{  
                     $connection->beginTransaction();
             $statement=$connection->prepare($sql); 
             
             $result= $statement->execute(array(':nome' => $nome,
                                            ':apelido' => $apelido, 
                                            ':nuit' => $nuit,
                                            ':email' => $email,
                                            ':documento_tipo' => $documento_tipo,
                                            ':documento_numero' => $documento_numero,
                                            ':documento_validade' => $documento_validade,
                                            ':local_residencia' => $local_residencia,
                                            ':data_registo' => $data_registo
                                          )
                                    );
                
            
                 if(!empty($result)){
                     //$pro =new Proprietario();
                     self::registar_log("Registo de Proprietario");
                     $mensagem= 'Registado com Sucesso!';
                   
                 }
              $connection->commit();
             }catch(PDOException $ex){
                  $connection->rollBack();
                    throw new Exception($ex->getCode(),$ex->getMessage()) ;
 }
              }
              return $mensagem;
             }
 
    function editar_proprietario($id){
        include 'includes/connection.php';
         $sql="SELECT*FROM proprietario WHERE id=:id";
         try{
         $statement=$connection->prepare($sql);
         $statement->execute(array(':id'=>$id));
         $proprietarios=$statement->fetchAll(PDO::FETCH_OBJ);
         return $proprietarios;
        
  
    } catch(PDOException $ex){
                    throw new Exception($ex->getCode(),$ex->getMessage()) ;
        
    }
    }
        
    
    function actualizar_proprietario(){
          include 'includes/connection.php';
          
            $id=$_POST['id'];
            $nome=$_POST['nome'];
            $apelido=$_POST['apelido'];
            $nuit=$_POST['nuit'];
            $email=$_POST['email'];
            $documento_tipo=$_POST['documento_tipo'];
            $documento_numero=$_POST['documento_numero'];
            $documento_validade=$_POST['documento_validade'];
            $local_residencia=$_POST['local_residencia'];
           
          $message='';
        $sql="UPDATE proprietario SET nome=:nome, apelido=:apelido, nuit=:nuit, email=:email, documento_tipo=:documento_tipo, ";
        $sql.="documento_numero=:documento_numero, documento_validade=:documento_validade, local_residencia=:local_residencia WHERE id=:id" ;
        try{
            $connection->beginTransaction();
            $statement=$connection->prepare($sql);
            $statement->execute(array(':nome' => $nome,
                                            ':apelido' => $apelido, 
                                            ':nuit' => $nuit,
                                            ':email' => $email,
                                            ':documento_tipo' => $documento_tipo,
                                            ':documento_numero' => $documento_numero,
                                            ':documento_validade' => $documento_validade,
                                            ':local_residencia' => $local_residencia,
                                            ':id'=>$id
                                          ));
            $this->registar_log("Actualizar Proprietatio");
                                          header('Location: ver_proprietarios.php');
           // return $message="Proprietario Actualizado com sucesso";
            $connection->commit();
        } catch (Exception $ex) {
             $connection->rollBack();
             throw new mysqli_sql_exception($ex->getCode(),$ex->getMessage()) ;
            
        }
    }
    
    function listar_proprietario(){    
        global $connection;
        $array= $this->paginacao();
        $inicio=$array[0];
        $final=$array[1];
         
         $sql="SELECT*FROM proprietario ORDER BY id DESC LIMIT {$inicio},{$final}";
         try{
         $statement=$connection->prepare($sql);
         $statement->execute();
         $proprietarios=$statement->fetchAll(PDO::FETCH_OBJ);
         return $proprietarios;
        
  
    } catch(PDOException $ex){
                    throw new Exception($ex->getCode(),$ex->getMessage()) ;
        
    }
    }
    
    function buscar_todos(){
        global $connection;
        $array= [];
        
        try{
            $stmnt = $connection->prepare("SELECT * FROM proprietario");
            $stmnt->execute();
            $array = $stmnt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex){
            throw new Exception($ex->getCode(),$ex->getMessage()) ;
        }
        
        return $array;
    }
    
    function apagar_proprietario($id){
        global $connection;
        //echo $id;
            $sql="DELETE FROM proprietario WHERE id=:id";
            try{
                $connection->beginTransaction();
                   $statement=$connection->prepare($sql);
            $statement->execute(array(':id' => $id));
            $this->registar_log('Apagar Usuario');
            $connection->commit();
            } catch (Exception $ex) {
                $connection->roolback();
                throw new Exception($ex->getCode(),$ex->getMessage()) ;
            }
         
        
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
 }}
 
function paginacao(){
    $limite=5;
    $inicio=0;
    $final=0;
    $array=[];
    if(isset($_GET['page']) && $_GET['page']!=1){
          //$incio=lista+1;
          
        $inicio=$_GET['page'];
         $inicio=($inicio*$limite)-$limite;
         $final=$limite;
        $array=[$inicio,$limite];
    }else{
        $inicio=0;
         $final=$limite;
          $array=[$inicio,$final];
    }
     return $array; 
}

function rCount(){
    global $connection;
    
    $sql='SELECT * FROM proprietario';
    try {
        $nr=0;
         $statement=$connection->query($sql);
    $nr=$statement->rowCount();
    } catch (Exception $ex) {
           throw new Exception($ex->getCode(),$ex->getMessage()) ;
    }
   
    return $nr;
}
 function ver_proprietarioPorNuit($nuit){
    global $connection;
    $array=[];
    $sql="SELECT * FROM proprietario WHERE nuit=:nuit";
    try {
        
         $statement=$connection->prepare($sql);
    $statement->execute(array(':nuit' => $nuit));
    $array=$statement->fetchAll(PDO::FETCH_OBJ);
    } catch (Exception $ex) {
           throw new Exception($ex->getCode(),$ex->getMessage()) ;
    }
   
    return $array;
}           
}

?>