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
            <h1>Editar registro</h1>

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
          <h3 class="card-title">Ingresa los datos que vas editar.</h3>

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
                $sql = "SELECT * FROM registrados WHERE id_registrado = $id ";
                $resultado = $conn->query($sql);
                $registrado = $resultado->fetch_assoc();    
                ?>
              <!-- form start -->
              <form class="form-horizontal editar-registrado" name="guardar-registro" id="guardar-registro" method="post" action="modelo-registrado.php">
                <div class="card-body">
                    <div class="form-group row">
                      <label for="nombre_registrado" class="col-sm-2 col-form-label">Nombre:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control " id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $registrado['nombre_registrado']; ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="apellido" class="col-sm-2 col-form-label">Apellido:</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" value="<?php echo $registrado['apellido_registrado']; ?>">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="email" class="col-sm-2 col-form-label">Email:</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control " id="email" name="email" placeholder="Email" value="<?php echo $registrado['email_registrado']; ?>">
                      </div>
                    </div>
                    <?php 
                       $pedido = $registrado['pases_articulos'];
                       $boletos = json_decode($pedido, true);              
                    ?>
                    <div class="form-group row">
                      <div id="paquetes" class="paquetes">
                          <h3>Elige el número de boletos</h3>
                          <ul class="lista-precios clearfix row">
                            <li class="col-md-4">
                              <div class="tabla-precio text-center">
                                <h3>Pase por día (Viernes)</h3>
                                <p class="numero">150</p>
                                <ul>
                                  <li>Bebidas Gratis</li>
                                  <li>Todas las conferencias</li>
                                  <li>Todos los talleres</li>
                                </ul>
                                <div class="orden">
                                    <label for="pase_dia">Boletos deseados:</label>
                                    <input value="<?php echo $boletos['un_dia']['cantidad']; ?>" type="number" class="form-control" min="0" id="pase_dia" size="3" name="boletos[un_dia][cantidad]" placeholder="0">
                                    <input type="hidden" value="30" name="boletos[un_dia][percio]">
                                </div>
                              </div>
                            </li>
                            <li class="col-md-4">
                            <div class="tabla-precio text-center">
                              <h3>Todos los días</h3>
                              <p class="numero">300</p>
                              <ul>
                                <li>Bebidas Gratis</li>
                                <li>Todas las conferencias</li>
                                <li>Todos los talleres</li>
                              </ul>
                              <div class="orden">
                                    <label for="pase_completo">Boletos deseados:</label>
                                    <input value="<?php echo $boletos['pase_completo']['cantidad']; ?>" type="number" class="form-control" min="0" id="pase_completo" size="3" name="boletos[completo][cantidad]" placeholder="0">
                                    <input type="hidden" value="300" name="boletos[completo][precio]">
                              </div>
                            </div>
                          </li>
                          <li class="col-md-4">
                          <div class="tabla-precio text-center">
                            <h3>Pase por dos días (Viernes y Sábado)</h3>
                            <p class="numero">250</p>
                            <ul>
                              <li>Bebidas Gratis</li>
                              <li>Todas las conferencias</li>
                              <li>Todos los talleres</li>
                            </ul>
                            <div class="orden">
                                <label for="pase_dosdias">Boletos deseados:</label>
                                <input value="<?php echo $boletos['pase_2dias']['cantidad']; ?>" type="number" class="form-control" min="0" id="pase_dosdias" size="3" name="boletos[2dias][cantidad]" placeholder="0">
                                <input type="hidden" value="250" name="boletos[2dias][precio]">

                            </div>
                          </div>
                        </li>
                        </ul>       
                      </div><!--Paquetes-->
                    </div> <!-- Cierre div-form-->
                    <div class="form-group row">                     
                      <div id="eventos" class="eventos clearfix">
                       <h3>Elige los talleres</h3>
                       <br>
                          <div class="caja">
                              <?php $eventos = $registrado['talleres_registrados'];
                                    $id_eventos_registrados = json_decode($eventos, true);                        
                              ?>
                              <?php
                                  try {
                                      
                                      $sql = " SELECT eventos.*, categoria_evento.cat_evento, invitados.nombre, invitados.apellido ";
                                      $sql .= " FROM eventos";
                                      $sql .= " JOIN categoria_evento ";
                                      $sql .= " ON eventos.id_cat_evento = categoria_evento.id_categoria ";
                                      $sql .= " JOIN invitados ";
                                      $sql .= " ON eventos.id_inv = invitados.invitado_id ";
                                      $sql .= " ORDER BY eventos.fecha_evento, eventos.id_cat_evento, eventos.hora_evento ";                        
                                      $resultado = $conn->query($sql);

                                  } catch(Exception $e){
                                      echo $e->getMessage();
                                  }
                                  while($eventos = $resultado->fetch_assoc()){
                                      $fecha = $eventos['fecha_evento'];
                                      setlocale(LC_ALL, 'esp_ESP.UTF-8');
                                      $dia_semana = strftime("%A", strtotime($fecha));
                                      $categoria = $eventos['cat_evento'];
                                      $dia = array(
                                          'nombre_evento' => $eventos['nombre_evento'],
                                          'hora' => $eventos['hora_evento'],
                                          'id' => $eventos['evento_id'],
                                          'nombre' => $eventos['nombre'],
                                          'apellido' => $eventos['apellido']
                                          
                                      );
                                      $eventos_dias[$dia_semana]['eventos'][$categoria][] = $dia;
                                  
                                  }           
                              
                              ?>
                              <?php foreach($eventos_dias as $dia => $eventos) { ?>

                                  
                                <div id="<?php echo str_replace('á', 'a', $dia); ?>" class="contenido-dia clearfix">
                                    <h4 class="text-center nombre-dia"><?php echo $dia ?></h4>
                                    <div class="row">
                                    <?php 
                                      foreach($eventos['eventos'] as $tipo => $eventos_dia): ?>
                                        <div class="col-md-4">
                                            <p><?php echo $tipo ?></p>
                                            
                                            <?php foreach($eventos_dia as $evento) { ?>
                                              <label>
                                                  <input <?php echo (in_array($evento['id'], $id_eventos_registrados['eventos']) ? 'checked': 'false'); ?> type="checkbox"   name="registro_evento[]" id="<?php echo$evento['id'] ?>" value="<?php echo$evento['id'] ?>">
                                                  <time><?php echo$evento['hora']; ?></time> <?php echo$evento['nombre_evento']; ?>
                                                  <br>
                                                  <span class="autor"> <?php echo $evento['nombre'] . " " .$evento['apellido']; ?></span>
                                              </label>

                                            <?php } //Foreach ?>                                          
                                        </div>
                                      <?php endforeach; ?>
                                      </div>
                                </div> <!--#Contenido días--> 
                                <?php }?>                
                            </div><!--.caja-->
                          </div> <!--#eventos-->
                  <div id="resumen" class="resumen clearfix">
                    <br>
                   <h3>Pago y extras</h3>
                   <br>
                      <div class="caja clearfix row">
                      <div class="extras col-md-6">
                        <div class="orden">
                            <label for="camisa_evento">Camia del evento 150 <small>(promoción 7% dto.)</small></label>
                            <input value="<?php echo  isset($boletos['camisas']); ?>" type="number" class="form-control" min="0" id="camisa_evento" name="pedido_extra[camisas][cantidad]" size="3" placeholder="0">
                          <input type="hidden" value="150" name="pedido_extra[camisas][precio]">
                        </div><!--Orden-->
                        <div class="orden">
                            <label for="etiquetas">Paquete de 10 stickers $ 70 <small>(JavaJs, React, HTML, Linux, Python)</small></label>
                            <input value="<?php echo isset($boletos['etiquetas']);  ?>" type="number" class="form-control" min="0" id="etiquetas" name="pedido_extra[etiquetas][cantidad]" size="3" placeholder="0">
                            <input type="hidden" value="70" name="pedido_extra[etiquetas][precio]">
                        </div><!--Orden-->
                        <div class="orden">
                            <label for="regalo">Seleccione un regalo</label>
                            <select id="regalo" name="regalo" required class="form-control seleccionar">
                                <option value="">-Seleccione un regalo-</option>
                                <option value="2" <?php echo($registrado['regalo'] == 2 ) ? 'selected' : '' ?> >Etiquetas</option>
                                <option value="1" <?php echo($registrado['regalo'] == 1 ) ? 'selected' : '' ?> >Pulsera</option>
                                <option value="3" <?php echo($registrado['regalo'] == 3 ) ? 'selected' : '' ?> >Plumas</option>
                            </select>
                        </div> <!--Orden-->
                        <br>
                        <input type="button" id="calcular" class="btn btn-success" name="submit" value="Calcular">
                        </div> <!--Extras-->
                        <div class="total col-md-6">
                          <p>Resumen:</p>
                          <div id="lista-productos">

                          </div>
                          <p>Total Ya Pagado: <?php echo $registrado['total_pagado']; ?></p>
                          <p>Total:</p>                          
                          <div id="suma-total">

                          </div>
                                            
                        </div><!--Total-->
                      </div><!--Caja-->
                  </div><!--Resumen-->
                        </div>
                 
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">   
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                <input type="hidden" name="total_pedido" id="total_pedido"> 
                <input type="hidden" name="total_descuento" id="total_descuento" value="total_descuento"> 
                  <input type="hidden" name="registro" value="actualizar">
                  <input type="hidden" name="id_registro" value="<?php echo $registrado['id_registrado']; ?>">
                  <input type="hidden" name="fecha_registro" value="<?php echo $registrado['fecha_registro']; ?>">
                  <button type="submit" class="btn btn-info" id="btnRegistro">Guardar</button>                  
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