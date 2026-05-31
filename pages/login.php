  <?php
  session_start();

  if (isset($_SESSION['logged_in'])&& $_SESSION['logged_in'] === true) {
    header("Location: dashboard.php");
    exit;
  }

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../css/app.css">
</head>
<body> 
  <section class="form-registration">
    <div class="title-form">
      <h1 class="title">Login Account</h1>
    </div>
    <div class="card-login">
      <form class="form-registration-platform" id="login-form">
        <div class="row-form">
          <label for="email">Email</label>
          <input type="email" id="email" name="email"/>
        </div>
        <div class="row-form">
          <label for="password">Password</label>
          <input type="password" id="password" name="password"/>
        </div>
        <div class="button-container">
          <button type="submit" class="input-register-form">Create account</button>
        </div>
      </form>
    </div>
  </section>
  <script src="../JavaScript/login.js"></script>
</body>
</html>