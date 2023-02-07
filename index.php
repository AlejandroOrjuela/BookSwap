<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <title>Tienda en línea</title>
</head>
<body>
  <header>
    <nav>
      <div class="search-container">
        <form action="buscar.php">
          <input type="text" placeholder="Buscar productos">
          <button type="submit">Buscar</button>
        </form>
      </div>
      <ul>
        <li><a href="#">Inicio</a></li>
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
      <h2>Destacados</h2>
      <div class="product">
        <img src="product1.jpg" alt="Product 1">
        <h3>Producto 1</h3>
        <p>$100</p>
        <button>Añadir al carrito</button>
      </div>
      <div class="product">
        <img src="product2.jpg" alt="Product 2">
        <h3>Producto 2</h3>
        <p>$200</p>
        <button>Añadir al carrito</button>
      </div>
      <div class="product">
        <img src="product3.jpg" alt="Product 3">
        <h3>Producto 3</h3>
        <p>$150</p>
        <button>Añadir al carrito</button>
      </div>
    </section>
  </main>
  <footer>
    <p>&copy; 2023 Tienda en línea</p>
  </footer>
</body>
</html>