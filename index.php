<?php
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
    <img class="logo" href="index.php" src="img/logo.png">
      <div class="search-container">
        <form action="buscar.php">
          <input type="text" placeholder="Buscar productos">
          <button type="submit">Ir</button>
        </form>
        <form action="buscar.php">
        <select id="categoria" name="categoria">
        <option value="">Selecciona una categoría</option>
        <option value="libros">Libros</option>
        <option value="electronica">Electrónica</option>
        <option value="ropa">Ropa</option>
      </select>
      
      <button type="submit">Filtrar</button>
    </form>
  
      </div>
      <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="#">Carrito de compra</a></li>
        <li><a href="session/index.php">Iniciar sesión</a></li>
        <li><a href="#">Subir producto</a></li>
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