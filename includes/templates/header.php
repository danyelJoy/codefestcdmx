<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="manifest" href="site.webmanifest">
  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/fontawesome.min.css">
  <link rel="stylesheet" href="css/all.min.css">
  <link rel="stylesheet" href="css/all.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Oswald&family=PT+Sans&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />



<?php 
    $archivo = basename($_SERVER['PHP_SELF']);
    $pagina = str_replace(".php", "", $archivo);

?>
<link rel="stylesheet" href="css/colorbox.css">
<link rel="stylesheet" href="css/main.css">

  <meta name="theme-color" content="#fafafa">
</head>



<body class="<?php echo $pagina?>">
  <!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->

   <header class="site-header">
     <div class="hero">
        <div class="contenido-header">
          <nav class="redes-sociales">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-pinterest-p"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
          </nav>
          <div class="informacion-evento">
            <div class="clearfix">
              <p class="fecha"><i class="far fa-calendar-alt"></i>11-12 Dic</p>
              <p class="ciudad"><i class="fas fa-map-marker-alt"></i>CDMX, México</p>
            </div>            
            <h1 class="nombre-sitio">codefestcdmx</h1>
            <P class="slogan">La mejor conferencia de <span>desarrollo y TI</span></P>
          </div> <!--Información evento--> 
        </div>   
     </div> <!--.hero -->
   </header>
   <div class="barra">
     <div class="contenedor clearfix">
       <div class="logo">
         <a href="index.php">
         <img src="img/ocelotl.svg" alt="logo cdmxwebcam" >
         </a>
       </div>
       <div class="menu-movil">
         <span></span>
         <span></span>
         <span></span>
       </div>
       <nav class="navegacion-principal">
         <a href="conferencia.php">Conferencia</a>
         <a href="calendario.php">Calendario</a>
         <a href="invitados.php">Invitados</a>
         <a href="registro.php">Reservaciones</a>
       </nav>
     </div><!--Contenedor-->
   </div><!--Barra-->