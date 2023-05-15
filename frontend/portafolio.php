<?php

require_once "../config/conexion.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$user_id = $_SESSION['user_id'];
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
<?php
if (isset($_POST) && isset($_FILES['foto']) && !empty($_FILES['foto']['name'])){
    $img = $_FILES['foto'];
    $name = $img['name'];
    $tmpname = $img['tmp_name']; 
    $fecha = date("YmdHis");
    $foto = $fecha . ".jpg";
    $destino = "img/" . $foto;
    $query = mysqli_query($conn, "UPDATE usuarios SET imagen='$foto' WHERE id='$user_id' ");
    if ($query) {
        if (move_uploaded_file($tmpname, $destino)) {
            $filas_afectadas = mysqli_affected_rows($conn);
            if ($filas_afectadas > 0) {
                // header('Location: portafolio.php');
                $alert = '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                !La foto de perfil se actualizo correctamente¡
            </div>';   
            } else {
                echo "Error al actualizar la imagen en la base de datos";
            }
        }
    }
}
?> 
<?php  if(isset($_POST['datosperso'])){ 
   $nombre =$_POST['newnombre']; 
   $curso =$_POST['newcurso'];
   $ciudad =$_POST['newciudad'];
   $sqldatos="UPDATE `usuarios` SET `nombre`='$nombre',`curso`='$curso',`ciudad`='$ciudad' WHERE id='$user_id'";
   $enviodedatos=mysqli_query($conn,$sqldatos);
   if($enviodedatos){
    echo "los datos se actualizaron";
//     $alert = '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">
//     !Los datos se actualizaron correctamente¡
// </div>';
   } else {
    echo "no se pudo actualizar";
   }
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
<header class="principalheder">
<img onclick="cambiarfoto()" id="btnfoto" class="img-thumbnail" title="foto de perfil" src="img/<?php echo $imagen; ?>" width="80">
<h1>Portafolio de <?php echo $nombre; ?></h1>
 <nav>
      <a class="dropdown-item" onclick="return confirm('¿Estás seguro de que deseas salir?')" href="salir.php">Salir <i class="fa fa-sign-out"></i></a>
</nav>       
</header>
  <form id="formfoto" action="" method="POST" enctype="multipart/form-data">  
            <input type="file" id="formFile" class="form-control" name="foto" required>
        <button class="btn btn-primary" type="submit">Guardar foto</button>
        <button class="btn btn-danger" onclick="ocultarform()" type="buton">Cancelar</button>
  </form>
<div> 
  
    <div class="box-informacion"> 
      <h3><b>Tu Información de usuario:</b></h3>
        <ul>
            <li>ID: <?php echo $user_id; ?></li>
            <li>Nombre: <?php echo $nombre; ?></li>
            <li>Curso: <?php echo $curso; ?></li>
            <li>Ciudad: <?php echo $ciudad; ?></li>
        </ul>
    </div>
    <?php echo (isset($alert)) ? $alert : ''; ?>
      <div class="box-btn-header">
          <button type="button" onclick="mostrarmodal()" id="btnnewpublic" class="btn btn-info">Publicar nuevo articulo</button>
          <button class="btn btn-primary" type="buton">Estadisticas</button>
          <button id="compra-enlace" class="btn btn-success" ><i class="fa fa-pencil-square-o"></i> Editar mís datos</button>
      </div>  
      <hr>
</div>

<style>
#formfoto {
  display: none;
}
.box-informacion {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: flex-start;
}

.box-btn-header {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
  }
.card-body {
    border: thin solid black;
    border-radius: 0.5rem;
    padding: 1% 2%;
    margin: 0% 2%;
    background: #3a3ace4a;
}
</style>   
<!-- ----------------------------------------------------- -->
<?php  
   $articulos ="SELECT `id`, `id_usuario`, `titulo`, `parafo` FROM `articulo` WHERE id_usuario='$user_id'";
   $Consultar = mysqli_query($conn,$articulos);
?><div class="card">
       <h2>Tus publicaciones</h2>
<?php
while ($texart = mysqli_fetch_assoc($Consultar)) {
?> 
  <!-- <from method="POST"> -->
<div class="card-body">
  <h5 class="card-title"><?php echo $texart['titulo'] ?></h5>
   <div>
    <?php echo "<a class='btn btn-warning' href='editarpubli.php?id=".$texart['id']."'><i class='fa fa-pencil-square-o'></i>Editar</a>";?>
   <input type="hidden" value="<?php echo $texart['id']; ?>">
    <?php echo "<a class='btn btn-danger' href='eliminararti.php?id=".$texart['id']."'><i class='fa fa-trash-o'></i> Eliminar</a>";?>
  </div>
  <p class="card-text" id="cambiartext" ><?php echo $texart['parafo'] ?></p>
</div>
 <hr>
<!-- </form> -->
<!-- </div> -->
  <?php
      
}
?> </div>

   <!-- <button type="button" onclick="mostrarmodal()" id="btnnewpublic" class="btn btn-info">Publicar nuevo articulo</button> -->

   <div id="modalpublic" class="modalpublic" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">publicar texto</h5>
        <button type="button" onclick="ocultarmodel()" id="btncerrar" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="mb-3">
        <form action="publicar.php" method="POST" enctype="multipart/form-data">
  <label class="modal-title">titulo</label>
  <input type="text" class="form-control" name="artitulo" placeholder="titulo">
      </div>
      <div class="mb-3">
      <label class="modal-title">articulo</label>
    <textarea class="form-control" name="arttext" aria-label="With textarea"></textarea>
     </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
        <button type="submit" class="btn btn-primary">Publicar</button>
        </form>
      </div>
    </div>
  </div>
</div>

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
<!-- ----------------------------------- -->
   <div class="div-estadisticas">
    <h3>Estadisticas</h3>
    <hr>
 <form action="estadisticas.php" method="post">
<div class="progress">
  <div class="progress-bar dynamic-progress" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
</div>
       <label for="rangeInput">HTML</label>
       <?php
  echo  "<div class='progress-bar htmlprogress' style='width:{$divhtml}%;' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'></div>";
  ?>
     <input type="range" id="rangeInput" name="inpthtml" min="0" max="100" value="<?php echo $divhtml ?>">
       <label for="rangeInput">CSS</label>
     <input type="range" id="rangecss" name="inptcss" min="0" max="100" value="<?php echo $divcss ?>">     
     <label for="rangeInput">JavaScript</label>
     <input type="range" id="rangejava" name="inptjava" min="0" max="100" value="<?php echo $divjava ?>">
            <button type="submit" id="guardarBtn">Guardar</button>
</form>
    </div>

<script>
const progressBar = document.querySelector('.dynamic-progress');
const rangeInput = document.getElementById('rangeInput');
const guardarBtn = document.getElementById('guardarBtn');

rangeInput.addEventListener('input', () => {
  const value = rangeInput.value;
  progressBar.style.width = value + '%';
});

guardarBtn.addEventListener('click', () => {
  const value = rangeInput.value;
 
  alert('Valor guardado en la base de datos: ' + value);
});
</script>
<!-- ------------------------------------------------------- -->
<div id="compra-modal" class="modal modalcom" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
  <div class="modal-contenido">
    <span class="cerrarcom">&times;</span>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">   
     <h2>Editar tus datos personales</h2>
     <hr>
<div class="mb-3">
  <label class="form-label">Nombre</label>
  <input type="text" class="form-control" value="<?php echo $nombre; ?>" name="newnombre">
</div>
<div class="mb-3">
  <label class="form-label">Curso</label>
  <input type="text" class="form-control" maxlength="50" value="<?php echo $curso; ?>" name="newcurso">
</div>
<div class="mb-3">
  <label class="form-label">Ciudad</label>
  <input type="text" class="form-control" maxlength="50" value="<?php echo $ciudad; ?>" name="newciudad">
</div>
<!-- <div class="form-floating">
  <textarea class="form-control" maxlength="150" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="tiedadescrip" ></textarea>
  <label for="floatingTextarea2">Comments</label>
</div> -->
 <button type="submit" name="datosperso" class="btn btn-primary">Guardar</button>
</form>
  </div> 
</div>
<!-- ------------------------------------------------------- -->
     <script src="../assets/js/scripts.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>     
   
</body>
</html>

<?php

mysqli_close($conn);

?>
