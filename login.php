<?php
session_start();
if (isset($_SESSION['ativo'])) {
  if ($_SESSION['ativo'] == true) {
    header("Location: index.php");
  }
}


require('config.php');
require('assets/class/login.class.php');


if (isset($_POST['username']) && !empty($_POST['password'])) {
  $username = filter_input(INPUT_POST, 'username');
  $password = filter_input(INPUT_POST, 'password');

  $login = new Login($pdo);

  $login->setUser($username);
  $login->setPass($password);

  $login->fazerLogin();
}




?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controles</title>

  <link rel="stylesheet" type="text/css" href="assets/css/login.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
  </script>
</head>

<div id="login">
  <h3 class="text-center text-white pt-5">Login form</h3>
  <div class="container">
    <div id="login-row" class="row justify-content-center align-items-center">
      <div id="login-column" class="col-md-6">
        <div id="login-box" class="col-md-12">

          <form id="login-form" class="form" action="" method="post">
            <h3 class="text-center text-info">Login</h3>
            <div class="form-group">
              <label for="username" class="text-info">Usuario:</label><br>
              <input type="text" name="username" id="username" class="form-control">
            </div>
            <div class="form-group">
              <label for="password" class="text-info">Senha:</label><br>
              <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
              <input type="submit" name="submit" class="btn btn-info btn-md" value="Acessar">
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>



</body>

</html>