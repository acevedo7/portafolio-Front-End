<?php
require_once "../config/conexion.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

   $user_id = $_SESSION['user_id'];
   $newtitulo =$_POST['artitulo'];
   $newtext =$_POST['arttext'];
  $insetart ="INSERT INTO `articulo`(`id_usuario`, `titulo`, `parafo`) VALUES ('$user_id','$newtitulo','$newtext')";
  $consulinsert = mysqli_query($conn,$insetart);
  if ($consulinsert){
    //    echo "todo OK";
    $alert = '<div class="alert alert-success text-center alert-dismissible fade show" role="alert">
                !Los datos se insertaron correctamente¡
            </div>';
  } else {
    echo "VERIFIQUE LOS DATOS";
  }
    mysqli_close($conn);
?>
  <?php echo (isset($alert)) ? $alert : ''; ?>

