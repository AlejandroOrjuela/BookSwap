<?php
    require("../databases/conexion.php");
    $nick = $_POST["username"];
    $name = $_POST["real_name"];
    $nac = $_POST["nac"];
    $pass = $_POST["password"];
    if($_POST["is_seller"])
    {
        $ven=1;
    } else {
    $ven = 0;}
echo $ven . "dsqaqas";
    $query = "INSERT INTO usuario (id_u, nomb_u, clave, fecha_nac, vendedor) VALUES ('$nick','$name','$pass' ,'$nac', $ven)";
	$consulta = mysqli_query($conexion, $query);
session_start();
$_SESSION['USER'] = $nick;
Header("Location:../index.php");
?>