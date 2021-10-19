
<?php include_once 'includes/templates/header.php';?>
   <section class="seccion contenedor">
       <h2>Registro de Usuarios</h2>
       <form id="registro" class="registro" action="pagar.php" method="post">
           <div id="datosusuario" class="registro caja campo-contenedor clearfix">
               <div class="campo">
                   <label for="nombre">Nombre:</label>
                   <input type="text" id="nombre" name="nombre" placeholder="Nombre">
               </div>               
            <div class="campo">
                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" placeholder="Apellido">
            </div>
            <div class="campo">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="E-mail">
            </div>
            <div id="error"></div>
           </div> <!--datos_usuario-->

           <div id="paquetes" class="paquetes">
               <h3>Elige el número de boletos</h3>
              <ul class="lista-precios clearfix">
                <li>
                   <div class="tabla-precio">
                     <h3>Pase por día (Viernes)</h3>
                     <p class="numero">150</p>
                     <ul>
                       <li>Bebidas Gratis</li>
                       <li>Todas las conferencias</li>
                       <li>Todos los talleres</li>
                     </ul>
                     <div class="orden">
                         <label for="pase_dia">Boletos deseados:</label>
                         <input type="number" min="0" id="pase_dia" size="3" name="boletos[un_dia][cantidad]" placeholder="0">
                         <input type="hidden" value="30" name="boletos[un_dia][percio]">
                     </div>
                   </div>
                </li>
                <li>
                 <div class="tabla-precio">
                   <h3>Todos los días</h3>
                   <p class="numero">300</p>
                   <ul>
                     <li>Bebidas Gratis</li>
                     <li>Todas las conferencias</li>
                     <li>Todos los talleres</li>
                   </ul>
                   <div class="orden">
                        <label for="pase_completo">Boletos deseados:</label>
                        <input type="number" min="0" id="pase_completo" size="3" name="boletos[completo][cantidad]" placeholder="0">
                        <input type="hidden" value="300" name="boletos[completo][precio]">
                   </div>
                 </div>
              </li>
              <li>
               <div class="tabla-precio">
                 <h3>Pase por dos días (Viernes y Sábado)</h3>
                 <p class="numero">250</p>
                 <ul>
                   <li>Bebidas Gratis</li>
                   <li>Todas las conferencias</li>
                   <li>Todos los talleres</li>
                 </ul>
                 <div class="orden">
                    <label for="pase_dosdias">Boletos deseados:</label>
                    <input type="number" min="0" id="pase_dosdias" size="3" name="boletos[2dias][cantidad]" placeholder="0">
                    <input type="hidden" value="250" name="boletos[2dias][precio]">

                 </div>
               </div>
            </li>
            </ul>       
           </div><!--Paquetes-->
           <div id="eventos" class="eventos clearfix">
            <h3>Elige tus talleres</h3>
            <div class="caja">
                <?php
                    try {
                        require('includes/funciones/bd.conexion.php');
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
                      <h4><?php echo $dia ?></h4>
                      <?php 
                        foreach($eventos['eventos'] as $tipo => $eventos_dia): ?>
                          <div>
                              <p><?php echo $tipo ?></p>
                              
                              <?php foreach($eventos_dia as $evento) { ?>
                                <label>
                                    <input type="checkbox" name="registro[]" id="<?php echo$evento['id'] ?>" value="<?php echo$evento['id'] ?>">
                                    <time><?php echo$evento['hora']; ?></time> <?php echo$evento['nombre_evento']; ?>
                                    <br>
                                    <span class="autor"> <?php echo $evento['nombre'] . " " .$evento['apellido']; ?></span>
                                </label>

                              <?php } //Foreach ?>
                             
                          </div>
                        <?php endforeach; ?>
                  </div> <!--#Contenido días--> 
                  <?php }?>                
              </div><!--.caja-->
        </div> <!--#eventos-->
        <div id="resumen" class="resumen clearfix">
            <h3>Pago y extras</h3>
            <div class="caja clearfix">
                <div class="extras">
                    <div class="orden">
                        <label for="camisa_evento">Camia del evento 150 <small>(promoción 7% dto.)</small></label>
                        <input type="number" min="0" id="camisa_evento" name="pedido_extra[camisas][cantidad]" size="3" placeholder="0">
                       <input type="hidden" value="150" name="pedido_extra[camisas][precio]">
                    </div><!--Orden-->
                    <div class="orden">
                        <label for="etiquetas">Paquete de 10 stickers $ 70 <small>(JavaJs, React, HTML, Linux, Python)</small></label>
                        <input type="number" min="0" id="etiquetas" name="pedido_extra[etiquetas][cantidad]" size="3" placeholder="0">
                        <input type="hidden" value="70" name="pedido_extra[etiquetas][precio]">
                    </div><!--Orden-->
                    <div class="orden">
                        <label for="regalo">Seleccione un regalo</label>
                        <select id="regalo" name="regalo" required>
                            <option value="">-Seleccione un regalo-</option>
                            <option value="2">Etiquetas</option>
                            <option value="1">Pulsera</option>
                            <option value="3">Plumas</option>
                        </select>
                    </div> <!--Orden-->
                    <input type="button" id="calcular" class="button" name="submit" value="Calcular">
                </div> <!--Extras-->
                <div class="total">
                    <p>Resumen:</p>
                    <div id="lista-productos">

                    </div>
                    <p>Total:</p>
                    <div id="suma-total">

                    </div>
                    <input type="hidden" name="total_pedido" id="total_pedido">
                    <input id="btnRegistro" type="submit" name="submit" class="button" value="Pagar">
                </div><!--Total-->
            </div><!--Caja-->
        </div><!--Resumen-->
       </form>
   </section>
   <?php include_once 'includes/templates/footer.php';?>