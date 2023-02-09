<?php
    require("../databases/conexion.php");
    session_start();
    $id = $_POST["book-id"];
    $name = $_POST["book-name"];
    $pre = $_POST["book-price"];
    $desc = $_POST["descripcion"];
    $id_u=$_SESSION["USER"];
echo "$id";
echo "$name";
echo "$pre";
echo "$desc";
echo "$id_u";

    $query = "INSERT INTO publicacion (id_p, id_u, nomb_p, precio, descr, disp) VALUES ('$id','$id_u','$name' ,$pre, '$desc',true)";
	$consulta = mysqli_query($conexion, $query);

Header("Location:../index.php");
?>