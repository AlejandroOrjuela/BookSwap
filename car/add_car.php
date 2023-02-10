<?php
require("../databases/conexion.php");
session_start();
$nick = $_SESSION["USER"];
$cod = $_GET["id"];

$query = "INSERT INTO compra (id_p, id_u, pagado) VALUES ('$cod','$nick', false)";
$consulta = mysqli_query($conexion, $query);
Header("Location:../index.php");
?>