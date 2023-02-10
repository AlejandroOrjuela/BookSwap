<?php
session_start();
require("../databases/conexion.php");
$id = $_SESSION["USER"];
$query = "SELECT c.id_c, p.id_p FROM compra c, publicacion p, usuario u WHERE c.id_p = p.id_p and u.id_u = c.id_u and u.id_u = '$id' and c.pagado = false";
$result = mysqli_query($conexion, $query);
$row = mysqli_fetch_assoc($result);
while($row = mysqli_fetch_assoc($result)){
    $id_p = $row["id_p"];
    $id_c = $row["id_c"];
    echo $id_p." ".$id_c;
    $update = "UPDATE publicacion SET disp = 0 WHERE id_p = '$id_p'";
    $up = mysqli_query($conexion, $update);
    $delete = "DELETE FROM compra WHERE id_c <> $id_c AND id_p = '$id_p'";
    $del = mysqli_query($conexion, $delete);
}

Header("Location:../index.php");
?>