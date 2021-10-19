<?php include_once 'includes/templates/header.php';
use PayPal\Api\PaymentExecution;
use PayPal\Rest\ApiContext;
use PayPal\Api\Payment;

require 'includes/paypal.php';

?>


<section class="seccion contenedor">
    <?php
    
        $paymentId = $_GET['paymentId'];
        $id_pago = (int) $_GET['id_pago'];

        //Peticiona REST API        
        $payment = Payment::get($paymentId, $apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId( $_GET['PayerID'] );

         //Tiene la información de la transacción 
        $resultado-> $payment->execute($execution, $apiContext);
        $respuesa = $resultado->$transactions[0]->related_resources[0]->sale->state;

        if($respuesa == "completed"){
            echo"<div class='resultado correcto'>";
            echo"El pago se realizó correctamente";
            echo"El ID es {$paymentId}";
            echo"</div>";

            require_once('includes/funciones/bd.conexion.php');
            $stmt->$conn->prepare('UPDATE `registrados` SET `pagado` = ? WHERE `id_registrado` = ? ');
            $pagado = 1;
            $stmt->bind_param('ii', $pagado, $id_pago);
            $stmt->execute();
            $stmt->close();
            $conn->close();
        }else {
            echo"<div class='resultado error'>";            
            echo "El pago  no se realizó";
            echo"</div>";
        }
     ?>
</section>   


<?php include_once 'includes/templates/footer.php';?>