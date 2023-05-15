<?php
require_once "../config/conexion.php";

     $inpthtml = $_POST['inpthtml'];
     $inptcss = $_POST['inptcss'];
     $inptjava = $_POST['inptjava'];

$sql = "UPDATE `estadistica` SET `valorhtml`='$inpthtml',`valorcss`='$inptcss',`valorjavascript`='$inptjava' WHERE 1";

if ($conn->query($sql) === TRUE) {
    header('Location: portafolio.php');
    echo 'Valor guardado en la base de datos: ' . $inpthtml;
} else {
    echo 'Error al guardar el valor en la base de datos: ' . $mysqli->error;
}

$conn->close();
?>