<?php 
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
            <h1>Crear Eventos</h1>

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

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Ingresa los datos para crear un evento</h3>

        </div>

      </div>
      <!-- /.card -->
      <div class="row">
          <div class="col-md-8">         
            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Formulario Eventos</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" name="guardar-registro" id="guardar-registro" method="post" action="modelo-evento.php">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="usuario" class="col-sm-2 col-form-label">Titulo del evento:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control " id="titulo_evento" name="titulo_evento" placeholder="Evento">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="usuario" class="col-sm-2 col-form-label">Categoría:</label>
                    <div class="col-sm-10">
                      <select name="categoria_evento" class=" form-control seleccionar">
                        <option value="0">- Seleccione -</option>
                          <?php
                            try {
                              $sql = "SELECT * FROM categoria_evento";
                              $resultado = $conn->query($sql);
                              while($cat_evento = $resultado->fetch_assoc()){ ?>
                                  <option value="<?php echo $cat_evento['id_categoria']; ?>">
                                      <?php  echo $cat_evento['cat_evento'];?>
                                  </option>

                            <?php }

                            }catch (Exception $e){
                              echo "Error" . $e->getMessage();
                              
                            }                         
                          
                          ?>
                      </select>
                    </div>
                  </div>
                   <!-- Date -->
                  
                  <div class="form-group row">
                    <label for="usuario" class="col-sm-2 col-form-label">Fecha:</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control " id="fecha_evento" name="fecha_evento" placeholder="DD/MM/AAAA">
                    </div>
                  </div>        
   
                <!-- Date and time -->
                     
                  <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Hora</label>
                    <div clas s="col-sm-10">
                      <input type="time" class="form-control" id="hora_evento" name="hora_evento" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="usuario" class="col-sm-2 col-form-label">Invitado:</label>
                    <div class="col-sm-10">
                      <select name="invitado" class=" form-control seleccionar">
                        <option value="0">- Seleccione -</option>
                          <?php
                            try {
                              $sql = "SELECT invitado_id, nombre, apellido FROM invitados";
                              $resultado = $conn->query($sql);
                              while($invitados = $resultado->fetch_assoc()){ ?>
                                  <option value="<?php echo $invitados['invitado_id']; ?>">
                                      <?php  echo $invitados['nombre'] ." ". $invitados['apellido'];?>
                                  </option>

                            <?php }

                            }catch (Exception $e){
                              echo "Error" . $e->getMessage();
                              
                            }                         
                          
                          ?>
                      </select>
                    </div>
                  </div>
                  

                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="registro" value="nuevo">
                  <button type="submit" class="btn btn-info">Añadir</button>                  
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

?>