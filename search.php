<?php
session_start();
require("databases/conexion.php");

$bus = $_POST["pet"];

$query = "SELECT * FROM publicacion WHERE disp = true AND nomb_p = '$bus'";
$libro = mysqli_query($conexion, $query);



?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css">
  <title>BookSwap</title>
</head>
<body>
  <header>
    <nav>
    <img class="logo" src="img/logo.png">
    <h1>BookSwap</h1>
      <div class="search-container">
        <form action="search.php" method = "post">
          <input type="text" placeholder="Buscar productos" name ="pet">
          <button type="submit">Buscar</button>
        </form>
      </div>
      <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><?php if (isset($_SESSION["USER"])) {
          ?>
          <li><a href="car/index.php">Carrito de compra</a></li>
          <li><a href="publication/index.php">Subir producto</a></li>
          <li><a href="perfil/index.php">
          <?php echo $_SESSION["USER"]; ?>
            </a></li>
            <li><a href="session/cerrar_sesion.php">Cerrar sesion</a></li>
            <?php
          }else{ ?><a href="session/index.php">Iniciar sesión</a>
        <?php }?>
      </li>
      </ul>
    </nav>
  </header>
  <main>
    <h1>Bienvenido a BookSwap</h1>
    <p>Aquí encontrarás una amplia variedad de productos para todos los gustos y presupuestos.</p>
    <section class="products">
    <?php
     while($row = mysqli_fetch_assoc($libro)){ 
     ?>
      <div class="product">
        <img class="portada" src="img/lib.png" alt="Product 1">
        <h3><?php echo $row["nomb_p"] ?></h3>
        <p>Publicador: <?php
        $id = $row["id_p"];
        $query = "SELECT nomb_u FROM usuario,publicacion WHERE id_p = '$id' and publicacion.id_u = usuario.id_u";
        $autor = mysqli_query($conexion, $query);
        $nombre = mysqli_fetch_assoc($autor);
        echo $nombre["nomb_u"] 
        ?></p>
        <p>Precio: <?php echo "$".$row["precio"] ?></p>
        <p>Descripcion:  <?php echo $row["descr"] ?></p>
        <?php if(isset($_SESSION["USER"])) {?>
        <form action="car/add_car.php">
        <?php }else{  ?>
          <form action="session/index.php">
        <?php }  ?>  
          <button type="submit" name="id" value= "<?php echo $row["id_p"] ?>">Añadir al carrito</button>
        </form>
      </div>
      <?php } ?>
    </section>
  </main>
  <footer>
    <p>&copy; 2023 BookSwap</p>
  </footer>
</body>
</html>