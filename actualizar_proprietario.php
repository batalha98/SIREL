<?php include 'header.php'; ?>
<?php require 'functions/proprietario.php';  ?>

<?php  ?>



    <!-- Page Content -->
    <div class="container">

       <section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Registar Proprietario</h1>
                 <?php  
                            if(isset($_GET['edit'])){ 
                                $id=$_GET['edit'];
                            $proprietario=new Proprietario();
                            $pro=$proprietario->editar_proprietario($id);
                            
                            }
                             
                    ?>
                
                
                <?php  if(isset($_POST['submit'])): ?>
                <div class="alert alert-success">
                    <?php 
                            
                            $proprietario=new Proprietario();
                            $proprietario->actualizar_proprietario();
                            
                            
                           
                    ?>
                </div>
                <?php endif; ?>
                <form role="form" method="post" id="" autocomplete="off">
                        <h6 class="text-center"><?php echo ""; ?></h6>
                        <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $pro[0]->id; ?>">
                         <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" id="nome" class="form-control" value="<?php echo $pro[0]->nome; ?>">
                        </div>
                        <div class="form-group">
                            <label for="Apelido">Apelido</label>
                            <input type="text" name="apelido" id="username" class="form-control" value="<?php echo $pro[0]->apelido; ?>">
                        </div>
                         <div class="form-group">
                            <label for="nuit">Numero de Nuit</label>
                            <input type="text" name="nuit" id="nuit" class="form-control" value="<?php echo $pro[0]->nuit; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email" >Email</label>
                            <input type="text" name="email" id="data_validade" class="form-control" value="<?php echo $pro[0]->email; ?>">
                        </div>
                        <div class="form-group">
                            <label for="documento_tipo">Tipo de Documento</label>
                            <select id="documento_tipo" name="documento_tipo" class="form-control">
                                <option value="<?php echo $pro[0]->documento_tipo; ?>" selected><?php echo $pro[0]->documento_tipo; ?></option>
                                <option value="BI">BI</option>
                                 <option value="Passaporte">Passaporte</option>
                                  <option value="BI Temporario">BI Temporario</option>
                                   <option value="DIR">DIR</option>
                                    <option value="Cartao de Refugiado">Cartao de Refugiado</option>
                            </select>
                         
                        </div>
                         <div class="form-group">
                            <label for="documento_numero">Numero de BI</label>
                            <input type="text" name="documento_numero" id="documento_numero" class="form-control" value="<?php echo $pro[0]->documento_numero; ?>">
                        </div>
                        
                         <div class="form-group">
                            <label for="data_validade" >Data de Validade</label>
                            <input type="date" name="documento_validade" id="data_validade" class="form-control" value="<?php echo $pro[0]->documento_validade; ?>">
                        </div>
                        <div class="form-group">
                            <label for="local_residencia" >Local de Residencia</label>
                            <input type="text" name="local_residencia" id="local_residencia" class="form-control" value="<?php echo $pro[0]->local_residencia; ?>">
                        </div>
                       
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-primary" value="Actualizar">
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