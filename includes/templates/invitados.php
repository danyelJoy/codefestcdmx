<section class="seccion contenedor">
       
       <?php 
         try {
             require_once('includes/funciones/bd.conexion.php');
             $sql = " SELECT * FROM `invitados` ";       
             $resultado = $conn->query($sql);

         }catch(Exception$e){
             echo $e->getMessage();
         }       
       ?>

    
           
    
                <h2>Nuestros Invitados</h2>
                <ul class="lista-invitados clearfix">

                  <?php while($invitados = $resultado->fetch_assoc()){?>
                        <li>
                            <div class="invitado">
                                <a class="invitado-info" href="#invitado<?php echo $invitados['invitado_id'];?>">
                                    <img src="img/invitados/<?php echo $invitados['url_imagen']?>" alt="imagen invitado">
                                    <p><?php echo $invitados['nombre']. " " . $invitados['apellido']; ?></p>
                                </a>
                            </div>
                        </li>
                        <div style="display:none;">
                            <div class="invitado-info" id="invitado<?php echo$invitados['invitado_id']; ?>" >
                                <h2> <?php echo $invitados['nombre']. " " . $invitados['apellido'];?></h2>
                                <img src="img/invitados/<?php echo $invitados['url_imagen']?>" alt="imagen invitado">
                                <p><?php echo $invitados['descripcion']; ?></p>
                            
                            </div>

                        </div>
                  <?php } ?>
            
                </ul>
          
       <?php 
         $conn->close();         
       ?>
   </section>