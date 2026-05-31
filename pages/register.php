<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="../css/app.css"></link>
</head>
<body>
  <section class="form-registration">
    <div class="title-form">
      <h1 class="title">Register Account</h1>
    </div>
    <form class="form-registration-platform" id="form-registration-platform">
      <div class="row-form">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Alberto"/>
      </div>
      <div class="row-form">
        <label for="lastName">Last Name</label>
        <input type="text" id="lastName" name="lastName" placeholder="Moreno"/>
      </div>
      <div class="row-form">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="email@example.com"/>
      </div>
      <div class="row-form">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="*********"/>
      </div>
      <div class="row-form">
        <label for="confirm-password">Confirm password</label>
        <input type="password" id="confirm-password" name="confirm-password" placeholder="*********"/>
      </div>
        <div class="button-container">
          <button type="submit" class="input-register-form">Create account</button>
        </div>
    </form>
    <div class="navegation-forms">
      <a class="  v" href="../pages/login.php">¿ya tienes una cuenta? Inicia sesion aquí</a>

    </div>
  </section>
  <script src="../JavaScript/register.js"></script>
</body>
</html>