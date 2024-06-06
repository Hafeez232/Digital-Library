<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Boxicons CSS -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <title>Login - Bit-Lib</title>
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
  <div class="login-container">
    <div class="logo-and-title">
      <img src="images/books.png" alt="Bit-Library Logo">
      <h2>Bit-Library</h2>
    </div>
    <h3>Sign-In</h3>
    <?php
    session_start();
    if (isset($_SESSION['error'])) {
        echo "<p style='color: red;'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    ?>
    <form action="php/login.php" method="post" id="login-form">
      <div class="input-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit">Login</button><br><br>
      <label>Don't have an account?</label>
      <a href="signup.html">Sign Up</a><br><br>
      <label>Psst. Are you an Admin?</label>
      <a href="admin.php">Here</a>
    </form>
  </div>
  <script src="login.js"></script>
</body>
</html>
