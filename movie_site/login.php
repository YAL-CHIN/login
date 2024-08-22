<?php
include 'includes/db.php';
include 'includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (login($username, $password)) {
        header('Location: index.php');
        exit;
    } else {
        $error = "Invalid login credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
    <div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="wrapper">
        <div class="form" id="form1">
          <div class="title">Login</div>
          <form action="#" class="loginForm">
            <div class="profileImage">
              <i class="fa fa-user-circle-o" aria-hidden="true"></i>
            </div>
            <div class="form-group">
              <i class="fa fa-envelope form-icon"></i>
              <input type="email" class="form-control" id="email" placeholder="Email">
            </div>
            <div class="form-group">
              <i class="fa fa-lock form-icon"></i>
              <input type="password" class="form-control" id="pwd" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-default">login</button>
          </form>
        </div>
        <div class="form form-horizontal" id="form2">
          <div class="title">Sign Up</div>
          <form action="#" class="signupForm">
            <div class="profileImage">
              <i class="fa fa-user-circle-o" aria-hidden="true"></i>
            </div>
            <div class="form-group">
              <i class="fa fa-envelope form-icon"></i>
              <input type="email" class="form-control" id="email" placeholder="Email">
            </div>
            <div class="form-group">
              <i class="fa fa-lock form-icon"></i>
              <input type="password" class="form-control" id="pwd" placeholder="Password">
            </div>
            <div class="form-group">
              <i class="fa fa-lock form-icon"></i>
              <input type="password" class="form-control" id="repwd" placeholder="Retype-Password">
            </div>
            <button type="submit" class="btn btn-default">Sign up</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="./assets/js/script.js"></script>
</body>
</html>
