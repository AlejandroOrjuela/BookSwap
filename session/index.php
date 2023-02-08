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
        <input type="text" name="username" placeholder="Usuario" autocomplete="on" required>
        <br><br>
        <input type="password" name="password" placeholder="Contraseña" required>
        <br><br>
        <button type="submit">Iniciar sesión</button>
      </form>
    </section>
    <h1>Registro de usuario</h1>
    <section class="register-form">
      <form action="registrar_usuario.php" method="post">
      <p>Nickname(necesario para iniciar sesion):</p>
        <input type="text" name="username" placeholder="Nickname" required>
        <br><br>
        <p>Nombre real</p>
        <input type="text" name="real_name" placeholder="Nombre real" required>
        <br><br>
        <p>Fecha de nacimiento</p>
        <input name="nac" type="date" value="2022-08-02" required>
        <br><br>
        <p>Contraseña</p>
        <input type="password" name="password" placeholder="Contraseña" required>
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
