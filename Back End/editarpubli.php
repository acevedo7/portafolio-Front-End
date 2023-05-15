<?php
require_once "../config/conexion.php";
 
    $idart =$_GET['id'];
 if(isset($_POST['enviar'])){
    $newtitulo =$_POST['inputitulo'];
    $newtexto =$_POST['inputtexto'];
     $consulart ="UPDATE `articulo` SET `titulo`='$newtitulo',`parafo`='$newtexto' WHERE id='$idart'";
     $resultart = mysqli_query($conn, $consulart);
      if ($resultart) {
        echo "Todo OK";
        header('Location: portafolio.php');
      } else {
        echo "¡Verifica los datos!";
      }
}
    //  echo $idart;
     $extraart = "SELECT `id`, `id_usuario`, `titulo`, `parafo` FROM `articulo` WHERE id='$idart'";
     $consultar = mysqli_query($conn, $extraart);
    
     if (mysqli_num_rows($consultar) > 0) {
        $row = mysqli_fetch_assoc($consultar);
        $nombre = $row['id_usuario'];
        $curso = $row['titulo'];
        $ciudad = $row['parafo'];
        $imagen = $row['id'];
    } else {
        die("Error: No se pudo encontrar la información del usuario.");
    }
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="admin.css">
<link href="../dist/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<script src="https://use.fontawesome.com/fefc2fb08e.js"></script>
    <title>admin Portafolio</title>
</head>
<body>
  <div class="boxpubli"> 
         <h1>Editar tu publicación N°<?php  echo $idart ?></h1> 
    <form  method="POST" enctype="multipart/form-data"> 
         <label class="form-label">Titulo actual</label>
      <input type="text" name="inputitulo" class="form-control" value="<?php echo $curso ?>" >
         <label class="form-label">Publicación actual</label>
      <textarea class="form-control" name="inputtexto" cols="30" rows="10"><?php echo $ciudad ?></textarea>
      <button type="submit" class="btn btn-primary" name="enviar">Guardar</button>
    </form>
  </div>
</body>