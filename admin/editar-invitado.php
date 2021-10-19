<?php
    $id = $_GET['id'];
    if(!filter_var($id, FILTER_VALIDATE_INT)){
        die("Error");
    } 

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
            <h1>Editar Invitados</h1>

          </div>
          <div class="col-sm-8">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="lista-invitados.php">Regresar</a></li>
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
          <h3 class="card-title">Ingresa los datos para editar.</h3>

        </div>

      </div>
      <!-- /.card -->
      <div class="row">
          <div class="col-md-8">         
            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Ingresa los datos</h3>
              </div>
              <!-- /.card-header -->

              <?php 
                  $sql = "SELECT * FROM invitados WHERE invitado_id = $id ";
                  $resultado = $conn->query($sql);
                  $invitado = $resultado->fetch_assoc();
             
                ?>
              <!-- form start -->
              <form class="form-horizontal" name="guardar-registro" id="guardar-registro-archivo" method="post" action="modelo-invitado.php" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="nombre_invitado" class="col-sm-2 col-form-label" >Nombre:</label>
                        <div class="col-sm-10">
                           <input type="text" class="form-control " id="nombre_invitado" name="nombre_invitado" placeholder="Nombre" value="<?php echo $invitado['nombre']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="apellido_invitado" class="col-sm-2 col-form-label">Apellido:</label>
                        <div class="col-sm-10">
                           <input type="text" class="form-control " id="apellido_invitado" name="apellido_invitado" placeholder="Apellido" value="<?php echo $invitado['apellido']; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="biografia_invitado" class="col-sm-2 col-form-label">Biografia:</label>
                        <div class="col-sm-10">
                           <textarea class="form-control" name="biografia_invitado" rows="8" placeholder="Biografía" id="biografia_invitado"><?php echo $invitado['descripcion']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="imagen_actual">Imagen Actual</label>
                        <br>
                        <img src="../img/invitados/<?php echo $invitado['url_imagen']; ?>" " >
                    </div>
                    <div class="form-group row">
                    <label for="imagen_invitado">Imagen</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="imagen_invitado" name="archivo_imagen">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>   

                  
                </div>
                 
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">   
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="hidden" name="registro" value="actualizar">
                  <input type="hidden" name="id_registro" value="<?php echo $invitado['invitado_id']; ?>">
                  <button type="submit" class="btn btn-info" id="crear_registro">Guardar</button>                  
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