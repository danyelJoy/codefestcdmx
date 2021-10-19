<?php include_once 'includes/templates/header.php';?>

   <section class="seccion contenedor">
       <h2>Calendario de Eventos</h2>
       <?php 
         try {
             require_once('includes/funciones/bd.conexion.php');
             $sql = " SELECT `evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `cat_evento`, `icono`, `nombre`, `apellido`  ";
             $sql .= " FROM `eventos`  ";             
             $sql .= " INNER JOIN `categoria_evento`  ";             
             $sql .= " ON `eventos`.`id_cat_evento` = `categoria_evento`.`id_categoria`  ";             
             $sql .= " INNER JOIN `invitados`  ";             
             $sql .= " ON `eventos`.`id_inv` = `invitados`.`invitado_id` ";
             $sql .=  " ORDER BY `evento_id` ";
             $resultado = $conn->query($sql);

         }catch(Exception$e){
             echo $e->getMessage();
         }       
       ?>

       <div class="calendario">
           <?php
           
             $calendario = array(); 

             while($eventos = $resultado->fetch_assoc()){ 
            
               //Obtiene la fecha del evento
                $fecha = $eventos['fecha_evento'];
                
                $evento = array (
                  'titulo' => $eventos['nombre_evento'],
                  'fecha' => $eventos['fecha_evento'],
                  'hora' => $eventos['hora_evento'],
                  'categoria' => $eventos['cat_evento'],
                  'icono' => $eventos['icono'],
                  'invitado' => $eventos['nombre']. " " . $eventos['apellido']

                );
                
                $calendario[$fecha][] = $evento;

                ?>             
                
            <?php } //While de fetch_assoc() ?>
            
            
            <?php
              //Imprimir todos los eventos
              foreach($calendario as $dia => $lista_eventos){ ?>
                <h3>
                <i class="far fa-calendar-alt"></i>
                <?php 
                    //UNIX
                    setlocale(LC_TIME, 'es.ES.UTF-8');
                    //Windows
                    setlocale(LC_TIME, 'spanish');                
                    echo ucwords(utf8_encode(strftime("%A,  %d de %B del %Y", strtotime($dia)))); 
                ?>
                </h3>
                <?php foreach($lista_eventos as $evento){ ?>
                  
                  <div class="dia">
                    <p class="titulo"><?php echo $evento['titulo'];?></p>
                    <p class="hora"><i class="far fa-clock" aria-hidden="true"></i><?php echo $evento['fecha']. " " . $evento['hora'] ;?></p>
                    <p><i class="fa <?php echo $evento['icono'];?>"></i><?php echo $evento['categoria'];?></p>
                    <p><i class="far fa-user-circle" aria-hidden="true" ></i><?php echo $evento['invitado'];?></p>
 
                  </div>

                <?php } //Fin foreach evento ?>

              <?php }//Fin foreach días?>
           

       </div> <!--Calendario-->
       <?php 
         $conn->close();         
       ?>
   </section>
   <?php include_once 'includes/templates/footer.php';?>