
<?php
require_once "../config/conexion.php";

session_start();


if (isset($_SESSION['user_id'])) {
    header('Location: portafolio.php');
    exit;
}
if (isset($_POST['usuario']) && isset($_POST['clave'])) {

    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $sql = "SELECT id FROM usuarios WHERE usuario='$usuario' AND clave='$clave'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
        header('Location: portafolio.php');
        exit;

    } else {

       
        $mensaje = "Datos inválidos. Inténtalo de nuevo.";

    }
    mysqli_close($conn);

}

?>

<!DOCTYPE html>
<html>
<head>
    <!-- ------------------------------------------------------- -->
<!-- Agrega los scripts necesarios -->
<script src="https://www.gstatic.com/firebasejs/9.22.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.22.0/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.22.0/firebase-auth.js"></script>

<!-- Agrega tu configuración de Firebase aquí -->
<script>
const firebaseConfig = {
    apiKey: "AIzaSyAhFfUx9t5N2_mJ4XSjrbv_27A4PgrLNIU",
    authDomain: "portafolio-5e28f.firebaseapp.com",
    projectId: "portafolio-5e28f",
    storageBucket: "portafolio-5e28f.appspot.com",
    messagingSenderId: "596683497898",
    appId: "1:596683497898:web:7aa8e5d23d097e9f1b4bd3",
    measurementId: "G-PNYLG7BE67"
};

firebase.initializeApp(firebaseConfig);
firebase.analytics();
</script>    
    <!-- ------------------------------------------------------- -->
<link rel="stylesheet" href="admin.css">
<link href="../dist/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<script src="https://use.fontawesome.com/fefc2fb08e.js"></script>
    <title>Login</title>
</head>
<body>

<div class="boxinicio">
    <h1>Iniciar sesión</h1>

    <?php if (isset($mensaje)) { echo '<p class="alert alert-danger" role="alert" style="color:red;">' . $mensaje . '</p>'; } ?>

    <form action="index.php" method="POST" autocomplete="off">
    <div class="mb-3"> 
        <label for="exampleInputEmail1" class="form-label">Usuario</label><br>
        <input type="text" class="form-control" name="usuario" required><br>
    </div>
    <div class="mb-3">  
        <label for="exampleInputEmail1" class="form-label">Clave</label><br>
        <input type="password"  id="inputPassword5" class="form-control" aria-labelledby="passwordHelpBlock" name="clave" placeholder="password" required><br>
    </div>    
          <input type="submit" class="btn btn-primary" value="Iniciar sesión"> 
    </form>
    <a href="logingoogle.php">iniciar con Google</a>
</div>
</body>
</html>