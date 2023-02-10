<?php
session_start();
require("../databases/conexion.php");
$nick = $_SESSION["USER"];
$query = "SELECT * FROM usuario WHERE id_u = '$nick'";
$consulta = mysqli_query($conexion, $query);
$user = mysqli_fetch_assoc($consulta);

$query = "SELECT p.precio, p.nomb_p FROM compra c, publicacion p, usuario u WHERE c.id_p = p.id_p and u.id_u = c.id_u and u.id_u = '$nick' and p.disp = false";
$consul = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Perfil de usuario</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <header>
      <nav>
      <img class="logo" src="../img/logo.png">
      <h1>BookSwap</h1>
        <ul>
          <li><a href="../index.php">Inicio</a></li>
        </ul>
      </nav>
    </header>
    <main>
      <h1>Perfil de usuario</h1>
      <div class="profile-info">
        <p><strong>Apodo:</strong> <span id="nickname"><?php echo $user["id_u"]; ?></span></p>
        <p><strong>Nombre:</strong> <span id="name"><?php echo $user["nomb_u"]; ?></span></p>
        <p><strong>Fecha de nacimiento:</strong> <span id="birthday"><?php echo $user["fecha_nac"]; ?></span></p>
      </div>
      <div class="table">
      <h1>Historial</h1>
      <table class="default">
<tr>
  <th>Libro</th>
  <td>-----------</td>
  <th>Precio</th>
</tr>

<?php while($row = mysqli_fetch_assoc($consul)){ ?>
<tr>
  <td><?php echo $row["nomb_p"] ?></td>
  <td>-----------</td>
  <td><?php echo $row["precio"] ?></td>
</tr>
<?php } ?>

</table>
      </div>
    </main>
    <footer>
      <p>Copyright &copy; 2023</p>
    </footer>
  </body>
</html>
