<?php
session_start();
require("../databases/conexion.php");
$id = $_SESSION["USER"];
$query = "SELECT p.nomb_p, p.precio FROM compra c, publicacion p, usuario u WHERE c.id_p = p.id_p and u.id_u = c.id_u and u.id_u = '$id' and p.disp = true";
$result = mysqli_query($conexion, $query);
$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
  <title>Carrito</title>
</head>
<body>
  <header>
    <nav>
    <img class="logo" src="../img/logo.png">
    <h1>BookSwap</h1>
      <ul>
        <li><a href="../index.php">Inicio</a></li>
        <li><?php if (isset($_SESSION["USER"])) {
          ?>
          <?php
            echo $_SESSION["USER"];
            ?>
            <li><a href="../session/cerrar_sesion.php">Cerrar sesion</a></li>
            <?php }?>
      </li>
      </ul>
    </nav>
  </header>
  <main>
    <h1>Carrito de compra</h1>
  <?php
    while($row =  mysqli_fetch_assoc($result)){ 
  ?>
    <ul>
    <li><?php echo $row["nomb_p"] ?></li>
    <li>$<?php echo $row["precio"] ?></li>
    <?php $total += (int)$row["precio"] ?>
    </ul>
    <?php
     }
  ?>
   <ul>
    <li>Total</li>
    <li><?php echo "$".$total ?></li>
    </ul>
    <form action = "buy.php">
    <button type="submit" name="id">Comprar</button>
    </form>
</main>
  <footer>
    <p>&copy; 2023 BookSwap</p>
  </footer>
</body>
</html>