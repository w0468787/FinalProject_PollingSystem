<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h2>Login</h2>
    <form action="" method="post">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" autocomplete="off">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" autocomplete="off">
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
    </form>
  </div>
  <?php 
  include_once '../Config/config.php'; 

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {   
      $conn = connect_sql();
      
      $username = $_POST['username'];
      $_SESSION ['username']=$username;
      $password = $_POST['password'];
      $_SESSION ['password']=$password;
      
      // Check if username exists in the database
      $query = "SELECT * FROM voters WHERE username = ?";
      $stmt = $conn->prepare($query);
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $result = $stmt->get_result();
      $stmt->close();
      
      if ($result->num_rows > 0) {
          // Username exists, check password
          $row = $result->fetch_assoc();
          $stored_password = $row['password'];
          if ($password== $stored_password) {
              // Passwords match, login successful
              echo "Login successful.";
              
              
              header("Location: ./poll.php");
          } else {
              // Password does not match
              echo "Incorrect password.  ";
              echo "$password, $stored_password";
          }
      } else {
          // Username not found
          echo "Username not found.";
      }
      
      $conn->close();
  }
  ?>
</body>
</html>
