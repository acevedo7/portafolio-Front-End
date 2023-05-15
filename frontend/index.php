<?php
require_once "config/conexion.php";

$user_id = 1;
$sql = "SELECT id, nombre, curso, ciudad, imagen FROM usuarios WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);
  
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $nombre = $row['nombre'];
    $curso = $row['curso'];
    $ciudad = $row['ciudad'];
    $imagen = $row['imagen'];
} else {
    die("Error: No se pudo encontrar la información del usuario.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link href="dist/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <script src="https://use.fontawesome.com/fefc2fb08e.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="codigo.js" ></script>
    <title>Mi portafolio PHP</title>
</head>
<body>
<header>
        <div id="container">
            <img id="small-img" alt="Small Image" class="img-thumbnail" src="admin/img/<?php echo $imagen; ?>" width="160">
            <img id="big-img" src="img/imagen portada.jpg" alt="Big Image">   
        </div>
        <div id="infodiv">
            <h1><b><?php echo $nombre; ?></b></h1>
            <p><b>Curso: </b><span> <?php echo $curso; ?></span></p>
            <p><b>Ciudad:</b><span> <?php echo $ciudad; ?></span></p>
        </div>
            <div class="contenedornav" role="group" aria-label="Basic radio toggle button group">
              <nav>
                <ul>
                  <li class="btn btn-outline-primary"><a href="#">Inicio</a></li>
                  <li class="btn btn-outline-primary"><a href="#estadisticas">Graficos</a></li>
                  <li class="btn btn-outline-primary"><a href="#">Experiencia</a></li>
                  <li class="btn btn-outline-primary"><a href="#">Acerca de</a></li>
                </ul>
              </nav>
            </div>
        <div style="display:none;">
            <div class="dropdown-center">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Opciones
                </button>
                <ul class="dropdown-menu">
                  <li><a href="#">Inicio</a></li>
                  <li><a href="#estadisticas">Graficos</a></li>
                  <li><a href="#">Experiencia</a></li>
                  <li><a href="#">Acerca de</a></li>
                </ul>
              </div>
        </div>
</header>
<style>

</style>
<?php  
   $articulos ="SELECT `id`, `id_usuario`, `titulo`, `parafo` FROM `articulo` WHERE id_usuario='$user_id'";
   $Consultar = mysqli_query($conn,$articulos);
?>  <div id="cajas">
  <div class="card"> 
<div class="card-body">
  <h5 class="card-title">Para el profesor.</h5>
  <p class="card-text" id="cambiartext">para ingresar al panel de admin <a href="admin/index.php"> Click aquí</a>Usuario: ema Clave: 1234</p>
</div>
<?php
while ($texart = mysqli_fetch_assoc($Consultar)) {
?> <div class="card"> 
<div class="card-body">
  <h5 class="card-title"><?php echo $texart['titulo'] ?></h5>
  <p class="card-text" id="cambiartext" ><?php echo $texart['parafo'] ?></p>
</div>
</div>
  <?php    
}
?>

<?php    
$sqlestadistica = "SELECT `id`, `valorhtml`, `valorcss`, `valorjavascript` FROM estadistica WHERE id='$user_id'";
$resultestadistica = mysqli_query($conn, $sqlestadistica);
  
if (mysqli_num_rows($resultestadistica) > 0) {
    $sta = mysqli_fetch_assoc($resultestadistica);
    $divhtml = $sta['valorhtml'];
    $divcss = $sta['valorcss'];
    $divjava = $sta['valorjavascript'];
} else {
    die("Error: No se pudo encontrar la estadisticas del usuario.");
}
?>
<div id="estadisticas"> 
      <h2>Conosimientos en las siguientes tecnologias</h2>
     <label>Uso en HTML <b> <?php echo $divhtml ?>%</b></label>
  <div class="progress">
    <?php
  echo  "<div class='progress-bar htmlprogress' style='width:{$divhtml}%;' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'></div>";
  ?>
  </div>
  <label>Uso en CSS <b> <?php echo $divcss ?>%</b></label>
    <div class="progress">
    <?php
  echo  "<div class='progress-bar css-progress' style='width:{$divcss}%;' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'></div>";
  ?>
   </div>
   <label>Uso en JavaScript <b> <?php echo $divjava ?>%</b></label>
   <div class="progress">
   <?php
  echo  "<div class='progress-bar java-progress' style='width:{$divjava}%;' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'></div>";
  ?>
   </div>
</div>
</div>
</div>
<footer>
  <hr>
  <div class="div-social">
     <h5>Redes sociales</h5>
    <ul>
      <li><i class="fa fa-github"></i> github</li>
      <li><i class="fa fa-instagram"></i> instagram</li>
      <li><i class="fa fa-linkedin-square"></i> linkedin</li>
    </ul>
  </div>
   <div class="div-centro">
    <label for="">creado y diseñado por:<b> Acevedo Emanuel</b></label>
        <p>2023</p>
   </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>     
</body>
</html>
