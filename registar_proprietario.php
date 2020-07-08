
<?php include 'header.php'; ?>
<?php require 'functions/proprietario.php';  ?>
 

    <!-- Page Content -->
    <div class="container">

       <section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Registar Proprietario</h1>
                <?php  if(isset($_POST['submit'])){ ?>
                <div class="alert alert-success">
                    <?php 
                           
                               
                                 $proprietario=new Proprietario();
                                 echo $proprietario->registar_proprietario();
                            
                          
                           
                            
                            }
                           
                    ?>
                </div>
                
                <form role="form" method="post" id="" autocomplete="off">
                        <h6 class="text-center"><?php echo ""; ?></h6>
                         <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" id="nome" class="form-control" placeholder="Enter Desired Nome">
                        </div>
                        <div class="form-group">
                            <label for="Apelido">Apelido</label>
                            <input type="text" name="apelido" id="username" class="form-control" placeholder="Enter Desired Apelido">
                        </div>
                         <div class="form-group">
                            <label for="nuit">Numero de Nuit</label>
                            <input type="text" name="nuit" id="nuit" class="form-control" placeholder="Enter Desired Nuit">
                        </div>
                        <div class="form-group">
                            <label for="email" >Email</label>
                            <input type="text" name="email" id="data_validade" class="form-control" placeholder="Enter Desired Email">
                        </div>
                        <div class="form-group">
                            <label for="documento_tipo">Tipo de Documento</label>
                            <select id="documento_tipo" name="documento_tipo" class="form-control">
                                <option value="BI">BI</option>
                                 <option value="Passaporte">Passaporte</option>
                                  <option value="BI Temporario">BI Temporario</option>
                                   <option value="dir">DIR</option>
                                    <option value="Cartao de Refugiado">Cartao de Refugiado</option>
                            </select>
                         
                        </div>
                         <div class="form-group">
                            <label for="documento_numero">Numero de BI</label>
                            <input type="text" name="documento_numero" id="documento_numero" class="form-control" placeholder="Enter Desired Numero de Documento">
                        </div>
                        
                         <div class="form-group">
                            <label for="data_validade" >Data de Validade</label>
                            <input type="date" name="documento_validade" id="data_validade" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="local_residencia" >Local de Residencia</label>
                            <input type="text" name="local_residencia" id="local_residencia" class="form-control" placeholder="Enter Desired Local de Residencia">
                        </div>
                       
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-primary" value="Registar">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

            </div>

            <!-- Blog Sidebar Widgets Column -->

             
          

       
        <!-- /.row -->

        <hr>

        <!-- Footer -->
       <?php include 'footer.php'; ?>