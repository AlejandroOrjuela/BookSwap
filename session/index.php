<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <title>Página de inicio de sesión</title>
</head>
<body>
  <header>
    <nav>
      <ul>
        <li><a href="#">Inicio</a></li>
        <li><a href="#">Carrito de compra</a></li>
        <li><a href="#">Iniciar sesión</a></li>
        <li><a href="#">Subir producto</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <h1>Inicio de sesión</h1>
    <section class="login-form">
      <form action="validar_usuario.php" method="post">
        <input type="text" name="username" placeholder="Usuario">
        <br><br>
        <input type="password" name="password" placeholder="Contraseña">
        <br><br>
        <button type="submit">Iniciar sesión</button>
      </form>
    </section>
    <h1>Registro de usuario</h1>
    <section class="register-form">
      <form action="registrar_usuario.php" method="post">
        <input type="text" name="username" placeholder="Nombre de perfil">
        <br><br>
        <input type="text" name="real_name" placeholder="Nombre real">
        <br><br>
        <input type="password" name="password" placeholder="Contraseña">
        <br><br>
        <input type="checkbox" name="is_seller" value="1"> Soy un vendedor
        <br><br>
        <button type="submit">Registrar</button>
      </form>
    </section>
  </main>
  <footer>
    <p>&copy; 2023 Tienda en línea</p>
  </footer>
</body>
</html>
