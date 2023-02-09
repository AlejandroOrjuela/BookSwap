<?php
session_start();
require("databases/conexion.php");
$query = "SELECT * FROM publicacion";
$libro = mysqli_query($conexion, $query);

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
  <title>Tienda en línea</title>
</head>
<body>
  <header>
    <nav>
    <img class="logo" src="img/logo.png">
    <h1>BookSwap</h1>
      <div class="search-container">
        <form action="buscar.php">
          <input type="text" placeholder="Buscar productos">
          <button type="submit">Ir</button>
        </form>
      </div>
      <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><?php if (isset($_SESSION["USER"])) {
          ?>
          <li><a href="#">Carrito de compra</a></li>
          <li><a href="publication/index.php">Subir producto</a></li>
          <?php
            echo $_SESSION["USER"];
            ?>
            <li><a href="session/cerrar_sesion.php">Cerrar sesion</a></li>
            <?php
          }else{ ?><a href="session/index.php">Iniciar sesión</a>
        <?php }?>
      </li>
      </ul>
    </nav>
  </header>
  <main>
    <h1>Bienvenido a nuestra tienda en línea</h1>
    <p>Aquí encontrarás una amplia variedad de productos para todos los gustos y presupuestos.</p>
    <section class="products">
    <?php
     while($row = mysqli_fetch_assoc($libro)){ 
     ?>
      <div class="product">
        <img class="portada" src="img/lib.png" alt="Product 1">
        <h3><?php echo $row["nomb_p"] ?></h3>
        <p><?php
        $id = $row["id_p"];
        $query = "SELECT nomb_u FROM usuario,publicacion WHERE id_p = '$id' and publicacion.id_u = usuario.id_u";
        $autor = mysqli_query($conexion, $query);
        $nombre = mysqli_fetch_assoc($autor);
        echo $nombre["nomb_u"] 
        ?></p>
        <p><?php echo $row["precio"] ?></p>
        <p><?php echo $row["descr"] ?></p>
        <button>Añadir al carrito</button>
      </div>
      <?php } ?>
    </section>
  </main>
  <footer>
    <p>&copy; 2023 Tienda en línea</p>
  </footer>
</body>
</html>