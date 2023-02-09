<?php
    require("../databases/conexion.php");
    $nick = $_POST["username"];
    $pass = $_POST["password"];
    $query = "SELECT id_u FROM usuario WHERE id_u='$nick' and clave = '$pass'";
	$consulta = mysqli_query($conexion, $query);
    
session_start();
$_SESSION['USER'] = $nick;
Header("Location:../index.php");
?>