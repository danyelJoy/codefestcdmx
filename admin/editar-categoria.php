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
            <h1>Editar Categoría Evento</h1>

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
          <h3 class="card-title">Ingresa los datos para editar una  categoría</h3>

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
                 $sql = "SELECT * FROM categoria_evento WHERE id_categoria = $id ";
                 $resultado = $conn->query($sql);
                 $categoria = $resultado->fetch_assoc();

               ?>
              <!-- form start -->
              <form class="form-horizontal" name="guardar-registro" id="guardar-registro" method="post" action="modelo-categpria.php">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="nombre_evento" class="col-sm-2 col-form-label">Nombre:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control " id="nombre_categoria" name="nombre_categoria" placeholder="Categoría" value="<?php echo $categoria['cat_evento']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                          <label for="">Icono</label>
                          <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                              <input type="text" id="icono" name="icono" class="form-control pull-right" placeholder="fa-icon" value="<?php echo $categoria['icono']; ?>">
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
                  <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
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