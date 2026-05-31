<?php
  $mostrarPopup = false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cuentas page</title>
  <link rel="stylesheet" href="../css/app.css">
</head>
<body>
  <section class="Navigation-bar">
    <nav>
      <div class="TitlePage">
        <h1 class="Title">Economic App</h1>
      </div>
      <div class="button-nav">
        <a href="../pages/dashboard.php" class="link-button">inicio</a>
      </div>
      <div class="button-nav">
        <a href="../php/auth/logout.php" class="link-button">logout</a>
      </div>
    </nav>
  </section>
    <div class="menu">
      <button id="activeFormCuenta">Agregar una nnueva cuenta</button>
    </div>
    <div class="formCuenta" id="formCuenta">
      <div class="modalContent">
        
      </div>
    </div>
  </section>
  <script src="../JavaScript/cuentas.js"></script>
</body>
</html>