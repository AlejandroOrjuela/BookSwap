<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <title>Tienda en línea</title>
</head>
<body>
  <header>
    <nav>
    <img href="index.php" src="img/lib.png">
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
        <li><a href="#">Iniciar sesión</a></li>
        <li><a href="#">Subir producto</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <h1>Bienvenido a nuestra tienda en línea</h1>
    <p>Aquí encontrarás una amplia variedad de productos para todos los gustos y presupuestos.</p>
    <section class="products">
      <div class="product">
        <img src="img/lib.png" alt="Product 1">
        <h3>Producto 1</h3>
        <p>$100</p>
        <button>Añadir al carrito</button>
      </div>
    </section>
  </main>
  <footer>
    <p>&copy; 2023 Tienda en línea</p>
  </footer>
</body>
</html>