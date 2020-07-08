<?php include './functions/proprietario.php' ?>
<?php include 'header.php'; ?>

    <!-- Page Content -->
     <div id="page-wrapper">
    <div class="container-fluid">

        <div class="row">
             <div class="col-lg-12">
                 
                 <form name="form_search" action="" method="post"> 
                 <div class="input-group col-sm-2 pull-right" >
                                     
                                    <input type="text" name="nuit" class="form-control" placeholder="Procurar por NUIT">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit" name="submit">
                                            <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                    </span>
                                    
                                </div>
                                </form>
                 
               
                <h1>Ver Proprietarios </h1>
              
                <table class='table table-bordered table-hover'>
                  
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nome</td>
                            <td>Apelido</td>
                            <td>NUIT</td>
                            <td>Email</td>
                            <td>Tipo de Documento</td>
                            <td>Numero de BI</td>
                            <td>Data de Validade</td>
                            <td>Local de Residencia</td>
                            <td>Data de Registo</td>
                            <td>Editar</td>
                            <td>Apagar</td>         
                       </tr>
                   </thead>
                   <tbody>
                         <?php 
                         if(isset($_GET['delete'])){
                             $id=$_GET['delete'];
                              $proprietario=new Proprietario();
                           $proprietarios= $proprietario->apagar_proprietario($id);
                         }else{
                             if(isset($_POST['submit'])){
                                 $nuit=$_POST['nuit'];
                                  $proprietario=new Proprietario();
                           $proprietarios= $proprietario->ver_proprietarioPorNuit($nuit);
                             foreach ($proprietarios as $pro) {
                                echo "</tr>";  
                                 echo "<td>{$pro->id}</td>";
                               echo "<td>{$pro->nome}</td>";
                               echo "<td>{$pro->apelido}</td>";
                                echo "<td>{$pro->nuit}</td>";
                               echo "<td>{$pro->email}</td>";
                               echo "<td>{$pro->documento_tipo}</td>";
                               echo "<td>{$pro->documento_numero}</td>";
                               echo "<td>{$pro->documento_validade}</td>";
                                echo "<td>{$pro->local_residencia}</td>";
                                 echo "<td>{$pro->data_registo}</td>";
                               echo "<td><a href='actualizar_proprietario.php?edit={$pro->id}'>EDIT</a></td>";                
                               echo "<td><a onClick=\" javascript: return confirm('Are you sure want to delete');\" href='ver_proprietarios.php?delete={$pro->id}'>Delete</a></td>";
                               echo "</tr>";
                           }
                           
                             }else{
                                 $proprietario=new Proprietario();
                           $proprietarios= $proprietario->listar_proprietario();
                           foreach ($proprietarios as $pro) {
                                echo "</tr>";  
                                 echo "<td>{$pro->id}</td>";
                               echo "<td>{$pro->nome}</td>";
                               echo "<td>{$pro->apelido}</td>";
                                echo "<td>{$pro->nuit}</td>";
                               echo "<td>{$pro->email}</td>";
                               echo "<td>{$pro->documento_tipo}</td>";
                               echo "<td>{$pro->documento_numero}</td>";
                               echo "<td>{$pro->documento_validade}</td>";
                                echo "<td>{$pro->local_residencia}</td>";
                                 echo "<td>{$pro->data_registo}</td>";
                               echo "<td><a href='actualizar_proprietario.php?edit={$pro->id}'>EDIT</a></td>";                
                               echo "<td><a onClick=\" javascript: return confirm('Are you sure want to delete');\" href='ver_proprietarios.php?delete={$pro->id}'>Delete</a></td>";
                               echo "</tr>";
                           }
                             }
                         }
                            
                        ?>
                        </tbody>   
                        </table>
                
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->


            <!-- Blog Sidebar Widgets Column -->

             
          

       
        <!-- /.row -->

        <hr>
         <ul class="pager">
            <?php
             $proprietario =new Proprietario();
            $count=$proprietario->rCount();
            $count= ceil($count/5);
                for($i=1; $i<=$count; $i++){
                   
                   echo  "<li ><a href=\"ver_proprietarios.php?page={$i}\">{$i}</a></li>";
            }
             if(isset($_GET['page'])){
                  $proprietario =new Proprietario();
            $count=$proprietario->listar_proprietario();
                   }
            ?>
           
        
        </ul>

        <!-- Footer -->
       <?php include 'footer.php'; ?>