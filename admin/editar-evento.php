<?php 

    $id = $_GET['id'];
    if(!filter_var($id, FILTER_VALIDATE_INT)):
        die("Error");

    else:
include_once 'funciones/sesiones.php';
include_once 'funciones/funciones.php';

include_once 'templates/header.php'; 
include_once 'templates/barra.php'; 
include_once 'templates/navegacion.php'; 


?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Eventos</h1>
          </div>
          <div class="col-sm-8">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">


      <!-- /.card -->
      <div class="row">
          <div class="col-md-8">         
            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Editar Eventos</h3>
              </div>
              <!-- /.card-header -->
              <?php  
                  $sql = "SELECT * FROM eventos WHERE evento_id = $id ";
                  $resultado = $conn->query($sql);
                  $evento = $resultado->fetch_assoc();

                  // echo "<pre>";
                  // var_dump($evento);
                  // echo "</pre>";
               
               ?>  

              <!-- form start -->
              <form class="form-horizontal" name="guardar-registro" id="guardar-registro" method="post" action="modelo-evento.php">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="usuario" class="col-sm-2 col-form-label">Titulo del evento:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control " id="titulo_evento" name="titulo_evento" placeholder="Evento" value="<?php echo $evento['nombre_evento']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="usuario" class="col-sm-2 col-form-label">Categoría:</label>
                    <div class="col-sm-10">
                      <select name="categoria_evento" class=" form-control seleccionar">
                        <option value="0">- Seleccione -</option>
                          <?php
                            try {
                              $categoria_actual =$evento['id_cat_evento'];
                              $sql = "SELECT * FROM categoria_evento";
                              $resultado = $conn->query($sql);
                              while($cat_evento = $resultado->fetch_assoc()){
                                  if($cat_evento['id_categoria']=== $categoria_actual) { ?>
                                  <option value="<?php echo $cat_evento['id_categoria']; ?>" selected>
                                    <?php  echo $cat_evento['cat_evento'];?>                                  
                                  </option>
                              <?php } else { ?>
                                <option value="<?php echo $cat_evento['id_categoria']; ?>">
                                    <?php  echo $cat_evento['cat_evento'];?>

                                <?php }

                              }  
                            } catch (Exception $e){
                              echo "Error" . $e->getMessage();
                              
                            }                          
                          ?>
                      </select>
                    </div>
                  </div>
                   <!-- Date -->
                  
                  <div class="form-group row">
                    <label for="usuario" class="col-sm-2 col-form-label">Fecha:</label>
                    <?php  
                        $fecha = $evento['fecha_evento'];
                    
                    ?>
                    <div class="col-sm-10">
                      <input type="date" class="form-control " id="fecha_evento" name="fecha_evento" value="<?php echo $fecha; ?>" >
                    </div>
                  </div>        
   
                <!-- Date and time -->
                     
                  <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Hora</label>
                    <?php 
                        $hora = $evento['hora_evento'];                    
                    
                    ?>
                    <div clas s="col-sm-10">
                      <input type="time" class="form-control" id="hora_evento" name="hora_evento" timeformat="24h" value="<?php  echo $hora ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="usuario" class="col-sm-2 col-form-label">Invitado:</label>
                    <div class="col-sm-10">
                      <select name="invitado" class=" form-control seleccionar">
                        <option value="0">- Seleccione -</option>
                          <?php
                            try {
                              $invitado_actual =$evento['id_inv'];
                              $sql = "SELECT invitado_id, nombre, apellido FROM invitados";
                              $resultado = $conn->query($sql);
                              while($invitados = $resultado->fetch_assoc()) {
                                if($invitados['invitado_id']=== $invitado_actual) { ?>
                                  <option value="<?php echo $invitados['invitado_id']; ?>" selected>
                                      <?php  echo $invitados['nombre'] ." ". $invitados['apellido'];?>
                                  </option>  
                                  <?php } else { ?> 
                                  <option value="<?php echo $invitados['invitado_id']; ?>">
                                      <?php  echo $invitados['nombre'] ." ". $invitados['apellido'];?>                                
                                 <?php } //Fin del if
                              } //Fin del while
                            }catch (Exception $e){
                              echo "Error" . $e->getMessage();
                              
                            }                         
                          ?>
                      </select>
                    </div>
                  </div>
                  

                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="registro" value="actualizar">
                  <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
                  <button type="submit" class="btn btn-info">Guardar</button>                  
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.card-body -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->


<?php 

include_once 'templates/footer.php'; 
                        endif;
?>