<?php
include 'php/db.php';
session_start();
if (isset($_SESSION['user'])) exit(header("Location: index.php"));

if (isset($_POST['username'])) {
  $user = $_POST['username'];
  $pass = $_POST['password'];
  $redirect = $_GET['redirect'];
  
  if ($redirect == "") $redirect = "/";
  
  $sqlout = $conn->query("SELECT * FROM `user` WHERE `username`='$user' AND `password`='$pass' LIMIT 1");
  if ($sqlout->num_rows > 0)  {
    $_SESSION['user'] = $user;
    exit(header("Location: " . $redirect));
  }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f8f9fa;
    }
    .login-container {
      width: 100%;
      max-width: 400px;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      background-color: #fff;
      text-align: center;
    }
    .app-icon {
      width: 200px;
      height: 200px;
      margin: 20px auto;
    }
    h2 {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
  </style>
</head>
<body class="bg-light d-flex justify-content-center align-items-center min-vh-100">

  <div class="login-container">
    <h2>Login</h2>

    <!-- Dummy Icon -->
    <img src="https://www.bildteknik.com/wp-content/uploads/Monitoring-icon.png" alt="App Icon" class="app-icon" />

    <form action="" method="post">
      <div class="mb-4 text-start">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Enter email" required />
      </div>
      <div class="mb-3 text-start">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required />
      </div>
      <div class="d-grid">
        <button type="submit" class="btn btn-dark">Login</button>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
