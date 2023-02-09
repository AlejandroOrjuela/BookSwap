<?php
    require("../databases/conexion.php");
    $nick = $_POST["username"];
    $pass = $_POST["password"];
    $query = "SELECT id_u FROM usuario WHERE id_u='$nick' and clave = '$pass'";
	$consulta = mysqli_query($conexion, $query);
    $row = mysqli_fetch_assoc($consulta);
if (isset($row)){
    session_start();
    $_SESSION['USER'] = $nick;
    $_SESSION['PASS'] = $pass;
}

Header("Location:../index.php");
?>